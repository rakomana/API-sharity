<?php

namespace App\Http\Requests\User\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => [
                'required', 'string', 'email',
                Rule::unique('users', 'email')->ignoreModel($this->user())
            ]
        ];
    }
}
