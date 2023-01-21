<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
            'body' => 'required|min:3',
            'image' => 'mimes:jpeg,png,gif,jpg',
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'recipe title is required',
            'body.min' => 'Please enter at least :min character',
        ];
    }
}
