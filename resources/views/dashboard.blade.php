<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <style>

    </style>
</head>
<body>

    @include('nav')

    <div class="container">
        <h2>Welcome to Your Dashboard,  {{ session('user')->first_name }}!</h2>
    </div>


</body>
</html>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

