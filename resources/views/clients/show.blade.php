@extends('layouts.app')

@section('title', $client->name)

@section('content')

<!-- Header -->
<div class="card-header">
    <div>
        <h1 class="card-title">{{ $client->name }}</h1>
        <div class="header-badges">
            <span class="badge badge-{{ $client->status }}">
                {{ ucfirst($client->status) }}
            </span>

            @if($client->next_follow_up)
                @if($client->next_follow_up->isToday())
                    <span class="badge badge-due">Follow-up Today</span>
                @elseif($client->next_follow_up->isPast())
                    <span class="badge badge-due">Follow-up Overdue</span>
                @else
                    <span class="badge">
                        Next follow-up: {{ $client->next_follow_up->format('M d, Y') }}
                    </span>
                @endif
            @endif
        </div>
    </div>

    <div class="header-actions">
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-secondary">Edit Client</a>
        <a href="{{ route('clients.index') }}" class="btn btn-outline">Back to Clients</a>
    </div>
</div>

<!-- Main Grid -->
<div class="show-grid">

    <!-- Client Info -->
    <div class="card span-2">
        <h2 class="card-title">Client Information</h2>

        <div class="info-grid">
            <!-- Contact -->
            <div>
                <h3 class="section-title">Contact Details</h3>

                <div class="info-list">
                    @if($client->email)
                        <div class="info-item">
                            <span>{{ $client->email }}</span>
                        </div>
                    @endif

                    @if($client->phone)
                        <div class="info-item">
                            <span>{{ $client->phone }}</span>
                        </div>
                    @endif

                    @if($client->company)
                        <div class="info-item">
                            <span>{{ $client->company }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Additional -->
            <div>
                <h3 class="section-title">Additional Information</h3>

                <div class="info-list">
                    @if($client->address)
                        <div class="info-item">
                            <span>{{ $client->address }}</span>
                        </div>
                    @endif

                    <div class="info-item muted">
                        Created {{ $client->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Follow-up -->
        <div class="followup-section">
            <h3 class="section-title">Update Follow-up Date</h3>

            <form method="POST" action="{{ route('clients.update', $client) }}" class="followup-form">
                @csrf
                @method('PUT')

                <input type="hidden" name="name" value="{{ $client->name }}">
                <input type="hidden" name="email" value="{{ $client->email }}">
                <input type="hidden" name="phone" value="{{ $client->phone }}">
                <input type="hidden" name="company" value="{{ $client->company }}">
                <input type="hidden" name="address" value="{{ $client->address }}">
                <input type="hidden" name="status" value="{{ $client->status }}">

                <input type="date" name="next_follow_up"
                       class="form-control"
                       value="{{ optional($client->next_follow_up)->format('Y-m-d') }}">

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <h2 class="card-title">Quick Actions</h2>

        <div class="action-list">
            <a href="mailto:{{ $client->email }}" class="btn btn-outline full-width">Send Email</a>

            @if($client->phone)
                <a href="tel:{{ $client->phone }}" class="btn btn-outline full-width">Call Client</a>
            @endif

            <button onclick="document.getElementById('addNoteForm').scrollIntoView()"
                    class="btn btn-accent full-width">
                Add Note
            </button>
        </div>
    </div>
</div>

<!-- Add Note -->
<div class="card" id="addNoteForm">
    <h2 class="card-title">Add Note</h2>

    <form method="POST" action="{{ route('notes.store', $client) }}">
        @csrf

        <div class="form-group">
            <select name="type" class="form-control">
                <option value="call">Phone Call</option>
                <option value="meeting">Meeting</option>
                <option value="email">Email</option>
                <option value="general" selected>General Note</option>
            </select>
        </div>

        <div class="form-group">
            <textarea name="content" class="form-control" rows="3"
                      placeholder="Enter note details..." required></textarea>
        </div>

        <div class="form-actions">
            <button class="btn btn-primary">Save Note</button>
        </div>
    </form>
</div>

<!-- Notes -->
<div class="card">
    <h2 class="card-title">Client Notes & Activity</h2>

    @if($notes->count())
        <div class="note-list">
            @foreach($notes as $note)
                <div class="note">
                    <div class="note-header">
                        <span class="badge badge-{{ $note->type }}">{{ ucfirst($note->type) }}</span>
                        <span class="muted">{{ $note->created_at->format('M d, Y H:i') }}</span>

                        <form action="{{ route('notes.destroy', $note) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="note-delete"
                                    onclick="return confirm('Delete this note?')">
                                Delete
                            </button>
                        </form>
                    </div>

                    <div class="note-content">{{ $note->content }}</div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $notes->links() }}</div>
    @else
        <div class="empty-state">
            <p class="muted">No notes yet.</p>
        </div>
    @endif
</div>

@endsection

@push('styles')
<style>

.card {
    background: #eee9f1 !important;
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.04);
}

