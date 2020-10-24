<?php

namespace App\Http\Requests\User\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'phone_number' => 'required|digits_between:9,10|unique:companies',
            'category' => 'nullable|string',
            'website' => 'required|string|max:200|url|unique:companies',
            'email' => 'nullable|string|email|unique:companies'
        ];
    }
}
