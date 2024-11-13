<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyGoodRequest extends FormRequest
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
    public function rules(): array
    {
        //
        return [
            'season_id' => 'required|exists:seasons,id',
            'weight' => 'required|numeric',
            'price_per_kg' => 'required|numeric',
            'total_cost' => 'required|numeric',
            'date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'season_id.required' => 'يرجى اختيار الموسم.',
            'season_id.exists' => 'الموسم الذي اخترته غير موجود.',
            'weight.required' => 'يرجى إدخال الوزن.',
            'weight.numeric' => 'الوزن يجب أن يكون رقماً.',
            'price_per_kg.required' => 'يرجى إدخال السعر لكل كيلو.',
            'price_per_kg.numeric' => 'السعر لكل كيلو يجب أن يكون رقماً.',
            'total_cost.required' => 'يرجى إدخال السعر الكلي.',
            'total_cost.numeric' => 'السعر الكلي يجب أن يكون رقماً.',
            'date.required' => 'يرجى اختيار التاريخ.',
            'date.date' => 'يرجى إدخال تاريخ صحيح.',
        ];
    }
}
