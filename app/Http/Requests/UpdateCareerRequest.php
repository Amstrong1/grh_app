<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCareerRequest extends FormRequest
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
            'user_name' => ['required', 'string', 'max:255', 'min:2'],
            'user_firstname' => ['required', 'string', 'max:255', 'min:2'],
            'user_email' => ['required', 'email:filter'],
            'marital_status' => ['required', 'string', 'max:255', 'min:2'],
            'child' => ['required', 'numeric'],
            'birthday' => ['required', 'date'],
            'contact' => ['required'],
            'post_name' => ['required'],
            'diploma' => ['required', 'string', 'max:255', 'min:2'],
            'contract' => ['required'],
            'sex' => ['required'],
            'contract_start' => ['required', 'date'],
            'contract_end' => ['exclude_if:contract,CDI', 'required', 'after_or_equal:contract_start'],
        ];
    }
}
