<!DOCTYPE html>
<html>
<head>
    <title>Registration Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Registration Summary</h3>
            <ul class="list-group">
                @foreach($data as $key => $value)
                    <li class="list-group-item">
                        <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}
                    </li>
                @endforeach
            </ul>
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="btn btn-primary">Back to Login</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
