<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Course\HandleCourseRequest;
use App\Http\Requests\Api\Course\AddStudentRequest;
use App\Http\Requests\Api\Course\CreateRequest;
use App\Http\Requests\Api\Course\DestroyRequest;
use App\Http\Requests\Api\Course\UpdateRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\StudentResource;
use App\Http\Resources\UserResource;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\CourseUserRepositoryInterface;
use App\Interfaces\NotificationRepositoryInterface;
use App\Interfaces\PaymentsRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Payment;
use App\Models\User;
use App\Traits\ApiTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends Controller
{
  use ApiTraits;
  public $courseRepoInterface, $userRepoInterface, $notificationRepository, $courseUserRepository, $paymentRepository;

  public function __construct(CourseRepositoryInterface $courseRepoInterface, UserRepositoryInterface $UserRepository, NotificationRepositoryInterface $notificationRepository, CourseUserRepositoryInterface $courseUserRepository, PaymentsRepositoryInterface $paymentRepository)
  {
    $this->courseRepoInterface = $courseRepoInterface;
    $this->notificationRepository = $notificationRepository;
    $this->courseUserRepository = $courseUserRepository;
    $this->userRepoInterface = $UserRepository;
    $this->paymentRepository = $paymentRepository;
  }


  public function listCourseStudents($id, Request $request)
  {
    if($request->user()->type != User::TYPE_INSTRUCTOR){
      return $this->responseJsonFailed("no access");
    }
    $course = $this->courseRepoInterface->find($id, $request);
    $inst_course =  auth()->user()->instructorCourses()->where('id', $course->id)->first();
    if ($inst_course) {
      $students = $inst_course->users;
      return $this->responseJson(UserResource::collection($students));
    } else
      return $this->responseJsonFailed("You don't have this course");
  }

  public function handleCourseRequest(HandleCourseRequest $request)
  {
    $notification = $this->notificationRepository->find($request->notification_id, $request);
    $check = $this->courseUserRepository->checkifExist($notification->sender_id, $notification->course_id);
    if ($check->status != CourseUser::PENDING_STATUS) {
      return $this->responseJsonFailed('action already taken');
    }
    $status = CourseUser::ACCEPT_STATUS;
    if ($request->action == 'reject') {
      $status = CourseUser::REJECT_STATUS;
    }
    $this->courseUserRepository->update(['status' => $status], $check->id, $request);
    return $this->responseJson();
  }

  public function addStudents($course_id, Request $request)
  {
     $this->courseRepoInterface->find($course_id, $request);
    $request->merge(['type' => User::TYPE_STUDENT]);
    $students = $this->userRepoInterface->BaseSearch($request)->whereDoesntHave('courses', function ($q) use ($course_id) {
      $q->where('course_id', $course_id);
    })->get();
    // return $students;
    return $this->responseJson(StudentResource::collection($students));
  }


  public function storeStudents(AddStudentRequest $request)
  {
    $course = $this->courseRepoInterface->find($request->course_id, $request);

    foreach ($request->students as $student_id) {
      $student = User::where(['id'=> $student_id ,'type' =>User::TYPE_STUDENT])->first();
     //return $student;
      if(!$student)
        return $this->responseJsonFailed('Student ' . $student_id . ' is not found');
     // $student = $this->userRepoInterface->find($student, $request);
    // if($student->type != User::TYPE_STUDENT)
     
      $is_join = $student->courses()->find($request->course_id);
      if ($is_join)
        return $this->responseJsonFailed('Student ' . $student->id . ' already join this course');
      $this->courseUserRepository->create([
        'user_id' => $student->id,
        'course_id' => $request->course_id,
        'status' => CourseUser::ACCEPT_STATUS,
      ]);

      for ($i = 1; $i <= intval($course->duration); $i++) {
        $this->paymentRepository->create([
          'student_id' => $student->id,
          'course_id' => $request->course_id,
          'date' => Carbon::parse($course->start_date)->addMonth($i)->format('y-m-d'),
          'status' => Payment::STATUS_UNPAID,
        ]);
      }
    }
    return $this->responseJson();
  }

  public function create(CreateRequest $request)
  {
      $instructor = $request->user();
      if($instructor->type != User::TYPE_INSTRUCTOR){
        return $this->responseJsonFailed('this user not have access to add course');
      }
      $request->merge(['instructor_id' => $instructor->id]);
      $this->courseRepoInterface->create($request->all());
      return $this->responseJson();
  }

  public function update(UpdateRequest $request)
  {
    $instructor = $request->user();
    $course = $this->courseRepoInterface->find($request->course_id, $request);
    if($instructor->type != User::TYPE_INSTRUCTOR){
      return $this->responseJsonFailed('this user not have access to add course');
    }
    if($instructor->id != $course->instructor_id){
      return $this->responseJsonFailed('this user not have access to edit this course');
    }

    $request['PaiedByCourseId'] = $request->course_id;
    $paid_users = $this->paymentRepository->BaseSearch($request)->count();
    if($paid_users > 0 ){
      return $this->responseJsonFailed('this course can not edit');
    }
    $this->courseRepoInterface->update($request->all(), $request->course_id, $request);
    return $this->responseJson();

  }


  public function destroy(DestroyRequest $request)
  {
    $instructor = $request->user();
    $course = $this->courseRepoInterface->find($request->course_id, $request);
    if($instructor->id != $course->instructor_id){
      return $this->responseJsonFailed('this instructor not have access to delete this course');
    }

    $request['PaiedByCourseId'] = $request->course_id;
    $paid_users = $this->paymentRepository->BaseSearch($request)->count();
    if($paid_users > 0 ){
      return $this->responseJsonFailed('this course can not edit');
    }
    $this->courseRepoInterface->destroy($request->course_id, $request);
    return $this->responseJson();
  }

  public function list(Request $request){
    $user = $request->user();
    $courses = $user->instructorCourses;
    if($user->type == User::TYPE_STUDENT){
      $courses = $user->userCourses;
    }
    return $this->responseJson(CourseResource::collection($courses));
  }
}
