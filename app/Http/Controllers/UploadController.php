<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * Show the upload form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('upload');
    }

    /**
     * Handle storing multiple uploaded files.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Loop through each uploaded file from the input named 'file'
        foreach ($request->file('file') as $file) {
            // Generate a unique hashed filename to avoid collisions
            $hashedName = $file->hashName();

            // Store the file in the 'uploads' folder within the 'public' disk
            $file->storeAs('uploads', $hashedName, 'public');

            // Create a new record in the Uploads table with metadata
            Upload::create([
                'original_filename' => $file->getClientOriginalName(), // Original client filename
                'filename' => $hashedName,                              // Stored filename
                'type' => $file->getClientMimeType(),                   // MIME type of the file
                'uploaded_by' => session('user')->id,                   // ID of the uploader (from session)
            ]);
        }

        // Redirect back to the upload page with a success message
        return redirect()->route('upload.index')->with('success', 'Files uploaded successfully.');
    }

    /**
     * Display a paginated list of uploads for the logged-in user,
     * with optional filtering by filename or file type.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Start a query for uploads by the current user
        $query = Upload::where('uploaded_by', session('user')->id);

        // Filter by filename if provided
        if ($request->filled('filename')) {
            $query->where('original_filename', 'like', '%' . $request->filename . '%');
        }

        // Filter by file type if provided
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Paginate results, preserving query strings for filters
        $uploads = $query->paginate(10)->withQueryString();

        // Return the view with the paginated uploads
        return view('my-uploads', compact('uploads'));
    }

    /**
     * Download a specific uploaded file if owned by the user.
     *
     * @param \App\Models\Upload $upload
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download(Upload $upload)
    {
        // Authorization: ensure the user owns this upload
        if ($upload->uploaded_by !== session('user')->id) {
            abort(403); // Forbidden access
        }

        // Download the file from storage with the original filename
        return Storage::disk('public')->download('uploads/' . $upload->filename, $upload->original_filename);
    }

    /**
     * Delete a specific uploaded file if owned by the user.
     *
     * @param \App\Models\Upload $upload
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Upload $upload)
    {
        // Authorization: ensure the user owns this upload
        if ($upload->uploaded_by !== session('user')->id) {
            abort(403); // Forbidden access
        }

        // Delete the file from the storage disk
        Storage::disk('public')->delete('uploads/' . $upload->filename);

        // Remove the record from the database
        $upload->delete();

        // Redirect back with a success message
        return back()->with('success', 'File deleted successfully.');
    }
}
