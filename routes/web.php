<?php

use App\Http\Controllers\Dashboard\SpecializationController;
use App\Http\Controllers\Dashboard\AppSettingController;
use App\Http\Controllers\Dashboard\AreaController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\InstructorController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\MethodController;
use App\Http\Controllers\Dashboard\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('login', [AuthenticatedSessionController::class, 'create'])
->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);


Route::middleware(['auth'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');  
    Route::resource('users',UserController::class);
    Route::get('users/block/{id}', [UserController::class, 'block'])->name('users.block');

    Route::resource('instructors',InstructorController::class);
    Route::get('instructors/upgrade/{id}',[InstructorController::class ,'upgrade'])->name('instructors.upgrade');
    Route::post('upgrade/{id}',[InstructorController::class ,'handleUpgrade'])->name('instructors.handleUpgrade');

    Route::resource('courses',CourseController::class)->except('create','index','edit');
    Route::get('cours/{id}',[CourseController::class,'create'])->name('courses.create');
    Route::get('course/{id}/{instructor_id}',[CourseController::class,'edit'])->name('courses.edit');
    Route::get('add-students-course/{course_id}',[CourseController::class,'addStudents'])->name('courses.add.students');
    Route::post('store-students-course',[CourseController::class,'storeStudents'])->name('courses.store.students');

    Route::get('students/{id}',[StudentController::class,'index'])->name('students.index');
    Route::get('edit/{id}/{course_id}',[StudentController::class,'edit'])->name('students.edit');
    Route::put('/update/{id}/',[StudentController::class,'update'])->name('students.update');
    Route::get('/block/{id}/{course_id}', [StudentController::class, 'block'])->name('students.block');


    Route::get('students-payment-list/{student_id}/{course_id}',[StudentController::class,'paymentList'])->name('students.payment');


    Route::post('employees/search',[HomeController::class,'searchEmployee'])->name('employee.search');
    
    Route::resource('employees', EmployeeController::class);
    Route::get('export-excel', [EmployeeController::class, 'exportExcel'])->name('employees.export.excel');
    Route::get('export-pdf', [EmployeeController::class, 'exportPdf'])->name('employees.export.pdf');
    Route::get('employees/block/{id}', [EmployeeController::class, 'block'])->name('employees.block');
    Route::resource('roles', RoleController::class);
    Route::post('roles/block/{role}', [RoleController::class, 'block'])->name('roles.block');
    Route::resource('categories',CategoryController::class);
    Route::resource('sub-categories',SubCategoryController::class);
    Route::get('get-sub-categorie',[CategoryController::class,'getSubByMainCategoryId'])->name('get-subCat');

    //sub specialization extra routes
    // Route::get('sub-specific-specializations/{id}',[SpecializationController::class,"subSpecificSpec"])->name('sub.specific.spec');
    // Route::get('sub-specs',[SpecializationController::class,"allSubSpecs"])->name('sub.specs');
    Route::get('sub-specs/chage-status',[SpecializationController::class,"changeStatus"])->name('changeStatusSpec');
    Route::resource('app-setting', AppSettingController::class);


    Route::get('reports-user', [ReportController::class, 'user'])->name('report.user');
    Route::get('reports-instructor', [ReportController::class, 'instructor'])->name('report.instructor');

    Route::resource('area',AreaController::class);
    Route::resource('method',MethodController::class);

    Route::get('get-areas',[AreaController::class,'getAreabyCityId'])->name('get-area');
});



require __DIR__.'/auth.php';
