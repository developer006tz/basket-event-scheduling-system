<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventStatisticsStoreRequest extends FormRequest
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
            'games_id' => ['required', 'exists:games,id'],
            'players_id' => ['required', 'exists:players,id'],
            'points' => ['required', 'numeric'],
            'rebounds' => ['required', 'numeric'],
            'assists' => ['required', 'numeric'],
            'blocks' => ['required', 'numeric'],
            'steals' => ['required', 'numeric'],
        ];
    }
}
