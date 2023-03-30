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
            'username' => 'required|between:3,8|unique:users',
            'password' => 'required|between:8,20|regex:/^[0-9a-zA-z-_]{8,32}$/',
            'password_conf' => 'same:password'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'username is required',
            'username.between' => 'Please enter at within three to ten words.',
            'username.unique' => 'Its username is already registered.',
            'password.required' => 'password is required',
            'password.between' => 'Please enter at within three to ten words.',
            'password.regex' => '半角英数字のみ',
            'password_conf.same' => 'password_conf is not match'
        ];
    }
}
