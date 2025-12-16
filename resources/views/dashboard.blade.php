@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card-header">
        <h1 class="card-title">Dashboard Overview</h1>
        <div class="flex items-center gap-4">
            <span class="text-sm opacity-70">
                Last updated: {{ now()->format('M d, Y H:i') }}
            </span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid mb-6">
        <div class="card stat-card">
            <div class="stat-number">{{ $stats['total_clients'] }}</div>
            <div class="stat-label">Total Clients</div>
        </div>
        
        <div class="card stat-card">
            <div class="stat-number">{{ $stats['today_followups'] }}</div>
            <div class="stat-label">Follow-ups Today</div>
        </div>
        
        <div class="card stat-card">
            <div class="stat-number">{{ $stats['active_clients'] }}</div>
            <div class="stat-label">Active Clients</div>
        </div>
        
        <div class="card stat-card">
            <div class="stat-number">{{ $stats['leads'] }}</div>
            <div class="stat-label">Leads</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Most Active Clients -->
        <div class="card">
            <h2 class="card-title mb-4">Most Active Clients</h2>
            @if($mostActiveClients->count() > 0)
                <div class="space-y-3">
                    @foreach($mostActiveClients as $client)
                        <div class="flex justify-between items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            <div>
                                <h3 class="font-medium">{{ $client->name }}</h3>
                                <p class="text-sm opacity-70">
                                    {{ $client->notes_count }} notes • 
                                    <span class="badge badge-{{ $client->status }}">
                                        {{ ucfirst($client->status) }}
                                    </span>
                                </p>
                            </div>
                            <a href="{{ route('clients.show', $client) }}" class="btn btn-outline btn-sm">
                                View
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center opacity-70 py-4">No clients yet</p>
            @endif
        </div>

        <!-- Upcoming Follow-ups -->
        <div class="card">
            <h2 class="card-title mb-4">Upcoming Follow-ups (7 days)</h2>
            @if($upcomingFollowUps->count() > 0)
                <div class="space-y-3">
                    @foreach($upcomingFollowUps as $client)
                        <div class="flex justify-between items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            <div>
                                <h3 class="font-medium">{{ $client->name }}</h3>
                                <p class="text-sm opacity-70">
                                    {{ $client->next_follow_up->format('M d, Y') }}
                                </p>
                            </div>
                            <a href="{{ route('clients.show', $client) }}" class="btn btn-accent btn-sm">
                                Follow up
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center opacity-70 py-4">No upcoming follow-ups</p>
            @endif
        </div>

        <!-- Recent Notes -->
        <div class="card">
            <h2 class="card-title mb-4">Recent Activity</h2>
            @if($recentNotes->count() > 0)
                <div class="space-y-4">
                    @foreach($recentNotes as $note)
                        <div class="note">
                            <div class="note-content">
                                {{ Str::limit($note->content, 100) }}
                            </div>
                            <div class="note-meta">
                                <span class="badge badge-{{ $note->type }}">
                                    {{ ucfirst($note->type) }}
                                </span>
                                • {{ $note->client->name }}
                                • {{ $note->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center opacity-70 py-4">No recent activity</p>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <h2 class="card-title mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('clients.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 5V19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Add New Client
            </a>
            <a href="{{ route('clients.today-followups') }}" class="btn btn-accent">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 10H3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 3V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7 3V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17 3V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                View Today's Follow-ups
            </a>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8518 20.8581 15.3516 20 15.13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                All Clients
            </a>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    //Add badge styles dynamically
    document.addEventListener('DOMContentLoaded', () => {
        const badges = document.querySelectorAll('.badge');
        badges.forEach(badge => {
            const type = badge.className.match(/badge-(\w+)/);
            if (type) {
                const color = getComputedStyle(document.documentElement)
                    .getPropertyValue(`--color-${type[1]}`) || '#6b7280';
                badge.style.backgroundColor = `${color}20`;
                badge.style.color = color;
            }
        });
    });
</script>
@endpush