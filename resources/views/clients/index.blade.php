@extends('layouts.app')

@section('title', 'Clients')

@section('content')

<!-- Header -->
<div class="dashboard-header">
    <div class="header-content">
        <div class="header-left">
            <h1 class="page-title">Clients</h1>
            <p class="page-subtitle">Manage your client relationships</p>
        </div>
        <a href="{{ route('clients.create') }}" class="primary-action-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Add New Client
        </a>
    </div>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="card stat-card">
        <div class="stat-number">{{ $clients->total() }}</div>
        <div class="stat-label">Total Clients</div>
    </div>
    
    <div class="card stat-card">
        <div class="stat-number">{{ $clients->where('status', 'active')->count() }}</div>
        <div class="stat-label">Active</div>
    </div>
    
    <div class="card stat-card">
        <div class="stat-number">{{ $clients->where('status', 'lead')->count() }}</div>
        <div class="stat-label">Leads</div>
    </div>
    
    <div class="card stat-card">
        <div class="stat-number">{{ $clients->where('status', 'inactive')->count() }}</div>
        <div class="stat-label">Inactive</div>
    </div>
</div>

<!-- Search & Filter -->
<div class="filter-section">
    <div class="filter-card">
        <form method="GET" action="{{ route('clients.index') }}" class="filter-form">
            <div class="search-box">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="var(--text)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search clients..." 
                    value="{{ request('search') }}"
                    class="search-input"
                >
            </div>
            
            <div class="filter-actions">
                <div class="filter-group">
                    <select name="status" class="filter-select" onchange="this.form.submit()">
                        <option value="all">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="lead" {{ request('status') == 'lead' ? 'selected' : '' }}>Lead</option>
                    </select>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="select-arrow">
                        <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                
                <button type="submit" class="filter-btn">
                    Apply Filters
                </button>
                
                @if(request('search') || request('status') != 'all')
                    <a href="{{ route('clients.index') }}" class="clear-btn">
                        Clear All
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Clients Grid -->
<div class="content-section">
    @if($clients->count())
        <div class="clients-grid">
            @foreach($clients as $client)
                <div class="client-card">
                    <!-- Card Header -->
                    <div class="client-card-header">
                        <div class="client-avatar">
                            {{ strtoupper(substr($client->name, 0, 1)) }}
                        </div>
                        <div class="client-info">
                            <h3 class="client-name">{{ $client->name }}</h3>
                            <div class="client-status">
                                <span class="status-badge status-{{ $client->status }}">
                                    {{ ucfirst($client->status) }}
                                </span>
                                <span class="notes-count">
                                    {{ $client->notes_count }} notes
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="client-contact">
                        @if($client->email)
                            <div class="contact-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="var(--text)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M22 6L12 13L2 6" stroke="var(--text)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <a href="mailto:{{ $client->email }}" class="contact-link">{{ $client->email }}</a>
                            </div>
                        @endif
                        
                        @if($client->phone)
                            <div class="contact-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92C19.95 20.92 18.91 20.77 17.92 20.47C16.15 19.96 14.45 19.12 12.99 17.99C10.95 16.3 9.16 13.92 8 11.32C7.21 9.56 6.82 7.68 6.82 5.78C6.82 5.23 7.27 4.78 7.82 4.78H10.82C11.37 4.78 11.82 5.23 11.82 5.78C11.82 7.3 12.22 8.79 12.99 10.12C13.24 10.57 13.16 11.15 12.79 11.51L11 13.3C12.68 15.77 15.05 17.45 17.53 18.11L19.32 16.32C19.68 15.96 20.26 15.88 20.71 16.13C21.37 16.49 22 17.18 22 17.92Z" stroke="var(--text)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <a href="tel:{{ $client->phone }}" class="contact-link">{{ $client->phone }}</a>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Company Info -->
                    @if($client->company)
                        <div class="client-company">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M21 7V17C21 17.7956 20.6839 18.5587 20.1213 19.1213C19.5587 19.6839 18.7956 20 18 20H6C5.20435 20 4.44129 19.6839 3.87868 19.1213C3.31607 18.5587 3 17.7956 3 17V7M21 7L12 3L3 7M21 7L12 11L3 7M12 11V20" stroke="var(--text)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>{{ $client->company }}</span>
                        </div>
                    @endif
                    
                    <!-- Follow-up Info -->
                    <div class="client-followup">
                        <div class="followup-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="var(--text)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="var(--text)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Next Follow-up
                        </div>
                        <div class="followup-date {{ $client->next_follow_up ? ($client->next_follow_up->isToday() ? 'today' : ($client->next_follow_up->isPast() ? 'overdue' : 'upcoming')) : 'not-set' }}">
                            @if($client->next_follow_up)
                                @if($client->next_follow_up->isToday())
                                    <span class="date-badge today">Today</span>
                                @elseif($client->next_follow_up->isPast())
                                    <span class="date-badge overdue">Overdue</span>
                                @else
                                    {{ $client->next_follow_up->format('M d, Y') }}
                                @endif
                            @else
                                <span class="not-set-text">Not scheduled</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="client-actions-row">
                        <a href="{{ route('clients.show', $client) }}" class="btn btn-primary">
                            View
                        </a>
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-secondary">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('clients.destroy', $client) }}" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this client?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="pagination-container">
            {{ $clients->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state-card">
            <div class="empty-state-icon">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="var(--text)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="var(--text)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8518 20.8581 15.3516 20 15.13" stroke="var(--text)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="var(--text)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3>No clients found</h3>
            <p>Start building your client network by adding your first client</p>
            <a href="{{ route('clients.create') }}" class="btn btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Add Your First Client
            </a>
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
    --danger: #dc3545;
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
    --danger: #dc3545;
}

/* ====================================
   LAYOUT & STRUCTURE (Dashboard Style)
   ==================================== */
.dashboard-header {
    background: var(--card);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid var(--card);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.dashboard-header:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-left {
    flex: 1;
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    color: var(--text);
}

.page-subtitle {
    font-size: 0.9rem;
    opacity: 0.7;
    color: var(--text);
}

/* ====================================
   STATS GRID (Dashboard Style)
   ==================================== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    text-align: center;
    padding: 1.5rem;
    background: var(--stat-card);
    border-radius: 12px;
    border: 1px solid var(--card);
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text);
    opacity: 0.8;
}

/* ====================================
   PRIMARY ACTION BUTTON
   ==================================== */
.primary-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--button);
    color: var(--background);
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(116, 54, 82, 0.2);
}

