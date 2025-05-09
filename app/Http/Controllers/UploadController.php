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
        return view('upload');
    }

    public function store(Request $request)
    {
        foreach ($request->file('file') as $file) {
            $hashedName = $file->hashName();
            $file->storeAs('uploads', $hashedName, 'public');

            Upload::create([
                'original_filename' => $file->getClientOriginalName(),
                'filename' => $hashedName,
                'type' => $file->getClientMimeType(),
                'uploaded_by' => session('user')->id,
            ]);
        }

        return redirect()->route('upload.index')->with('success', 'Files uploaded successfully.');
    }

    public function index(Request $request)
    {
        $query = Upload::where('uploaded_by', session('user')->id);

        if ($request->filled('filename')) {
            $query->where('original_filename', 'like', '%' . $request->filename . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $uploads = $query->paginate(10)->withQueryString();

        return view('my-uploads', compact('uploads'));
    }

    public function download(Upload $upload)
    {
        if ($upload->uploaded_by !== session('user')->id) {
            abort(403);
        }

        return Storage::disk('public')->download('uploads/' . $upload->filename, $upload->original_filename);
    }

    public function destroy(Upload $upload)
    {
        if ($upload->uploaded_by !== session('user')->id) {
            abort(403);
        }

        Storage::disk('public')->delete('uploads/' . $upload->filename);
        $upload->delete();

        return back()->with('success', 'File deleted successfully.');
    }
}
