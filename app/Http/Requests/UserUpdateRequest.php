<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->user),
                'email',
            ],
            'phone' => ['nullable', 'max:255', 'string'],
            'maritial_status' => ['nullable', 'in:single,maried'],
            'address' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'password' => ['nullable'],
            'roles' => 'array',
        ];
    }
}
