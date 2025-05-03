<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #fffcbf; /* Pale yellow from palette */
        font-family: Arial, sans-serif;
    }

    h2 {
        color: #ffb98a;
        font-size: 2rem;
        text-align: center;
    }

    .card {
        border: 1px solid #ffd2d2;
        border-radius: 8px;
        background-color: #ffffff;
    }

    .card-body {
        padding: 2rem;
    }

    .form-label {
        color: #ffdac7;
    }

    .form-control {
        border: 1px solid #ffd2d2;
        background-color: #fff5f5;
        border-radius: 5px;
    }

    .form-control:focus {
        border-color: #ffb98a;
        outline: none;
        box-shadow: 0 0 5px #ffb98a;
    }

    .btn-primary {
        background-color: #ffd2d2;
        border-color: #ffd2d2;
        color: #333;
    }

    .btn-primary:hover {
        background-color: #ffb98a;
        border-color: #ffb98a;
    }

    .btn-outline-secondary {
        border-color: #ffdac7;
        color: #ffb98a;
    }

    .btn-outline-secondary:hover {
        background-color: #ffdac7;
        color: #333;
    }

    .btn-danger {
        background-color: #ffb98a;
        border-color: #ffb98a;
        color: white;
    }

    .btn-danger:hover {
        background-color: #ffecb0;
        border-color: #ffecb0;
        color: #333;
    }

    .btn-success {
        background: #ffecb0;
        border-color: #ffecb0;
        color: #333;
    }

    .btn-success:hover {
        background: #fffcbf;
        border-color: #fffcbf;
    }

    .table-primary {
        background-color: #ffd2d2;
        color: #333;
    }

    .table th,
    .table td {
        text-align: center;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fff7e6; /* subtle peach striping */
    }

    .alert-success {
        background-color: #ffecb0;
        color: #333;
    }

    .alert-danger {
        background-color: #ffd2d2;
        color: #333;
    }

    .nav-bar {
        background: #ffdac7;
        padding: 10px;
        text-align: center;
    }

    .nav-bar a {
        color: white;
        margin: 0 15px;
        text-decoration: none;
        font-weight: bold;
    }

    .profile-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 40px auto;
        width: 50%;
    }

    .profile-title {
        color: #ffb98a;
        font-size: 2rem;
        text-align: center;
    }
</style>

</head>

<body>

    @include('nav')

    @if (session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    @if ($errors->has('delete'))
        <div class="alert alert-danger mt-2">{{ $errors->first('delete') }}</div>
    @endif

    <div class="container mt-5">
        <h2>User List</h2>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('user.list') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="searchName" class="form-label">Search by Name</label>
                            <input type="text" id="searchName" name="name" placeholder="e.g. John"
                                value="{{ request('name') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="searchEmail" class="form-label">Search by Email</label>
                            <input type="text" id="searchEmail" name="email" placeholder="e.g. john@example.com"
                                value="{{ request('email') }}" class="form-control">
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            @if(request('name') || request('email'))
                                <a href="{{ route('user.list') }}" class="btn btn-outline-secondary">Clear Filters</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="table-responsive shadow-sm rounded bg-white p-3">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="table-primary">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ ucfirst($user->user_type) }}</td>
                            <td class="text-center">
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-md">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>

</body>

</html>
