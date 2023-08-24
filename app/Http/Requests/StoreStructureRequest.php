<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStructureRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'adresse' => ['required', 'string', 'min:3', 'max:255'],
            'contact' => ['required'],
            'email' => ['required', 'unique:structures', 'email:filter'],
            'ifu' => ['required', 'numeric', 'digits:13'],
            'rccm' => ['required', 'min:10', 'max:20'],
            'logo' => ['required', 'image', 'max:5000'],
        ];
    }
}
