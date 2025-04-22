<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 400px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Login</h3>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100" type="submit">Login</button>
            </form>

            <div class="text-center mt-3">
                <small>Don't have an account? <a href="{{ route('register') }}">Register</a></small>
            </div>
        </div>
    </div>
</div>
=======
</head>
<body>
    <h2>Login Form</h2>
    @if($errors->any())
        <p style="color:red;">{{ $errors->first() }}</p>
    @endif
    <form method="POST" action="/login">
        @csrf
        <label>Username:</label><br>
        <input type="text" name="username"><br><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br><br>
        <button type="submit">Login</button>
    </form>
    <br>
    <a href="/register">Register</a>
>>>>>>> 2ef51e9fe0291416c8b1dbb50e1385acf6720a69
</body>
</html>
