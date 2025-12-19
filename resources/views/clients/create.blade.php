@extends('layouts.app')

@section('title', 'Add Client')

@section('content')
<div class="card-header">
    <h1 class="card-title">Add New Client</h1>
    <a href="{{ route('clients.index') }}" class="btn btn-outline">Back to Clients</a>
</div>

<div class="card">
    <form method="POST" action="{{ route('clients.store') }}" class="client-form">
        @csrf
        
        <div class="form-grid">
            <!-- Left Column -->
            <div>
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" id="company" name="company" value="{{ old('company') }}">
                    @error('company')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" rows="3">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="lead" {{ old('status') == 'lead' ? 'selected' : '' }}>Lead</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="next_follow_up">Next Follow-up Date</label>
                    <input type="date" id="next_follow_up" name="next_follow_up" value="{{ old('next_follow_up') }}">
                    @error('next_follow_up')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('clients.index') }}" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">
                Save Client
            </button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
/* ---------- CARDS ---------- */
.card, .card-header {
    background: var(--background);
    color: var(--text);
    padding: 1rem 1.5rem;
    margin-bottom: 1rem;
    border-radius: 0.5rem;
    border: 1px solid var(--secondary);
}

/* ---------- CARD HEADER ---------- */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.card-title {
    font-size: 1.5rem;
    font-weight: 600;
}

/* ---------- FORM GRID ---------- */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
}

/* ---------- FORM GROUP ---------- */
.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 1rem;
}
.form-group label {
    margin-bottom: 0.5rem;
    font-weight: 500;
}
.form-group input,
.form-group select,
.form-group textarea {
    padding: 0.5rem;
    border: 1px solid var(--secondary);
    border-radius: 0.375rem;
    background: var(--background);
    color: var(--text);
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: 2px solid var(--primary);
}
.invalid-feedback {
    font-size: 0.8rem;
    color: #e74c3c;
    margin-top: 0.25rem;
}

/* ---------- BUTTONS ---------- */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
}
.btn-outline {
    background: transparent;
    color: var(--primary);
    border: 1px solid var(--primary);
}
.btn-outline:hover {
    background: var(--primary);
    color: var(--background);
}
.btn-primary {
    background: var(--primary);
    color: var(--background);
    border: 1px solid var(--primary);
}
.btn-primary:hover {
    background: var(--accent);
    border-color: var(--accent);
}

/* ---------- FORM ACTIONS ---------- */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
    margin-top: 1.5rem;
}
</style>
@endpush
