<?php

namespace App\Http\Requests\Api\Payment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangePaymentStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'date' => ['required','date' ,Rule::exists('payments','date')->where('course_id',request('course_id') )->where('student_id' ,request('student_id') )],
            'student_id' => ["required" ,Rule::exists('payments','student_id')->where('course_id',request('course_id'))],
            'course_id' => "required|exists:courses,id",
            'status' => 'required|in:paid,unpaid,refund,due'
        ];
    }
}
