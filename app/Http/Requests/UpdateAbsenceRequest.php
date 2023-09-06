<?php

namespace App\Http\Requests;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAbsenceRequest extends FormRequest
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
        if (Auth::user()->role === UserRoleEnum::User) {
            return [
                'start_date' => ['required', 'date', 'before_or_equal:end_date'],
                'start_hour' => ['required'],
                'end_date' => ['required', 'date', 'after_or_equal:start_date'],
                'end_hour' => ['required'],
                'cause' => ['required', 'string', 'min:2'],
            ];
        } else {
            return [
                'status' => ['required'],
            ];
        }
    }
}
