<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #fffcbf; /* Soft pastel yellow */
    }

    .navbar {
        background-color: #ffd2d2; /* Soft pink */
    }

    .navbar-brand,
    .nav-link {
        color: white !important;
    }

    .nav-link:hover {
        background-color: #ffb98a; /* Light orange */
        color: white !important;
    }

    .logout-btn {
        background-color: #ffd2d2; /* Soft pink */
        border-color: #ffd2d2;
        color: white !important;
    }

    .logout-btn:hover {
        background-color: #ffb98a;
        border-color: #ffb98a;
        color: white !important;
    }

    .container {
        margin-top: 20px;
    }

    h2 {
        color: #ffb98a; /* Light orange */
        font-size: 2rem;
        text-align: center;
    }

    .table {
        border-radius: 8px;
        background-color: #ffffff;
    }

    .table thead {
        background-color: #ffdac7; /* Light peach */
        color: #333;
    }

    .table tbody {
        background-color: #ffffff;
    }

    .table th, .table td {
        text-align: center;
        padding: 1rem;
    }

    .btn {
        border-radius: 8px;
    }

    .btn-danger {
        background-color: #ffb98a; /* Light orange */
        border-color: #ffb98a;
        color: white;
    }

    .btn-danger:hover {
        background-color: #ffecb0; /* Pale yellow */
        border-color: #ffecb0;
        color: #333;
    }
</style>

</head>
<body>
<div class="nav-bar">
    <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('edit-password') }}">Edit Password</a>
        <a href="{{ route('edit-profile') }}">Edit Profile</a>
        <a href="{{ route('register') }}">Register</a>
        <a href="{{ route('uploaded-files') }}">Uploaded Files</a>
        <!-- <a href="{{route('users')}}">Users</a> -->
         <!-- Only show the "Users" link to admins -->
    @if(session('user') && session('user')->user_type === 'Admin')
        <a href="{{ route('user.list') }}">Users</a>
        
    </div>
    @include('nav')
    
    <div class="container mt-4">
        <h2>User Management</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example user row (replace with dynamic data) -->
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john@example.com</td>
                    <td>Admin</td>
                    <td>
                        <form action="{{ route('user.destroy', 1) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-md">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
