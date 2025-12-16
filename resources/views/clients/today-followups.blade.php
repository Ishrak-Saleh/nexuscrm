@extends('layouts.app')

@section('title', "Today's Follow-ups")

@section('content')
    <div class="card-header">
        <h1 class="card-title">Today's Follow-ups</h1>
        <div class="flex items-center gap-4">
            <span class="text-sm opacity-70">
                {{ now()->format('F d, Y') }}
            </span>
            <a href="{{ route('clients.index') }}" class="btn btn-outline">
                All Clients
            </a>
        </div>
    </div>

    @if($clients->count() > 0)
        <div class="card">
            <div class="table-container">
                <table>
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
                                        <div class="text-sm opacity-70">
                                            Scheduled for today
                                        </div>
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
                                <td>{{ $client->notes_count }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('clients.show', $client) }}" class="btn btn-accent btn-sm">
                                            Follow up
                                        </a>
                                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-outline btn-sm">
                                            Reschedule
                                        </a>
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
        </div>
    @else
        <div class="card">
            <div class="text-center py-12">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 opacity-50">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 8V12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 16H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3 class="text-lg font-medium mb-2">No follow-ups scheduled for today</h3>
                <p class="opacity-70 mb-4">Great job! You're all caught up with today's follow-ups.</p>
                <div class="flex justify-center gap-3">
                    <a href="{{ route('clients.index') }}" class="btn btn-primary">
                        View All Clients
                    </a>
                    <a href="{{ route('clients.create') }}" class="btn btn-secondary">
                        Add New Client
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Instructions -->
    <div class="card mt-6">
        <h2 class="card-title mb-4">Follow-up Tips</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                <h3 class="font-medium mb-2">📞 Phone Call</h3>
                <p class="text-sm opacity-70">Call clients during business hours. Prepare talking points beforehand.</p>
            </div>
            <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/20">
                <h3 class="font-medium mb-2">✉️ Email</h3>
                <p class="text-sm opacity-70">Send personalized emails. Follow up within 24-48 hours if no response.</p>
            </div>
            <div class="p-4 rounded-lg bg-purple-50 dark:bg-purple-900/20">
                <h3 class="font-medium mb-2">📝 Notes</h3>
                <p class="text-sm opacity-70">Document all interactions. Set next follow-up date immediately after contact.</p>
            </div>
        </div>
    </div>
@endsection