
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
        color: #fca17d; /* Palette Soft Orange */
        font-size: 2rem;
        text-align: center;
    }

    .btn-primary {
        background: #ffa6c9; /* Light Pink from palette */
        border-color: #ffa6c9;
        color: black;
    }

    .btn-primary:hover {
        background: #f88379; /* Brighter pink for hover */
        border-color: #f88379;
    }

    .btn-success {
        background: #fca17d; /* Soft Orange */
        border-color: #fca17d;
        color: white;
    }

    .btn-success:hover {
        background: #ff6f61; /* Coral red hover */
        border-color: #ff6f61;
    }

    #password-strength {
        font-size: 0.9rem;
    }

    .strength-weak {
        color: #ff6f61; /* Coral red from palette */
    }

    .strength-medium {
        color: #fca17d; /* Soft Orange */
    }

    .strength-strong {
        color: #63b995; /* Soft green - OK for contrast even if not in original palette */
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
