<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Payment\ChangePaymentStatusRequest;
use App\Http\Requests\Api\Payment\ListPaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\PaymentsRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\CourseUser;
use App\Models\Payment;
use App\Traits\ApiTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use ApiTraits;
    public $userRepoInterface, $courseRepoInterface, $paymentRepoInterface;
    public function __construct(UserRepositoryInterface $userRepoInterface, PaymentsRepositoryInterface $paymentRepoInterface, CourseRepositoryInterface $courseRepoInterface)
    {
        $this->userRepoInterface = $userRepoInterface;
        $this->courseRepoInterface = $courseRepoInterface;
        $this->paymentRepoInterface = $paymentRepoInterface;
    }

    public function listOfStudentPayments(ListPaymentRequest $request)
    {
        $inst_course =  auth()->user()->instructorCourses->where('id', $request->course_id)->first();
        if (!$inst_course) {
            return $this->responseJsonFailed("You don't have this course");
        } else {
            $course = $this->courseRepoInterface->find($request->course_id, $request);
            //  return $course->users;
            if ($course->users()->count() < 1)
                return $this->responseJsonFailed("The selected course don't have any students");
            $student = $course->users()->where('user_id', $request->student_id)->where('course_user.status', CourseUser::ACCEPT_STATUS)->first();
            //    return $student;
            if (!$student)
                return $this->responseJsonFailed('The student has id ' . $request->student_id . ' not belonge to this course');
            $payments = $this->paymentRepoInterface->listPayments($request);
            return $this->responseJson(PaymentResource::collection($payments));
        }
        // $payments= Payment::where(['course_id' => $request->course_id],['student_id' => $request->student_id])->get();
    }

    public function changePaymentStatus(ChangePaymentStatusRequest $request)
    {
        // $this->paymentRepoInterface
        $course =  $this->courseRepoInterface->find($request->course_id, $request);
       // $date = Carbon::parse($course->start_date)->diffInMonths($request->date);
        // return $date;
        $record = Payment::where(['student_id' => $request->student_id, 'course_id' => $request->course_id, 'date' => $request->date])->first();
        // return $record;
        if (!$record)
            return 'false';
        $status = '';
        switch ($request->status) {
            case 'paid':
                $status = Payment::STATUS_PAID;
                break;
            case 'unpaid':
                $status = Payment::STATUS_UNPAID;
                break;
            case 'refund':
                $status = Payment::STATUS_REFUND;
                break;
            default:
                $status = Payment::STATUS_DUE;
                break;
        }
        $this->paymentRepoInterface->update(['status' => $status], $record->id, $request);
        return $this->responseJson();
    }
}
