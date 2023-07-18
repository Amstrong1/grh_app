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
                'absence_date' => ['required', 'date'],
                'cause' => ['required', 'string', 'max:255', 'min:2'],
            ];
        } else {
            return [
                'status' => ['required'],
            ];
        }
    }
}
