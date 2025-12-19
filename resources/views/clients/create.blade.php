@extends('layouts.app')

@section('title', 'Add Client')

@section('content')

<!-- Header -->
<div class="dashboard-header">
    <div class="header-content">
        <div class="header-left">
            <h1 class="page-title">Add New Client</h1>
            <p class="page-subtitle">Enter client details to create a new record</p>
        </div>
        <a href="{{ route('clients.index') }}" class="btn btn-outline">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Back to Clients
        </a>
    </div>
</div>

<!-- Form Card -->
<div class="form-card">
    <div class="form-header">
        <h2>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 0.75rem;">
                <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Client Information
        </h2>
        <p class="form-subtitle">Fill in the details below to add a new client</p>
    </div>

    <form method="POST" action="{{ route('clients.store') }}" class="add-form">
        @csrf

        <!-- Two Column Layout -->
        <div class="form-grid">

            <!-- Left Column -->
            <div class="form-column">
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">Full Name</span>
                        <span class="required">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-input @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" 
                           placeholder="Enter client name"
                           required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">Email Address</span>
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
                               placeholder="client@example.com">
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">Phone Number</span>
                    </label>
                    <div class="input-with-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="input-icon">
                            <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92C19.95 20.92 18.91 20.77 17.92 20.47C16.15 19.96 14.45 19.12 12.99 17.99C10.95 16.3 9.16 13.92 8 11.32C7.21 9.56 6.82 7.68 6.82 5.78C6.82 5.23 7.27 4.78 7.82 4.78H10.82C11.37 4.78 11.82 5.23 11.82 5.78C11.82 7.3 12.22 8.79 12.99 10.12C13.24 10.57 13.16 11.15 12.79 11.51L11 13.3C12.68 15.77 15.05 17.45 17.53 18.11L19.32 16.32C19.68 15.96 20.26 15.88 20.71 16.13C21.37 16.49 22 17.18 22 17.92Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               class="form-input @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}"
                               placeholder="+1 234 567 8900">
                    </div>
                    @error('phone')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">Company</span>
                    </label>
                    <div class="input-with-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="input-icon">
                            <path d="M21 7V17C21 17.7956 20.6839 18.5587 20.1213 19.1213C19.5587 19.6839 18.7956 20 18 20H6C5.20435 20 4.44129 19.6839 3.87868 19.1213C3.31607 18.5587 3 17.7956 3 17V7M21 7L12 3L3 7M21 7L12 11L3 7M12 11V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="text" 
                               id="company" 
                               name="company" 
                               class="form-input @error('company') is-invalid @enderror"
                               value="{{ old('company') }}"
                               placeholder="Company name">
                    </div>
                    @error('company')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="form-column">
                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">Address</span>
                    </label>
                    <div class="textarea-wrapper">
                        <textarea id="address" 
                                  name="address" 
                                  rows="3"
                                  class="form-textarea @error('address') is-invalid @enderror"
                                  placeholder="Street, City, State, ZIP Code">{{ old('address') }}</textarea>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="textarea-icon">
                            <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 11.5C13.3807 11.5 14.5 10.3807 14.5 9C14.5 7.61929 13.3807 6.5 12 6.5C10.6193 6.5 9.5 7.61929 9.5 9C9.5 10.3807 10.6193 11.5 12 11.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    @error('address')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">Status</span>
                        <span class="required">*</span>
                    </label>
                    <div class="select-wrapper">
                        <select id="status" 
                                name="status" 
                                class="form-select @error('status') is-invalid @enderror" 
                                required>
                            <option value="">Select Status</option>
                            <option value="lead" {{ old('status') == 'lead' ? 'selected' : '' }}>
                                Lead
                            </option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="select-arrow">
                            <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    @error('status')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <span class="label-text">Next Follow-up Date</span>
                    </label>
                    <div class="input-with-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="input-icon">
                            <path d="M8 2V5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 2V5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3 9H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 4H5C3.89543 4 3 4.89543 3 6V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="date" 
                               id="next_follow_up" 
                               name="next_follow_up"
                               class="form-input @error('next_follow_up') is-invalid @enderror"
                               value="{{ old('next_follow_up') }}">
                    </div>
                    @error('next_follow_up')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <a href="{{ route('clients.index') }}" class="btn btn-outline">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 0.5rem;">
                    <path d="M19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16L21 8V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17 21V13H7V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7 3V8H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Create Client
            </button>
        </div>
    </form>
