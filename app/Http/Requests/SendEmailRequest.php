<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email:filter|exists:users,email'
        ];
        // exists:users,emailは、入力されたメールアドレスがusersテーブルに登録されているメールアドレスかを確認します。
        // 入力されたメールアドレスが、usersテーブルに登録されていない場合、バリデーションで弾きます。
    }

    // public function 
}
