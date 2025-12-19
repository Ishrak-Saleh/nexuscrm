<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Verify Email - NexusCRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Theme Variables - Using app.blade.php color system */
        :root[data-theme="light"] {
            --color-text: #160b19;
            --color-bg: #f6f1f9;
            --color-primary: #53285d;
            --color-secondary: #cd89b5;
            --color-accent: #af4b75;
            --color-border: rgba(205, 137, 181, 0.3);
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-info: #3b82f6;
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
            --color-success: #34d399;
            --color-warning: #fbbf24;
            --color-info: #60a5fa;
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
            max-width: 500px;
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

        /* Email Icon Animation */
        .email-icon-container {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 2rem;
        }

        .email-icon {
            width: 100%;
            height: 100%;
            animation: float 3s ease-in-out infinite;
        }

        .email-icon-circle {
            fill: none;
            stroke: var(--color-primary);
            stroke-width: 2;
            stroke-dasharray: 314;
            stroke-dashoffset: 314;
            animation: drawCircle 2s ease-out forwards;
        }

        .email-icon-envelope {
            fill: var(--color-primary);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease-out 0.5s forwards;
        }

        .email-icon-check {
            fill: var(--color-success);
            opacity: 0;
            transform: scale(0);
            animation: checkmark 0.5s ease-out 2s forwards;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes drawCircle {
            to { stroke-dashoffset: 0; }
        }

        @keyframes fadeInUp {
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes checkmark {
            0% {
                opacity: 0;
                transform: scale(0);
            }
            50% {
                opacity: 1;
                transform: scale(1.2);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
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
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .auth-title::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-accent));
            border-radius: 3px;
        }

        .auth-subtitle {
            font-size: 1rem;
            color: var(--color-text);
            opacity: 0.8;
            line-height: 1.6;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Status Messages */
        .verification-message {
            background: rgba(83, 40, 93, 0.1);
            border: 1px solid var(--color-primary);
            color: var(--color-text);
            padding: 1.25rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            font-size: 0.95rem;
            line-height: 1.6;
            text-align: center;
            transition: all 0.3s ease;
        }

        .verification-message:hover {
            background: rgba(83, 40, 93, 0.15);
            transform: translateY(-1px);
        }

        .success-message {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--color-success);
            color: var(--color-success);
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            text-align: center;
            animation: slideIn 0.5s ease-out;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
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

        /* Action Buttons */
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 2rem;
        }

        .action-row {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: center;
        }

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

        .btn-primary {
            background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(83, 40, 93, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--color-secondary);
            color: var(--color-text);
            flex: 1;
        }

        .btn-outline:hover {
            background: var(--color-secondary);
            color: var(--color-bg);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(205, 137, 181, 0.2);
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

        /* Success Animation for Resend */
        .btn-success {
            background: var(--color-success);
        }

        .success-check {
            width: 20px;
            height: 20px;
            margin-left: 0.5rem;
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }

        .btn-success .success-check {
            opacity: 1;
            transform: scale(1);
            animation: checkmark 0.5s ease-out;
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

        /* Instructions */
        .instructions {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--color-border);
        }

        .instructions-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 0.75rem;
            text-align: center;
            opacity: 0.8;
        }

        .instruction-steps {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .instruction-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--color-text);
            opacity: 0.7;
            text-align: center;
            max-width: 120px;
        }

        .step-number {
            width: 28px;
            height: 28px;
            background: var(--color-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .auth-card {
                padding: 2rem 1.5rem;
            }
            
            .auth-title {
                font-size: 1.5rem;
            }
            
            .auth-subtitle {
                font-size: 0.95rem;
            }
            
            .action-row {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
            
            .instruction-steps {
                gap: 1rem;
            }
            
            .instruction-step {
                max-width: 100px;
            }
        }

        /* Countdown Timer */
        .countdown {
            font-size: 0.85rem;
            color: var(--color-text);
            opacity: 0.7;
            text-align: center;
            margin-top: 1rem;
            font-weight: 500;
        }

        .countdown-number {
            color: var(--color-primary);
            font-weight: 700;
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
                <a href="{{ route('dashboard') }}" class="auth-logo">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    NexusCRM
                </a>
                
                <div class="email-icon-container">
                    <svg class="email-icon" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <circle class="email-icon-circle" cx="50" cy="50" r="50"/>
                        <path class="email-icon-envelope" d="M30 40 L70 40 L70 70 L30 70 Z M30 40 L50 55 L70 40"/>
                        <path class="email-icon-check" d="M40 55 L45 60 L55 50"/>
                    </svg>
                </div>
                
                <h1 class="auth-title">Verify Your Email</h1>
                <p class="auth-subtitle">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
                </p>
            </div>

            <!-- Status Messages -->
            <div class="verification-message">
                If you didn't receive the email, we will gladly send you another. Please check your spam folder as well.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="success-message">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="action-buttons">
                <div class="action-row">
                    <form method="POST" action="{{ route('verification.send') }}" id="resendForm">
                        @csrf
                        <button type="submit" class="btn btn-primary" id="resendBtn">
                            <span>{{ __('Resend Verification Email') }}</span>
                            <svg class="success-check" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
                
                <div class="countdown" id="countdown">
                    You can resend in <span class="countdown-number">60</span> seconds
                </div>
            </div>

            <!-- Instructions -->
            <div class="instructions">
                <h3 class="instructions-title">Need Help?</h3>
                <div class="instruction-steps">
                    <div class="instruction-step">
                        <div class="step-number">1</div>
                        Check your inbox for our email
                    </div>
                    <div class="instruction-step">
                        <div class="step-number">2</div>
                        Click the verification link
                    </div>
                    <div class="instruction-step">
                        <div class="step-number">3</div>
                        Start using NexusCRM
                    </div>
                </div>
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

        // Set theme on load
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);

            // Form elements
            const resendForm = document.getElementById('resendForm');
            const resendBtn = document.getElementById('resendBtn');
            const countdownElement = document.getElementById('countdown');
            const countdownNumber = countdownElement.querySelector('.countdown-number');
            
            let countdown = 60; // 60 seconds cooldown
            let canResend = false;

            // Countdown timer
            function startCountdown() {
                canResend = false;
                resendBtn.disabled = true;
                resendBtn.classList.add('btn-loading');
                
                const timer = setInterval(() => {
                    countdown--;
                    countdownNumber.textContent = countdown;
                    
                    if (countdown <= 0) {
                        clearInterval(timer);
                        countdownElement.innerHTML = 'Ready to resend';
                        resendBtn.disabled = false;
                        resendBtn.classList.remove('btn-loading');
                        canResend = true;
                        countdown = 60; // Reset for next time
                    }
                }, 1000);
            }

            // Initial countdown start
            startCountdown();

            // Resend form submission
            if (resendForm && resendBtn) {
                resendForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    
                    if (!canResend) return;
                    
                    // Show loading state
                    resendBtn.classList.add('btn-loading');
                    resendBtn.disabled = true;
                    
                    // Simulate sending (in real app, this would be the actual form submission)
                    setTimeout(() => {
                        // Show success state
                        resendBtn.classList.remove('btn-loading');
                        resendBtn.classList.add('btn-success');
                        
                        // Submit the form
                        resendForm.submit();
                        
                        // Reset button after 2 seconds
                        setTimeout(() => {
                            resendBtn.classList.remove('btn-success');
                            startCountdown();
                        }, 2000);
                    }, 1500);
                });
            }

            // Add enter key submission
            document.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && e.target.type !== 'textarea') {
                    const form = document.getElementById('resendForm');
                    if (form && form.contains(e.target) && canResend) {
                        form.requestSubmit();
                    }
                }
            });

            // Add animation to buttons on hover
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(btn => {
                btn.addEventListener('mouseenter', () => {
                    btn.style.transform = 'translateY(-2px)';
                });
                
                btn.addEventListener('mouseleave', () => {
                    if (!btn.disabled) {
                        btn.style.transform = 'translateY(0)';
                    }
                });
            });

            // Email icon interaction
            const emailIcon = document.querySelector('.email-icon-envelope');
            if (emailIcon) {
                emailIcon.addEventListener('mouseenter', () => {
                    emailIcon.style.fill = 'var(--color-accent)';
                });
                
                emailIcon.addEventListener('mouseleave', () => {
                    emailIcon.style.fill = 'var(--color-primary)';
                });
            }

            // Auto-refresh the page if verification is detected
            function checkVerification() {
                // In a real app, you might poll an API endpoint
                // For now, we'll just refresh after 30 seconds
                setTimeout(() => {
                    location.reload();
                }, 30000); // Check every 30 seconds
            }

            // Start verification check
            checkVerification();
        });

        // Add some fun animations
        document.addEventListener('DOMContentLoaded', () => {
            // Animate the instruction steps on hover
            const steps = document.querySelectorAll('.instruction-step');
            steps.forEach((step, index) => {
                step.style.animationDelay = `${index * 0.1}s`;
                step.style.opacity = '0';
                step.style.transform = 'translateY(10px)';
                step.style.transition = 'all 0.5s ease';
                
                setTimeout(() => {
                    step.style.opacity = '1';
                    step.style.transform = 'translateY(0)';
                }, 500 + (index * 100));
                
                step.addEventListener('mouseenter', () => {
                    const number = step.querySelector('.step-number');
                    number.style.transform = 'scale(1.1) rotate(5deg)';
                    number.style.backgroundColor = 'var(--color-accent)';
                });
                
                step.addEventListener('mouseleave', () => {
                    const number = step.querySelector('.step-number');
                    number.style.transform = 'scale(1) rotate(0)';
                    number.style.backgroundColor = 'var(--color-primary)';
                });
            });
        });
    </script>
</body>
</html>