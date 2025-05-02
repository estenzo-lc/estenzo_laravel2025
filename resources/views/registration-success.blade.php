
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Success</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #fffcbd; /* Pale Yellow */
    }

    .nav-bar {
        background: #ffb98a; /* Soft Orange */
        padding: 10px;
        text-align: center;
    }

    .nav-bar a {
        color: white;
        margin: 0 15px;
        text-decoration: none;
        font-weight: bold;
    }

    .register-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 40px auto;
        width: 50%;
    }

    .register-title {
        color: #ffb98a; /* Soft Orange */
        font-size: 2rem;
        text-align: center;
    }

    .btn-primary {
        background: #ffd2d2; /* Light Pink */
        border-color: #ffd2d2;
        color: black;
    }

    .btn-primary:hover {
        background: #ffdac7; /* Blush Pink */
        border-color: #ffdac7;
    }

    .btn-success {
        background: #ffb98a; /* Soft Orange */
        border-color: #ffb98a;
        color: white;
    }

    .btn-success:hover {
        background: #e5a4c2; /* Muted pink hover */
        border-color: #e5a4c2;
    }

    #password-strength {
        font-size: 0.9rem;
    }

    .strength-weak {
        color: #e66767; /* Soft red */
    }

    .strength-medium {
        color: #f3b664; /* Pastel yellow-orange */
    }

    .strength-strong {
        color: #63b995; /* Soft green */
    }
</style>

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
