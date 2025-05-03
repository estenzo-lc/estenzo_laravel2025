<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'first_name' => 'required|string|max:50|regex:/^[a-zA-Z\s\'\-]+$/',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-Z\s\'\-]+$/',
            'birthday' => 'required|date',
            'sex' => 'required|in:Male,Female',
            'email' => 'required|email|unique:usersinfo,email',
            'username' => 'required|string|unique:usersinfo,username',
            'password' => 'required|string|min:8|confirmed',  // Ensures password confirmation matches
            'terms' => 'accepted',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'first_name.regex' => 'The first name may only contain letters, spaces, hyphens, and apostrophes.',
            'last_name.regex' => 'The last name may only contain letters, spaces, hyphens, and apostrophes.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => ucwords(strtolower(trim($this->first_name))),
            'last_name' => ucwords(strtolower(trim($this->last_name))),
            'username' => trim($this->username),
        ]);
    }
}
