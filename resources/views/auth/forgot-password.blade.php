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
        /* Theme Variables - Matching app.blade.php */
        :root[data-theme="light"] {
            --text: #160b19;
            --background: #f6f1f9;
            --primary: #53285d;
            --secondary: #cd89b5;
            --accent: #af4b75;
            --card: #eee9f1;
            --stat-card: #e9d1e4;
            --button: #743652;
            --button-hover: #b4507a;
            --border: rgba(205, 137, 181, 0.3);
            --input-bg: #ffffff;
            --shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.12);
        }
        
        :root[data-theme="dark"] {
            --text: #f1e6f4;
            --background: #0b060e;
            --primary: #cda2d7;
            --secondary: #76325e;
            --accent: #b4507a;
            --card: #130e16;
            --stat-card: #2b1326;
            --button: #743652;
            --button-hover: #b4507a;
            --border: rgba(118, 50, 94, 0.5);
            --input-bg: #1a0f1c;
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
            color: var(--text);
            background: var(--background);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            transition: all 0.3s ease;
            line-height: 1.6;
        }

        .auth-container {
            width: 100%;
            max-width: 440px;
            margin: 0 auto;
        }

        .auth-card {
            background: var(--card);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .auth-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
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
            color: var(--primary);
            text-decoration: none;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .auth-logo:hover {
            color: var(--accent);
        }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            font-size: 0.95rem;
            color: var(--text);
            opacity: 0.7;
            line-height: 1.5;
        }

        /* Session Status */
        .auth-session-status {
            background: rgba(83, 40, 93, 0.1);
            border: 1px solid var(--primary);
            color: var(--primary);
            padding: 0.875rem 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .auth-session-status:hover {
            background: rgba(83, 40, 93, 0.15);
            transform: translateY(-1px);
        }

        /* Form Styles */
        .auth-form {
            margin-top: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text);
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            background: var(--input-bg);
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem;
            color: var(--text);
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--button);
            box-shadow: 0 0 0 3px rgba(116, 54, 82, 0.15);
        }

        .form-input.is-invalid {
            border-color: var(--accent);
        }

        .form-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(175, 75, 117, 0.15);
        }

        .invalid-feedback {
            color: var(--accent);
            font-size: 0.85rem;
            margin-top: 0.375rem;
            display: block;
        }

        /* Button Styles - Matching index.blade.php */
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
            box-shadow: 0 4px 12px rgba(116, 54, 82, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: var(--button);
            color: var(--background);
        }

        .btn-primary:hover {
            background: var(--button-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(116, 54, 82, 0.3);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        /* Back to Login Link */
        .back-to-login {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
        }

        .back-to-login a {
            color: var(--text);
            text-decoration: none;
            font-size: 0.9rem;
            opacity: 0.8;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-to-login a:hover {
            color: var(--primary);
            opacity: 1;
        }

        /* Theme Toggle */
        .theme-toggle-container {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .theme-toggle {
            background: var(--card);
            border: 1px solid var(--border);
            color: var(--text);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            background: var(--button);
            color: var(--background);
            transform: rotate(15deg);
        }

        /* Animation */
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

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.02);
            }
            100% {
                transform: scale(1);
            }
        }

        .btn-primary:hover {
            animation: pulse 2s infinite;
        }

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

        /* Success Message */
        .success-message {
            background: rgba(83, 40, 93, 0.1);
            border: 1px solid var(--primary);
            color: var(--primary);
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
            animation: fadeIn 0.3s ease-out;
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
                    Enter your email address and we'll send you a link to reset your password.
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        class="form-input @error('email') is-invalid @enderror" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        placeholder="Enter your email address"
                    >
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        {{ __('Send Reset Link') }}
                    </button>
                </div>
            </form>

            <div class="back-to-login">
                <a href="{{ route('login') }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Back to Login
                </a>
            </div>
        </div>
    </div>

    <script>
        //Theme toggle
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }

        //Set theme on load
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);

            //Add loading state to submit button
            const form = document.querySelector('.auth-form');
            const submitBtn = document.getElementById('submitBtn');
            
            if (form && submitBtn) {
                form.addEventListener('submit', () => {
                    submitBtn.classList.add('btn-loading');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = 'Sending...';
                });
            }

            //Add subtle animation to form inputs
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.parentElement.style.transform = 'translateY(-2px)';
                });
                
                input.addEventListener('blur', () => {
                    input.parentElement.style.transform = 'translateY(0)';
                });
            });

            //Add enter key submission
            document.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && e.target.type !== 'textarea') {
                    const form = document.querySelector('.auth-form');
                    if (form && form.contains(e.target)) {
                        form.requestSubmit();
                    }
                }
            });
        });

        //Form validation feedback
        const emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.addEventListener('input', function() {
                const isValid = this.checkValidity();
                if (isValid) {
                    this.classList.remove('is-invalid');
                    this.style.borderColor = 'var(--border)';
                }
            });

            emailInput.addEventListener('invalid', function(e) {
                e.preventDefault();
                this.classList.add('is-invalid');
                this.style.borderColor = 'var(--accent)';
                
                //Show custom error message
                const errorMessage = this.nextElementSibling;
                if (errorMessage && errorMessage.classList.contains('invalid-feedback')) {
                    errorMessage.style.display = 'block';
                }
            });
        }
    </script>
</body>
</html>