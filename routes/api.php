<?php

use App\Http\Controllers\Api\AppSettingController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\SpecializationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\MethodController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\HomePageController;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
Route::post('refresh-token', [AuthController::class, 'refreshToken']);
// App Setting
Route::get('app-setting', [AppSettingController::class, 'index']);



Route::middleware('auth:sanctum')->group(function () {
  Route::get('logout', [AuthController::class, 'logout']);

  // profile
  Route::get('profile', [UserController::class, 'profile']);
  Route::post('update-profile', [UserController::class, 'update']);
  Route::post('change-password', [UserController::class, 'changePassword']);
  Route::get('all-user-location', [UserController::class, 'allLocation']);
  Route::post('set-location', [UserController::class, 'setLocation']);
  Route::post('destroy-location', [UserController::class, 'destroyLocation']);

  // wishlist
  Route::post('like-dislike', [WishlistController::class, 'likeDislike']);
  Route::get('wishlist', [WishlistController::class, 'list']);

  // method
  Route::post('create-method', [MethodController::class, 'store']);
  Route::get('method-list', [MethodController::class, 'list']);


  //Instructor
  Route::get('instructors/{id}', [InstructorController::class, 'show']);
  Route::post('upgrade', [InstructorController::class, 'upgrade']);
  Route::post('take/attendance', [InstructorController::class, 'takeAttendance']);
  Route::post('show-profile', [InstructorController::class, 'showProfile']);


    //courses
    Route::get('course/students/{id}', [CourseController::class, 'listCourseStudents']);
    Route::post('course/handle-course-request', [CourseController::class, 'handleCourseRequest']);
    Route::get('add-students-course/{course_id}',[CourseController::class,'addStudents']);
    Route::post('store-students-course',[CourseController::class,'storeStudents']);
    
    Route::post('course-create', [CourseController::class, 'create']);
    Route::post('course-update', [CourseController::class, 'update']);
    Route::post('course-destroy', [CourseController::class, 'destroy']);
    Route::get('course-list', [CourseController::class, 'list']);

    //payment module 
    Route::post('list', [PaymentController::class, 'listOfStudentPayments']);
    Route::post('change/status', [PaymentController::class, 'changePaymentStatus']);


  //user
  Route::post('course-subscrib', [UserController::class, 'subscribCourse']);
  Route::get('my-courses', [UserController::class, 'userCourses']);
});

//homepage
Route::post('search', [HomePageController::class, 'search']);
Route::get('home', [HomePageController::class, 'index']);

// Category & Sub Category
Route::get('specializations', [SpecializationController::class, 'index']);
Route::get('specializations/{id}', [SpecializationController::class, 'showSubSpecializations']);
Route::get('subSpecializations/{id}', [SpecializationController::class, 'showSubSpecializationsWithInstructors']);

// city
Route::get('city-list', [CityController::class, 'list']);
// area
Route::post('area-list', [AreaController::class, 'listByCitiesId']);
