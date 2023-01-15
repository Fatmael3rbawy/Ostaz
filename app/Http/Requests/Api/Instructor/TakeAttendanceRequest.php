<?php

namespace App\Http\Requests\Api\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class TakeAttendanceRequest extends FormRequest
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
            'date' => 'required|date',
            'attendance_array' => 'array|required',
            "attendance_array.id*" => "required|exists:users,id",
            "attendance_array.status*" =>"required|in:attend,absent",
            'course_id' => "required|exists:courses,id",
        ];
    }
}
