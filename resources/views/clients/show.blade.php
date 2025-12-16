@extends('layouts.app')

@section('title', $client->name)

@section('content')
    <div class="card-header">
        <div>
            <h1 class="card-title">{{ $client->name }}</h1>
            <div class="flex items-center gap-2 mt-1">
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
        
        <div class="flex items-center gap-3">
            <a href="{{ route('clients.edit', $client) }}" class="btn btn-secondary">
                Edit Client
            </a>
            <a href="{{ route('clients.index') }}" class="btn btn-outline">
                Back to Clients
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Client Details -->
        <div class="card lg:col-span-2">
            <h2 class="card-title mb-4">Client Information</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-medium mb-2">Contact Details</h3>
                    <div class="space-y-2">
                        @if($client->email)
                            <div class="flex items-center gap-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <a href="mailto:{{ $client->email }}" class="text-primary hover:underline">
                                    {{ $client->email }}
                                </a>
                            </div>
                        @endif
                        
                        @if($client->phone)
                            <div class="flex items-center gap-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92C19.95 20.92 18.91 20.77 17.92 20.47C16.15 19.96 14.45 19.12 12.99 17.99C10.95 16.3 9.16 13.92 8 11.32C7.21 9.56 6.82 7.68 6.82 5.78C6.82 5.23 7.27 4.78 7.82 4.78H10.82C11.37 4.78 11.82 5.23 11.82 5.78C11.82 7.3 12.22 8.79 12.99 10.12C13.24 10.57 13.16 11.15 12.79 11.51L11 13.3C12.68 15.77 15.05 17.45 17.53 18.11L19.32 16.32C19.68 15.96 20.26 15.88 20.71 16.13C21.37 16.49 22 17.18 22 17.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <a href="tel:{{ $client->phone }}" class="text-primary hover:underline">
                                    {{ $client->phone }}
                                </a>
                            </div>
                        @endif
                        
                        @if($client->company)
                            <div class="flex items-center gap-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 7V17C21 17.7956 20.6839 18.5587 20.1213 19.1213C19.5587 19.6839 18.7956 20 18 20H6C5.20435 20 4.44129 19.6839 3.87868 19.1213C3.31607 18.5587 3 17.7956 3 17V7M21 7L12 3L3 7M21 7L12 11L3 7M12 11V20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>{{ $client->company }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div>
                    <h3 class="font-medium mb-2">Additional Information</h3>
                    <div class="space-y-2">
                        @if($client->address)
                            <div class="flex items-start gap-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 11.5C13.3807 11.5 14.5 10.3807 14.5 9C14.5 7.61929 13.3807 6.5 12 6.5C10.6193 6.5 9.5 7.61929 9.5 9C9.5 10.3807 10.6193 11.5 12 11.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>{{ $client->address }}</span>
                            </div>
                        @endif
                        
                        <div class="flex items-center gap-2">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Created {{ $client->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Update Follow-up Date -->
            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h3 class="font-medium mb-3">Update Follow-up Date</h3>
                <form method="POST" action="{{ route('clients.update', $client) }}" class="flex gap-3">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="name" value="{{ $client->name }}">
                    <input type="hidden" name="email" value="{{ $client->email }}">
                    <input type="hidden" name="phone" value="{{ $client->phone }}">
                    <input type="hidden" name="company" value="{{ $client->company }}">
                    <input type="hidden" name="address" value="{{ $client->address }}">
                    <input type="hidden" name="status" value="{{ $client->status }}">
                    
                    <input type="date" 
                           name="next_follow_up" 
                           class="form-control" 
                           value="{{ $client->next_follow_up ? $client->next_follow_up->format('Y-m-d') : '' }}">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="card">
            <h2 class="card-title mb-4">Quick Actions</h2>
            <div class="space-y-3">
                <a href="mailto:{{ $client->email }}" class="btn btn-outline w-full justify-center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Send Email
                </a>
                
                @if($client->phone)
                <a href="tel:{{ $client->phone }}" class="btn btn-outline w-full justify-center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92C19.95 20.92 18.91 20.77 17.92 20.47C16.15 19.96 14.45 19.12 12.99 17.99C10.95 16.3 9.16 13.92 8 11.32C7.21 9.56 6.82 7.68 6.82 5.78C6.82 5.23 7.27 4.78 7.82 4.78H10.82C11.37 4.78 11.82 5.23 11.82 5.78C11.82 7.3 12.22 8.79 12.99 10.12C13.24 10.57 13.16 11.15 12.79 11.51L11 13.3C12.68 15.77 15.05 17.45 17.53 18.11L19.32 16.32C19.68 15.96 20.26 15.88 20.71 16.13C21.37 16.49 22 17.18 22 17.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Call Client
                </a>
                @endif
                
                <button onclick="document.getElementById('addNoteForm').scrollIntoView()" 
                        class="btn btn-accent w-full justify-center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5V19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Add Note
                </button>
            </div>
        </div>
    </div>

    <!-- Add Note Form -->
    <div class="card mb-6" id="addNoteForm">
        <h2 class="card-title mb-4">Add Note</h2>
        <form method="POST" action="{{ route('notes.store', $client) }}">
            @csrf
            
            <div class="form-group mb-3">
                <select name="type" class="form-control">
                    <option value="call">Phone Call</option>
                    <option value="meeting">Meeting</option>
                    <option value="email">Email</option>
                    <option value="general" selected>General Note</option>
                </select>
            </div>
            
            <div class="form-group mb-3">
                <textarea name="content" 
                          class="form-control" 
                          rows="3" 
                          placeholder="Enter note details (call summary, meeting highlights, next steps, etc.)"
                          required></textarea>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16L21 8V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 21V13H7V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 3V8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Save Note
                </button>
            </div>
        </form>
    </div>

    <!-- Client Notes -->
    <div class="card">
        <h2 class="card-title mb-4">Client Notes & Activity</h2>
        
        @if($notes->count() > 0)
            <div class="space-y-4">
                @foreach($notes as $note)
                    <div class="note">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <span class="badge badge-{{ $note->type }}">
                                    {{ ucfirst($note->type) }}
                                </span>
                                <span class="text-sm opacity-70 ml-2">
                                    {{ $note->created_at->format('M d, Y H:i') }}
                                </span>
                            </div>
                            
                            <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800 text-sm"
                                        onclick="return confirm('Are you sure you want to delete this note?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                        
                        <div class="note-content">
                            {{ $note->content }}
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $notes->links() }}
            </div>
        @else
            <div class="text-center py-8">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 opacity-50">
                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 13H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 17H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 9H9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3 class="text-lg font-medium mb-2">No notes yet</h3>
                <p class="opacity-70">Add your first note above to track interactions with this client.</p>
            </div>
        @endif
    </div>
@endsection