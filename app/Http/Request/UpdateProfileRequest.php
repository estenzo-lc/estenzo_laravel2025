<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = session('user');
        return [
            'first_name' => 'required|string|max:50|regex:/^[a-zA-Z\s\'\-]+$/',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-Z\s\'\-]+$/',
            'username' => 'required|string|max:100|unique:usersinfo,username,' . $userId . ',id',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.regex' => 'The first name may only contain letters, spaces, hyphens, and apostrophes.',
            'last_name.regex' => 'The last name may only contain letters, spaces, hyphens, and apostrophes.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => ucwords(strtolower(trim($this->first_name))),
            'last_name' => ucwords(strtolower(trim($this->last_name))),
            'username' => trim($this->username),
        ]);
    }
}