@extends('layouts.app')

@section('title', 'Edit Client')

@section('content')

<!-- Header -->
<div class="card-header">
    <h1 class="card-title">Edit Client: {{ $client->name }}</h1>
    <a href="{{ route('clients.show', $client) }}" class="btn btn-outline">
        Back to Client
    </a>
</div>

<!-- Form Card -->
<div class="card">
    <form method="POST" action="{{ route('clients.update', $client) }}">
        @csrf
        @method('PUT')

        <!-- Two Column Layout -->
        <div class="form-grid">

            <!-- Left Column -->
            <div>
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $client->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $client->email) }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone', $client->phone) }}">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Company</label>
                    <input type="text" name="company" class="form-control @error('company') is-invalid @enderror"
                           value="{{ old('company', $client->company) }}">
                    @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <div class="form-group">
                    <label class="form-label">Address</label>
                    <textarea name="address" rows="3"
                              class="form-control @error('address') is-invalid @enderror">{{ old('address', $client->address) }}</textarea>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="">Select Status</option>
                        <option value="lead" {{ old('status', $client->status) == 'lead' ? 'selected' : '' }}>Lead</option>
                        <option value="active" {{ old('status', $client->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $client->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Next Follow-up Date</label>
                    <input type="date" name="next_follow_up"
                           class="form-control @error('next_follow_up') is-invalid @enderror"
                           value="{{ old('next_follow_up', optional($client->next_follow_up)->format('Y-m-d')) }}">
                    @error('next_follow_up')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <a href="{{ route('clients.show', $client) }}" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">
                Update Client
            </button>
        </div>
    </form>
</div>

@endsection

@push('styles')
<style>

/* ---------- GRID ---------- */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

/* ---------- FORM GROUP ---------- */
.form-group {
    margin-bottom: 1.1rem;
}

.form-label {
    display: block;
    margin-bottom: 0.35rem;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--primary);
}

/* ---------- INPUTS ---------- */
.form-control {
    width: 100%;
    padding: 0.6rem 0.75rem;
    font-size: 0.9rem;
    border-radius: 0.45rem;
    border: 1px solid var(--color-border);
    background: var(--color-bg);
    color: var(--color-text);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 2px rgba(175,75,117,0.25);
}

/* ---------- VALIDATION ---------- */
.is-invalid {
    border-color: #e74c3c;
}
.invalid-feedback {
    font-size: 0.75rem;
    color: #e74c3c;
    margin-top: 0.25rem;
}

/* ---------- ACTIONS ---------- */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
    margin-top: 1.5rem;
}

/* ---------- RESPONSIVE ---------- */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    .form-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }
}

</style>
@endpush
