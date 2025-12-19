@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <!-- Header -->
    <div class="dashboard-header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="page-title">Profile Settings</h1>
                <p class="page-subtitle">Manage your account preferences and security</p>
            </div>
            <a href="{{ route('dashboard') }}" class="primary-action-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Success Messages -->
    @if (session('status') === 'profile-updated')
        <div class="success-message-card">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Profile information updated successfully.
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="success-message-card">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M19 4H5C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M16 8V7C16 5.34315 14.6569 4 13 4H11C9.34315 4 8 5.34315 8 7V8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Password updated successfully.
        </div>
    @endif

    <div class="content-section">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Update Profile Information -->
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="card-title">Profile Information</h2>
                        <p class="card-subtitle">Update your account's profile information</p>
                    </div>
                    <div class="profile-avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" id="profileForm">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="name">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Full Name
                            </label>
                        </div>
                        <div class="form-input-container">
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="form-input @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $user->name) }}" 
                                   required 
                                   autofocus 
                                   autocomplete="name"
                                   placeholder="Enter your full name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="email">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Email Address
                            </label>
                        </div>
                        <div class="form-input-container">
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-input @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $user->email) }}" 
                                   required 
                                   autocomplete="username"
                                   placeholder="Enter your email address">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" id="profileSubmitBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16L21 8V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 21V13H7V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 3V8H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Update Password -->
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="card-title">Update Password</h2>
                        <p class="card-subtitle">Secure your account with a strong password</p>
                    </div>
                    <div class="security-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 4H5C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 8V7C16 5.34315 14.6569 4 13 4H11C9.34315 4 8 5.34315 8 7V8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.update') }}" id="passwordForm">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="current_password">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19 4H5C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16 8V7C16 5.34315 14.6569 4 13 4H11C9.34315 4 8 5.34315 8 7V8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Current Password
                            </label>
                        </div>
                        <div class="form-input-container">
                            <input type="password" 
                                   id="current_password" 
                                   name="current_password" 
                                   class="form-input @error('current_password') is-invalid @enderror" 
                                   autocomplete="current-password"
                                   placeholder="Enter your current password">
                            <button type="button" class="toggle-password" onclick="togglePasswordVisibility('current_password')">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19 4H5C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16 8V7C16 5.34315 14.6569 4 13 4H11C9.34315 4 8 5.34315 8 7V8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                New Password
                            </label>
                        </div>
                        <div class="form-input-container">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-input @error('password') is-invalid @enderror" 
                                   autocomplete="new-password"
                                   placeholder="Create a new password">
                            <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password')">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Password Strength Meter -->
                        <div class="password-strength-container" id="passwordStrengthContainer">
                            <div class="strength-meter">
                                <div class="strength-fill" id="strengthFill"></div>
                            </div>
                            <div class="strength-label" id="strengthLabel">Password strength: None</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password_confirmation">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Confirm New Password
                            </label>
                        </div>
                        <div class="form-input-container">
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   class="form-input" 
                                   autocomplete="new-password"
                                   placeholder="Confirm your new password">
                            <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password_confirmation')">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Password Match Indicator -->
                        <div class="password-match" id="passwordMatch"></div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" id="passwordSubmitBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 4H5C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 8V7C16 5.34315 14.6569 4 13 4H11C9.34315 4 8 5.34315 8 7V8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="card mt-6">
            <div class="card-header">
                <div>
                    <h2 class="card-title text-danger">Delete Account</h2>
                    <p class="card-subtitle">Permanently remove your account and all data</p>
                </div>
                <div class="danger-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 9V12M12 15H12.01M5.07183 19H18.9282C20.4678 19 21.4301 17.3333 20.6603 16L13.7321 4C12.9623 2.66667 11.0377 2.66667 10.2679 4L3.33975 16C2.56995 17.3333 3.5322 19 5.07183 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <div class="delete-warning">
                <div class="warning-content">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 9V12M12 15H12.01M5.07183 19H18.9282C20.4678 19 21.4301 17.3333 20.6603 16L13.7321 4C12.9623 2.66667 11.0377 2.66667 10.2679 4L3.33975 16C2.56995 17.3333 3.5322 19 5.07183 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div>
                        <h3>Warning: This action cannot be undone</h3>
                        <p>Once your account is deleted, all of your clients, notes, and data will be permanently removed. Please ensure you have downloaded any important information before proceeding.</p>
                    </div>
                </div>
            </div>

            <button type="button" 
                    class="btn btn-danger w-full"
                    onclick="toggleDeleteForm()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 6H5H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Delete Account
            </button>

            <form method="POST" 
                  action="{{ route('profile.destroy') }}" 
                  id="deleteAccountForm" 
                  class="delete-form hidden">
                @csrf
                @method('delete')

                <div class="confirmation-message">
                    <h3>Confirm Account Deletion</h3>
                    <p>To confirm you want to delete your account, please enter your password below.</p>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="delete_password">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 4H5C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 8V7C16 5.34315 14.6569 4 13 4H11C9.34315 4 8 5.34315 8 7V8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Your Password
                        </label>
                    </div>
                    <div class="form-input-container">
                        <input type="password" 
                               id="delete_password" 
                               name="password" 
                               class="form-input @error('password') is-invalid @enderror" 
                               placeholder="Enter your password to confirm"
                               required>
                        <button type="button" class="toggle-password" onclick="togglePasswordVisibility('delete_password')">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" 
                            class="btn btn-outline"
                            onclick="toggleDeleteForm()">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 6H5H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Delete My Account
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
/* ====================================
   PROFILE PAGE STYLES
   ==================================== */

