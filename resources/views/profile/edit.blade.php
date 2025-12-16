@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="card-header">
        <h1 class="card-title">Profile Settings</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-outline">
            Back to Dashboard
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Update Profile Information -->
        <div class="card">
            <h2 class="card-title mb-4">Profile Information</h2>
            <p class="text-sm opacity-70 mb-4">Update your account's profile information and email address.</p>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $user->name) }}" 
                           required 
                           autofocus 
                           autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $user->email) }}" 
                           required 
                           autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex items-center gap-4 mt-6">
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                    
                    @if (session('status') === 'profile-updated')
                        <p class="text-sm text-green-600">Saved.</p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Update Password -->
        <div class="card">
            <h2 class="card-title mb-4">Update Password</h2>
            <p class="text-sm opacity-70 mb-4">Ensure your account is using a long, random password to stay secure.</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label class="form-label" for="current_password">Current Password</label>
                    <input type="password" 
                           id="current_password" 
                           name="current_password" 
                           class="form-control @error('current_password') is-invalid @enderror" 
                           autocomplete="current-password">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">New Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           autocomplete="new-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="form-control" 
                           autocomplete="new-password">
                </div>

                <div class="flex items-center gap-4 mt-6">
                    <button type="submit" class="btn btn-primary">
                        Update Password
                    </button>
                    
                    @if (session('status') === 'password-updated')
                        <p class="text-sm text-green-600">Password updated.</p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Account -->
    <div class="card mt-6">
        <h2 class="card-title mb-4 text-red-600">Delete Account</h2>
        <p class="text-sm opacity-70 mb-4">
            Once your account is deleted, all of its resources and data will be permanently deleted. 
            Before deleting your account, please download any data or information that you wish to retain.
        </p>

        <button type="button" 
                class="btn btn-danger"
                onclick="document.getElementById('delete-account-form').style.display = 'block'">
            Delete Account
        </button>

        <form method="POST" 
              action="{{ route('profile.destroy') }}" 
              id="delete-account-form" 
              class="hidden mt-4 p-4 border border-red-200 dark:border-red-800 rounded-lg">
            @csrf
            @method('delete')

            <h3 class="font-medium mb-2">Are you sure you want to delete your account?</h3>
            <p class="text-sm opacity-70 mb-4">
                Once your account is deleted, all of its resources and data will be permanently deleted. 
                Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Enter your password to confirm" 
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button" 
                        class="btn btn-outline"
                        onclick="document.getElementById('delete-account-form').style.display = 'none'">
                    Cancel
                </button>
                <button type="submit" class="btn btn-danger">
                    Delete Account
                </button>
            </div>
        </form>
    </div>
@endsection