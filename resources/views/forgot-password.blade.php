<!-- resources/views/forgot-password.blade.php -->

<!DOCTYPE html> <!-- Declare HTML5 document type -->
<html>

<head>
    <title>Forgot Password</title> <!-- Page title shown on browser tab -->

    <!-- Link to Bootstrap CSS for styling -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
<div class="container mt-5"> <!-- Bootstrap container with top margin -->
    <h3 class="text-center mb-4">Forgot Password</h3> <!-- Page heading -->

    <!-- Display success message if available in the session -->
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Password reset request form -->
    <form method="POST" action="{{ route('password.email') }}">
        @csrf <!-- Laravel CSRF token for form protection -->

        <!-- Email input field -->
        <div class="mb-3">
            <label for="email" class="form-label">Enter your email address</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required>
            <!-- Display validation error for email if any -->
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
    </form>
</div>
</body>

</html>