</div>

@endsection

@push('styles')
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
   DASHBOARD HEADER
   ==================================== */
.dashboard-header {
    background: var(--card);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid var(--border);
    box-shadow: 0 2px 8px var(--shadow);
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
    color: var(--text);
}

.page-subtitle {
    font-size: 0.9rem;
    opacity: 0.7;
    color: var(--text);
}

/* ====================================
   BUTTONS
   ==================================== */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: none;
    transition: all 0.3s ease;
    font-size: 0.875rem;
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

.btn-primary {
    background: var(--button);
    color: white;
}

.btn-primary:hover {
    background: var(--button-hover);
    color: white;
}

/* ====================================
   FORM CARD
   ==================================== */
.form-card {
    background: var(--card);
    border-radius: 12px;
    padding: 2rem;
    border: 1px solid var(--border);
    box-shadow: 0 2px 8px var(--shadow);
}

.form-header {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--border);
}

.form-header h2 {
    display: flex;
    align-items: center;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 0.5rem;
}

.form-subtitle {
    font-size: 0.9rem;
    color: var(--text);
    opacity: 0.8;
}

/* ====================================
   FORM LAYOUT
   ==================================== */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    margin-bottom: 2rem;
}

.form-column {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* ====================================
   FORM ELEMENTS
   ==================================== */
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

.label-text {
    opacity: 0.9;
}

.required {
    color: var(--error);
    font-size: 0.875em;
}

/* ====================================
   INPUT STYLES
   ==================================== */
.form-input,
.form-select,
.form-textarea {
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

.form-textarea {
    padding: 0.875rem 1rem 0.875rem 2.75rem;
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: var(--button);
    box-shadow: 0 0 0 3px rgba(116, 54, 82, 0.1);
}

/* ====================================
   INPUT WITH ICON
   ==================================== */
.input-with-icon,
.textarea-wrapper,
.select-wrapper {
    position: relative;
}

.input-icon,
.textarea-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text);
    opacity: 0.5;
    pointer-events: none;
}

.textarea-icon {
    top: 1rem;
    transform: none;
}

.select-arrow {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text);
    opacity: 0.5;
    pointer-events: none;
}

/* ====================================
   SELECT STYLES
   ==================================== */
.form-select {
    appearance: none;
    cursor: pointer;
    padding-right: 2.5rem;
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

/* ====================================
   FORM ACTIONS
   ==================================== */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
}

/* ====================================
   RESPONSIVE DESIGN
   ==================================== */
@media (max-width: 1024px) {
    .form-grid {
        gap: 1.5rem;
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
    
    .form-card {
        padding: 1.5rem;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .form-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }
    
    .form-actions .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .form-card {
        padding: 1.25rem;
    }
    
    .form-header h2 {
        font-size: 1.1rem;
    }
    
    .form-input,
    .form-select,
    .form-textarea {
        padding: 0.75rem 0.875rem 0.75rem 2.5rem;
        font-size: 0.9rem;
    }
    
    .input-icon,
    .textarea-icon {
        left: 0.875rem;
    }
    
    .select-arrow {
        right: 0.875rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const formInputs = document.querySelectorAll('.form-input, .form-select, .form-textarea');
    
    formInputs.forEach(input => {

        input.addEventListener('focus', function() {
            this.parentElement?.classList?.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement?.classList?.remove('focused');
        });
        

        const parent = input.parentElement;
        if (parent.classList.contains('input-with-icon') || 
            parent.classList.contains('textarea-wrapper') || 
            parent.classList.contains('select-wrapper')) {
            input.classList.add('has-icon');
        }
    });
    

    const dateInput = document.querySelector('input[type="date"]');
    if (dateInput && !dateInput.value) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('placeholder', today);
    }
    

    const formCard = document.querySelector('.form-card');
    if (formCard) {
        formCard.style.opacity = '0';
        formCard.style.transform = 'translateY(10px)';
        
        setTimeout(() => {
            formCard.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            formCard.style.opacity = '1';
            formCard.style.transform = 'translateY(0)';
        }, 100);
    }
});
</script>
@endpush