<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GamesStoreRequest extends FormRequest
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
            'home_team_id' => ['required', 'max:255'],
            'away_team_id' => ['required', 'max:255'],
            'location' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i:s'],
            'result' => ['nullable', 'max:255', 'string'],
            'result_status' => ['nullable', 'in:1,3,2'],
        ];
    }
}
