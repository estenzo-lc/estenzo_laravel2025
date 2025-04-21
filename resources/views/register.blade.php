<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
</body>
</html>
