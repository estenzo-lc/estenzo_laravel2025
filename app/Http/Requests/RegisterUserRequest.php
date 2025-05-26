<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        // Allow all users to make this request (registration is open)
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
            // First name is required, max length 50, only letters, spaces, hyphens, apostrophes allowed
            'firstname' => 'required|string|max:50|regex:/^[a-zA-Z\s\'\-]+$/',

            // Last name with same rules as first name
            'lastname' => 'required|string|max:50|regex:/^[a-zA-Z\s\'\-]+$/',

            // Birthday must be a valid date and required
            'bod' => 'required|date',

            // Sex must be either 'Male' or 'Female' and required
            'sex' => 'required|in:Male,Female',

            // Email is required, must be a valid email format and unique in usersinfo table
            'email' => 'required|email|unique:usersinfo,email',

            // Username is required, string, and unique in usersinfo table
            'username' => 'required|string|unique:usersinfo,username',

            // Password required, must be a string with minimum 8 characters
            'password' => 'required|string|min:8',

            // Terms must be accepted (checkbox)
            'terms' => 'accepted',
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
            'firstname.regex' => 'The first name may only contain letters, spaces, hyphens, and apostrophes.',
            'lastname.regex' => 'The last name may only contain letters, spaces, hyphens, and apostrophes.',
        ];
    }

    /**
     * Prepare the data for validation before the validation runs.
     * This trims and formats names and username for consistency.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            // Trim whitespace, convert to lowercase then capitalize first letters of each word for firstname
            'firstname' => ucwords(strtolower(trim($this->firstname))),

            // Same formatting for lastname
            'lastname' => ucwords(strtolower(trim($this->lastname))),

            // Trim whitespace from username
            'username' => trim($this->username),
        ]);
    }
}
