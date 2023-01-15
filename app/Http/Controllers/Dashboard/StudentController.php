<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\Student\UpdateRequest;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\PaymentsRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\CourseUser;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    private $userRepoInterface, $courseRepoInterface , $paymentRepostory;
    public function __construct(UserRepositoryInterface $userRepoInterface, CourseRepositoryInterface $courseRepoInterface, PaymentsRepositoryInterface $paymentRepostory)
    {
        $this->userRepoInterface = $userRepoInterface;
        $this->courseRepoInterface = $courseRepoInterface;
        $this->paymentRepostory = $paymentRepostory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $course = $this->courseRepoInterface->find($id, $request);
        $students = $course->users()->where('course_user.status', CourseUser::ACCEPT_STATUS)->get();
        return view('web.pages.student.index', compact('course', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $student = $this->userRepoInterface->find($id, $request);
        return view('web.pages.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $course = $this->userRepoInterface->update($request->validated(), $id, $request);
        return redirect(route('students.index', $request->course_id))->with('success', 'student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
    }

    public function block($id,$course_id, Request $request)
    {   
        $course =  $this->courseRepoInterface->find($course_id ,$request);
        $student = $course->users()->find($id);
      // dd($student->pivot->status);
        $student->update(['pivot.status' => CourseUser::REJECT_STATUS]);
        return back()->with('success', 'Student Blocked Succesfully');
    }

    public function paymentList(Request $request, $student_id, $course_id)
    {
        $course =  $this->courseRepoInterface->find($course_id ,$request);
        
        $request->merge(['student_id' =>  $student_id, 'course_id' => $course_id]);
        $list = $this->paymentRepostory->listPayments($request); 
        return view('web.pages.student.payment', compact('list', 'course'));

    }
}
