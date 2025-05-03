<!-- ... same <head> section ... -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <style>
    body {
        font-family: Arial, sans-serif;
        background: #ffa6c9; /* light pink background from palette */
    }

    .nav-bar {
        background: #fca17d; /* orange from palette */
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
        color: #f88379; /* salmon pink from palette */
        font-size: 2rem;
        text-align: center;
    }

    .btn-primary {
        background: #ff6f61; /* coral red */
        border-color: #ff6f61;
        color: white;
    }

    .btn-primary:hover {
        background: #e65a5a; /* deep red hover */
        border-color: #e65a5a;
    }

    .btn-success {
        background: #fca17d; /* soft orange */
        border-color: #fca17d;
        color: white;
    }

    .btn-success:hover {
        background: #f88379; /* hover salmon */
        border-color: #f88379;
    }
</style>


</head>
<body>

@include('nav')

    @if (session('success') || $errors->any())
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <div class="toast fade show shadow-lg text-white {{ session('success') ? 'bg-success' : 'bg-danger' }}"
                role="alert" style="min-width: 300px;">
                <div class="d-flex">
                    <div class="toast-body fs-6">
                        @if(session('success'))
                            {{ session('success') }}
                        @else
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="profile-container">
        <h2 class="profile-title">Edit Profile</h2>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text"
                       class="form-control @error('first_name') is-invalid @enderror"
                       id="first_name" name="first_name"
                       value="{{ old('first_name', $user->first_name ?? '') }}">
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text"
                       class="form-control @error('last_name') is-invalid @enderror"
                       id="last_name" name="last_name"
                       value="{{ old('last_name', $user->last_name ?? '') }}">
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text"
                       class="form-control @error('username') is-invalid @enderror"
                       id="username" name="username"
                       value="{{ old('username', $user->username ?? '') }}">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.querySelector('.toast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show();
            }
        });
    </script>
</body>
</html>



