@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Change Password</h2>
    
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
    
    <!-- Change password form -->
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <!-- Old Password -->
        <div class="form-group">
            <label for="old_password">Old Password</label>
            <input type="password" class="form-control @error('old_password') is-invalid @enderror" 
                id="old_password" name="old_password" required>
            @error('old_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- New Password -->
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm New Password -->
        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
</div>
@endsection
