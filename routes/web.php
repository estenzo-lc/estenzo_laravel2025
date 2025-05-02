<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', function () {
    return view('login'); 
})->name('login');

//login Controller
Route::post('/login', [AuthController::class, 'login'])->name('login');
//logout Controller
Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); // or Route::post()

Route::get('/dashboard', function (){
    return view('dashboard');
})->name('dashboard');

Route::get('/register', function () {
    return view('registration');
})->name('register');



Route::post('/register', [RegistrationController:: class, 'save'])->name('register.save');



//Controller for editing name and username
Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/edit-profile', [ProfileController::class, 'update'])->name('profile.update');


//Controller for changing password

Route::get('/edit-password', [PasswordController::class, 'edit'])->name('password.edit');
Route::post('/edit-password', [PasswordController::class, 'update'])->name('password.update');

//Controller route for display user
Route::get('/users', [UserController::class, 'index'])->name('user.list');

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');


//Controller for upload view and uploading
Route::middleware([])->group(function () {
    Route::get('/upload', [UploadController::class, 'create'])->name('upload.create');
    Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
    Route::get('/my-uploads', [UploadController::class, 'index'])->name('upload.index');
    Route::get('/download/{upload}', [UploadController::class, 'download'])->name('upload.download');
    Route::delete('/upload/{upload}', [UploadController::class, 'destroy'])->name('upload.destroy');
});