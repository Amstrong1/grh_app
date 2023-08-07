<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceLogRequest extends FormRequest
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
            "structure_id" => "required|string",
            "user_id" => "required|string",
            "reader_id" => "required|string",
            "log_date" => "required|string",
            "log_time" => "required|string",
            "direction" => "required|string",
        ];
    }
}
