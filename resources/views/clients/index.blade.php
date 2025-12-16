@extends('layouts.app')

@section('title', 'Clients')

@section('content')
    <div class="card-header">
        <h1 class="card-title">Clients</h1>
        <div class="flex items-center gap-4">
            <a href="{{ route('clients.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 5V19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Add Client
            </a>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card mb-6">
        <form method="GET" action="{{ route('clients.index') }}" class="flex flex-wrap gap-4">
            <div class="form-group flex-1">
                <input type="text" 
                       name="search" 
                       class="form-control" 
                       placeholder="Search clients by name, email, phone, or company..."
                       value="{{ request('search') }}">
            </div>
            
            <div class="form-group">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="lead" {{ request('status') == 'lead' ? 'selected' : '' }}>Lead</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Search
            </button>
            
            @if(request('search') || request('status') != 'all')
                <a href="{{ route('clients.index') }}" class="btn btn-outline">
                    Clear Filters
                </a>
            @endif
        </form>
    </div>

    <!-- Clients Table -->
    <div class="card">
        @if($clients->count() > 0)
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>Next Follow-up</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>
                                    <div class="font-medium">{{ $client->name }}</div>
                                    @if($client->address)
                                        <div class="text-sm opacity-70">{{ Str::limit($client->address, 30) }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($client->email)
                                        <div class="text-sm">{{ $client->email }}</div>
                                    @endif
                                    @if($client->phone)
                                        <div class="text-sm">{{ $client->phone }}</div>
                                    @endif
                                </td>
                                <td>{{ $client->company ?? '-' }}</td>
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
                                        <span class="opacity-50">Not set</span>
                                    @endif
                                </td>
                                <td>{{ $client->notes_count }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('clients.show', $client) }}" class="btn btn-outline btn-sm">
                                            View
                                        </a>
                                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-secondary btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this client?')">
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
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $clients->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 opacity-50">
                    <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8518 20.8581 15.3516 20 15.13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3 class="text-lg font-medium mb-2">No clients found</h3>
                <p class="opacity-70 mb-4">Get started by adding your first client</p>
                <a href="{{ route('clients.create') }}" class="btn btn-primary">
                    Add Your First Client
                </a>
            </div>
        @endif
    </div>
@endsection

@push('styles')
<style>
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }
    
    .pagination a, .pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        height: 2.5rem;
        padding: 0 0.75rem;
        border-radius: 0.5rem;
        background-color: var(--color-bg);
        border: 1px solid var(--color-border);
        color: var(--color-text);
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .pagination a:hover {
        background-color: var(--color-primary);
        color: white;
        border-color: var(--color-primary);
    }
    
    .pagination .active span {
        background-color: var(--color-primary);
        color: white;
        border-color: var(--color-primary);
    }
</style>
@endpush