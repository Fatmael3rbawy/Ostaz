<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dashboard\Course\AddStudentRequest;
use App\Http\Requests\Web\Dashboard\Course\StoreRequest;
use App\Http\Requests\Web\Dashboard\Course\UpdateRequest;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\CourseUserRepositoryInterface;
use App\Interfaces\PaymentsRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    private $userRepoInterface ,$courseRepoInterface, $courseUserRepository, $paymentRepository;
    public function __construct(UserRepositoryInterface $userRepoInterface ,CourseRepositoryInterface $courseRepoInterface, CourseUserRepositoryInterface $courseUserRepository, PaymentsRepositoryInterface $paymentRepository )
    {
      $this->userRepoInterface = $userRepoInterface;
      $this->courseRepoInterface = $courseRepoInterface;
      $this->courseUserRepository = $courseUserRepository;
      $this->paymentRepository = $paymentRepository;
      
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $instructor = $this->userRepoInterface->find($request->id ,$request);
        return view('web.pages.course.create',compact('instructor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->courseRepoInterface->create($request->validated());
        return redirect(route('instructors.show',$request->instructor_id))->with('success', 'Course created successfully');

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
    public function edit($id ,$instructor_id,Request $request)
    {
        $instructor = $this->userRepoInterface->find($instructor_id,$request);
        // dd($instructor->specializations);
        $course = $this->courseRepoInterface->find($id,$request);
        return view('web.pages.course.edit',compact('course','instructor'));
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
        $course = $this->courseRepoInterface->update($request->validated(),$id,$request);
        return redirect(route('instructors.show',$request->instructor_id))->with('success', 'Course updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id ,Request $request)
    {
        $this->courseRepoInterface->destroy($id, $request);
        return back()->with('success', 'Course Deleted Succesfully');
    }


    public function addStudents($course_id,Request $request)
    { 
        $request->merge(['type' => User::TYPE_STUDENT]);
        $students = $this->userRepoInterface->BaseSearch($request)->whereDoesntHave('courses', function($q) use($course_id){
            $q->where('course_id', $course_id);
        })->get();
        return view('web.pages.course.add_students',compact('students','course_id'));
    }

    public function storeStudents(AddStudentRequest $request)
    {   
        $course = $this->courseRepoInterface->find($request->course_id,$request);

        foreach($request->students as $student){
            $student = $this->userRepoInterface->find($student, $request);
            $this->courseUserRepository->create([
                'user_id' => $student->id,
                'course_id' => $request->course_id,
                'status' => CourseUser::ACCEPT_STATUS,
            ]);

            for($i = 1 ; $i <= intval($course->duration) ; $i++){
                $this->paymentRepository->create([
                    'student_id' => $student->id,
                    'course_id' => $request->course_id ,
                   'date' => Carbon::parse($course->start_date)->addMonth($i)->format('y-m-d'),
                    'status' => Payment::STATUS_UNPAID,
                ]); 
            }

        }
        return redirect(route('students.index',$request->course_id))->with('success', 'Students Added successfully');
    }

    
}
