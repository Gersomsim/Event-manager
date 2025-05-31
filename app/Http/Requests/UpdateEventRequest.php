<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'event_start_date' => 'nullable|date',
            'event_end_date' => 'nullable|date',
            'available_places' => 'nullable|integer',
            'category_id' => 'nullable|uuid|exists:categories,id',
            'location_id' => 'nullable|uuid|exists:locations,id',
        ];
    }
}
