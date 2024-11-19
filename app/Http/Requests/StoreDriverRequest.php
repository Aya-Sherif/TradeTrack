<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all for now, or add custom authorization logic.
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'person_id' => 'required|exists:people,id',
            'season_id' => 'required|exists:seasons,id',
            'start_from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'fare' => 'required|numeric|min:0',
            'trip_date' => 'required|date',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'required' => 'هذا الحقل مطلوب.',
            'exists' => 'القيمة المحددة غير موجودة.',
            'numeric' => 'يجب أن تكون القيمة رقمية.',
            'date' => 'يجب أن يكون التاريخ صالحًا.',
        ];
    }
}
