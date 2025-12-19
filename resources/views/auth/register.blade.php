<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Create Account') }} - NexusCRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ====================================
           THEME VARIABLES
           ==================================== */
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
            --border: #e5d8eb;
            --shadow: rgba(22, 11, 25, 0.08);
            --error: #dc3545;
            --success: #28a745;
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
            --border: #2d1b32;
            --shadow: rgba(241, 230, 244, 0.05);
            --error: #dc3545;
            --success: #28a745;
        }

        /* ====================================
           BASE STYLES
           ==================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: var(--background);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        /* ====================================
           AUTH CONTAINER
           ==================================== */
        .auth-container {
            width: 100%;
            max-width: 480px;
            animation: fadeInUp 0.6s ease;
        }

        /* ====================================
           AUTH HEADER
           ==================================== */
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            margin-bottom: 1rem;
        }

        .auth-logo:hover {
            color: var(--accent);
        }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .auth-subtitle {
            font-size: 0.95rem;
            color: var(--text);
            opacity: 0.7;
        }

        /* ====================================
           AUTH CARD
           ==================================== */
        .auth-card {
            background: var(--card);
            border-radius: 16px;
            padding: 2.5rem;
            border: 1px solid var(--border);
            box-shadow: 0 8px 32px var(--shadow);
            transition: all 0.3s ease;
        }

        .auth-card:hover {
            box-shadow: 0 12px 48px var(--shadow);
        }

        /* ====================================
           FORM STYLES
           ==================================== */
        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text);
        }

        .form-label-text {
            opacity: 0.9;
        }

        .required {
            color: var(--error);
            font-size: 0.875em;
        }

        /* ====================================
           INPUT STYLES
           ==================================== */
        .form-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            background: var(--background);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.95rem;
            color: var(--text);
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px var(--shadow);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--button);
            box-shadow: 0 0 0 3px rgba(116, 54, 82, 0.1);
        }

        /* ====================================
           INPUT WITH ICON
           ==================================== */
        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text);
            opacity: 0.5;
            pointer-events: none;
        }

        /* ====================================
           PASSWORD STRENGTH
           ==================================== */
        .password-strength {
            margin-top: 0.5rem;
        }

        .strength-meter {
            height: 4px;
            background: var(--border);
            border-radius: 2px;
            margin-bottom: 0.25rem;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 2px;
            transition: width 0.3s ease, background 0.3s ease;
        }

        .strength-text {
            font-size: 0.75rem;
            color: var(--text);
            opacity: 0.7;
        }

        /* ====================================
           ERROR STATES
           ==================================== */
        .is-invalid {
            border-color: var(--error) !important;
        }

        .error-message {
            font-size: 0.875rem;
            color: var(--error);
            margin-top: 0.25rem;
        }

        .validation-errors {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.2);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .validation-errors ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .validation-errors li {
            font-size: 0.875rem;
            color: var(--error);
            margin-bottom: 0.25rem;
        }

        .validation-errors li:last-child {
            margin-bottom: 0;
        }

        /* ====================================
           BUTTONS
           ==================================== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            width: 100%;
        }

        .btn-primary {
            background: var(--button);
            color: white;
            box-shadow: 0 2px 8px rgba(116, 54, 82, 0.2);
        }

        .btn-primary:hover {
            background: var(--button-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(116, 54, 82, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--text);
            border: 2px solid var(--border);
        }

        .btn-outline:hover {
            background: var(--button);
            color: white;
            border-color: var(--button);
        }

        /* ====================================
           TERMS & CONDITIONS
           ==================================== */
        .terms {
            font-size: 0.875rem;
            color: var(--text);
            opacity: 0.7;
            line-height: 1.5;
        }

        .terms a {
            color: var(--button);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .terms a:hover {
            color: var(--button-hover);
        }

        /* ====================================
           AUTH FOOTER
           ==================================== */
        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            color: var(--text);
            opacity: 0.7;
            font-size: 0.875rem;
        }

        .auth-footer a {
            color: var(--button);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .auth-footer a:hover {
            color: var(--button-hover);
        }

        /* ====================================
           THEME TOGGLE
           ==================================== */
        .theme-toggle {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.75rem;
            color: var(--text);
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 100;
        }

        .theme-toggle:hover {
            background: var(--button);
            color: white;
            border-color: var(--button);
        }

        /* ====================================
           ANIMATIONS
           ==================================== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ====================================
           RESPONSIVE DESIGN
           ==================================== */
        @media (max-width: 480px) {
            .auth-card {
                padding: 1.5rem;
            }
            
            .auth-title {
                font-size: 1.25rem;
            }
            
            .form-input {
                padding: 0.75rem 0.875rem 0.75rem 2.5rem;
                font-size: 0.9rem;
            }
            
            .input-icon {
                left: 0.875rem;
            }
            
            .theme-toggle {
                top: 1rem;
                right: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Theme Toggle -->
    <button class="theme-toggle" onclick="toggleTheme()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
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

    <div class="auth-container">
        <!-- Header -->
        <div class="auth-header">
            <a href="{{ url('/') }}" class="auth-logo">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                NexusCRM
            </a>
            <h1 class="auth-title">Create Account</h1>
            <p class="auth-subtitle">Join NexusCRM to manage your client relationships</p>
        </div>

        <!-- Card -->
        <div class="auth-card">
            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="validation-errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="form-label-text">Full Name</span>
                        <span class="required">*</span>
                    </label>
                    <div class="input-with-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="input-icon">
                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="form-input @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="John Doe"
                               required
                               autofocus>
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="form-label-text">Email Address</span>
                        <span class="required">*</span>
                    </label>
                    <div class="input-with-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="input-icon">
                            <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-input @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="you@example.com"
                               required>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="form-label-text">Password</span>
                        <span class="required">*</span>
                    </label>
                    <div class="input-with-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="input-icon">
                            <path d="M19 11H5C3.89543 11 3 11.8954 3 13V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V13C21 11.8954 20.1046 11 19 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7 11V7C7 5.67392 7.52678 4.40215 8.46447 3.46447C9.40215 2.52678 10.6739 2 12 2C13.3261 2 14.5979 2.52678 15.5355 3.46447C16.4732 4.40215 17 5.67392 17 7V11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input @error('password') is-invalid @enderror"
                               placeholder="Create a strong password"
                               required
                               autocomplete="new-password">
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="password-strength">
                        <div class="strength-meter">
                            <div class="strength-fill" id="passwordStrength"></div>
                        </div>
                        <div class="strength-text" id="passwordStrengthText">Password strength</div>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="form-label">
                        <span class="form-label-text">Confirm Password</span>
                        <span class="required">*</span>
                    </label>
                    <div class="input-with-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="input-icon">
                            <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-input"
                               placeholder="Confirm your password"
                               required
                               autocomplete="new-password">
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="terms">
                    <label>
                        <input type="checkbox" name="terms" required>
                        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 0.5rem;">
                        <path d="M19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16L21 8V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 21V13H7V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 3V8H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Create Account
                </button>
            </form>

            <!-- Footer -->
            <div class="auth-footer">
                <p>
                    Already have an account?
                    <a href="{{ route('login') }}">Sign in here</a>
                </p>
            </div>
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

        // Password strength indicator
        function checkPasswordStrength(password) {
            let strength = 0;
            const strengthFill = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordStrengthText');
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            const percentage = (strength / 5) * 100;
            
            // Update visual indicator
            strengthFill.style.width = `${percentage}%`;
            
            // Update text and color
            if (password.length === 0) {
                strengthFill.style.background = 'var(--border)';
                strengthText.textContent = 'Password strength';
                strengthText.style.color = 'var(--text)';
            } else if (strength <= 2) {
                strengthFill.style.background = 'var(--error)';
                strengthText.textContent = 'Weak password';
                strengthText.style.color = 'var(--error)';
            } else if (strength <= 3) {
                strengthFill.style.background = '#ffc107';
                strengthText.textContent = 'Fair password';
                strengthText.style.color = '#ffc107';
            } else if (strength <= 4) {
                strengthFill.style.background = '#28a745';
                strengthText.textContent = 'Good password';
                strengthText.style.color = '#28a745';
            } else {
                strengthFill.style.background = '#20c997';
                strengthText.textContent = 'Strong password';
                strengthText.style.color = '#20c997';
            }
        }

        // Set theme on load
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            
            // Add focus effects
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });
            
            // Password strength checker
            const passwordInput = document.getElementById('password');
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    checkPasswordStrength(this.value);
                });
            }
            
            // Password confirmation checker
            const confirmPasswordInput = document.getElementById('password_confirmation');
            if (confirmPasswordInput && passwordInput) {
                confirmPasswordInput.addEventListener('input', function() {
                    if (this.value !== passwordInput.value) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            }
            
            // Add subtle animation to card
            const card = document.querySelector('.auth-card');
            if (card) {
                card.style.opacity = '0';
                card.style.transform = 'translateY(10px)';
                
                setTimeout(() => {
                    card.style.transition = 'opacity 0.4s ease, transform 0.4s ease, box-shadow 0.3s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>
</body>
</html>