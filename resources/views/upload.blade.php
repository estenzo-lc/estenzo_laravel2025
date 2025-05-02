<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Files</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #fffcbf; /* Pale yellow from palette */
    }

    .nav-bar {
        background: #ffd2d2; /* Soft pink from palette */
        padding: 10px;
        text-align: center;
    }

    .nav-bar a {
        color: white;
        margin: 0 15px;
        text-decoration: none;
        font-weight: bold;
    }

    .container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 40px auto;
        width: 70%;
    }

    .table th {
        background: #ffdac7; /* Light peach from palette */
        color: #333;
    }

    .btn-danger {
        background: #ffb98a; /* Soft orange from palette */
        border-color: #ffb98a;
        color: white;
    }

    .btn-danger:hover {
        background: #ffecb0; /* Pale yellow hover */
        border-color: #ffecb0;
        color: #333;
    }

    .btn-info {
        background: #ffecb0; /* Pale yellow from palette */
        border-color: #ffecb0;
        color: #333;
    }

    .btn-info:hover {
        background: #fffcbf; /* Lighter yellow */
        border-color: #fffcbf;
    }
</style>

</head>

<body>

@include('nav') 
    <div class="container">
        <div class="container">
            <h1 class="text-center" style="color: #4b70b4;">Upload a file</h1>

            {{-- Success message --}}
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Upload form --}}
            <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @csrf
                <div class="form-group">
                    <label for="file">Choose Files</label>
                    <input type="file" name="file[]" class="form-control @error('file.*') is-invalid @enderror" multiple required>
                    @error('file.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-2">Upload</button>
            </form>


        </div>

    </div>

</body>

</html>