<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    // File upload method
    public function uploadFile(Request $request)
    {
        // Validate the request
        $request->validate([
            'file' => 'required|file|mimes:png,jpg,jpeg,pdf|max:10240',
        ]);

        // Handle the file upload
        $file = $request->file('file');
        $originalFilename = $file->getClientOriginalName();
        $filename = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        // Store upload information in the database
        Upload::create([
            'original_filename' => $originalFilename,
            'filename' => $filename,
            'type' => $file->getMimeType(),
            'uploaded_by' => auth()->id(), // assuming user is authenticated
        ]);

        return response()->json(['message' => 'File uploaded successfully']);
    }
}
