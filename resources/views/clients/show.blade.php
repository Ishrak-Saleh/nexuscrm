@extends('layouts.app')

@section('title', $client->name)

@section('content')

<!-- Header -->
<div class="dashboard-header">
    <div class="header-content">
        <div class="header-left">
            <h1 class="page-title">{{ $client->name }}</h1>
            <div class="client-meta">
                <span class="status-badge status-{{ $client->status }}">
                    {{ ucfirst($client->status) }}
                </span>
                @if($client->next_follow_up)
                    @if($client->next_follow_up->isToday())
                        <span class="priority-badge">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Follow-up Today
                        </span>
                    @elseif($client->next_follow_up->isPast())
                        <span class="priority-badge overdue">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 8V12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 16H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Follow-up Overdue
                        </span>
                    @else
                        <span class="date-badge">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                <path d="M8 2V5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 2V5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M3 9H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 4H5C3.89543 4 3 4.89543 3 6V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $client->next_follow_up->format('M d, Y') }}
                        </span>
                    @endif
                @endif
            </div>
        </div>
        <div class="header-right">
            <a href="{{ route('clients.edit', $client) }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.5 2.5C18.8978 2.10217 19.4374 1.87868 20 1.87868C20.5626 1.87868 21.1022 2.10217 21.5 2.5C21.8978 2.89782 22.1213 3.43739 22.1213 4C22.1213 4.56261 21.8978 5.10217 21.5 5.5L12 15L8 16L9 12L18.5 2.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Edit Client
            </a>
            <a href="{{ route('clients.index') }}" class="btn btn-outline">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                All Clients
            </a>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="content-grid">
    <!-- Client Information Card -->
    <div class="main-card">
        <div class="card-header-section">
            <h2 class="card-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 0.75rem;">
                    <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Client Information
            </h2>
        </div>

        <div class="info-sections">
            <!-- Contact Information -->
            <div class="info-section">
                <h3 class="section-title">Contact Details</h3>
                <div class="info-items">
                    @if($client->email)
                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Email</div>
                                <a href="mailto:{{ $client->email }}" class="info-value">{{ $client->email }}</a>
                            </div>
                        </div>
                    @endif

                    @if($client->phone)
                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92C19.95 20.92 18.91 20.77 17.92 20.47C16.15 19.96 14.45 19.12 12.99 17.99C10.95 16.3 9.16 13.92 8 11.32C7.21 9.56 6.82 7.68 6.82 5.78C6.82 5.23 7.27 4.78 7.82 4.78H10.82C11.37 4.78 11.82 5.23 11.82 5.78C11.82 7.3 12.22 8.79 12.99 10.12C13.24 10.57 13.16 11.15 12.79 11.51L11 13.3C12.68 15.77 15.05 17.45 17.53 18.11L19.32 16.32C19.68 15.96 20.26 15.88 20.71 16.13C21.37 16.49 22 17.18 22 17.92Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Phone</div>
                                <a href="tel:{{ $client->phone }}" class="info-value">{{ $client->phone }}</a>
                            </div>
                        </div>
                    @endif

                    @if($client->company)
                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 7V17C21 17.7956 20.6839 18.5587 20.1213 19.1213C19.5587 19.6839 18.7956 20 18 20H6C5.20435 20 4.44129 19.6839 3.87868 19.1213C3.31607 18.5587 3 17.7956 3 17V7M21 7L12 3L3 7M21 7L12 11L3 7M12 11V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Company</div>
                                <span class="info-value">{{ $client->company }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Additional Information -->
            <div class="info-section">
                <h3 class="section-title">Additional Information</h3>
                <div class="info-items">
                    @if($client->address)
                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 11.5C13.3807 11.5 14.5 10.3807 14.5 9C14.5 7.61929 13.3807 6.5 12 6.5C10.6193 6.5 9.5 7.61929 9.5 9C9.5 10.3807 10.6193 11.5 12 11.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Address</div>
                                <span class="info-value">{{ $client->address }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="info-item">
                        <div class="info-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Created</div>
                            <span class="info-value">{{ $client->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Follow-up Section -->
        <div class="followup-section">
            <div class="section-header">
                <h3 class="section-title">Next Follow-up</h3>
                <span class="section-subtitle">Schedule the next client follow-up</span>
            </div>
            <form method="POST" action="{{ route('clients.update', $client) }}" class="followup-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="name" value="{{ $client->name }}">
                <input type="hidden" name="email" value="{{ $client->email }}">
                <input type="hidden" name="phone" value="{{ $client->phone }}">
                <input type="hidden" name="company" value="{{ $client->company }}">
                <input type="hidden" name="address" value="{{ $client->address }}">
                <input type="hidden" name="status" value="{{ $client->status }}">
                
                <div class="form-group">
                    <div class="input-with-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="input-icon">
                            <path d="M8 2V5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 2V5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3 9H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 4H5C3.89543 4 3 4.89543 3 6V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="date" 
                               name="next_follow_up"
                               class="form-input"
                               value="{{ optional($client->next_follow_up)->format('Y-m-d') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 0.5rem;">
                        <path d="M19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16L21 8V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 21V13H7V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 3V8H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Update Date
                </button>
            </form>
        </div>
    </div>

    <!-- Quick Actions Card -->
    <div class="sidebar-card">
        <div class="card-header-section">
            <h2 class="card-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 0.75rem;">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 9V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 17H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Quick Actions
            </h2>
        </div>
        
        <div class="action-buttons">
            <a href="mailto:{{ $client->email }}" class="action-btn primary-action">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Send Email
            </a>
            
            @if($client->phone)
                <a href="tel:{{ $client->phone }}" class="action-btn secondary-action">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92C19.95 20.92 18.91 20.77 17.92 20.47C16.15 19.96 14.45 19.12 12.99 17.99C10.95 16.3 9.16 13.92 8 11.32C7.21 9.56 6.82 7.68 6.82 5.78C6.82 5.23 7.27 4.78 7.82 4.78H10.82C11.37 4.78 11.82 5.23 11.82 5.78C11.82 7.3 12.22 8.79 12.99 10.12C13.24 10.57 13.16 11.15 12.79 11.51L11 13.3C12.68 15.77 15.05 17.45 17.53 18.11L19.32 16.32C19.68 15.96 20.26 15.88 20.71 16.13C21.37 16.49 22 17.18 22 17.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Call Client
                </a>
            @endif
            
            <button onclick="document.getElementById('addNoteSection').scrollIntoView({ behavior: 'smooth' })" 
                    class="action-btn accent-action">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Add Note
            </button>
        </div>
    </div>
</div>

<!-- Add Note Section -->
<div class="form-card" id="addNoteSection">
    <div class="card-header-section">
        <h2 class="card-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 0.75rem;">
                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14 2V8H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Add Note
        </h2>
        <p class="card-subtitle">Document client interactions and updates</p>
    </div>

    <form method="POST" action="{{ route('notes.store', $client) }}" class="note-form">
        @csrf

        <div class="form-group">
            <div class="select-wrapper">
                <select name="type" class="form-select">
                    <option value="call">Phone Call</option>
                    <option value="meeting">Meeting</option>
                    <option value="email">Email</option>
                    <option value="general" selected>General Note</option>
                </select>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="select-arrow">
                    <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="form-group">
            <div class="textarea-wrapper">
                <textarea name="content" 
                          class="form-textarea"
                          rows="3"
                          placeholder="Enter note details (call summary, meeting highlights, next steps, etc.)"
                          required></textarea>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="textarea-icon">
                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right: 0.5rem;">
                    <path d="M19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16L21 8V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Save Note
            </button>
        </div>
    </form>
</div>

<!-- Notes Section -->
<div class="card">
    <div class="card-header-section">
        <h2 class="card-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="margin-right: 0.75rem;">
                <path d="M21 11.5V12C21 13.1819 20.7672 14.3522 20.3149 15.4442C19.8626 16.5361 19.1997 17.5282 18.364 18.364C17.5282 19.1997 16.5361 19.8626 15.4442 20.3149C14.3522 20.7672 13.1819 21 12 21C10.8181 21 9.64778 20.7672 8.55585 20.3149C7.46392 19.8626 6.47177 19.1997 5.63604 18.364C4.80031 17.5282 4.13738 16.5361 3.68508 15.4442C3.23279 14.3522 3 13.1819 3 12C3 10.8181 3.23279 9.64778 3.68508 8.55585C4.13738 7.46392 4.80031 6.47177 5.63604 5.63604C6.47177 4.80031 7.46392 4.13738 8.55585 3.68508C9.64778 3.23279 10.8181 3 12 3C13.1819 3 14.3522 3.23279 15.4442 3.68508C16.5361 4.13738 17.5282 4.80031 18.364 5.63604C19.1997 6.47177 19.8626 7.46392 20.3149 8.55585C20.7672 9.64778 21 10.8181 21 12V12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Client Notes & Activity
        </h2>
        <p class="card-subtitle">History of client interactions and communications</p>
    </div>

    @if($notes->count())
        <div class="notes-list">
            @foreach($notes as $note)
                <div class="note-item">
                    <div class="note-header">
                        <div class="note-type">
                            <span class="type-badge type-{{ $note->type }}">
                                {{ ucfirst($note->type) }}
                            </span>
                            <span class="note-date">{{ $note->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <form action="{{ route('notes.destroy', $note) }}" method="POST" class="note-actions">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn-icon danger"
                                    onclick="return confirm('Are you sure you want to delete this note?')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <path d="M3 6H5H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 21 17 21H7C6.46957 21 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="note-content">{{ $note->content }}</div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($notes->hasPages())
        <div class="pagination-container">
            {{ $notes->links() }}
        </div>
        @endif
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 2V8H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3>No notes yet</h3>
            <p>Add your first note above to track interactions with this client.</p>
        </div>
    @endif
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
    align-items: flex-start;
}

.header-left {
    flex: 1;
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--text);
}

.client-meta {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.header-right {
    display: flex;
    gap: 0.75rem;
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

.btn-secondary {
    background: var(--secondary);
    color: white;
}

.btn-secondary:hover {
    background: var(--button-hover);
    color: white;
}

.btn-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
    border-radius: 6px;
    background: transparent;
    border: none;
    color: var(--text);
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-icon.danger:hover {
    background: rgba(220, 53, 69, 0.1);
    color: var(--error);
}

/* ====================================
   BADGES
   ==================================== */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-lead {
    background: rgba(205, 137, 181, 0.1);
    color: var(--secondary);
    border: 1px solid rgba(205, 137, 181, 0.2);
}

.status-active {
    background: rgba(83, 40, 93, 0.1);
    color: var(--primary);
    border: 1px solid rgba(83, 40, 93, 0.2);
}

.status-inactive {
    background: rgba(175, 75, 117, 0.1);
    color: var(--accent);
    border: 1px solid rgba(175, 75, 117, 0.2);
}

.priority-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.75rem;
    background: rgba(180, 80, 122, 0.1);
    color: var(--accent);
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.priority-badge.overdue {
    background: rgba(220, 53, 69, 0.1);
    color: var(--error);
}

.date-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.75rem;
    background: rgba(83, 40, 93, 0.1);
    color: var(--primary);
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

/* ====================================
   CONTENT GRID
   ==================================== */
.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
}

/* ====================================
   CARDS
   ==================================== */
.main-card,
.sidebar-card,
.card,
.form-card {
    background: var(--card);
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid var(--border);
    box-shadow: 0 2px 8px var(--shadow);
}

.card-header-section {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border);
}

.card-title {
    display: flex;
    align-items: center;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 0.25rem;
}

.card-subtitle {
    font-size: 0.9rem;
    color: var(--text);
    opacity: 0.7;
}

/* ====================================
   INFORMATION SECTIONS
   ==================================== */
.info-sections {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    margin-bottom: 2rem;
}

@media (max-width: 768px) {
    .info-sections {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

.info-section {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.section-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.8;
}

.info-items {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.info-icon {
    margin-top: 0.125rem;
    opacity: 0.6;
}

.info-content {
    flex: 1;
}

.info-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text);
    opacity: 0.6;
    margin-bottom: 0.125rem;
}

.info-value {
    font-size: 0.95rem;
    color: var(--text);
    text-decoration: none;
    display: block;
}

.info-value:hover {
    color: var(--button);
}

/* ====================================
   FOLLOW-UP SECTION
   ==================================== */
.followup-section {
    background: rgba(83, 40, 93, 0.05);
    border-radius: 8px;
    padding: 1.5rem;
    border: 1px solid var(--border);
}

.section-header {
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 0.875rem;
    color: var(--text);
    opacity: 0.7;
}

.followup-form {
    display: flex;
    gap: 0.75rem;
    align-items: stretch;
}

.followup-form .form-group {
    display: flex;
}

.followup-form .form-input {
    height: 48px;
    padding-top: 0;
    padding-bottom: 0;
}   

.followup-form .btn {
    height: 48px;
    padding: 0 1.5rem;
    display: inline-flex;
    align-items: center;
}

@media (max-width: 640px) {
    .followup-form {
        flex-direction: column;
        align-items: stretch;
    }
}

/* ====================================
   FORM ELEMENTS
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
   ACTION BUTTONS
   ==================================== */
.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.875rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: none;
    transition: all 0.3s ease;
    font-size: 0.875rem;
}

.primary-action {
    background: var(--button);
    color: white;
}

.primary-action:hover {
    background: var(--button-hover);
    color: white;
}

.secondary-action {
    background: var(--secondary);
    color: white;
}

.secondary-action:hover {
    background: var(--button-hover);
    color: white;
}

.accent-action {
    background: var(--accent);
    color: white;
}

.accent-action:hover {
    background: var(--button-hover);
    color: white;
}

/* ====================================
   NOTES SECTION
   ==================================== */
.notes-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.note-item {
    background: rgba(0, 0, 0, 0.03);
    border-radius: 8px;
    padding: 1rem;
    border: 1px solid var(--border);
    transition: all 0.3s ease;
}

.note-item:hover {
    border-color: var(--secondary);
}

.note-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.note-type {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.type-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.type-call {
    background: rgba(83, 40, 93, 0.1);
    color: var(--primary);
    border: 1px solid rgba(83, 40, 93, 0.2);
}

.type-meeting {
    background: rgba(205, 137, 181, 0.1);
    color: var(--secondary);
    border: 1px solid rgba(205, 137, 181, 0.2);
}

.type-email {
    background: rgba(116, 54, 82, 0.1);
    color: var(--button);
    border: 1px solid rgba(116, 54, 82, 0.2);
}

.type-general {
    background: rgba(175, 75, 117, 0.1);
    color: var(--accent);
    border: 1px solid rgba(175, 75, 117, 0.2);
}

.note-date {
    font-size: 0.75rem;
    color: var(--text);
    opacity: 0.6;
}

.note-content {
    font-size: 0.9rem;
    line-height: 1.5;
    color: var(--text);
}

/* ====================================
   EMPTY STATE
   ==================================== */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-icon {
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state h3 {
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: var(--text);
}

.empty-state p {
    color: var(--text);
    opacity: 0.7;
    max-width: 300px;
    margin: 0 auto;
}

/* ====================================
   PAGINATION
   ==================================== */
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.pagination {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.pagination a,
.pagination span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 0.75rem;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 8px;
    color: var(--text);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px var(--shadow);
}

.pagination a:hover {
    background: var(--button);
    color: white;
    border-color: var(--button);
    transform: translateY(-2px);
}

.pagination .active span {
    background: var(--button);
    color: white;
    border-color: var(--button);
}

/* ====================================
   FORM ACTIONS
   ==================================== */
.form-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 1.5rem;
}

/* ====================================
   RESPONSIVE DESIGN
   ==================================== */
@media (max-width: 768px) {
    .dashboard-header {
        padding: 1.25rem;
    }
    
    .header-content {
        flex-direction: column;
        gap: 1rem;
    }
    
    .header-right {
        width: 100%;
        flex-direction: column;
    }
    
    .header-right .btn {
        width: 100%;
        justify-content: center;
    }
    
    .main-card,
    .sidebar-card,
    .card,
    .form-card {
        padding: 1.25rem;
    }
    
    .followup-form {
        flex-direction: column;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .client-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .card-title {
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
    // Smooth scroll to note form
    const noteButtons = document.querySelectorAll('[onclick*="addNoteSection"]');
    noteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const target = document.getElementById('addNoteSection');
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
                target.querySelector('textarea').focus();
            }
        });
    });
    
    // Add hover effects to note items
    const noteItems = document.querySelectorAll('.note-item');
    noteItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 12px var(--shadow)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
    
    // Set today's date as placeholder for date input
    const dateInput = document.querySelector('input[type="date"]');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
});
</script>
@endpush