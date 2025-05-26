<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Allow any authenticated user to update their profile
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
            // First name is required, must be string, max length 50, 
            // and only letters, spaces, hyphens, apostrophes allowed
            'first_name' => 'required|string|max:50|regex:/^[a-zA-Z\s\'\-]+$/',

            // Last name has the same validation rules as first name
            'last_name' => 'required|string|max:50|regex:/^[a-zA-Z\s\'\-]+$/',

            // Username is required, string, max length 100, and unique in usersinfo table
            // Exclude current user's ID from uniqueness check
            'username' => 'required|string|max:100|unique:usersinfo,username,' . session('user')->id . ',id',
        ];
    }

    /**
     * Custom error messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'first_name.regex' => 'The first name may only contain letters, spaces, hyphens, and apostrophes.',
            'last_name.regex' => 'The last name may only contain letters, spaces, hyphens, and apostrophes.',
        ];
    }

    /**
     * Prepare data for validation by normalizing inputs.
     * 
     * This method trims whitespace, converts names to lowercase then
     * capitalizes each word, and trims the username.
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
