<style>
    body {
        background-color: #F2EFE7; /* Light background */
    }

    .navbar {
        background-color: #48A6A7; /* Main navbar color */
    }

    .navbar-brand,
    .nav-link {
        color: white !important;
        transition: background-color 0.3s ease, color 0.3s ease;
        padding: 8px 12px;
        border-radius: 4px;
    }

    .nav-link:hover {
        color: #D0EBF2 !important; /* Light hover color */
        background-color: #3D9394; /* Darker hover background */
        transform: translateY(-2px);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0;
        height: 2px;
        background-color: #D0EBF2; /* Underline color */
        transition: width 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .logout-btn {
        background-color: #2973B2; /* Logout button color */
        border-color: #2973B2;
        color: white !important;
        margin-left: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
    }

    .logout-btn:hover {
        background-color: #9ACBD0; /* Logout hover color */
        border-color: #9ACBD0;
        color: white !important;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.5);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255,255,255,1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
            aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('upload.index') }}">Uploaded Files</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('password.edit') }}">Change Password</a></li>
                @if(session('user') && session('user')->user_type === 'Admin')
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.list') }}">Users</a></li>
                @endif
            </ul>
        </div>
        <div class="d-flex">
            <a class="btn logout-btn" href="{{ route('login') }}">Logout</a>
        </div>
    </div>
</nav>