.primary-action-btn:hover {
    background: var(--button-hover);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(116, 54, 82, 0.3);
}

/* ====================================
   FILTER SECTION
   ==================================== */
.filter-section {
    margin-bottom: 2rem;
}

.filter-card {
    background: var(--card);
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid var(--card);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.filter-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.filter-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.search-box {
    position: relative;
    flex: 1;
}

.search-box svg {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text);
    opacity: 0.6;
}

.search-input {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 3rem;
    background: var(--background);
    border: 1px solid var(--secondary);
    border-radius: 8px;
    font-size: 0.95rem;
    color: var(--text);
    transition: all 0.3s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.search-input:focus {
    outline: none;
    border-color: var(--button);
    box-shadow: 0 0 0 3px rgba(116, 54, 82, 0.1);
}

.filter-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.filter-group {
    position: relative;
    flex: 1;
}

.filter-select {
    width: 100%;
    padding: 0.875rem 1rem;
    background: var(--background);
    border: 1px solid var(--secondary);
    border-radius: 8px;
    font-size: 0.95rem;
    color: var(--text);
    appearance: none;
    cursor: pointer;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.select-arrow {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: var(--text);
}

.filter-btn {
    background: var(--button);
    color: var(--background);
    border: none;
    padding: 0.875rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(116, 54, 82, 0.2);
}

.filter-btn:hover {
    background: var(--button-hover);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(116, 54, 82, 0.3);
}

.clear-btn {
    background: transparent;
    color: var(--text);
    border: 1px solid var(--secondary);
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.clear-btn:hover {
    background: var(--secondary);
    color: var(--background);
    transform: translateY(-2px);
}

/* ====================================
   CLIENTS GRID (Dashboard Card Style)
   ==================================== */
.content-section {
    margin-bottom: 3rem;
}

.clients-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.client-card {
    background: var(--card);
    border-radius: 12px;
    padding: 1.5rem;
    transition: all 0.3s ease;
    border: 1px solid var(--card);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

/* UPWARD HOVER EFFECT (Removed reflection animation) */
.client-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.client-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    border-color: var(--secondary);
}

.client-card:active {
    transform: translateY(-2px);
}

/* ====================================
   CLIENT CARD HEADER
   ==================================== */
.client-card-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.25rem;
    transition: transform 0.2s ease;
}

.client-card:hover .client-card-header {
    transform: translateY(-2px);
}

.client-avatar {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: var(--button);
    color: var(--background);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.25rem;
    flex-shrink: 0;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(116, 54, 82, 0.2);
}

/* Removed avatar rotation, kept scale only */
.client-card:hover .client-avatar {
    transform: scale(1.05);
    background: var(--button-hover);
}

.client-info {
    flex: 1;
}

.client-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 0.25rem;
}

.client-status {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    transition: all 0.2s ease;
}

.client-card:hover .status-badge {
    transform: scale(1.05);
}

.status-active {
    background: rgba(116, 54, 82, 0.15);
    color: var(--button);
}

.status-lead {
    background: rgba(205, 137, 181, 0.15);
    color: var(--secondary);
}

.status-inactive {
    background: rgba(175, 75, 117, 0.15);
    color: var(--accent);
}

.notes-count {
    font-size: 0.8rem;
    color: var(--text);
    opacity: 0.7;
}

/* ====================================
   CONTACT INFORMATION
   ==================================== */
.client-contact {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.contact-link {
    color: var(--text);
    text-decoration: none;
    font-size: 0.9rem;
    opacity: 0.8;
    transition: all 0.2s ease;
}

.client-card:hover .contact-link {
    color: var(--button);
    opacity: 1;
}

/* ====================================
   COMPANY INFO
   ==================================== */
.client-company {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: rgba(0, 0, 0, 0.03);
    border-radius: 8px;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    color: var(--text);
    transition: all 0.2s ease;
}

.client-card:hover .client-company {
    background: rgba(116, 54, 82, 0.08);
}

/* ====================================
   FOLLOW-UP SECTION
   ==================================== */
.client-followup {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: var(--stat-card);
    border-radius: 8px;
    margin-bottom: 1.25rem;
    transition: all 0.2s ease;
}

.client-card:hover .client-followup {
    background: var(--secondary);
}

.followup-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--text);
    opacity: 0.8;
}

