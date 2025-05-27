<!DOCTYPE html> <!-- Declares the document type and version of HTML -->
<html lang="en"> <!-- Starts the HTML document with English as the language -->
<head>
    <meta charset="UTF-8"> <!-- Sets the character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Makes the page responsive on all devices -->
    <title>Dashboard</title> <!-- Sets the title of the page in the browser tab -->

    <!-- Link to Bootstrap CSS file from the public asset folder -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Link to a custom dashboard CSS file -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <style>
        /* Inline CSS can be added here */
    </style>
</head>
<body>

    <!-- Include the navigation bar from a Blade partial named 'nav' -->
    @include('nav')

    <!-- Main container for the dashboard content -->
    <div class="container">
        <!-- Display a welcome message including the logged-in user's first name -->
        <h2>Welcome to Your Dashboard,  {{ session('user')->first_name }}!</h2>
    </div>

</body>
</html>

<!-- Include Bootstrap JS bundle (includes Popper) from the public asset folder -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
