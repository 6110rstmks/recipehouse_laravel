<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'between:3,8|unique:users',
            'password' => 'required|between:8,20|confirmed|regex:/[A-Za-z0-9]{8,21}/'
        ];
    }

    public function messages()
    {
        return [
            'username.between' => 'Please enter at within three to ten words.',
            'username.unique' => 'Its username is already registered.'
        ];
    }
}
