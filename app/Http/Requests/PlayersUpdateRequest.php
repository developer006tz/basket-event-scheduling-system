<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayersUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'team_id' => ['required', 'exists:teams,id'],
            'jersey_number' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
        ];
    }
}
