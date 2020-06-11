<?php

namespace App\Http\Requests\User;

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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first' => 'required|string',
            'last' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'type' => 'required|string',
            'phone' => [
                'required', 'digits_between:9,15', 'unique:users'
            ],
            'password' => 'required|string|confirmed|min:8'
        ];
    }
}
