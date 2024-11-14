<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyPaymentRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:1',
            'payment_type' => 'required|in:نقدي,تحويل بنك',
            'payment_date' => 'required|date',
            'season_id' => 'required|exists:seasons,id',
            'description' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'حقل المبلغ مطلوب.',
            'amount.numeric' => 'يجب أن يكون المبلغ رقمًا.',
            'amount.min' => 'يجب أن يكون المبلغ أكبر من الصفر.',
            'payment_type.required' => 'حقل طريقة الدفع مطلوب.',
            'payment_type.in' => 'نوع الدفع غير صالح.',
            'payment_date.required' => 'حقل التاريخ مطلوب.',
            'payment_date.date' => 'يجب أن يكون التاريخ بتنسيق صحيح.',
            'season_id.required' => 'حقل الموسم مطلوب.',
            'season_id.exists' => 'الموسم المحدد غير موجود.',
            'description.max' => 'يجب ألا يتجاوز الوصف 255 حرفًا.',
        ];
    }
}
