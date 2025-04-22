@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Edit Profile</h2>
    
    <!-- Success and Error messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <!-- Profile edit form -->
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <!-- First Name -->
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                id="first_name" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}" required>
            @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                id="last_name" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" required>
            @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" 
                id="username" name="username" value="{{ old('username', auth()->user()->username) }}" required>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
