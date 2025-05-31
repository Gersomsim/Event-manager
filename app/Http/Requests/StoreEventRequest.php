<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:events,name',
            'description' => 'nullable|string',
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date',
            'available_places' => 'nullable|integer',
            'category_id' => 'required|uuid|exists:categories,id',
            'location_id' => 'required|uuid|exists:locations,id',
        ];
    }
}
