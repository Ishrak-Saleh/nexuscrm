@extends('layouts.app')

@section('title', 'Clients')

@section('content')

<!-- Header -->
<div class="card-header">
    <h1 class="card-title">Clients</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <path d="M12 5V19" stroke="white" stroke-width="2" stroke-linecap="round"/>
            <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round"/>
        </svg>
        Add Client
    </a>
</div>

<!-- Search & Filter -->
<div class="card mb-6">
    <form method="GET" action="{{ route('clients.index') }}" class="filter-bar">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search by name, email, phone, or company"
            value="{{ request('search') }}"
        >

        <select name="status" class="form-control" onchange="this.form.submit()">
            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            <option value="lead" {{ request('status') == 'lead' ? 'selected' : '' }}>Lead</option>
        </select>

        <button type="submit" class="btn btn-secondary">
            Search
        </button>

        @if(request('search') || request('status') != 'all')
            <a href="{{ route('clients.index') }}" class="btn btn-outline">
                Clear
            </a>
        @endif
    </form>
</div>

<!-- Clients Table -->
<div class="card">
@if($clients->count())
    <div class="table-container">
        <table class="clients-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th>Follow-up</th>
                    <th>Notes</th>
                    <th class="actions-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>
                        <strong>{{ $client->name }}</strong>
                        @if($client->address)
                            <div class="muted">{{ Str::limit($client->address, 30) }}</div>
                        @endif
                    </td>

                    <td>
                        @if($client->email)<div>{{ $client->email }}</div>@endif
                        @if($client->phone)<div>{{ $client->phone }}</div>@endif
                    </td>

                    <td>{{ $client->company ?? '—' }}</td>

                    <td>
                        <span class="badge badge-{{ $client->status }}">
                            {{ ucfirst($client->status) }}
                        </span>
                    </td>

                    <td>
                        @if($client->next_follow_up)
                            @if($client->next_follow_up->isToday())
                                <span class="badge badge-due">Today</span>
                            @elseif($client->next_follow_up->isPast())
                                <span class="badge badge-due">Overdue</span>
                            @else
                                {{ $client->next_follow_up->format('M d, Y') }}
                            @endif
                        @else
                            <span class="muted">Not set</span>
                        @endif
                    </td>

                    <td>{{ $client->notes_count }}</td>

                    <td>
                        <div class="action-group">
                            <a href="{{ route('clients.show', $client) }}" class="btn btn-outline btn-sm">View</a>
                            <a href="{{ route('clients.edit', $client) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form method="POST" action="{{ route('clients.destroy', $client) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this client?')">
                                    Delete
                                </button>
                            </form>
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

@else
    <div class="empty-state">
        <h3>No clients found</h3>
        <p>Start by adding your first client.</p>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            Add Client
        </a>
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


/* ---------- FILTER BAR ---------- */
.filter-bar {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}
.filter-bar input {
    flex: 1 1 280px;
    border: 1px solid var(--secondary);
    border-radius: 0.375rem;
    padding: 0.5rem;
    background: var(--background);
    color: var(--text);
}
.filter-bar select {
    width: 180px;
    border: 1px solid var(--secondary);
    border-radius: 0.375rem;
    padding: 0.5rem;
    background: var(--background);
    color: var(--text);
}
.filter-bar .btn {
    border-radius: 0.375rem;
}

/* ---------- TABLE ---------- */
.table-container {
    overflow-x: auto;
}
.clients-table {
    width: 100%;
    border-collapse: collapse;
}
.clients-table th {
    text-align: left;
    padding: 0.75rem;
    font-size: 0.875rem;
    color: var(--background);
    border-bottom: 1px solid var(--secondary);
}
.clients-table td {
    padding: 0.75rem;
    vertical-align: top;
    border-bottom: 1px solid var(--secondary);
    font-size: 0.9rem;
    color: var(--text);
}
.clients-table th:nth-child(6),
.clients-table td:nth-child(6) {
    padding-right: 1.5rem;
}
.clients-table th.actions-col,
.clients-table td.actions-col {
    padding-left: 1.5rem;
    min-width: 200px;
}

/* ---------- TEXT ---------- */
.muted {
    font-size: 0.8rem;
    opacity: 0.65;
}

/* ---------- BADGES ---------- */
.badge {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    border-radius: 0.375rem;
    color: var(--background);
    display: inline-block;
}
.badge-lead { background: var(--primary); }
.badge-active { background: var(--accent); }
.badge-inactive { background: var(--secondary); }
.badge-due { background: var(--accent); }

/* ---------- ACTIONS ---------- */
.action-group {
    display: flex;
    gap: 0.4rem;
    flex-wrap: nowrap;
}
.btn-sm {
    height: 32px;
    min-width: 64px;
    padding: 0 0.75rem;
    font-size: 0.8rem;
    line-height: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
    border-radius: 0.375rem;
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
.btn-secondary {
    background: var(--secondary);
    color: var(--background);
    border: 1px solid var(--secondary);
}
.btn-secondary:hover {
    background: var(--primary);
    border-color: var(--primary);
}
.btn-danger {
    background: #e74c3c;
    color: #fff;
    border: 1px solid #e74c3c;
}
.btn-danger:hover {
    background: #c0392b;
    border-color: #c0392b;
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

/* ---------- EMPTY STATE ---------- */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--text);
}
.empty-state h3 {
    margin-bottom: 0.5rem;
}
.empty-state p {
    opacity: 0.7;
    margin-bottom: 1rem;
}

/* ---------- PAGINATION ---------- */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 1rem;
}
.pagination {
    display: flex;
    gap: 0.4rem;
}
.pagination a,
.pagination span {
    min-width: 2.25rem;
    height: 2.25rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.5rem;
    border: 1px solid var(--secondary);
    color: var(--text);
    text-decoration: none;
}
.pagination .active span {
    background: var(--primary);
    color: var(--background);
}

/* ---------- RESPONSIVE ---------- */
@media (max-width: 768px) {
    .actions-col {
        width: auto;
    }
    .action-group {
        flex-wrap: wrap;
    }
}

</style>
@endpush
