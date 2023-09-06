<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCareerRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'firstname' => ['required', 'string', 'max:255', 'min:2'],
            'birthday' => ['required', 'date'],
            'marital_status' => ['required', 'string'],
            'child' => ['required', 'numeric'],
            'email' => ['required', 'email:filter', 'unique:users,email'],
            'contact' => ['required',],
            'place' => ['required'],
            'sex' => ['required'],
            'diploma' => ['required', 'string', 'max:255', 'min:2'],
            'contract' => ['required'],
            'contract_start' => ['required'],
            'contract_end' => ['exclude_if:contract,CDI', 'required', 'after_or_equal:contract_start'],
        ];
    }
}
