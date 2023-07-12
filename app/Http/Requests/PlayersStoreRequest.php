<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayersStoreRequest extends FormRequest
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
            'email' => ['required', 'unique:users,email', 'email'],
            'phone' => ['nullable', 'max:255', 'string'],
            'maritial_status' => ['nullable', 'in:single,maried'],
            'address' => ['nullable', 'max:255', 'string'],
            'password' => ['required'],
            'team_id' => ['required', 'exists:teams,id'],
            'jersey_number' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
        ];
    }
}
