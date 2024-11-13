<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'الاسم' => 'required|string|max:255', // Arabic field name for 'name'
        ];
    }

    public function messages()
    {
        return [
            'الاسم.required' => 'يجب ادخال اسم التاجر.',
            'الاسم.max' => 'يجب ألا يزيد الاسم عن 255 حرفًا.',
        ];
    }
}
