<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;


Route::get('/', function () {
    return view('welcome');
});



// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// //login Controller
// Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', function () {
        return view('registration');
    })->name('register');

    Route::post('/register', [RegistrationController::class, 'save'])->name('register.save');
});


Route::get('/dashboard', function (){
    return view('dashboard');
})->name('dashboard');

// Route::get('/register', function () {
//     return view('registration');
// })->name('register');

//REGISTRATION CONTROLLER --  TODO: MOVE TO A CONTROLLER FOR A BETTER CODE AYAW KALIMTA.

Route::post('/register', [RegistrationController:: class, 'save'])->name('register.save');

// Route::post('/register', function (Request $request) {
//     // not including password
//     $data = $request->except('password');

//     return view('registration-success', ['data' => $data]);
// });


//Controller for editing name and username
Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/edit-profile', [ProfileController::class, 'update'])->name('profile.update');


//Controller for changeing password

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


//request verification
Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');



// View to enter email for verification// verification for email
Route::get('/verify-email', [EmailVerificationController::class, 'showVerificationForm'])->name('verify.email.form');
Route::post('/verify-email', [EmailVerificationController::class, 'sendVerificationEmail'])->name('verify.email.send');
Route::get('/verify-email-token/{token}', [EmailVerificationController::class, 'verifyToken'])->name('verify.email.token');




Route::get('/forgot-password', [ForgotPasswordController::class, 'showRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');



Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.change');
