<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fffcbd; /* Pale Yellow */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        width: 350px;
    }

    h2 {
        color: #ffb98a; /* Soft Orange */
        margin-bottom: 30px;
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #ffdac7; /* Blush Pink */
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #ffecb0; /* Light Peach */
    }

    .btn-login {
        background-color: #ffd2d2; /* Light Pink */
        color: black;
        border: none;
        padding: 12px;
        width: 100%;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-login:hover {
        background-color: #ffdac7; /* Blush Pink */
    }

    .btn-outline-secondary {
        margin-top: 10px;
        width: 100%;
        color: #ffb98a;
        border-color: #ffb98a;
        border-radius: 5px;
        padding: 10px;
        font-weight: bold;
        text-align: center;
        display: inline-block;
        text-decoration: none;
    }

    .btn-outline-secondary:hover {
        background-color: #ffb98a;
        color: white;
        border-color: #ffb98a;
    }

    .input-group {
        position: relative;
    }

    .input-group-text {
        position: absolute;
        right: 10px;
        top: 10px;
        cursor: pointer;
    }

    .invalid-feedback {
        color: red;
        font-size: 0.875rem;
    }
</style>

</head>
<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="login-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2>Login</h2>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                    class="form-control @error('username') is-invalid @enderror"
                    placeholder="Enter your username" value="{{ old('username') }}">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter your password" required>
                    <span class="input-group-text" onclick="togglePassword()">
                        <i id="togglePasswordIcon" class="bi bi-eye-slash"></i>
                    </span>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">Login</button>
            <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register</a>
        </form>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            const icon = document.getElementById("togglePasswordIcon");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        }
    </script>
</body>
</html>
