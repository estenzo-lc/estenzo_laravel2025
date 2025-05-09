<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Success</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>

<div class="container mt-5">
    <div class="alert alert-success text-center">
        <h4 class="mb-3">Registration Successful!</h4>
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Full Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
        <p>Please check your email to verify your account before logging in.</p>
        <a href="{{ route('login') }}" class="btn btn-primary mt-3">Go to Login</a>
    </div>
</div>

</body>
</html>
