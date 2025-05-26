<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * Returning true means anyone can send this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for the registration form inputs.
     * 
     * - firstname and lastname: required, max 50 characters, only letters, spaces, hyphens, apostrophes.
     * - bod (birthdate): required, must be a valid date.
     * - sex: required, must be either 'Male' or 'Female'.
     * - email: required, must be valid email, must be unique in usersinfo table.
     * - username: required, must be unique in usersinfo table.
     * - password: required, minimum length 8 characters.
     * - terms: must be accepted (checked).
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:50|regex:/^[a-zA-Z\s\'\-]+$/',
            'lastname' => 'required|string|max:50|regex:/^[a-zA-Z\s\'\-]+$/',
            'bod' => 'required|date',
            'sex' => 'required|in:Male,Female',
            'email' => 'required|email|unique:usersinfo,email',
            'username' => 'required|string|unique:usersinfo,username',
            'password' => 'required|string|min:8',
            'terms' => 'accepted',
        ];
    }

    /**
     * Custom error messages for specific validation failures.
     */
    public function messages(): array
    {
        return [
            'firstname.regex' => 'The first name may only contain letters, spaces, hyphens, and apostrophes.',
            'lastname.regex' => 'The last name may only contain letters, spaces, hyphens, and apostrophes.',
        ];
    }

    /**
     * Prepare input data before validation.
     * This normalizes name casing and trims whitespace for firstname, lastname, and username.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'firstname' => ucwords(strtolower(trim($this->firstname))),
            'lastname' => ucwords(strtolower(trim($this->lastname))),
            'username' => trim($this->username),
        ]);
    }
}
