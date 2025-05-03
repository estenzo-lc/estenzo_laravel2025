<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #fffcbf; /* Soft yellow */
    }

    .nav-bar {
        background: #ffdac7; /* Light peach */
        padding: 10px;
        text-align: center;
    }

    .nav-bar a {
        color: #ffffff;
        margin: 0 15px;
        text-decoration: none;
        font-weight: bold;
    }

    .register-container {
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 40px auto;
        width: 50%;
    }

    .register-title {
        color: #ffb98a; /* Light orange */
        font-size: 2rem;
        text-align: center;
    }

    .btn-primary {
        background: #ffd2d2; /* Soft pink */
        border-color: #ffd2d2;
        color: #333;
    }

    .btn-primary:hover {
        background: #ffb98a;
        border-color: #ffb98a;
    }

    .btn-success {
        background: #ffecb0; /* Pale yellow */
        border-color: #ffecb0;
        color: #333;
    }

    .btn-success:hover {
        background: #fffcbf;
        border-color: #fffcbf;
    }

    #password-strength {
        font-size: 0.9rem;
    }

    .strength-weak {
        color: #f88379; /* Coral red */
    }

    .strength-medium {
        color: #fca17d; /* Pastel orange */
    }

    .strength-strong {
        color: #63b995; /* Soft green */
    }
    </style>
</head>
<body>
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="register-container">
        <h2 class="register-title">Register</h2>
        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Enter your first name" required>
                @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter your last name" required>
                @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="sex">Sex</label>
                <select class="form-control @error('sex') is-invalid @enderror" id="sex" name="sex" required>
                    <option value="" disabled {{ old('sex') ? '' : 'selected' }}>Select your sex</option>
                    <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('sex') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="birthday" name="birthday" value="{{ old('birthday') }}" required>
                @error('birthday') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Choose a username" required>
                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password" required>
                <div id="password-strength" class="mt-1 fw-semibold"></div>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Password Confirmation Field -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Re-enter your password" required>
                @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }} required>
                <label class="form-check-label" for="terms">Do you agree with our Privacy Policy and Terms and Conditions?</label>
                @error('terms') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-success btn-block">Register</button>
            <br><br>
            <a href="{{ route('login') }}" class="btn btn-secondary btn-block">Go Back</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/password-strength.js') }}"></script>
</body>
</html>
