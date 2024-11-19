<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255', // Validate the name field
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages()
    {
        return [
            'name.required' => 'اسم العامل مطلوب.',
            'name.string' => 'اسم العامل يجب أن يكون نص.',
            'name.max' => 'اسم العامل يجب ألا يتجاوز 255 حرف.',
        ];
    }
}
