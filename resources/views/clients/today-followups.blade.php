@extends('layouts.app')

@section('title', "Today's Follow-ups")

@section('content')

<!-- Header -->
<div class="dashboard-header">
    <div class="header-content">
        <div class="header-left">
            <h1 class="page-title">Today's Follow-ups</h1>
            <p class="page-subtitle">{{ now()->format('F d, Y') }} • Clients scheduled for follow-up today</p>
        </div>
        <div class="header-right">
            <a href="{{ route('clients.index') }}" class="btn btn-outline">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Back to Clients
            </a>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="card stat-card">
        <div class="stat-number">{{ $clients->total() }}</div>
        <div class="stat-label">Due Today</div>
        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="var(--button)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 6V12L16 14" stroke="var(--button)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
    
    <div class="card stat-card">
        <div class="stat-number">{{ $clients->where('status', 'active')->count() }}</div>
        <div class="stat-label">Active Clients</div>
        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.709 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.7649 14.1003 1.98232 16.07 2.85999" stroke="var(--button)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22 4L12 14.01L9 11.01" stroke="var(--button)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
    
    <div class="card stat-card">
        <div class="stat-number">{{ $clients->where('status', 'lead')->count() }}</div>
        <div class="stat-label">Leads</div>
        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 12C21 13.1819 20.7672 14.3522 20.3149 15.4442C19.8626 16.5361 19.1997 17.5282 18.364 18.364C17.5282 19.1997 16.5361 19.8626 15.4442 20.3149C14.3522 20.7672 13.1819 21 12 21C10.8181 21 9.64778 20.7672 8.55585 20.3149C7.46392 19.8626 6.47177 19.1997 5.63604 18.364C4.80031 17.5282 4.13738 16.5361 3.68508 15.4442C3.23279 14.3522 3 13.1819 3 12C3 9.61305 3.94821 7.32387 5.63604 5.63604C7.32387 3.94821 9.61305 3 12 3C14.3869 3 16.6761 3.94821 18.364 5.63604C20.0518 7.32387 21 9.61305 21 12Z" stroke="var(--button)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15 12L11 16L9 14" stroke="var(--button)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
    
    <div class="card stat-card">
        <div class="stat-number">{{ $clients->where('status', 'inactive')->count() }}</div>
        <div class="stat-label">Inactive</div>
        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.364 18.364C16.6761 20.0518 14.3869 21 12 21C9.61305 21 7.32387 20.0518 5.63604 18.364C3.94821 16.6761 3 14.3869 3 12C3 9.61305 3.94821 7.32387 5.63604 5.63604C7.32387 3.94821 9.61305 3 12 3C14.3869 3 16.6761 3.94821 18.364 5.63604C20.0518 7.32387 21 9.61305 21 12C21 14.3869 20.0518 16.6761 18.364 18.364Z" stroke="var(--button)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15 9L9 15" stroke="var(--button)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 9L15 15" stroke="var(--button)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
</div>

<!-- Action Bar -->
<div class="action-bar">
    <div class="action-content">
        <div class="action-info">
            <h3>Today's Priority Tasks</h3>
            <p>Complete follow-ups for optimal client relationship management</p>
        </div>
        <div class="action-buttons">
            <a href="{{ route('clients.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Add Client
            </a>
        </div>
    </div>
</div>

