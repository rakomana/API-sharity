<?php

namespace App\Http\Requests\User\Curriculum;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurriculumUpdateRequest extends FormRequest
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
            'nationality' => 'required|string',
            'gender' => 'required|string',
            'languages' => 'required|string',
            'physical_address' => 'required|string',
            'category' => 'required|string',
            'languages' => 'required|string',
            'documents' => 'nullable|string',
            'video' => 'nullable|string',
            'id_or_passport' => [
                'required', 'string',
                Rule::unique('currims', 'id_or_passport')
                    ->ignoreModel($this->user()->curriculum)
            ],
            'phone_number' => [
                'required', 'string',
                Rule::unique('currims', 'phone_number')
                    ->ignoreModel($this->user()->curriculum)
            ],
        ];
    }
}
