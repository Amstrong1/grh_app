<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveRequest extends FormRequest
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
            'leave_type' => ['required'],
            'user' => ['required'],
            'date_start' => ['required', 'before_or_equal:date_end'],
            'hour_start' => ['required'],
            'date_end' => ['required', 'after_or_equal:date_start'],
            'hour_end' => ['required'],
        ];
    }
}
