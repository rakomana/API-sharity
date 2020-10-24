<?php

namespace App\Http\Requests\User\Curriculum;

use Illuminate\Foundation\Http\FormRequest;

class CurriculumStoreRequest extends FormRequest
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
            'id_or_passport' => 'required|string|unique:currims',
            'nationality' => 'required|string',
            'gender' => 'required|string',
            'physical_address' => 'required|string',
            'category' => 'required|string',
            'languages' => 'required|string',
            'phone_number' => 'required|string|unique:currims',
            'documents' => 'nullable|string',//rm
            'video' => 'nullable|file',//rm
        ];
    }
}
