<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\SetLocationRequest;
use App\Http\Requests\Api\Profile\ChangePasswordRequest;
use App\Http\Requests\Api\Profile\DestroyLocationRequest;
use App\Http\Requests\Api\Profile\UpdateRequest;
use App\Http\Requests\Api\User\SubscribCourseRequest;
use App\Http\Resources\AreaCityResource;
use App\Http\Resources\AreaResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\UserResource;
use App\Interfaces\AreaRepositoryInterface;
use App\Interfaces\AttachmentAbleRepositoryInterface;
use App\Interfaces\AttachmentRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\CourseUserRepositoryInterface;
use App\Interfaces\NotificationRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\City;
use App\Models\User;
use App\Traits\ApiTraits;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiTraits , HelperTrait;
    private $UserRepository, $areaRepository, $attachmentRepository, $attachmentAbleRepository, $notificationRepository, $courseUserRepository, $courseRepository, $cityRepo;
    public function __construct(UserRepositoryInterface $UserRepository, AreaRepositoryInterface $areaRepository, AttachmentRepositoryInterface $attachmentRepository,  AttachmentAbleRepositoryInterface $attachmentAbleRepository, NotificationRepositoryInterface $notificationRepository, 
        CourseUserRepositoryInterface $courseUserRepository, CourseRepositoryInterface $courseRepository, CityRepositoryInterface $cityRepo)
    {
        $this->UserRepository = $UserRepository;
        $this->areaRepository = $areaRepository;
        $this->attachmentRepository = $attachmentRepository;
        $this->attachmentAbleRepository = $attachmentAbleRepository;
        $this->notificationRepository = $notificationRepository; 
        $this->courseUserRepository = $courseUserRepository;
        $this->courseRepository = $courseRepository;
        $this->cityRepo = $cityRepo;
    }

    public function profile(Request $request){
        return $this->responseJson(new UserResource($request->user()));
    }

    public function update(UpdateRequest $request){
        $this->UserRepository->update($request->all(), $request->user()->id, $request);
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
        
        $user = $this->UserRepository->find($request->user()->id, $request);
        return $this->responseJson(new UserResource($user));
    }

    public function changePassword(ChangePasswordRequest $request){
        $check = $this->UserRepository->checkPassword($request->old_password , $request->user()->password);
        if($check){
            $this->UserRepository->update(
                [
                    'password' => $request->new_password,
                ], $request->user()->id, $request);
            return $this->responseJson(new UserResource($request->user()));
        }
        return $this->responseJsonFailed('old password incorrect');
    }

    public function allLocation(Request $request){

        // $cities = City::with(['areas' =>function($q) use($request){
        //     $q->whereHas('users', function($q) use($request){
        //         $q->where('user_id', $request->user()->id);
        //     });
        // }])->whereHas('areas', function($q) use($request){
        //     $q->whereHas('users', function($q) use($request){
        //         $q->where('user_id', $request->user()->id);
        //     });
        // })->get();
        $request->merge([
            'cityWithAreaByUser' => $request->user()->id,
            'activeAreaCityByUser' => $request->user()->id,
        ]);
        $cities = $this->cityRepo->BaseSearch($request);
        return $this->responseJson((AreaCityResource::collection($cities->get())));
        // return $this->responseJson(AreaResource::collection($this->areaRepository->allUserLocation($request->user())));
    }
    

    public function setLocation(SetLocationRequest $request)
    {
        $this->UserRepository->addArea($request->user(), $request->areas_id);   
        // $area = $this->areaRepository->find($request->area_id, $request);
        return $this->responseJson();
    }

    public function destroyLocation(DestroyLocationRequest $request){
        $this->UserRepository->destroyArea($request->user(), $request->area_id);
        return $this->responseJson();
    }

    public function subscribCourse(SubscribCourseRequest $request){
        $user = $request->user();
        $course = $this->courseRepository->find($request->course_id, $request);
        $old = $this->courseUserRepository->checkifExist($user->id, $request->course_id);
        if($old){
            return $this->responseJsonFailed('User already subscribed');
        }
        $notification_data=[
            'message' => $user->name.' ask to goin '.$course->name ,
            'sender_id' => $user->id,
            'receiver_id' => $course->instructor_id,
            'course_id' => $request->course_id,
        ];
        $course_user_data=[
            'user_id' => $user->id,
            'course_id' => $request->course_id,
        ];
        $notifcation = $this->notificationRepository->create($notification_data);
        $this->courseUserRepository->create($course_user_data);
        
        $instructor_token = $course->instructor->devicToken;
        if($instructor_token){
            $tokens = [$instructor_token['device_token']];
            $notification_message=[
                'title' => 'Course Request',
                'body' => $notifcation->message,
            ];
            $additional_data = [
                'notifcation_id' => $notifcation->id,
            ];
            $this->sendNotification($tokens, $notification_message, $additional_data);
        }
        return $this->responseJson();
    }

    public function userCourses(Request $request){
        $user = $request->user();

        if($user->type == User::TYPE_INSTRUCTOR){
            $courses = $user->instructorCourses;
        }else{
            $courses = $user->courses;
        }
        return $this->responseJson(CourseResource::collection($courses));
    }

   
}
