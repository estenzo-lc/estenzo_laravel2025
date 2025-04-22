<!-- resources/views/upload.blade.php -->
@extends('layouts.app') <!-- Make sure this matches the correct path -->

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Upload File</h2>
    
    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Upload Form -->
    <form action="{{ route('upload.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="file" class="form-label">Choose a file to upload</label>
            <input type="file" class="form-control" name="file" id="file" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
