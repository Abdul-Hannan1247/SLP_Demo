<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // You can add authorization logic here if needed.
        // For now, let's assume all authenticated users can create appointments.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'patient_name' => 'required|string|max:255',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:500', // Example max length for notes
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'patient_name.required' => 'The patient name field is required.',
            'patient_name.string' => 'The patient name must be a string.',
            'patient_name.max' => 'The patient name cannot exceed 255 characters.',
            'date.required' => 'The appointment date is required.',
            'date.date_format' => 'The appointment date must be in the format YYYY-MM-DD.',
            'time.required' => 'The appointment time is required.',
            'time.date_format' => 'The appointment time must be in the format HH:MM (e.g., 09:00 or 14:30).',
            'notes.string' => 'The notes must be a string.',
            'notes.max' => 'The notes cannot exceed 500 characters.',
        ];
    }
}