<!-- Follow-ups Grid -->
<div class="content-section">
    @if($clients->count())
        <div class="clients-grid">
            @foreach($clients as $client)
                <div class="client-card followup-card">
                    <!-- Card Header -->
                    <div class="card-header-row">
                        <div class="client-avatar">
                            {{ strtoupper(substr($client->name, 0, 1)) }}
                        </div>
                        <div class="client-main-info">
                            <div class="client-name-row">
                                <h3 class="client-name">{{ $client->name }}</h3>
                                <div class="priority-badge">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Today
                                </div>
                            </div>
                            <div class="client-meta">
                                <span class="status-badge status-{{ $client->status }}">
                                    {{ ucfirst($client->status) }}
                                </span>
                                <span class="meta-item">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                        <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{ $client->notes_count }} notes
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="contact-section">
                        @if($client->email)
                            <div class="contact-row">
                                <div class="contact-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="contact-details">
                                    <span class="contact-label">Email</span>
                                    <a href="mailto:{{ $client->email }}" class="contact-value">{{ $client->email }}</a>
                                </div>
                            </div>
                        @endif
                        
                        @if($client->phone)
                            <div class="contact-row">
                                <div class="contact-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92C19.95 20.92 18.91 20.77 17.92 20.47C16.15 19.96 14.45 19.12 12.99 17.99C10.95 16.3 9.16 13.92 8 11.32C7.21 9.56 6.82 7.68 6.82 5.78C6.82 5.23 7.27 4.78 7.82 4.78H10.82C11.37 4.78 11.82 5.23 11.82 5.78C11.82 7.3 12.22 8.79 12.99 10.12C13.24 10.57 13.16 11.15 12.79 11.51L11 13.3C12.68 15.77 15.05 17.45 17.53 18.11L19.32 16.32C19.68 15.96 20.26 15.88 20.71 16.13C21.37 16.49 22 17.18 22 17.92Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="contact-details">
                                    <span class="contact-label">Phone</span>
                                    <a href="tel:{{ $client->phone }}" class="contact-value">{{ $client->phone }}</a>
                                </div>
                            </div>
                        @endif
                        
                        @if($client->company)
                            <div class="contact-row">
                                <div class="contact-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 7V17C21 17.7956 20.6839 18.5587 20.1213 19.1213C19.5587 19.6839 18.7956 20 18 20H6C5.20435 20 4.44129 19.6839 3.87868 19.1213C3.31607 18.5587 3 17.7956 3 17V7M21 7L12 3L3 7M21 7L12 11L3 7M12 11V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="contact-details">
                                    <span class="contact-label">Company</span>
                                    <span class="contact-value">{{ $client->company }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Follow-up Action Section -->
                    <div class="followup-action-section">
                        <div class="action-header">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Follow-up Required</span>
                        </div>
                        <div class="action-options">
                            <a href="{{ route('clients.show', $client) }}" class="action-btn primary-action">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                View Details
                            </a>
                            @if($client->email)
                                <a href="mailto:{{ $client->email }}" class="action-btn secondary-action">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                        <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Email
                                </a>
                            @endif
                            @if($client->phone)
                                <a href="tel:{{ $client->phone }}" class="action-btn secondary-action">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                        <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92C19.95 20.92 18.91 20.77 17.92 20.47C16.15 19.96 14.45 19.12 12.99 17.99C10.95 16.3 9.16 13.92 8 11.32C7.21 9.56 6.82 7.68 6.82 5.78C6.82 5.23 7.27 4.78 7.82 4.78H10.82C11.37 4.78 11.82 5.23 11.82 5.78C11.82 7.3 12.22 8.79 12.99 10.12C13.24 10.57 13.16 11.15 12.79 11.51L11 13.3C12.68 15.77 15.05 17.45 17.53 18.11L19.32 16.32C19.68 15.96 20.26 15.88 20.71 16.13C21.37 16.49 22 17.18 22 17.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Call
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($clients->hasPages())
        <div class="pagination-container">
            {{ $clients->links() }}
        </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="empty-state-card">
            <div class="empty-state-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="var(--text)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 8V12" stroke="var(--text)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 16H12.01" stroke="var(--text)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3>No follow-ups scheduled for today</h3>
            <p>Great job! You're all caught up with today's follow-ups.</p>
            <div class="empty-actions">
                <a href="{{ route('clients.index') }}" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    View All Clients
                </a>
                <a href="{{ route('clients.create') }}" class="btn btn-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Add New Client
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Professional Tips -->
<div class="professional-tips">
    <div class="tips-header">
        <h2>Professional Follow-up Strategies</h2>
        <p>Best practices for effective client communication</p>
    </div>
    <div class="tips-grid">
        <div class="tip-card">
            <div class="tip-icon-wrapper">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92C19.95 20.92 18.91 20.77 17.92 20.47C16.15 19.96 14.45 19.12 12.99 17.99C10.95 16.3 9.16 13.92 8 11.32C7.21 9.56 6.82 7.68 6.82 5.78C6.82 5.23 7.27 4.78 7.82 4.78H10.82C11.37 4.78 11.82 5.23 11.82 5.78C11.82 7.3 12.22 8.79 12.99 10.12C13.24 10.57 13.16 11.15 12.79 11.51L11 13.3C12.68 15.77 15.05 17.45 17.53 18.11L19.32 16.32C19.68 15.96 20.26 15.88 20.71 16.13C21.37 16.49 22 17.18 22 17.92Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3>Phone Etiquette</h3>
            <ul class="tip-list">
                <li>Schedule calls during business hours</li>
                <li>Prepare talking points beforehand</li>
                <li>Confirm next steps at call end</li>
            </ul>
        </div>
        
        <div class="tip-card">
            <div class="tip-icon-wrapper">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 6L12 13L2 6" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3>Email Best Practices</h3>
            <ul class="tip-list">
                <li>Use clear, professional subject lines</li>
                <li>Personalize each message</li>
                <li>Follow up within 48 hours</li>
            </ul>
        </div>
        
        <div class="tip-card">
            <div class="tip-icon-wrapper">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 2V8H20" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3>Documentation</h3>
            <ul class="tip-list">
                <li>Record key discussion points</li>
                <li>Note agreed action items</li>
                <li>Schedule next follow-up immediately</li>
            </ul>
        </div>
    </div>
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
}

