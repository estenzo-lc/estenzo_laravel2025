<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Authorizes all users to make this request
    }

    public function rules(): array
    {
        return [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:new_password',
        ];
    }

    public function messages(): array
    {
        return [
            'confirm_password.same' => 'New passwords do not match.',
            'new_password.min' => 'New password must be at least 8 characters.',
        ];
    }
}