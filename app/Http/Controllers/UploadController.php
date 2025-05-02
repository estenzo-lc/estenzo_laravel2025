<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function create()
    {
        // Check if the user is logged in
        if (!session('user')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to upload files.']);
        }

        return view('upload');
    }

    public function store(Request $request)
    {
        $userId = session('user'); 
        
        // Check if the user is logged in
        if (!session('user')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to upload files.']);
        }

        foreach ($request->file('file') as $file) {
            $hashedName = $file->hashName();
            $file->storeAs('uploads', $hashedName, 'public');

            Upload::create([
                'original_filename' => $file->getClientOriginalName(),
                'filename' => $hashedName,
                'type' => $file->getClientMimeType(),
                'uploaded_by' => $userId ,  // Accessing user ID only if user is logged in
            ]);
        }

        return redirect()->route('upload.index')->with('success', 'Files uploaded successfully.');
    }

    public function index(Request $request)
    {
        // Check if the user is logged in
        $currentUserId = session('user');  // Get the user ID from the session
        
        if (!$currentUserId) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to view your uploads.']);
        }
    
        $query = Upload::where('uploaded_by', $currentUserId);  // Use the user ID to fetch uploads
    
        // Check for filters and apply them to the query
        if ($request->filled('filename')) {
            $query->where('original_filename', 'like', '%' . $request->filename . '%');
        }
    
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
    
        // Get the paginated uploads
        $uploads = $query->paginate(10)->withQueryString();
    
        return view('my-uploads', compact('uploads'));
    }
    

    public function download(Upload $upload)
    {
        // Check if the user is logged in
        if (!session('user')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to download files.']);
        }
    
        // Check if the uploaded file belongs to the logged-in user
        if ($upload->uploaded_by !== session('user')) {
            abort(403);
        }
    
        // Make sure the file exists before trying to download it
        $filePath = storage_path('app/public/uploads/' . $upload->filename);
    
        if (!file_exists($filePath)) {
            return back()->withErrors(['error' => 'File not found.']);
        }
    
        return response()->download($filePath, $upload->original_filename);
    }
    
    public function destroy(Upload $upload)
    {

        $userId = session('user'); // ✅ Correct

        
        // Check if the user is logged in
        if (!session('user')) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to delete files.']);
        }

        // Check if the uploaded file belongs to the logged-in user
        if ($upload->uploaded_by !== $userId) {
            abort(403);
        }

        Storage::disk('public')->delete('uploads/' . $upload->filename);
        $upload->delete();

        return back()->with('success', 'File deleted successfully.');
    }
}
