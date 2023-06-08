<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationsUpdateRequest extends FormRequest
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
            'games_id' => ['nullable', 'exists:games,id'],
            'practices_id' => ['nullable', 'exists:practices,id'],
            'event_types_id' => ['required', 'exists:event_types,id'],
            'title' => ['required', 'max:255', 'string'],
            'message' => ['required', 'max:255', 'string'],
            'sent_at' => ['required', 'date'],
        ];
    }
}
