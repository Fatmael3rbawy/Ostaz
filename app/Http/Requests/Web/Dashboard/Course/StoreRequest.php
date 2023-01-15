<?php

namespace App\Http\Requests\Web\Dashboard\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'max:250'],
            'duration' => ['required' ,'numeric' ],
            'start_date' => ['required','date'],
            'price' => ['required', 'numeric'],
            'description' => ['string' , 'required'],
            'instructor_id' => ['exists:users,id'],
            'specialization_id' => ['required','exists:specialization_user,specialization_id']
        ];
    }

    
}
