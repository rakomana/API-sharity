<?php

namespace App\Http\Requests\User\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
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
            'company_name' => 'required|string',
            'description' => 'required|string',
            'category' => 'nullable|string',
            'website' => [
                'required', 'string', 'url',
                Rule::unique('companies', 'website')->ignore($this->user()->company)
            ],
            'phone_number' => [
                'required', 'digits_between:9,15',
                Rule::unique('companies', 'phone_number')
                    ->ignore($this->user()->company)
            ],
            'email' => [
                'required', 'string', 'email',
                Rule::unique('companies', 'email')->ignore($this->user()->company)
            ]
        ];
    }
}
