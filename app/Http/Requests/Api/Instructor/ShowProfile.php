<?php

namespace App\Http\Requests\Api\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class ShowProfile extends FormRequest
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
            "instructor_id" => "required|exists:users,id",
        ];
    }
}