/* Header */
.dashboard-header {
    background: var(--card-bg);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
}

.dashboard-header:hover {
    box-shadow: var(--shadow-hover);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-left {
    flex: 1;
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    color: var(--color-text);
}

.page-subtitle {
    font-size: 0.9rem;
    opacity: 0.7;
    color: var(--color-text);
}

/* Cards */
.card {
    background: var(--card-bg);
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-2px);
}

/* Success Messages */
.success-message-card {
    background: rgba(83, 40, 93, 0.1);
    border: 1px solid var(--color-primary);
    color: var(--color-primary);
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
    animation: slideIn 0.5s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Card Header */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--color-border);
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--color-text);
}

.card-subtitle {
    font-size: 0.9rem;
    color: var(--color-text);
    opacity: 0.7;
    margin-top: 0.25rem;
}

/* Profile Avatar */
.profile-avatar {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: var(--color-primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.25rem;
}

/* Security Icon */
.security-icon,
.danger-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: rgba(83, 40, 93, 0.1);
    color: var(--color-primary);
    display: flex;
    align-items: center;
    justify-content: center;
}

.danger-icon {
    background: rgba(175, 75, 117, 0.1);
    color: var(--color-accent);
}

/* Form Groups */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
}

.form-label {
    font-weight: 500;
    color: var(--color-text);
    font-size: 0.95rem;
}

.form-input-container {
    position: relative;
}

.form-input {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 3rem;
    background: var(--input-bg);
    border: 2px solid var(--color-border);
    border-radius: 10px;
    font-size: 0.95rem;
    color: var(--color-text);
    transition: all 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(83, 40, 93, 0.15);
}

.form-input.is-invalid {
    border-color: var(--color-accent);
}

.form-input.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(175, 75, 117, 0.15);
}

.toggle-password {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--color-text);
    opacity: 0.6;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.toggle-password:hover {
    opacity: 1;
    color: var(--color-primary);
    background: rgba(83, 40, 93, 0.1);
}

.invalid-feedback {
    color: var(--color-accent);
    font-size: 0.85rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem;
    background: rgba(175, 75, 117, 0.1);
    border-radius: 6px;
    border-left: 3px solid var(--color-accent);
}

