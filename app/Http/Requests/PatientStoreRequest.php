<?php

//-----------------------------------------------------//
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // You can add authorization logic here if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:patients|max:255',
            'gender' => 'required|string|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'phone' => 'required|string|max:20',
            'emergency_contact' => 'required|string|max:20',
            'address' => 'nullable|string',
            'referral' => 'nullable|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB for picture
            'files' => 'nullable|array',
            'files.*' => 'nullable|file|max:10240', // Max 10MB per file
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
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'gender.required' => 'Please select a gender.',
            'gender.in' => 'Please select a valid gender.',
            'date_of_birth.date' => 'Please enter a valid date.',
            'phone.max' => 'The phone number cannot exceed 20 characters.',
            'emergency_contact.max' => 'The emergency contact cannot exceed 20 characters.',
            'emergency_contact.required' => 'The emergency contact field is required.',
            'referral.max' => 'The referral cannot exceed 255 characters.',
            'picture.image' => 'The picture must be an image.',
            'picture.mimes' => 'The picture must be a file of type: jpeg, png, jpg, gif, svg.',
            'picture.max' => 'The picture must not be greater than 2MB.',
            'files.*.file' => 'Each file must be a valid file.',
            'files.*.max' => 'Each file must not be greater than 10MB.',
        ];
    }
}