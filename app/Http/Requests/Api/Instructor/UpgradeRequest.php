<?php

namespace App\Http\Requests\Api\Instructor;

use App\Traits\ApiTraits;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpgradeRequest extends FormRequest
{
    use ApiTraits;
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
        $id = Auth::user()->id;
        return [
            
            'phone'                  => ['required', 'unique:users,phone,'.$id],
            'whatsapp'               => ['required', 'unique:users,whatsapp,'.$id] ,
            'facebook'               => ['required','url', 'unique:users,facebook,'.$id],
            'areas'                  => ['required', 'array', 'min:1', 'exists:areas,id'],
            'subspecializations'     => ['required', 'array', 'min:1', 'exists:specializations,id'],
            'image'                  => ['image'],
            'courses'                => ['required', 'array', 'min:1'],

        
            'teaching_method'        => ['required', 'array','min:1'],
            'teaching_method.*'      => ['integer','exists:methods,id'],
            'courses'                => ['nullable','array', 'min:1'], 
            'courses.*.name'         => ['required'],
            'courses.*.description'  => ['required'],
            'courses.*.start_date'   => ['required'],
            'courses.*.duration'     => ['required', 'in:1,2,3,4,5,6,7,8,9,10,11,12'],
            'courses.*.price'        => ['required'],
            'courses.*.specialization_id'  => ['required', 'exists:specializations,id'],
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response =  $this->responseJsonFailedValidate($validator->errors());
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
