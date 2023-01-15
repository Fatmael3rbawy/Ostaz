<?php

namespace App\Http\Requests\Web\Dashboard\Instructor;

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

            'name'                  => ['string', 'required', 'min:1', 'max:200'],
            'email'                 => ['email', 'required','unique:users,email'],
            'phone'                 => ['numeric', 'required', 'min:10', 'unique:users,phone'],
            'whatsapp'              => ['numeric', 'required', 'min:10', 'unique:users,whatsapp'],
            'facebook'              => ['string', 'required','url', 'unique:users,facebook'],
            'city'                  => ['required'],
            'country'               => ['required'],
            'areas'                  => ['required', 'array', 'min:1'],
            'subspecializations'        => ['required', 'array', 'min:1'],

        ];
    }
}