/* ====================================
   LAYOUT & STRUCTURE
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

.header-right {
    display: flex;
    align-items: center;
    gap: 1rem;
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
    padding: 0.5rem 1.5rem;
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

/* ====================================
   STATS GRID
   ==================================== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: var(--stat-card);
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid var(--border);
    box-shadow: 0 2px 8px var(--shadow);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px var(--shadow);
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

.stat-icon {
    position: absolute;
    right: 1.5rem;
    bottom: 1.5rem;
    opacity: 0.3;
}

/* ====================================
   ACTION BAR
   ==================================== */
.action-bar {
    background: var(--card);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid var(--border);
    box-shadow: 0 2px 8px var(--shadow);
}

.action-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.action-info h3 {
    font-size: 1.25rem;
    margin-bottom: 0.25rem;
    color: var(--text);
}

.action-info p {
    font-size: 0.9rem;
    opacity: 0.7;
    color: var(--text);
}

/* ====================================
   CLIENTS GRID - PROFESSIONAL STYLE
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

.followup-card {
    background: var(--card);
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid var(--border);
    box-shadow: 0 2px 8px var(--shadow);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.followup-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--accent);
}

.followup-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px var(--shadow);
    border-color: var(--secondary);
}

/* ====================================
   CARD HEADER
   ==================================== */
.card-header-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.client-avatar {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1.25rem;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.followup-card:hover .client-avatar {
    background: var(--button);
}

.client-main-info {
    flex: 1;
}

.client-name-row {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
}

.client-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text);
    margin: 0;
}

.priority-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    background: var(--accent);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.client-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-active {
    background: rgba(83, 40, 93, 0.1);
    color: var(--primary);
    border: 1px solid rgba(83, 40, 93, 0.2);
}

.status-lead {
    background: rgba(205, 137, 181, 0.1);
    color: var(--secondary);
    border: 1px solid rgba(205, 137, 181, 0.2);
}

.status-inactive {
    background: rgba(175, 75, 117, 0.1);
    color: var(--accent);
    border: 1px solid rgba(175, 75, 117, 0.2);
}

.meta-item {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.75rem;
    color: var(--text);
    opacity: 0.7;
}

/* ====================================
   CONTACT SECTION
   ==================================== */
.contact-section {
    margin-bottom: 1.5rem;
}

.contact-row {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border);
}

.contact-row:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.contact-icon {
    margin-top: 0.125rem;
    opacity: 0.7;
}

.contact-details {
    flex: 1;
}

.contact-label {
    display: block;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text);
    opacity: 0.6;
    margin-bottom: 0.25rem;
}

.contact-value {
    display: block;
    font-size: 0.9rem;
    color: var(--text);
    text-decoration: none;
    transition: color 0.3s ease;
}

.contact-value:hover {
    color: var(--button);
}

/* ====================================
   FOLLOW-UP ACTION SECTION
   ==================================== */
.followup-action-section {
    background: rgba(83, 40, 93, 0.05);
    border-radius: 8px;
    padding: 1rem;
    border: 1px solid var(--border);
}

