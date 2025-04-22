<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Home route (redirect to login)
Route::get('/', function () {
    return redirect('/login');
});

// Dashboard route (after successful login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Login form
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

// Handle login authentication
Route::post('/login', function (Request $request) {
    // Validate login data
    $credentials = $request->only('username', 'password');

    // Check if username and password are correct
    if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
        return redirect()->route('dashboard');
    } else {
        return back()->with('error', 'Invalid credentials');
    }
})->name('login.submit');

// Registration form
Route::get('/register', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('register');
})->name('register');

// Handle registration form data
Route::post('/register', function (Request $request) {
    // Validate registration data
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Create the user in the database
    $user = User::create([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'username' => $validated['username'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    // Log the user in
    Auth::login($user);

    // Redirect to the dashboard
    return redirect()->route('dashboard');
})->name('register.submit');

// Edit Profile route (show form to edit profile)
Route::get('/profile/edit', function () {
    return view('edit-profile'); // Ensure to create 'edit-profile.blade.php'
})->middleware('auth')->name('profile.edit');

// Handle the Edit Profile form data
Route::post('/profile/edit', function (Request $request) {
    // Validate the new name and username
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . Auth::id(), // Skip checking current user
    ]);

    // Update the user's profile information
    $user = Auth::user();
    $user->update([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'username' => $validated['username'],
    ]);

    return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
})->middleware('auth')->name('profile.update');

// Edit Password route (show form to change password)
Route::get('/password/edit', function () {
    return view('edit-password'); // Ensure to create 'edit-password.blade.php'
})->middleware('auth')->name('password.edit');

// Handle the Edit Password form data
Route::post('/password/edit', function (Request $request) {
    // Validate old password, new password, and confirm password
    $validated = $request->validate([
        'old_password' => 'required|string',
        'password' => 'required|string|min:8|confirmed', // New password validation
    ]);

    // Check if the old password matches
    if (!Hash::check($validated['old_password'], Auth::user()->password)) {
        return back()->with('error', 'Old password is incorrect');
    }

    // Update the password in the database
    $user = Auth::user();
    $user->update([
        'password' => bcrypt($validated['password']),
    ]);

    return redirect()->route('dashboard')->with('success', 'Password updated successfully!');
})->middleware('auth')->name('password.update');

// Upload form (show the form to upload a file)
Route::get('/upload', function () {
    return view('upload');
})->middleware('auth')->name('upload.form');

// Handle file upload (submit the file)
Route::post('/upload', function (Request $request) {
    $request->validate([
        'file' => 'required|file|max:10240', // 10MB max file size
    ]);

    // Handle the uploaded file
    $file = $request->file('file');
    $filename = $file->hashName();
    $file->storeAs('uploads', $filename, 'public'); // Store in the 'uploads' folder in storage/app/public

    // Optionally, store file information in the database (e.g., user ID, original filename, etc.)
    // Your logic for storing in the database goes here

    return back()->with('success', 'File uploaded successfully!');
})->middleware('auth')->name('upload.submit');

// Admin Routes to view user list
Route::get('/admin/users', function (Request $request) {
    // Ensure the user is an admin
    if (Auth::user()->is_admin !== 1) {
        return redirect()->route('dashboard');
    }

    // Query users with optional search filters
    $query = User::query();

    if ($request->filled('name')) {
        $query->where('first_name', 'like', '%' . $request->name . '%')
              ->orWhere('last_name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    // Paginate the results
    $users = $query->paginate(10);

    return view('admin.users', compact('users'));
})->middleware('auth')->name('admin.users');

