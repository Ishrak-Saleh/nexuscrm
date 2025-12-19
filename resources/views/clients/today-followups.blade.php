@extends('layouts.app')

@section('title', "Today's Follow-ups")

@section('content')
<div class="card-header">
    <h1 class="card-title">Today's Follow-ups</h1>
    <div class="header-actions">
        <span class="date-label">{{ now()->format('F d, Y') }}</span>
        <a href="{{ route('clients.index') }}" class="btn btn-outline">All Clients</a>
    </div>
</div>

@if($clients->count() > 0)
<div class="card">
    <div class="table-container">
        <table class="clients-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th>Notes Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>
                        <div class="font-medium">{{ $client->name }}</div>
                        @if($client->next_follow_up)
                        <div class="muted">Scheduled for today</div>
                        @endif
                    </td>
                    <td>
                        @if($client->email)
                        <div class="muted">{{ $client->email }}</div>
                        @endif
                        @if($client->phone)
                        <div class="muted">{{ $client->phone }}</div>
                        @endif
                    </td>
                    <td>{{ $client->company ?? '-' }}</td>
                    <td>
                        <span class="badge badge-{{ $client->status }}">{{ ucfirst($client->status) }}</span>
                    </td>
                    <td>{{ $client->notes_count }}</td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('clients.show', $client) }}" class="btn btn-accent btn-sm">Follow up</a>
                            <a href="{{ route('clients.edit', $client) }}" class="btn btn-outline btn-sm">Reschedule</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $clients->links() }}
    </div>
</div>
@else
<div class="card empty-state">
    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" class="icon">
        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 8V12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 16H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <h3>No follow-ups scheduled for today</h3>
    <p>Great job! You're all caught up with today's follow-ups.</p>
    <div class="empty-actions">
        <a href="{{ route('clients.index') }}" class="btn btn-primary">View All Clients</a>
        <a href="{{ route('clients.create') }}" class="btn btn-secondary">Add New Client</a>
    </div>
</div>
@endif

<div class="card followup-tips">
    <h2>Follow-up Tips</h2>
    <div class="tips-grid">
        <div class="tip-card tip-call">
            <h3>📞 Phone Call</h3>
            <p>Call clients during business hours. Prepare talking points beforehand.</p>
        </div>
        <div class="tip-card tip-email">
            <h3>✉️ Email</h3>
            <p>Send personalized emails. Follow up within 24-48 hours if no response.</p>
        </div>
        <div class="tip-card tip-notes">
            <h3>📝 Notes</h3>
            <p>Document all interactions. Set next follow-up date immediately after contact.</p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
    background: #eee9f1 !important;
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.04);
}
/* ---------- Theme Variables ---------- */
:root[data-theme="light"] {
    --text: #160b19;
    --background: #f6f1f9;
    --primary: #53285d;
    --secondary: #cd89b5;
    --accent: #af4b75;
}

:root[data-theme="dark"] {
    --text: #f1e6f4;
    --background: #0b060e;
    --primary: #cda2d7;
    --secondary: #76325e;
    --accent: #b4507a;
}

/* ---------- Card ---------- */
.card, .card-header {
    background: var(--background);
    color: var(--text);
    padding: 1rem 1.5rem;
    margin-bottom: 1rem;
    border-radius: 0.5rem;
    border: 1px solid var(--secondary);
}

/* ---------- Header ---------- */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.date-label {
    font-size: 0.875rem;
    opacity: 0.7;
}

/* ---------- Table ---------- */
.table-container {
    overflow-x: auto;
}
.clients-table {
    width: 100%;
    border-collapse: collapse;
}
.clients-table th, .clients-table td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid var(--secondary);
}
.clients-table th {
    font-size: 0.875rem;
}
.clients-table td {
    font-size: 0.9rem;
}
.badge {
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    color: var(--background);
}
.badge-lead { background: var(--secondary); }
.badge-active { background: var(--primary); }
.badge-inactive { background: var(--accent); }

/* ---------- Buttons ---------- */
.btn {
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
}
.btn-outline {
    border: 1px solid var(--primary);
    background: transparent;
    color: var(--primary);
}
.btn-outline:hover { background: var(--primary); color: var(--background); }
.btn-primary { background: var(--primary); color: var(--background); border: 1px solid var(--primary); }
.btn-primary:hover { background: var(--accent); border-color: var(--accent); }
.btn-secondary { background: var(--secondary); color: var(--background); border: 1px solid var(--secondary); }
.btn-secondary:hover { background: var(--accent); border-color: var(--accent); }
.btn-sm { font-size: 0.8rem; padding: 0.25rem 0.5rem; }

/* ---------- Actions ---------- */
.action-group {
    display: flex;
    gap: 0.5rem;
}

/* ---------- Pagination ---------- */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 1rem;
}

/* ---------- Empty State ---------- */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}
.empty-state .icon { margin-bottom: 1rem; opacity: 0.5; }
.empty-actions {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
}

/* ---------- Follow-up Tips ---------- */
.followup-tips h2 {
    margin-bottom: 1rem;
}
.tips-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}
@media (max-width: 768px) {
    .tips-grid { grid-template-columns: 1fr; }
}
.tip-card {
    border-radius: 0.5rem;
    padding: 1rem;
    color: var(--text);
}
.tip-call { background: rgba(82, 40, 93, 0.1); }
.tip-email { background: rgba(205, 137, 181, 0.1); }
.tip-notes { background: rgba(175, 75, 117, 0.1); }
.tip-card h3 { margin-bottom: 0.5rem; font-weight: 500; }
.tip-card p { font-size: 0.875rem; opacity: 0.7; }
</style>
@endpush
