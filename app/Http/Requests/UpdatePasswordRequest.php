<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        // Allow any authenticated user to update password
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * @return array
     */
    public function rules(): array
    {
        return [
            // Old password is required and must be a string
            'old_password' => 'required|string',

            // New password is required, string, minimum length 8
            'new_password' => 'required|string|min:8',

            // Confirm password is required, string, and must match new_password exactly
            'confirm_password' => 'required|string|same:new_password',
        ];
    }

    /**
     * Custom error messages for validation failures.
     * 
     * @return array
     */
    public function messages(): array
    {
        return [
            // Custom message when confirm_password does not match new_password
            'confirm_password.same' => 'New passwords do not match.',
        ];
    }
}

// This class handles validation of password update requests, ensuring
// the old password is provided, the new password meets length requirements,
// and that the new password confirmation matches exactly.
