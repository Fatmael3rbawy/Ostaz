<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Instructor\ShowProfile;
use App\Http\Requests\Api\Instructor\TakeAttendanceRequest;
use App\Http\Requests\Api\Instructor\UpgradeRequest;
use App\Http\Requests\Api\Payment\PaymentRequest;
use App\Http\Resources\InstructorResource;
use App\Http\Resources\UserResource;
use App\Interfaces\AttachmentAbleRepositoryInterface;
use App\Interfaces\AttachmentRepositoryInterface;
use App\Interfaces\AttendanceRepositoryInterface;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\PaymentsRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Attendance;
use App\Models\CourseUser;
use App\Models\User;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
  use ApiTraits, HelperTrait;
  public $userRepoInterface, $attendanceRepoInterface, $courseRepoInterface , $paymentRepoInterface, $attachmentRepository, $attachmentAbleRepository, $courseRepository;
  public function __construct(UserRepositoryInterface $userRepoInterface, AttendanceRepositoryInterface $attendanceRepoInterface, CourseRepositoryInterface $courseRepoInterface ,
      PaymentsRepositoryInterface $paymentRepoInterface, AttachmentRepositoryInterface $attachmentRepository, AttachmentAbleRepositoryInterface $attachmentAbleRepository, CourseRepositoryInterface $courseRepository)
  {
    $this->userRepoInterface = $userRepoInterface;
    $this->attendanceRepoInterface = $attendanceRepoInterface;
    $this->courseRepoInterface = $courseRepoInterface;
    $this->paymentRepoInterface = $paymentRepoInterface;
    $this->attachmentRepository = $attachmentRepository;
    $this->attachmentAbleRepository = $attachmentAbleRepository;
    $this->courseRepository = $courseRepository;
  }
  public function show($id, Request $request)
  {
    // $show = User::where('type',User::TYPE_INSTRUCTOR)->findOrFail($id);
    $user = $this->userRepoInterface->find($id, $request);
    if ($user->type != User::TYPE_INSTRUCTOR) {
      return $this->responseJsonFailed('this id not belonge to instructor');
    }
    return $this->responseJson(new InstructorResource($user));
  }

  /*
     Upgrade user to insructor
    */
  public function upgrade(UpgradeRequest $request)
  {
    $request = $request->merge(['type'    => User::TYPE_INSTRUCTOR]);
    
    $id = Auth::user()->id;
    $user = $this->userRepoInterface->update($request->all(), $id, $request);
    $user = $this->userRepoInterface->find($id, $request);

    // link area
    $user->areas()->sync($request->areas);

    // link method
    $user->methods()->sync($request->teaching_method);

    // link category 
    $user->specializations()->sync($request->subspecializations);
   
    //upload image
    if ($request->hasFile('image')) {
      $image = $this->uploadImages($request->image , 'users/avatars');
      $oldImage = $request->user()->attachments()->where('key', 'avatar')->first();
      if($oldImage){
          try {
              unlink(public_path().$oldImage->file);
            } catch (\Throwable $th) {
              //throw $th;
            }
            $this->attachmentRepository->destroy($oldImage->id, $request);
      }
      $avtar = $this->attachmentRepository->create(['file' => $image]); 
      $this->attachmentAbleRepository->create([
          'attachment_id' => $avtar->id,
          'attachmentable_id' => $request->user()->id,
          'attachmentable_type' => 'App\Models\User',
          'key' => 'avatar',
      ]); 

    }

    // add cources
    if(isset($request->courses)){
      foreach( $request->courses as $course)
      {
        $course['instructor_id']= $user->id;
        $this->courseRepository->create($course);
      }
    }

    return $this->responseJson(new UserResource($user));
  }

  public function showProfile(ShowProfile $request)
  {
    $instructor = $this->userRepoInterface->find($request->instructor_id, $request);
    if ($instructor->type != User::TYPE_INSTRUCTOR) {
      return $this->responseJsonFailed('this id not belonge to instructor');
    }
    $this->userRepoInterface->update(['views' => (intval($instructor->views) + 1)], $instructor->id, $request);
    return $this->responseJson(new UserResource($instructor));
  }

  public function takeAttendance(TakeAttendanceRequest $request)
  {
    $inst_course =  auth()->user()->instructorCourses()->find($request->course_id);
    //where('id',$request->course_id)->first();
    //return $inst_course;
    if (!$inst_course) {
      return $this->responseJsonFailed("You don't have this course");
    } else {
      $course = $this->courseRepoInterface->find($request->course_id, $request);
      $students = $course->users()->where('course_user.status', CourseUser::ACCEPT_STATUS)->pluck('user_id');
      //get();

      // return $students;
      foreach ($request->attendance_array as  $value) {

        if ($students->contains($value['id'])) {

          $status = Attendance::ATTENDENCE_STATUS;
          if ($value['status'] == 'absent')
            $status = Attendance::ABSENT_STATUS;

          $attributes = [
            'date' => Carbon::parse($request->date),
            'user_id' => $value['id'],
            'course_id' => $request->course_id,
            'status' => $status
          ];

          //CHECK
          $attendance =  Attendance::where([['user_id', $value['id']], ['date', Carbon::parse($request->date)], ['course_id',  $request->course_id]])->exists();
          if ($attendance)
            return $this->responseJsonFailed('The attendance of student '.$value['id'].' already taken');
          $this->attendanceRepoInterface->create($attributes);
        }
        //  return $this->responseJsonFailed('The student has id ' . $value . ' not belonge to this course');
      }
      return $this->responseJson();
    }
  }


  // public function pay(PaymentRequest $request)
  // {
  //   $inst_course =  auth()->user()->instructorCourses->where('id', $request->course_id)->first();
  //   if (!$inst_course) {
  //     return $this->responseJsonFailed("You don't have this course");
  //   } else {
  //     $course = $this->courseRepoInterface->find($request->course_id, $request);
  //     $student = $course->users->where('id', $request->student_id)->where('pivot.status', 1);
  //     if ($student) {
  //       $this->paymentRepoInterface->create($request->validated());
  //       return $this->responseJson();
  //     }
  //     return $this->responseJsonFailed('The student has id ' . $request->student_id . ' not belonge to this course');
  //   }
  // }
}