/* ---------- GENERAL ---------- */
body {
    color: var(--text);
    background: var(--background);
    font-family: system-ui, sans-serif;
}

/* ---------- HEADER ---------- */
.header-badges {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.25rem;
}

.header-actions {
    display: flex;
    gap: 0.75rem;
}

/* ---------- GRID ---------- */
.show-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.span-2 {
    grid-column: span 1;
}

/* ---------- CARD ---------- */
.card {
    background: var(--background);
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 0.5rem;
    padding: 1rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

/* ---------- INFO ---------- */
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.section-title {
    font-size: 0.8rem;
    margin-bottom: 0.5rem;
    color: var(--secondary);
    text-transform: uppercase;
}

.info-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.info-item {
    font-size: 0.9rem;
}

/* ---------- FOLLOWUP ---------- */
.followup-section {
    margin-top: 1.5rem;
    padding-top: 1.25rem;
    border-top: 1px solid var(--secondary);
}

.followup-form {
    display: flex;
    gap: 0.75rem;
    align-items: center;
}

.form-control {
    border: 1px solid var(--secondary);
    border-radius: 0.375rem;
    padding: 0.5rem;
    font-size: 0.9rem;
    color: var(--text);
    background: var(--background);
}

/* ---------- BUTTONS ---------- */
.btn {
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-size: 0.9rem;
    cursor: pointer;
    border: 1px solid transparent;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    justify-content: center;
    transition: all 0.2s ease;
}

.btn-primary {
    background: var(--primary);
    color: var(--background);
    border-color: var(--primary);
}

.btn-primary:hover {
    background: var(--accent);
    border-color: var(--accent);
}

.btn-secondary {
    background: var(--secondary);
    color: var(--background);
    border-color: var(--secondary);
}

.btn-secondary:hover {
    background: var(--primary);
    border-color: var(--primary);
}

.btn-outline {
    background: transparent;
    color: var(--primary);
    border-color: var(--primary);
}

.btn-outline:hover {
    background: var(--primary);
    color: var(--background);
}

.btn-accent {
    background: var(--accent);
    color: var(--background);
    border-color: var(--accent);
}

.btn-accent:hover {
    background: var(--primary);
    border-color: var(--primary);
}

.full-width {
    width: 100%;
}

/* ---------- BADGES ---------- */
.badge {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    border-radius: 0.375rem;
    color: var(--background);
    background: var(--primary);
}

.badge-lead { background: var(--primary); }
.badge-active { background: var(--accent); }
.badge-inactive { background: var(--secondary); }
.badge-due { background: var(--accent); }

/* ---------- NOTES ---------- */
.note-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.note {
    padding: 0.75rem;
    border-radius: 0.5rem;
    background: rgba(0,0,0,0.03);
    border: 1px solid var(--secondary);
}

.note-header {
    display: flex;
    gap: 0.75rem;
    align-items: center;
    margin-bottom: 0.5rem;
}

.note-delete {
    margin-left: auto;
    background: none;
    border: none;
    color: #e74c3c;
    font-size: 0.75rem;
    cursor: pointer;
}

.note-content {
    font-size: 0.9rem;
    line-height: 1.4;
}

/* ---------- RESPONSIVE ---------- */
@media (max-width: 900px) {
    .show-grid {
        grid-template-columns: 1fr;
    }
    .info-grid {
        grid-template-columns: 1fr;
    }
    .followup-form {
        flex-direction: column;
        align-items: stretch;
    }
    .header-actions {
        flex-direction: column;
    }
}
</style>
@endpush