.action-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 0.75rem;
}

.action-options {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.5rem;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
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

/* ====================================
   EMPTY STATE
   ==================================== */
.empty-state-card {
    background: var(--card);
    border-radius: 12px;
    padding: 3rem 2rem;
    text-align: center;
    border: 1px solid var(--border);
    box-shadow: 0 2px 8px var(--shadow);
}

.empty-state-icon {
    margin-bottom: 1.5rem;
    opacity: 0.5;
}

.empty-state-icon svg {
    stroke-width: 1.5;
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

.empty-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

/* ====================================
   PROFESSIONAL TIPS
   ==================================== */
.professional-tips {
    margin-top: 3rem;
    margin-bottom: 2rem;
}

.tips-header {
    text-align: center;
    margin-bottom: 2rem;
}

.tips-header h2 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: var(--text);
}

.tips-header p {
    color: var(--text);
    opacity: 0.7;
    font-size: 0.95rem;
}

.tips-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.tip-card {
    background: var(--card);
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid var(--border);
    box-shadow: 0 2px 8px var(--shadow);
    transition: all 0.3s ease;
}

.tip-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px var(--shadow);
}

.tip-icon-wrapper {
    width: 56px;
    height: 56px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    background: rgba(83, 40, 93, 0.1);
}

.tip-card h3 {
    font-size: 1.1rem;
    margin-bottom: 1rem;
    color: var(--text);
}

.tip-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.tip-list li {
    position: relative;
    padding-left: 1.25rem;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: var(--text);
    opacity: 0.8;
}

.tip-list li:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.5rem;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--primary);
}

.tip-list li:last-child {
    margin-bottom: 0;
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
   ANIMATIONS
   ==================================== */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.followup-card {
    animation: fadeInUp 0.5s ease forwards;
    opacity: 0;
}

.followup-card:nth-child(1) { animation-delay: 0.1s; }
.followup-card:nth-child(2) { animation-delay: 0.15s; }
.followup-card:nth-child(3) { animation-delay: 0.2s; }
.followup-card:nth-child(4) { animation-delay: 0.25s; }
.followup-card:nth-child(5) { animation-delay: 0.3s; }
.followup-card:nth-child(6) { animation-delay: 0.35s; }
.followup-card:nth-child(7) { animation-delay: 0.4s; }
.followup-card:nth-child(8) { animation-delay: 0.45s; }
.followup-card:nth-child(9) { animation-delay: 0.5s; }
.followup-card:nth-child(10) { animation-delay: 0.55s; }

/* ====================================
   RESPONSIVE DESIGN
   ==================================== */
@media (max-width: 1024px) {
    .clients-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    }
    
    .tips-grid {
        grid-template-columns: repeat(2, 1fr);
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
    
    .header-right {
        justify-content: flex-start;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .action-content {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .action-buttons {
        width: 100%;
    }
    
    .action-buttons .btn {
        width: 100%;
        justify-content: center;
    }
    
    .clients-grid {
        grid-template-columns: 1fr;
    }
    
    .followup-card {
        padding: 1.25rem;
    }
    
    .action-options {
        flex-direction: column;
    }
    
    .tips-grid {
        grid-template-columns: 1fr;
    }
    
    .empty-actions {
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
    
    .client-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .contact-row {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .action-btn {
        padding: 0.75rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Card hover effects
    const cards = document.querySelectorAll('.followup-card');
    
    cards.forEach((card, index) => {
        // Add data attribute for stagger effect
        card.setAttribute('data-index', index);
        
        // Simple hover effect for avatar
        const avatar = card.querySelector('.client-avatar');
        if (avatar) {
            card.addEventListener('mouseenter', () => {
                avatar.style.transform = 'scale(1.05)';
            });
            
            card.addEventListener('mouseleave', () => {
                avatar.style.transform = 'scale(1)';
            });
        }
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
                const delay = (index * 50) + 100;
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, delay);
            }
        });
    }, observerOptions);

    // Observe follow-up cards
    cards.forEach(card => {
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease, box-shadow 0.3s ease';
        observer.observe(card);
    });
    
    // Tip cards hover effect
    const tipCards = document.querySelectorAll('.tip-card');
    tipCards.forEach(tip => {
        tip.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        tip.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush