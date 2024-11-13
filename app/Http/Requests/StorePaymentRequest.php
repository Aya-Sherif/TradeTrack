<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Allow all users, you can modify it if you have any authorization checks
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_date' => 'required|date|before_or_equal:today', // Ensure the payment date is valid and not in the future
            'payment_type' => 'required|string|in:cash,credit,debit', // Payment type must be one of: cash, credit, or debit
            'season_id' => 'required|exists:seasons,id', // Ensure the season exists in the database
            'amount' => 'required|numeric|min:0', // Amount should be a positive number
            'description' => 'nullable|string|max:1000', // Description is optional but should not exceed 255 characters
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'payment_date.required' => 'تاريخ الدفع مطلوب.',
            'payment_date.date' => 'يجب أن يكون تاريخ الدفع بتاريخ صالح.',
            'payment_date.before_or_equal' => 'لا يمكن أن يكون تاريخ الدفع في المستقبل.',
            'payment_type.required' => 'نوع الدفع مطلوب.',
            'payment_type.in' => 'يجب أن يكون نوع الدفع واحد من: نقدي، بطاقة ائتمان، بطاقة خصم.',
            'season_id.required' => 'رقم الموسم مطلوب.',
            'season_id.exists' => 'الموسم المحدد غير موجود.',
            'amount.required' => 'المبلغ مطلوب.',
            'amount.numeric' => 'يجب أن يكون المبلغ رقماً صالحاً.',
            'amount.min' => 'يجب أن يكون المبلغ رقماً إيجابياً.',
            'description.max' => 'الوصف لا يمكن أن يتجاوز 255 حرفاً.',
        ];
    }
}
