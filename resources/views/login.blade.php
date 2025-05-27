<!DOCTYPE html> <!-- Declare HTML5 document type -->
<html lang="en">

<head>
    <meta charset="UTF-8"> <!-- Character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive layout -->
    <title>Login</title> <!-- Page title -->

    <!-- Bootstrap CSS for layout and components -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS specific to login page -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>

<body>
    <div class="card"> <!-- Centered card container for login form -->

        <!-- Heading for the login form -->
        <h2 class="text-center mb-4">Login</h2>

        <!-- Display a success message if one exists in the session (e.g. from registration or reset) -->
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Login form starts -->
        <form method="POST" action="{{ route('login') }}">
            @csrf <!-- Include CSRF token for security -->

            <!-- Username input field -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}">
            </div>

            <!-- Password input field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <!-- Login button -->
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <!-- End of login form -->

        <!-- Links to Forgot Password and Email Verification -->
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ route('password.request') }}" class="mx-3">Forgot Password?</a>
            <a href="{{ route('verify.email.form') }}" class="mx-3">Verify Your Email</a>
        </div>

        <!-- Link to registration page -->
        <p class="text-center mt-3">
            <a href="{{ route('register') }}">Don't have an account? Register</a>
        </p>

        <!-- Display validation or login error messages -->
        @if($errors->any())
            <div class="mt-3">
                @if ($errors->has('email'))
                    <!-- Specific error for email -->
                    <div class="alert alert-warning text-center">
                        {{ $errors->first('email') }}
                    </div>
                @else
                    <!-- General error (e.g. invalid login credentials) -->
                    <div class="alert alert-warning text-danger text-center">{{ $errors->first() }}</div>
                @endif
            </div>
        @endif
    </div>
</body>

</html>
