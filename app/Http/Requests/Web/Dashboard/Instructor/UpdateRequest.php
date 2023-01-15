<?php

namespace App\Http\Requests\Web\Dashboard\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        // dd(request('id'));

        return [
            'image'                 =>['image'],
            'name'                  => ['string', 'required', 'min:1', 'max:200'],
            'email'                 => ['email', 'required','unique:users,email,'.request('id').''],
            'phone'                 => ['numeric', 'required', 'min:10', 'unique:users,phone, '.request('id').''],
            'whatsapp'              => ['required','numeric', 'min:10', 'unique:users,whatsapp, '.request('id').''],
            'facebook'              => [ 'required','url', 'unique:users,facebook, '.request('id').''],
            'city'                  => ['required'],
            'areas'                  => ['required', 'array', 'min:1'],
            'specializations'        => ['required', 'array', 'min:1'],
            'subspecializations'     => ['required', 'array', 'min:1'],
            'methods '      => [ 'array', 'min:1'],

        ];
    }
}
