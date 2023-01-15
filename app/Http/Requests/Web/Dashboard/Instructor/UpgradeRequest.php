<?php

namespace App\Http\Requests\Web\Dashboard\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class UpgradeRequest extends FormRequest
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
        //dd(request('user_id'));

        return [
            'image'                 =>['image'],
            'name'                  => ['string', 'required', 'min:1', 'max:200'],
            'email'                 => ['email', 'required','unique:users,email,'.request('user_id').''],
            'phone'                 => ['numeric', 'required', 'min:10', 'unique:users,phone, '.request('user_id').''],
            'whatsapp'              => ['numeric', 'required', 'min:10', 'unique:users,whatsapp, '.request('user_id').''],
            'facebook'              => [ 'required','url', 'unique:users,facebook, '.request('user_id').''],
            'city'                  => ['required'],
            'country'               => ['required'],
            'areas'                  => ['required', 'array', 'min:1'],
            'subspecializations'        => ['required', 'array', 'min:1'],

        ];
    }
}
