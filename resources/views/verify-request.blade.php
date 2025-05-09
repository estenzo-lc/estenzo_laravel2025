<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    
    <div class="container mt-5">
    <a class="btn btn-secondary" href="{{ route('login') }}">Go back</a>
    <br><br>

        <h3 class="mb-4">Verify Your Email</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('verify.email.send') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button class="btn btn-primary">Send Verification Email</button>
        </form>
    </div>
</body>
</html>
