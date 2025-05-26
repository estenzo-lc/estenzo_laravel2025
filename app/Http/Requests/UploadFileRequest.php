<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Allow all users to upload files (adjust as needed for authentication)
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
            // The 'file' input is required and must be an array (for multiple files)
            'file' => 'required|array',

            // Each file in the 'file' array must be a file and have one of the allowed MIME types
            // Allowed types: pdf, png, jpeg, jpg, docx, txt
            // Max size for each file: 10240 kilobytes (10 MB)
            'file.*' => 'file|mimes:pdf,png,jpeg,jpg,docx,txt|max:10240',
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
            'file.required' => 'Please upload at least one file.',
            'file.*.mimes' => 'Only PDF, PNG, JPEG, DOCX, and TXT files are allowed.',
            'file.*.max' => 'Each file must not exceed 10MB.',
        ];
    }
}
