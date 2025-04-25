<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Success</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2>Registration Successful</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>First Name:</strong> {{ $data['firstname'] ?? '' }}</li>
            <li class="list-group-item"><strong>Middle Name:</strong> {{ $data['middlename'] ?? '' }}</li>
            <li class="list-group-item"><strong>Last Name:</strong> {{ $data['lastname'] ?? '' }}</li>
            <li class="list-group-item"><strong>Birthday:</strong> {{ $data['bod'] ?? '' }}</li>
            <li class="list-group-item"><strong>Sex:</strong> {{ $data['sex'] ?? '' }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $data['email'] ?? '' }}</li>
            <li class="list-group-item"><strong>Username:</strong> {{ $data['username'] ?? '' }}</li>
            <li class="list-group-item"><strong>Accepted Terms:</strong> {{ isset($data['terms']) ? 'Yes' : 'No' }}</li>
        </ul>
        <a href="login" class="btn btn-primary"> Go back</a>
    </div>
</body>
</html>
