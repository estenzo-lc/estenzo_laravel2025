<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => 'required|array',
            'file.*' => 'file|mimes:pdf,png,jpeg,jpg,docx,txt|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Please upload at least one file.',
            'file.*.mimes' => 'Only PDF, PNG, JPEG, DOCX, and TXT files are allowed.',
            'file.*.max' => 'Each file must not exceed 10MB.',
        ];
    }
}