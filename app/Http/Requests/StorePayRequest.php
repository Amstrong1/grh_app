<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user' => ['required'],
            'period_start' => ['required', 'before:period_end'],
            'period_end' => ['required', 'after:period_start'],
            'overtime_done' => ['required'],
            'overtime_done_week' => ['required'],
            'pay_date' => ['required'],
        ];
    }
}
