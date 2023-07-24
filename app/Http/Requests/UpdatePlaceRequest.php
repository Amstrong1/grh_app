<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaceRequest extends FormRequest
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
            'department' => 'required',
            'name' => 'required|string|min:2|max:255',
            'basis_wage' => 'required_without:hourly_rate|numeric',
            'hourly_rate' => 'required_without:basis_wage|numeric',
            'overtime_rate' => 'required_without:basis_wage|numeric',
            'overtime_rate_week' => 'required_without:basis_wage'
        ];
    }
}