/* Password Strength */
.password-strength-container {
    margin-top: 0.75rem;
}

.strength-meter {
    height: 6px;
    background: var(--color-border);
    border-radius: 3px;
    overflow: hidden;
    position: relative;
}

.strength-fill {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0%;
    border-radius: 3px;
    transition: width 0.3s ease, background 0.3s ease;
}

.strength-fill.weak { 
    width: 25%; 
    background: var(--color-accent); 
}
.strength-fill.fair { 
    width: 50%; 
    background: var(--color-secondary); 
}
.strength-fill.good { 
    width: 75%; 
    background: var(--color-primary); 
}
.strength-fill.strong { 
    width: 100%; 
    background: var(--color-primary);
}

.strength-label {
    font-size: 0.8rem;
    color: var(--color-text);
    opacity: 0.7;
    margin-top: 0.25rem;
    text-align: right;
}

/* Password Match Indicator */
.password-match {
    font-size: 0.85rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    opacity: 0;
    transition: all 0.3s ease;
}

.password-match.matching {
    opacity: 1;
    color: var(--color-primary);
}

.password-match.not-matching {
    opacity: 1;
    color: var(--color-accent);
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

/* Delete Account Section */
.delete-warning {
    background: rgba(175, 75, 117, 0.1);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.warning-content {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.warning-content h3 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--color-accent);
}

.warning-content p {
    font-size: 0.9rem;
    color: var(--color-text);
    opacity: 0.8;
    line-height: 1.5;
}

.delete-form {
    margin-top: 1.5rem;
    padding: 1.5rem;
    background: rgba(175, 75, 117, 0.05);
    border-radius: 12px;
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.confirmation-message {
    margin-bottom: 1.5rem;
    text-align: center;
}

.confirmation-message h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--color-text);
}

