<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Models\User;
use Illuminate\Validation\Rule;


class EmailSendRequest extends FormRequest
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
            'email' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.in' => 'The email address entered is not registered.',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $emails = User::whereNull('deleted_at')->pluck('email')->toArray();

        $validator->sometimes('email', Rule::in($emails), function ($input) {
            return $input->email == true;
        });
    }
}
