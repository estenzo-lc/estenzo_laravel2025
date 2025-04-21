<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
</body>
</html>