.followup-date {
    font-weight: 600;
    font-size: 0.95rem;
}

.date-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    transition: all 0.2s ease;
}

.date-badge.today {
    background: var(--button-hover);
    color: white;
    animation: pulse 2s infinite;
}

.client-card:hover .date-badge.today {
    animation: pulse 1.5s infinite;
}

.date-badge.overdue {
    background: rgba(175, 75, 117, 0.2);
    color: var(--button-hover);
}

.client-card:hover .date-badge.overdue {
    background: var(--accent);
    color: white;
}

.not-set-text {
    color: var(--text);
    opacity: 0.5;
    font-style: italic;
}

/* ====================================
   ACTION BUTTONS
   ==================================== */
.client-actions-row {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
    transition: transform 0.2s ease;
}

.client-card:hover .client-actions-row {
    transform: translateY(-2px);
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    border: none;
    transition: all 0.2s ease;
    font-size: 0.875rem;
    flex: 1;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background: var(--button);
    color: var(--background);
}

.btn-primary:hover {
    background: var(--button-hover);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(116, 54, 82, 0.3);
}

.btn-secondary {
    background: var(--secondary);
    color: var(--background);
}

.btn-secondary:hover {
    background: var(--button-hover);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(116, 54, 82, 0.3);
}

.btn-danger {
    background: var(--danger);
    color: white;
}

.btn-danger:hover {
    background: #c82333;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
}

.inline-form {
    display: flex;
    flex: 1;
}

/* ====================================
   EMPTY STATE
   ==================================== */
.empty-state-card {
    background: var(--card);
    border-radius: 12px;
    padding: 3rem 2rem;
    text-align: center;
    border: 1px solid var(--card);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.empty-state-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.empty-state-icon {
    margin-bottom: 1.5rem;
    opacity: 0.5;
}

.empty-state-card h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: var(--text);
}

