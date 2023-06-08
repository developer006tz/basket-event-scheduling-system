<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamsUpdateRequest extends FormRequest
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
            'coaches_id' => ['required', 'exists:coaches,id'],
            'image' => ['nullable', 'image', 'max:1024'],
            'location' => ['required', 'max:255', 'string'],
        ];
    }
}
