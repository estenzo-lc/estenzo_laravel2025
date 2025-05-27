<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Uploaded Files</title>

    <!-- Custom dashboard styles -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <!-- Bootstrap for responsive UI and components -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Inline styling for filter card -->
    <style>
        .filter-card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1rem;
        }
    </style>
</head>

<body>
    <!-- Navigation bar inclusion -->
    @include('nav')

    <div class="container mt-5">
        <!-- Header and upload button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">My Uploaded Files</h2>
            <a href="{{ route('upload.create') }}" class="btn btn-primary">Upload Files</a>
        </div>

        <!-- Display success message if present -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Filter form -->
        <div class="filter-card mb-4">
            <form method="GET" action="{{ route('upload.index') }}" class="row gy-2 gx-3 align-items-center">
                <!-- Filename search input -->
                <div class="col-md-4">
                    <input type="text" name="filename" class="form-control" placeholder="Search by filename"
                        value="{{ request('filename') }}">
                </div>

                <!-- File type dropdown -->
                <div class="col-md-4">
                    <select name="type" class="form-select">
                        <option value="">All File Types</option>
                        <option value="application/pdf" {{ request('type') == 'application/pdf' ? 'selected' : '' }}>PDF</option>
                        <option value="image/png" {{ request('type') == 'image/png' ? 'selected' : '' }}>PNG</option>
                        <option value="image/jpeg" {{ request('type') == 'image/jpeg' ? 'selected' : '' }}>JPEG</option>
                        <option value="application/vnd.openxmlformats-officedocument.wordprocessingml.document" {{ request('type') == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ? 'selected' : '' }}>DOCX</option>
                        <option value="text/plain" {{ request('type') == 'text/plain' ? 'selected' : '' }}>TXT</option>
                    </select>
                </div>

                <!-- Filter and Clear buttons -->
                <div class="col-md-4">
                    <div class="d-flex flex-wrap justify-content-md-end justify-content-start gap-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('upload.index') }}" class="btn btn-outline-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table of uploaded files -->
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle bg-white">
                <thead class="table-primary text-center">
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
                                <!-- Download button -->
                                <a href="{{ route('upload.download', $upload) }}"
                                   class="btn btn-sm btn-success me-1">Download</a>

                                <!-- Delete button (with confirmation) -->
                                <form action="{{ route('upload.destroy', $upload) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <!-- Message when no files are found -->
                        <tr>
                            <td colspan="4" class="text-center text-muted">No uploaded files found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $uploads->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
</body>

</html>
