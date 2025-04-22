<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Registration Form</h3>

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sex</label>
                    <select name="sex" class="form-select" required>
                        <option disabled selected>Select sex</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Birthday</label>
                    <input type="date" name="birthday" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="agree" class="form-check-input" required>
                    <label class="form-check-label">I agree with the Privacy Policy and Terms</label>
                </div>

                <button type="submit" class="btn btn-success w-100">Register</button>
            </form>

            <div class="text-center mt-3">
                <small>Already have an account? <a href="{{ route('login') }}">Login here</a></small>
            </div>
        </div>
    </div>
</div>
=======
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <label>First Name: <input type="text" name="first_name"></label><br>
        <label>Last Name: <input type="text" name="last_name"></label><br>
        <label>Sex: 
            <select name="sex">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </label><br>
        <label>Birthday: <input type="date" name="birthday"></label><br>
        <label>Username: <input type="text" name="username"></label><br>
        <label>Email: <input type="email" name="email"></label><br>
        <label>Password: <input type="password" name="password"></label><br>
        <label><input type="checkbox" name="agree"> I agree with the Privacy Policy and Terms</label><br>
        <button type="submit">Register</button>
    </form>
>>>>>>> 2ef51e9fe0291416c8b1dbb50e1385acf6720a69
</body>
</html>
