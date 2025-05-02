<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Uploaded Files</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #fffcbd; /* Pale Yellow */
        font-family: Arial, sans-serif;
    }

    .nav-bar {
        background: #ffb98a; /* Soft Orange */
        padding: 10px;
        text-align: center;
    }

    .nav-bar a {
        color: white;
        margin: 0 15px;
        text-decoration: none;
        font-weight: bold;
    }

    .filter-card {
        background-color: #ffecb0; /* Light Peach */
        border: 2px solid #ffb98a; /* Soft Orange */
        border-radius: 8px;
        padding: 1rem;
        color: #4b0b4; /* Custom accent, remains if intentional */
    }

    .profile-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(216, 151, 194, 0.1);
        margin: 40px auto;
        width: 50%;
    }

    .profile-title {
        color: #ffb98a; /* Soft Orange */
        font-size: 2rem;
        text-align: center;
    }

    .btn-primary {
        background: #ffd2d2; /* Light Pink */
        border-color: #ffd2d2;
        color: black;
    }

    .btn-primary:hover {
        background: #ffdac7; /* Blush Pink */
        border-color: #ffdac7;
    }

    .btn-success {
        background: #ffb98a; /* Soft Orange */
        border-color: #ffb98a;
        color: white;
    }

    .btn-success:hover {
        background: #e5a4c2; /* Slightly deeper pink */
        border-color: #e5a4c2;
    }

    .btn-danger {
        background: #d88aad; /* Medium pink */
        border-color: #d88aad;
        color: white;
    }

    .btn-danger:hover {
        background: #c67397;
        border-color: #c67397;
    }

    .table-light th {
        background-color: #ffecb0; /* Light Peach */
        color: #4b0b4; /* Custom accent */
    }

    h2 {
        color: #ffb98a; /* Soft Orange */
    }
</style>

</head>

<body>
@include('nav')

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">My Uploaded Files</h2>
            <a href="{{ route('upload.create') }}" class="btn btn-primary">Upload Files</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="filter-card mb-4">
            <form method="GET" action="{{ route('upload.index') }}" class="row gy-2 gx-3 align-items-center">
                <div class="col-md-4">
                    <input type="text" name="filename" class="form-control" placeholder="Search by filename"
                        value="{{ request()->input('filename') }}">
                </div>
                <div class="col-md-4">
                    <select name="type" class="form-select">
                        <option value="">All File Types</option>
                        <option value="application/pdf" {{ request()->input('type') == 'application/pdf' ? 'selected' : '' }}>PDF</option>
                        <option value="image/png" {{ request()->input('type') == 'image/png' ? 'selected' : '' }}>PNG</option>
                        <option value="image/jpeg" {{ request()->input('type') == 'image/jpeg' ? 'selected' : '' }}>JPEG</option>
                        <option value="application/vnd.openxmlformats-officedocument.wordprocessingml.document" {{ request()->input('type') == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ? 'selected' : '' }}>DOCX</option>
                        <option value="text/plain" {{ request()->input('type') == 'text/plain' ? 'selected' : '' }}>TXT</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-wrap justify-content-md-end justify-content-start gap-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('upload.index') }}" class="btn btn-outline-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Filename</th>
                        <th>Type</th>
                        <th>Uploaded</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($uploads as $upload)
                        <tr>
                            <td>{{ $upload->original_filename }}</td>
                            <td>{{ $upload->type }}</td>
                            <td>{{ $upload->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('upload.download', $upload) }}"
                                    class="btn btn-sm btn-success me-1">Download</a>
                                <form action="{{ route('upload.destroy', $upload) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No uploaded files found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $uploads->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
</body>

</html>
