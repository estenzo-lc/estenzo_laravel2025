<!DOCTYPE html> <!-- Declares the HTML document type -->
<html lang="en"> <!-- Sets the language of the document to English -->

<head>
    <meta charset="UTF-8"> <!-- Character encoding for the document -->
    <title>Edit Profile</title> <!-- Browser tab title -->

    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Custom CSS for toast notifications -->
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">
</head>

<body>

    <!-- Includes the navigation bar from a Blade partial -->
    @include('nav')

    <!-- Conditional display of success or error messages in a toast -->
    @if (session('success') || $errors->any())
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <div class="toast fade show shadow-lg text-white {{ session('success') ? 'bg-success' : 'bg-danger' }}"
                role="alert" style="min-width: 300px;">
                <div class="d-flex">
                    <div class="toast-body fs-6">
                        @if(session('success'))
                            {{ session('success') }} <!-- Display success message -->
                        @else
                            <ul class="mb-0"> <!-- Display list of validation errors -->
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <!-- Button to close the toast -->
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Profile Edit Form Section -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center fw-bold">Edit Profile</div>
                    <div class="card-body p-3">

                        <!-- Profile update form -->
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf <!-- Laravel CSRF protection -->

                            <!-- First Name Input -->
                            <div class="mb-2">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    id="first_name" name="first_name"
                                    value="{{ old('first_name', session('user')->first_name) }}">
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name Input -->
                            <div class="mb-2">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    id="last_name" name="last_name"
                                    value="{{ old('last_name', session('user')->last_name) }}">
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Username Input -->
                            <div class="mb-2">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username"
                                    value="{{ old('username', session('user')->username) }}">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-md">Update Profile</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS bundle from CDN (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toast auto-display script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.querySelector('.toast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show(); // Show toast on page load
            }
        });
    </script>

</body>

</html>
