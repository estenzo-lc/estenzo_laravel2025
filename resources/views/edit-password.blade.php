<!DOCTYPE html> <!-- Declares the HTML document type -->
<html lang="en"> <!-- Specifies the document language -->

<head>
    <meta charset="UTF-8"> <!-- Sets the character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Enables responsive design -->
    <title>Change Password</title> <!-- Title shown in the browser tab -->

    <!-- Link to Bootstrap CSS from the public assets -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Link to custom toast notification styles -->
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">

    <style>
        /* Custom inline styles (optional) */
    </style>
</head>

<body>

    <!-- Include navigation bar from a Blade partial -->
    @include('nav')

    <!-- Display toast message if success or validation errors exist -->
    @if (session('success') || $errors->any())
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <div id="feedbackToast"
                class="toast align-items-center text-white {{ session('success') ? 'bg-success' : 'bg-danger' }} border-0"
                role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        @if(session('success'))
                            {{ session('success') }} <!-- Display success message -->
                        @else
                            <ul class="mb-0">
                                <!-- Loop through all validation errors -->
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <!-- Close button for the toast -->
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Main container for the password change form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center fw-bold">Change Password</div>
                    <div class="card-body p-4">
                        <!-- Password change form -->
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf <!-- CSRF protection -->

                            <!-- Old Password Field -->
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input type="password" id="old_password" name="old_password"
                                    class="form-control form-control-md @error('old_password') is-invalid @enderror">
                                @error('old_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- New Password Field -->
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" id="new_password" name="new_password"
                                    class="form-control form-control-md @error('new_password') is-invalid @enderror">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password" id="confirm_password" name="confirm_password"
                                    class="form-control form-control-md @error('confirm_password') is-invalid @enderror">
                                @error('confirm_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-md">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS bundle from CDN (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script to trigger toast messages if they exist -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.getElementById('feedbackToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show(); // Show toast for 3 seconds
            }
        });
    </script>

</body>
</html>