.confirmation-message p {
    font-size: 0.9rem;
    color: var(--color-text);
    opacity: 0.7;
    line-height: 1.5;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: none;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.btn-primary {
    background: var(--color-primary);
    color: white;
}

.btn-primary:hover {
    background: var(--color-accent);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(83, 40, 93, 0.3);
}

.btn-outline {
    background: transparent;
    border: 2px solid var(--color-secondary);
    color: var(--color-text);
}

.btn-outline:hover {
    background: var(--color-secondary);
    color: var(--color-bg);
    transform: translateY(-2px);
}

.btn-danger {
    background: var(--color-accent);
    color: white;
}

.btn-danger:hover {
    background: var(--color-danger);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(175, 75, 117, 0.3);
}

/* Utility Classes */
.hidden {
    display: none !important;
}

.grid {
    display: grid;
}

.grid-cols-1 {
    grid-template-columns: 1fr;
}

.lg\:grid-cols-2 {
    grid-template-columns: repeat(2, 1fr);
}

.gap-6 {
    gap: 1.5rem;
}

.mt-6 {
    margin-top: 1.5rem;
}

.w-full {
    width: 100%;
}

/* Primary Action Button */
.primary-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--color-primary);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.primary-action-btn:hover {
    background: var(--color-accent);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(83, 40, 93, 0.3);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .lg\:grid-cols-2 {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .dashboard-header {
        padding: 1.25rem;
    }
    
    .header-content {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .card-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .warning-content {
        flex-direction: column;
        text-align: center;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    window.togglePasswordVisibility = function(fieldId) {
        const input = document.getElementById(fieldId);
        const toggleBtn = input.nextElementSibling;
        
        if (input.type === 'password') {
            input.type = 'text';
            toggleBtn.innerHTML = `
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.94 17.94C16.2306 19.243 14.1491 19.9649 12 20C5 20 1 12 1 12C2.24389 9.6819 3.96914 7.65661 6.06 6.06L17.94 17.94Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1 1L23 23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.9 4.24C10.5883 4.07888 11.2931 3.99834 12 4C19 4 23 12 23 12C22.393 13.1356 21.6691 14.2047 20.84 15.19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 17C9.87827 17 7.84344 16.1571 6.34315 14.6569C4.84285 13.1566 4 11.1217 4 9C4 8.659 4.028 8.325 4.08 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            `;
        } else {
            input.type = 'password';
            toggleBtn.innerHTML = `
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            `;
        }
    };

    // Toggle delete account form
    window.toggleDeleteForm = function() {
        const form = document.getElementById('deleteAccountForm');
        form.classList.toggle('hidden');
        
        if (!form.classList.contains('hidden')) {
            form.scrollIntoView({ behavior: 'smooth' });
            document.getElementById('delete_password').focus();
        }
    };

    // Password strength checker
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const strengthFill = document.getElementById('strengthFill');
    const strengthLabel = document.getElementById('strengthLabel');
    const passwordMatch = document.getElementById('passwordMatch');
    
    if (passwordInput && strengthFill && strengthLabel) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Check password criteria
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            // Update strength indicator
            const strengthClasses = ['', 'weak', 'fair', 'good', 'strong'];
            const strengthTexts = ['None', 'Weak', 'Fair', 'Good', 'Strong'];
            
            strengthFill.className = 'strength-fill ' + strengthClasses[strength];
            strengthLabel.textContent = `Password strength: ${strengthTexts[strength]}`;
            
            // Check password match
            checkPasswordMatch();
        });
    }
    
    // Password match checker
    function checkPasswordMatch() {
        const password = passwordInput?.value || '';
        const confirm = confirmPasswordInput?.value || '';
        
        if (!password || !confirm) {
            if (passwordMatch) {
                passwordMatch.textContent = '';
                passwordMatch.className = 'password-match';
            }
            return;
        }
        
        if (password === confirm) {
            if (passwordMatch) {
                passwordMatch.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M9 12L11 14L15 10M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Passwords match
                `;
                passwordMatch.className = 'password-match matching';
            }
            if (confirmPasswordInput) {
                confirmPasswordInput.classList.remove('is-invalid');
            }
        } else {
            if (passwordMatch) {
                passwordMatch.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M12 9V12M12 15H12.01M5.07183 19H18.9282C20.4678 19 21.4301 17.3333 20.6603 16L13.7321 4C12.9623 2.66667 11.0377 2.66667 10.2679 4L3.33975 16C2.56995 17.3333 3.5322 19 5.07183 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Passwords do not match
                `;
                passwordMatch.className = 'password-match not-matching';
            }
            if (confirmPasswordInput) {
                confirmPasswordInput.classList.add('is-invalid');
            }
        }
    }
    
    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    }
    
    // Form submission loading states
    const profileForm = document.getElementById('profileForm');
    const profileSubmitBtn = document.getElementById('profileSubmitBtn');
    const passwordForm = document.getElementById('passwordForm');
    const passwordSubmitBtn = document.getElementById('passwordSubmitBtn');
    
    if (profileForm && profileSubmitBtn) {
        profileForm.addEventListener('submit', function(e) {
            profileSubmitBtn.disabled = true;
            profileSubmitBtn.innerHTML = `
                <svg class="animate-spin" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 9.27455 20.9097 6.80375 19.1414 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Saving...
            `;
        });
    }
    
    if (passwordForm && passwordSubmitBtn) {
        passwordForm.addEventListener('submit', function(e) {
            if (passwordInput.value !== confirmPasswordInput.value) {
                e.preventDefault();
                checkPasswordMatch();
                confirmPasswordInput.focus();
                return;
            }
            
            passwordSubmitBtn.disabled = true;
            passwordSubmitBtn.innerHTML = `
                <svg class="animate-spin" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 9.27455 20.9097 6.80375 19.1414 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Updating...
            `;
        });
    }
    
    // Add spin animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
    `;
    document.head.appendChild(style);
    
    // Focus first invalid input
    const invalidInputs = document.querySelectorAll('.is-invalid');
    if (invalidInputs.length > 0) {
        invalidInputs[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>
@endpush