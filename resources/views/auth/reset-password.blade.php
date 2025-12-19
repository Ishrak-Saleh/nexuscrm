<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset Password - NexusCRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Theme Variables - Referencing app.blade.php variables */
        :root {
            --color-text: #160b19;
            --color-bg: #f6f1f9;
            --color-primary: #53285d;
            --color-secondary: #cd89b5;
            --color-accent: #af4b75;
            --color-border: #cd89b5;
            --color-danger: #af4b75;
            --color-warning: #cd89b5;
            --color-success: #53285d;
        }

        :root[data-theme="light"] {
            --color-text: #160b19;
            --color-bg: #f6f1f9;
            --color-primary: #53285d;
            --color-secondary: #cd89b5;
            --color-accent: #af4b75;
            --color-border: rgba(205, 137, 181, 0.3);
            --input-bg: #ffffff;
            --card-bg: #eee9f1;
            --shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.12);
        }
        
        :root[data-theme="dark"] {
            --color-text: #f1e6f4;
            --color-bg: #0b060e;
            --color-primary: #cda2d7;
            --color-secondary: #76325e;
            --color-accent: #b4507a;
            --color-border: rgba(118, 50, 94, 0.5);
            --input-bg: #1a0f1c;
            --card-bg: #130e16;
            --shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
            --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.35);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--color-text);
            background: var(--color-bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            transition: all 0.3s ease;
            line-height: 1.6;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(83, 40, 93, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(205, 137, 181, 0.05) 0%, transparent 20%);
        }

        body[data-theme="dark"] {
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(205, 162, 215, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(118, 50, 94, 0.05) 0%, transparent 20%);
        }

        .auth-container {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
        }

        .auth-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--color-border);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .auth-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }

        /* Decorative accent line */
        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-accent));
            border-radius: 16px 16px 0 0;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-logo {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--color-primary);
            text-decoration: none;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .auth-logo:hover {
            color: var(--color-accent);
            transform: translateY(-1px);
        }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 0.75rem;
            position: relative;
            display: inline-block;
        }

        .auth-title::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-accent));
            border-radius: 3px;
        }

        .auth-subtitle {
            font-size: 0.95rem;
            color: var(--color-text);
            opacity: 0.8;
            line-height: 1.5;
            max-width: 320px;
            margin: 0 auto;
        }

        /* Form Styles */
        .auth-form {
            margin-top: 2rem;
        }

        .form-group {
            margin-bottom: 1.75rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
            font-weight: 500;
            color: var(--color-text);
            font-size: 0.95rem;
        }

        .form-label svg {
            opacity: 0.7;
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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
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

        .form-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-text);
            opacity: 0.6;
            transition: all 0.3s ease;
        }

        .form-input:focus + .form-icon {
            color: var(--color-primary);
            opacity: 1;
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

        .password-requirements {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: var(--color-text);
            opacity: 0.7;
        }

        .requirement.valid {
            color: var(--color-primary);
            opacity: 1;
        }

        .requirement.valid svg {
            color: var(--color-primary);
        }

        .strength-meter {
            height: 6px;
            background: var(--color-border);
            border-radius: 3px;
            margin-top: 0.5rem;
            overflow: hidden;
            position: relative;
        }

        .strength-fill {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0%;
            background: var(--color-primary);
            transition: width 0.3s ease, background 0.3s ease;
            border-radius: 3px;
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
            background: linear-gradient(90deg, var(--color-primary), var(--color-accent));
        }

        .strength-label {
            font-size: 0.8rem;
            color: var(--color-text);
            opacity: 0.7;
            margin-top: 0.25rem;
            text-align: right;
        }

        /* Toggle Password Visibility */
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
            transition: all 0.3s ease;
            padding: 0.25rem;
            border-radius: 4px;
        }

        .toggle-password:hover {
            opacity: 1;
            color: var(--color-primary);
            background: rgba(83, 40, 93, 0.1);
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            width: 100%;
            background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
            color: white;
            box-shadow: 0 4px 12px rgba(83, 40, 93, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(83, 40, 93, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        /* Theme Toggle */
        .theme-toggle-container {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .theme-toggle {
            background: var(--card-bg);
            border: 1px solid var(--color-border);
            color: var(--color-text);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            background: var(--color-primary);
            color: var(--color-bg);
            transform: rotate(15deg);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-card {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-group {
            animation: slideIn 0.4s ease-out forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }

        /* Responsive Design */
        @media (max-width: 480px) {
            .auth-card {
                padding: 2rem 1.5rem;
            }
            
            .auth-title {
                font-size: 1.25rem;
            }
            
            .auth-subtitle {
                font-size: 0.9rem;
            }
            
            .btn {
                padding: 0.75rem 1.5rem;
            }
            
            .password-requirements {
                grid-template-columns: 1fr;
            }
        }

        /* Loading State */
        .btn-loading {
            opacity: 0.8;
            cursor: not-allowed;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Success Animation */
        .success-check {
            display: none;
            width: 24px;
            height: 24px;
            margin-left: 0.5rem;
            animation: checkmark 0.5s ease-out;
        }

        @keyframes checkmark {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
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
    </style>
</head>
<body>
    <div class="theme-toggle-container">
        <button class="theme-toggle" onclick="toggleTheme()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 17C14.7614 17 17 14.7614 17 12C17 9.23858 14.7614 7 12 7C9.23858 7 7 9.23858 7 12C7 14.7614 9.23858 17 12 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 1V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 21V23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.22 4.22L5.64 5.64" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.36 18.36L19.78 19.78" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M1 12H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M21 12H23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M4.22 19.78L5.64 18.36" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.36 5.64L19.78 4.22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <a href="{{ route('login') }}" class="auth-logo">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    NexusCRM
                </a>
                
                <h1 class="auth-title">Reset Your Password</h1>
                <p class="auth-subtitle">
                    Create a new secure password for your account
                </p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="auth-form" id="resetForm">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Email Address
                    </label>
                    
                    <div class="form-input-container">
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            class="form-input @error('email') is-invalid @enderror" 
                            value="{{ old('email', $request->email) }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="Enter your email address"
                        >
                        
                        <svg class="form-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    
                    @error('email')
                        <span class="invalid-feedback">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 9V12M12 15H12.01M5.07183 19H18.9282C20.4678 19 21.4301 17.3333 20.6603 16L13.7321 4C12.9623 2.66667 11.0377 2.66667 10.2679 4L3.33975 16C2.56995 17.3333 3.5322 19 5.07183 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 4H5C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 8V7C16 5.34315 14.6569 4 13 4H11C9.34315 4 8 5.34315 8 7V8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        New Password
                    </label>
                    
                    <div class="form-input-container">
                        <input 
                            id="password" 
                            type="password"
                            name="password"
                            class="form-input @error('password') is-invalid @enderror" 
                            required 
                            autocomplete="new-password"
                            placeholder="Create a new password"
                        >
                        
                        <svg class="form-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 4H5C4.44772 4 4 4.44772 4 5V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V5C20 4.44772 19.5523 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 8V7C16 5.34315 14.6569 4 13 4H11C9.34315 4 8 5.34315 8 7V8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        
                        <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password')">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Password Requirements -->
                    <div class="password-strength-container">
                        <div class="password-requirements" id="passwordRequirements">
                            <div class="requirement" data-requirement="length">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                At least 8 characters
                            </div>
                            <div class="requirement" data-requirement="uppercase">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                One uppercase letter
                            </div>
                            <div class="requirement" data-requirement="number">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                One number
                            </div>
                            <div class="requirement" data-requirement="special">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                One special character
                            </div>
                        </div>
                        
                        <div class="strength-meter">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div class="strength-label" id="strengthLabel">Password strength: None</div>
                    </div>
                    
                    @error('password')
                        <span class="invalid-feedback">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 9V12M12 15H12.01M5.07183 19H18.9282C20.4678 19 21.4301 17.3333 20.6603 16L13.7321 4C12.9623 2.66667 11.0377 2.66667 10.2679 4L3.33975 16C2.56995 17.3333 3.5322 19 5.07183 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Confirm New Password
                    </label>
                    
                    <div class="form-input-container">
                        <input 
                            id="password_confirmation" 
                            type="password"
                            name="password_confirmation"
                            class="form-input @error('password_confirmation') is-invalid @enderror" 
                            required 
                            autocomplete="new-password"
                            placeholder="Confirm your new password"
                        >
                        
                        <svg class="form-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        
                        <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password_confirmation')">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="password-match" id="passwordMatch"></div>
                    
                    @error('password_confirmation')
                        <span class="invalid-feedback">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 9V12M12 15H12.01M5.07183 19H18.9282C20.4678 19 21.4301 17.3333 20.6603 16L13.7321 4C12.9623 2.66667 11.0377 2.66667 10.2679 4L3.33975 16C2.56995 17.3333 3.5322 19 5.07183 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn" id="submitBtn">
                        <span>{{ __('Reset Password') }}</span>
                        <svg class="success-check" id="successCheck" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Theme toggle
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }

        // Set theme on load
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);

            // Form elements
            const form = document.getElementById('resetForm');
            const submitBtn = document.getElementById('submitBtn');
            const successCheck = document.getElementById('successCheck');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const passwordMatch = document.getElementById('passwordMatch');
            const strengthFill = document.getElementById('strengthFill');
            const strengthLabel = document.getElementById('strengthLabel');
            const requirements = document.querySelectorAll('.requirement');
            
            // Add loading state to submit button
            if (form && submitBtn) {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    
                    // Validate passwords match
                    if (passwordInput.value !== confirmPasswordInput.value) {
                        passwordMatch.textContent = 'Passwords do not match';
                        passwordMatch.className = 'password-match not-matching';
                        confirmPasswordInput.classList.add('is-invalid');
                        confirmPasswordInput.focus();
                        return;
                    }
                    
                    submitBtn.classList.add('btn-loading');
                    submitBtn.disabled = true;
                    
                    // Simulate processing
                    setTimeout(() => {
                        submitBtn.classList.remove('btn-loading');
                        successCheck.style.display = 'inline-block';
                        
                        // Submit the form after showing success animation
                        setTimeout(() => {
                            form.submit();
                        }, 800);
                    }, 1000);
                });
            }

            // Toggle password visibility
            window.togglePasswordVisibility = function(fieldId) {
                const input = document.getElementById(fieldId);
                const toggleBtn = input.nextElementSibling?.nextElementSibling;
                
                if (!input || !toggleBtn) return;
                
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
            }

            // Password strength checker
            function checkPasswordStrength(password) {
                let strength = 0;
                const requirements = {
                    length: password.length >= 8,
                    uppercase: /[A-Z]/.test(password),
                    number: /[0-9]/.test(password),
                    special: /[^A-Za-z0-9]/.test(password)
                };

                // Count fulfilled requirements
                Object.values(requirements).forEach(fulfilled => {
                    if (fulfilled) strength++;
                });

                // Update UI
                requirements.forEach(req => {
                    const type = req.getAttribute('data-requirement');
                    if (requirements[type]) {
                        req.classList.add('valid');
                        req.querySelector('svg').innerHTML = `
                            <path d="M9 12L11 14L15 10M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        `;
                    } else {
                        req.classList.remove('valid');
                        req.querySelector('svg').innerHTML = `
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        `;
                    }
                });

                // Update strength meter
                const strengthClasses = ['', 'weak', 'fair', 'good', 'strong'];
                const strengthLabels = ['None', 'Weak', 'Fair', 'Good', 'Strong'];
                
                strengthFill.className = 'strength-fill ' + strengthClasses[strength];
                strengthLabel.textContent = `Password strength: ${strengthLabels[strength]}`;

                return strength;
            }

            // Password match checker
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirm = confirmPasswordInput.value;
                
                if (!password || !confirm) {
                    passwordMatch.textContent = '';
                    passwordMatch.className = 'password-match';
                    return;
                }
                
                if (password === confirm) {
                    passwordMatch.innerHTML = `
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M9 12L11 14L15 10M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Passwords match
                    `;
                    passwordMatch.className = 'password-match matching';
                    confirmPasswordInput.classList.remove('is-invalid');
                } else {
                    passwordMatch.innerHTML = `
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M12 9V12M12 15H12.01M5.07183 19H18.9282C20.4678 19 21.4301 17.3333 20.6603 16L13.7321 4C12.9623 2.66667 11.0377 2.66667 10.2679 4L3.33975 16C2.56995 17.3333 3.5322 19 5.07183 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Passwords do not match
                    `;
                    passwordMatch.className = 'password-match not-matching';
                    confirmPasswordInput.classList.add('is-invalid');
                }
            }

            // Event listeners
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    checkPasswordStrength(this.value);
                    checkPasswordMatch();
                    
                    // Form validation feedback
                    const isValid = this.checkValidity();
                    if (isValid) {
                        this.classList.remove('is-invalid');
                        this.style.borderColor = '';
                    }
                });

                passwordInput.addEventListener('invalid', function(e) {
                    e.preventDefault();
                    this.classList.add('is-invalid');
                    this.style.borderColor = 'var(--color-accent)';
                });
            }

            if (confirmPasswordInput) {
                confirmPasswordInput.addEventListener('input', function() {
                    checkPasswordMatch();
                    
                    // Form validation feedback
                    const isValid = this.checkValidity();
                    if (isValid) {
                        this.classList.remove('is-invalid');
                        this.style.borderColor = '';
                    }
                });

                confirmPasswordInput.addEventListener('invalid', function(e) {
                    e.preventDefault();
                    this.classList.add('is-invalid');
                    this.style.borderColor = 'var(--color-accent)';
                });
            }

            // Add enter key submission
            document.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && e.target.type !== 'textarea') {
                    const form = document.getElementById('resetForm');
                    if (form && form.contains(e.target)) {
                        form.requestSubmit();
                    }
                }
            });

            // Add focus animation to inputs
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.parentElement.style.transform = 'translateY(-2px)';
                });
                
                input.addEventListener('blur', () => {
                    input.parentElement.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>