<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'NexusCRM') - {{ config('app.name', 'NexusCRM') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <style>
        :root {
            --color-text: #160b19;
            --color-bg: #f6f1f9;
            --color-primary: #52285d;
            --color-secondary: #cd89b5;
            --color-accent: #af4b75;
            --color-border: #e5d8eb;
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-danger: #ef4444;
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-gray-400: #9ca3af;
        }

        [data-theme="dark"] {
            --color-text: #f6f1f9;
            --color-bg: #160b19;
            --color-primary: #b184bb;
            --color-secondary: #8a4a72;
            --color-accent: #d16a97;
            --color-border: #2d1b32;
            --color-success: #34d399;
            --color-warning: #fbbf24;
            --color-gray-400: #6b7280;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--color-text);
            background-color: var(--color-bg);
            line-height: 1.6;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Histogram Chart Styles */
        .histogram-chart {
            display: flex;
            align-items: flex-end; /* Anchors bars to the bottom */
            justify-content: space-around;
            height: 250px; 
            padding: 40px 10px 10px 10px;
            margin-top: 20px;
            border-bottom: 2px solid var(--color-border);
            background-color: transparent;
        }

        .chart-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
        }

        .bar-container {
            flex: 1;
            width: 100%;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            position: relative;
        }

        .bar {
            width: 45px; /* Fixed width prevents horizontal stretching */
            border-radius: 10px; /* Match the rounded tops in your image */
            position: relative;
            transition: all 0.3s ease;
        }

        .bar:hover {
            transform: scaleY(1.05); /* Grow slightly on hover */
            filter: brightness(1.1);
            cursor: pointer;
        }

        .bar-value {
            position: absolute;
            top: -30px; /* Positions number above the bar */
            left: 50%;
            transform: translateX(-50%);
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--color-text);
        }

        .bar-label {
            margin-top: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--color-text);
            text-align: center;
            opacity: 0.8;
        }

        /* Header Styles */
        header {
            background-color: var(--color-bg);
            border-bottom: 1px solid var(--color-border);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
            background-color: rgba(246, 241, 249, 0.95);
        }

        [data-theme="dark"] header {
            background-color: rgba(22, 11, 25, 0.95);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo:hover {
            color: var(--color-accent);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            color: var(--color-text);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .nav-links a:hover {
            background-color: var(--color-primary);
            color: white;
        }

        .nav-links a.active {
            background-color: var(--color-primary);
            color: white;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .theme-toggle {
            background: none;
            border: none;
            color: var(--color-text);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .theme-toggle:hover {
            background-color: var(--color-border);
        }

        .user-dropdown {
            position: relative;
        }

        .user-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: none;
            border: 1px solid var(--color-border);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            color: var(--color-text);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .user-btn:hover {
            background-color: var(--color-border);
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background-color: var(--color-bg);
            border: 1px solid var(--color-border);
            border-radius: 0.5rem;
            padding: 0.5rem;
            min-width: 200px;
            margin-top: 0.5rem;
            display: none;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 0.75rem 1rem;
            color: var(--color-text);
            text-decoration: none;
            border-radius: 0.25rem;
            transition: all 0.2s ease;
        }

        .dropdown-menu a:hover {
            background-color: var(--color-border);
        }

        /* Main Content */
        main {
            padding: 2rem 0;
            min-height: calc(100vh - 140px);
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--color-success);
            color: var(--color-success);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--color-danger);
            color: var(--color-danger);
        }

        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            border: 1px solid var(--color-warning);
            color: var(--color-warning);
        }

        .close-alert {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            font-size: 1.25rem;
        }

        /* Card Styles */
        .card {
            background-color: var(--color-bg);
            border: 1px solid var(--color-border);
            border-radius: 1rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--color-primary);
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--color-accent);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: var(--color-secondary);
            color: white;
        }

        .btn-secondary:hover {
            background-color: var(--color-primary);
        }

        .btn-accent {
            background-color: var(--color-accent);
            color: white;
        }

        .btn-accent:hover {
            background-color: var(--color-primary);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--color-primary);
            color: var(--color-primary);
        }

        .btn-outline:hover {
            background-color: var(--color-primary);
            color: white;
        }

        .btn-danger {
            background-color: var(--color-danger);
            color: white;
        }

        .btn-danger:hover {
            opacity: 0.9;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--color-text);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--color-border);
            border-radius: 0.75rem;
            background-color: var(--color-bg);
            color: var(--color-text);
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(82, 40, 93, 0.1);
        }

        .form-control.is-invalid {
            border-color: var(--color-danger);
        }

        .invalid-feedback {
            color: var(--color-danger);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 0.75rem;
            border: 1px solid var(--color-border);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--color-bg);
        }

        th {
            background-color: var(--color-primary);
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 1rem;
            border-top: 1px solid var(--color-border);
        }

        tr:hover {
            background-color: rgba(205, 137, 181, 0.1);
        }

        /* Badge Styles */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-active {
            background-color: rgba(16, 185, 129, 0.2);
            color: var(--color-success);
        }

        .badge-inactive {
            background-color: rgba(107, 114, 128, 0.2);
            color: #6b7280;
        }

        .badge-lead {
            background-color: rgba(245, 158, 11, 0.2);
            color: var(--color-warning);
        }

        .badge-due {
            background-color: rgba(239, 68, 68, 0.2);
            color: var(--color-danger);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--color-text);
            opacity: 0.8;
        }

        /* Notes Styles */
        .note {
            border-left: 4px solid var(--color-secondary);
            padding-left: 1rem;
            margin-bottom: 1rem;
        }

        .note-content {
            color: var(--color-text);
        }

        .note-meta {
            font-size: 0.75rem;
            color: var(--color-text);
            opacity: 0.7;
            margin-top: 0.25rem;
        }

        /* Utility Classes */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mt-1 { margin-top: 0.25rem; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-3 { margin-top: 1rem; }
        .mt-4 { margin-top: 1.5rem; }
        .mt-6 { margin-top: 2.5rem; }
        .mb-1 { margin-bottom: 0.25rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-3 { margin-bottom: 1rem; }
        .mb-4 { margin-bottom: 1.5rem; }
        .mb-6 { margin-bottom: 2.5rem; }
        .mx-auto { margin-left: auto; margin-right: auto; }
        .w-full { width: 100%; }
        .hidden { display: none; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-2 { gap: 0.5rem; }
        .gap-4 { gap: 1rem; }
        .grid { display: grid; }
        .grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
        .grid-cols-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-cols-4 { grid-template-columns: repeat(4, 1fr); }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 0.5rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .table-container {
                margin: 0 -1rem;
                border-radius: 0;
                border-left: none;
                border-right: none;
            }
        }

        /* Footer */
        footer {
            border-top: 1px solid var(--color-border);
            padding: 1.5rem 0;
            text-align: center;
            color: var(--color-text);
            opacity: 0.7;
            font-size: 0.875rem;
        }
    </style>
    
    <!-- Scripts -->
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
            
            // Close alerts
            document.querySelectorAll('.close-alert').forEach(button => {
                button.addEventListener('click', () => {
                    button.closest('.alert').style.display = 'none';
                });
            });
            
            // Dropdown toggle
            const userBtn = document.querySelector('.user-btn');
            if (userBtn) {
                userBtn.addEventListener('click', () => {
                    const menu = document.querySelector('.dropdown-menu');
                    menu.classList.toggle('show');
                });
            }
            
            // Close dropdown when clicking outside
            document.addEventListener('click', (event) => {
                const dropdowns = document.querySelectorAll('.dropdown-menu.show');
                dropdowns.forEach(dropdown => {
                    if (!dropdown.contains(event.target) && 
                        !event.target.closest('.user-btn')) {
                        dropdown.classList.remove('show');
                    }
                });
            });
        });
    </script>
    
    @stack('styles')
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar">
                <a href="{{ route('dashboard') }}" class="logo">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    NexusCRM
                </a>
                
                <div class="nav-links">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('clients.index') }}" class="{{ request()->routeIs('clients.*') ? 'active' : '' }}">
                        Clients
                    </a>
                    <a href="{{ route('clients.today-followups') }}" class="{{ request()->routeIs('clients.today-followups') ? 'active' : '' }}">
                        Today's Follow-ups
                    </a>
                </div>
                
                <div class="user-menu">
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
                    
                    <div class="user-dropdown">
                        <button class="user-btn">
                            {{ Auth::user()->name }}
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('profile.edit') }}">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 0.5rem;">
                                    <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6 20C6 18.67 8.67 16 12 16C15.33 16 18 18.67 18 20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 0.5rem;">
                                        <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16 17L21 12L16 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Logout
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <button class="close-alert">&times;</button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                    <button class="close-alert">&times;</button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">
            <p>NexusCRM &copy; {{ date('Y') }} - Lightweight Client Relationship Management</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>