.empty-state-card p {
    color: var(--text);
    opacity: 0.7;
    margin-bottom: 2rem;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
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
    border: 1px solid var(--secondary);
    border-radius: 8px;
    color: var(--text);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.pagination a:hover {
    background: var(--button);
    color: white;
    border-color: var(--button);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(116, 54, 82, 0.2);
}

.pagination .active span {
    background: var(--button);
    color: white;
    border-color: var(--button);
    box-shadow: 0 2px 4px rgba(116, 54, 82, 0.2);
}

/* ====================================
   ANIMATIONS
   ==================================== */
@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(180, 80, 122, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(180, 80, 122, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(180, 80, 122, 0);
    }
}

/* Card appear animation */
@keyframes cardAppear {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.client-card {
    animation: cardAppear 0.5s ease forwards;
    opacity: 0;
}

/* Stagger the animation for each card */
.client-card:nth-child(1) { animation-delay: 0.1s; }
.client-card:nth-child(2) { animation-delay: 0.15s; }
.client-card:nth-child(3) { animation-delay: 0.2s; }
.client-card:nth-child(4) { animation-delay: 0.25s; }
.client-card:nth-child(5) { animation-delay: 0.3s; }
.client-card:nth-child(6) { animation-delay: 0.35s; }
.client-card:nth-child(7) { animation-delay: 0.4s; }
.client-card:nth-child(8) { animation-delay: 0.45s; }
.client-card:nth-child(9) { animation-delay: 0.5s; }
.client-card:nth-child(10) { animation-delay: 0.55s; }

/* ====================================
   RESPONSIVE DESIGN
   ==================================== */
@media (max-width: 1024px) {
    .clients-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    }
}

@media (max-width: 768px) {
    .dashboard-header {
        padding: 1.25rem;
    }
    
    .header-content {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .filter-actions {
        flex-direction: column;
    }
    
    .clients-grid {
        grid-template-columns: 1fr;
    }
    
    .client-card {
        padding: 1.25rem;
    }
    
    .client-actions-row {
        flex-direction: column;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .client-contact {
        flex-direction: column;
    }
    
    .client-followup {
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced card animations
    const cards = document.querySelectorAll('.client-card');
    
    cards.forEach((card, index) => {
        // Add data attribute for stagger effect
        card.setAttribute('data-index', index);
        
        // Add click animation
        card.addEventListener('click', function(e) {
            // Don't trigger if clicking on buttons or links
            if (!e.target.closest('a') && !e.target.closest('button')) {
                card.style.transform = 'translateY(-2px)';
                setTimeout(() => {
                    card.style.transform = 'translateY(-5px)';
                }, 150);
            }
        });
        
        // Removed avatar rotation animation
        const avatar = card.querySelector('.client-avatar');
        const buttons = card.querySelectorAll('.btn');
        
        // Simplified avatar hover (scale only, no rotation)
        if (avatar) {
            card.addEventListener('mouseenter', () => {
                avatar.style.transform = 'scale(1.05)';
            });
            
            card.addEventListener('mouseleave', () => {
                avatar.style.transform = 'scale(1)';
            });
        }
        
        // Add ripple effect to buttons (optional, can remove if not wanted)
        buttons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                const x = e.clientX - e.target.getBoundingClientRect().left;
                const y = e.clientY - e.target.getBoundingClientRect().top;
                
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.background = 'rgba(255, 255, 255, 0.5)';
                ripple.style.borderRadius = '50%';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    });
    
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const card = entry.target;
                const index = card.getAttribute('data-index');
                const delay = (index * 50) + 100; // Stagger delay
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, delay);
            }
        });
    }, observerOptions);

    // Observe client cards
    cards.forEach(card => {
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease, box-shadow 0.3s ease';
        observer.observe(card);
    });
    
    // Add ripple animation CSS (optional)
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        /* Enhance the hover effect for status badges */
        .client-card:hover .status-active {
            background: rgba(116, 54, 82, 0.25);
            transform: scale(1.05);
        }
        
        .client-card:hover .status-lead {
            background: rgba(205, 137, 181, 0.25);
            transform: scale(1.05);
        }
        
        .client-card:hover .status-inactive {
            background: rgba(175, 75, 117, 0.25);
            transform: scale(1.05);
        }
        
        /* Smooth transition for status badges */
        .status-badge {
            transition: all 0.2s ease;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush