@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card-header">
        <h1 class="card-title">Dashboard Overview</h1>
        <div class="header-actions">
            <span class="last-updated">
                Last updated: {{ now()->format('M d, Y H:i') }}
            </span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
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

    <!-- Most Active Clients & Weekly Follow-ups Side by Side -->
    <div class="dashboard-row">
        <!-- Most Active Clients -->
        <div class="card half-width">
            <div class="card-header">
                <h2 class="card-title">Most Active Clients</h2>
                <div class="card-subtitle">
                    {{ $mostActiveClients->count() }} active
                </div>
            </div>
            
            @if($mostActiveClients->count() > 0)
                <div class="client-list">
                    @foreach($mostActiveClients as $client)
                        <div class="client-activity-item">
                            <div class="client-info">
                                <div class="client-avatar">
                                    {{ strtoupper(substr($client->name, 0, 1)) }}
                                </div>
                                <div class="client-details">
                                    <h3 class="client-name">{{ $client->name }}</h3>
                                    <div class="client-meta">
                                        <span>{{ $client->notes_count }} notes</span>
                                        <span class="separator">•</span>
                                        <span class="badge badge-{{ $client->status }}">
                                            {{ ucfirst($client->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="client-actions">
                                    @if($client->next_follow_up)
                                        <span class="followup-date-badge {{ $client->next_follow_up->isToday() ? 'today-badge' : 'upcoming-badge' }}">
                                            {{ $client->next_follow_up->format('M d') }}
                                        </span>
                                    @endif
                                    <a href="{{ route('clients.show', $client) }}" class="btn btn-outline btn-small">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8518 20.8581 15.3516 20 15.13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h3>No clients yet</h3>
                    <p>Start by adding your first client</p>
                    <a href="{{ route('clients.create') }}" class="btn btn-primary btn-small">
                        Add Client
                    </a>
                </div>
            @endif
        </div>

        <!-- Weekly Follow-up Distribution -->
        <div class="card half-width">
            <div class="card-header">
                <h2 class="card-title">Weekly Follow-up Distribution</h2>
                <div class="card-subtitle">
                    Next 7 days
                    <span class="scale-badge">
                        Scale max: {{ min(15, $maxWeekly) }}
                    </span>
                </div>
            </div>
            
            <div class="weekly-chart-container">
                <div class="chart-bars">
                    @php
                        $maxWeekly = $maxWeekly ?: 1;
                    @endphp
                    
                    @foreach($weeklyData as $index => $day)
                        @php 
                            $scaleMax = max(1, $maxWeekly);
                            $containerHeight = 220;
                            $heightPx = ($day['capped_count'] / $scaleMax) * $containerHeight;
                            
                            $barColor = $index % 2 === 0 ? 'var(--color-accent)' : 'var(--color-primary)';
                        @endphp
                        
                        <div class="chart-day">
                            <div class="day-label">{{ $day['day'] }}</div>
                            <div class="date-label">{{ $day['date'] }}</div>
                            
                            <!-- Bar with max indicator -->
                            <div class="bar-container">
                                <!-- Max indicator line -->
                                @if($day['is_capped'])
                                    <div class="max-indicator" title="Max limit reached">
                                        <div class="max-line"></div>
                                        <div class="max-label">15+</div>
                                    </div>
                                @endif
                                
                                <!-- Actual bar -->
                                <div class="bar"
                                style="height: {{ $heightPx }}px;
                                        background-color: {{ $barColor }};
                                        {{ $day['is_capped'] ? 'border-top: 3px dashed var(--color-text);' : '' }}">

                                    @if($day['count'] > 0)
                                        <div class="bar-value" data-original="{{ $day['count'] }}">
                                            {{ $day['count'] }}
                                            @if($day['is_capped'])
                                                <span class="capped-indicator">+</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="day-count">
                                {{ $day['count'] }} follow-up{{ $day['count'] != 1 ? 's' : '' }}
                                @if($day['is_capped'])
                                    <span class="capped-warning" title="Exceeds daily visualization limit">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 9V11M12 15H12.01M5.07183 19H18.9282C20.4678 19 21.4301 17.3333 20.6603 16L13.7321 4C12.9623 2.66667 11.0377 2.66667 10.2679 4L3.33975 16C2.56995 17.3333 3.53223 19 5.07183 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                
                @php
                    $totalWeekly = array_sum(array_column($weeklyData, 'count'));
                    $exceededDays = array_filter($weeklyData, function($day) {
                        return $day['is_capped'];
                    });
                @endphp
                
                <div class="chart-summary">
                    <div class="summary-item">
                        <span class="summary-label">Total this week:</span>
                        <span class="summary-value">{{ $totalWeekly }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">Today:</span>
                        <span class="summary-value accent">{{ $weeklyData[0]['count'] }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">Max day:</span>
                        <span class="summary-value {{ $weeklyData[0]['count'] > 15 ? 'max-exceeded' : 'max-normal' }}">
                            {{ max(array_column($weeklyData, 'count')) }}
                        </span>
                    </div>
                </div>
                
                @if(count($exceededDays) > 0)
                    <div class="capped-alert">
                        <div class="alert-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 8V12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 16H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="alert-text">
                            <strong>Note:</strong> Bars are capped at 15 for visualization. 
                            {{ count($exceededDays) }} day{{ count($exceededDays) > 1 ? 's' : '' }} exceed this limit.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bottom Row: Upcoming Follow-ups & Recent Activity -->
    <div class="dashboard-row">
        <!-- Upcoming Follow-ups -->
        <div class="card half-width">
            <h2 class="card-title">Upcoming Follow-ups</h2>
            @if($upcomingFollowUps->count() > 0)
                <div class="followup-list">
                    @foreach($upcomingFollowUps as $client)
                        <div class="followup-item">
                            <div class="followup-content">
                                <div class="followup-date {{ $client->next_follow_up->isToday() ? 'today' : '' }}">
                                    <div class="date-day">{{ $client->next_follow_up->format('d') }}</div>
                                    <div class="date-month">{{ $client->next_follow_up->format('M') }}</div>
                                </div>
                                <div class="followup-info">
                                    <h3 class="followup-client">{{ $client->name }}</h3>
                                    <div class="followup-meta">
                                        {{ $client->company ? $client->company . ' • ' : '' }}
                                        <span class="badge badge-{{ $client->status }}">
                                            {{ ucfirst($client->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="followup-action">
                                    <a href="{{ route('clients.show', $client) }}" 
                                       class="btn btn-accent btn-small {{ $client->next_follow_up->isToday() ? 'pulse' : '' }}">
                                        {{ $client->next_follow_up->isToday() ? 'Today!' : 'Follow up' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h3>No upcoming follow-ups</h3>
                    <p>Great! You're all caught up for now</p>
                    <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-small">
                        Schedule Follow-ups
                    </a>
                </div>
            @endif
        </div>

        <!-- Recent Activity -->
        <div class="card half-width">
            <h2 class="card-title">Recent Activity</h2>
            @if($recentNotes->count() > 0)
                <div class="activity-timeline">
                    @foreach($recentNotes as $note)
                        <div class="activity-item">
                            <div class="activity-icon {{ $note->type }}">
                                @if($note->type == 'call')
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 16.92V19.92C22 20.47 21.55 20.92 21 20.92C19.95 20.92 18.91 20.77 17.92 20.47C16.15 19.96 14.45 19.12 12.99 17.99C10.95 16.3 9.16 13.92 8 11.32C7.21 9.56 6.82 7.68 6.82 5.78C6.82 5.23 7.27 4.78 7.82 4.78H10.82C11.37 4.78 11.82 5.23 11.82 5.78C11.82 7.3 12.22 8.79 12.99 10.12C13.24 10.57 13.16 11.15 12.79 11.51L11 13.3C12.68 15.77 15.05 17.45 17.53 18.11L19.32 16.32C19.68 15.96 20.26 15.88 20.71 16.13C21.37 16.49 22 17.18 22 17.92Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @elseif($note->type == 'meeting')
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8518 20.8581 15.3516 20 15.13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @elseif($note->type == 'email')
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M22 6L12 13L2 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @else
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16 13H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16 17H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10 9H9H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="activity-content">
                                <div class="activity-header">
                                    <span class="activity-type">{{ ucfirst($note->type) }}</span>
                                    <span class="activity-time">{{ $note->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="activity-text">{{ Str::limit($note->content, 80) }}</p>
                                <div class="activity-client">
                                    <a href="{{ route('clients.show', $note->client) }}">
                                        {{ $note->client->name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 13H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 17H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10 9H9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h3>No recent activity</h3>
                    <p>Start adding notes to track your client interactions</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card full-width">
        <h2 class="card-title">Quick Actions</h2>
        <div class="quick-actions">
            <a href="{{ route('clients.create') }}" class="quick-action-btn primary-btn">
                <span class="action-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5V19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span class="action-label">Add New Client</span>
            </a>
            
            <a href="{{ route('clients.today-followups') }}" class="quick-action-btn accent-btn">
                <span class="action-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 10H3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 3V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 3V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 3V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span class="action-label">Today's Follow-ups</span>
                @if($stats['today_followups'] > 0)
                    <span class="action-badge">{{ $stats['today_followups'] }}</span>
                @endif
            </a>
            
            <a href="{{ route('clients.index') }}" class="quick-action-btn secondary-btn">
                <span class="action-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8518 20.8581 15.3516 20 15.13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span class="action-label">All Clients</span>
            </a>
        </div>
    </div>
@endsection

@push('styles')
<style>


    .card {
        background: var(--card);
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.04);
    }

    .stats-grid .stat-card {
        background: var(--stat-card);
    }
    /* Layout Styles */
    .dashboard-row {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .half-width {
        flex: 1;
        min-width: 300px;
    }
    
    .full-width {
        width: 100%;
    }
    
    /* Header Styles */
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .header-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .last-updated {
        font-size: 0.875rem;
        opacity: 0.7;
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        text-align: center;
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--color-primary);
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        font-size: 0.875rem;
        color: var(--color-text);
        opacity: 0.8;
    }
    
    /* Card Styles */
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--color-primary);
        margin-bottom: 0.5rem;
    }
    
    .card-subtitle {
        font-size: 0.875rem;
        opacity: 0.7;
    }
    
    /* Most Active Clients Styles */
    .client-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .client-activity-item {
        padding: 0.75rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }
    
    .client-activity-item:hover {
        border-color: var(--color-border);
        background-color: rgba(83, 40, 93, 0.05);
    }
    
    .client-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .client-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--color-primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        flex-shrink: 0;
    }
    
    .client-details {
        flex: 1;
        min-width: 0;
    }
    
    .client-name {
        font-weight: 500;
        font-size: 1rem;
        color: var(--color-text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 0.25rem;
    }
    
    .client-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        opacity: 0.7;
    }
    
    .separator {
        opacity: 0.5;
    }
    
    .client-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-shrink: 0;
    }
    
    .followup-date-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 9999px;
        font-weight: 500;
    }
    
    .today-badge {
        background-color: rgba(175, 75, 117, 0.2);
        color: var(--color-accent);
    }
    
    .upcoming-badge {
        background-color: rgba(83, 40, 93, 0.1);
        color: var(--color-primary);
    }
    
    /* Weekly Chart Styles */
    .weekly-chart-container {
        padding: 1rem 0;
    }
    
    .chart-bars {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        height: auto;
        min-height: 280px;
        padding: 0 0.5rem;
        border-bottom: none;
    }
    
    .chart-day {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0 0.25rem;
        position: relative;
    }
    
    .day-label {
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
        color: var(--color-text);
    }
    
    .date-label {
        font-size: 0.75rem;
        opacity: 0.7;
        margin-bottom: 0.5rem;
        color: var(--color-text);
    }
    
    .bar-container {
        width: 100%;
        height: auto;
        min-height: 220px;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        position: relative;
    }
    
    .bar {
        width: 80%;
        border-radius: 5px;
        transition: height 0.3s ease;
        position: relative;
        min-height: 2px;
        max-height: 220px;
    }
    
    .bar-value {
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
        background-color: var(--color-bg);
        color: var(--color-text);
        padding: 2px 6px;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid var(--color-border);
        white-space: nowrap;
        display: none;
    }
    
    .bar:hover .bar-value {
        display: block;
    }
    
    .day-count {
        margin-top: 0.5rem;
        font-size: 0.75rem;
        opacity: 0.8;
        text-align: center;
        min-height: 1.5rem;
        color: var(--color-text);
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .capped-warning svg {
        width: 16px;
        height: 16px;
        color: var(--color-accent);
    }
    
    /* Weekly Chart with Cap */
    .max-indicator {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100%;
        pointer-events: none;
    }
    
    .max-line {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background-color: var(--color-accent);
        opacity: 0.7;
    }
    
    .max-label {
        position: absolute;
        top: -20px;
        right: -10px;
        background-color: var(--color-accent);
        color: white;
        padding: 1px 4px;
        border-radius: 4px;
        font-size: 0.625rem;
        font-weight: 600;
    }
    
    .capped-indicator {
        font-size: 0.875em;
        font-weight: bold;
        margin-left: 1px;
    }
    
    
    .scale-badge {
        font-size: 0.75rem;
        background-color: rgba(175, 75, 117, 0.1);
        color: var(--color-accent);
        padding: 0.125rem 0.5rem;
        border-radius: 9999px;
        margin-left: 0.5rem;
    }
    
    /* Capped Alert */
    .capped-alert {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        background-color: rgba(175, 75, 117, 0.1);
        border: 1px solid var(--color-accent);
        border-radius: 0.5rem;
        font-size: 0.75rem;
        margin-top: 0.75rem;
    }
    
    .alert-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .alert-icon svg {
        width: 20px;
        height: 20px;
        color: var(--color-accent);
    }
    
    .alert-text {
        flex: 1;
        color: var(--color-text);
    }
    
    /* Chart Summary */
    .chart-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        padding-top: 1rem;
        border-top: none;
        margin-top: 1rem;
    }
    
    .summary-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .summary-label {
        font-size: 0.75rem;
        opacity: 0.7;
        margin-bottom: 0.25rem;
        color: var(--color-text);
    }
    
    .summary-value {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--color-primary);
    }
    
    .summary-value.accent {
        color: var(--color-accent);
    }
    
    .max-exceeded {
        color: var(--color-accent);
    }
    
    .max-normal {
        color: var(--color-secondary);
    }
    
    /* Upcoming Follow-ups Styles */
    .followup-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .followup-item {
        padding: 0.75rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
    }
    
    .followup-item:hover {
        background-color: rgba(83, 40, 93, 0.05);
    }
    
    .followup-content {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .followup-date {
        width: 48px;
        height: 48px;
        border-radius: 0.5rem;
        background-color: var(--color-primary);
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .followup-date.today {
        background-color: var(--color-accent);
        animation: pulse 2s infinite;
    }
    
    .date-day {
        font-size: 1rem;
        font-weight: 600;
    }
    
    .date-month {
        font-size: 0.75rem;
        opacity: 0.9;
    }
    
    .followup-info {
        flex: 1;
        min-width: 0;
    }
    
    .followup-client {
        font-weight: 500;
        font-size: 1rem;
        color: var(--color-text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 0.25rem;
    }
    
    .followup-meta {
        font-size: 0.875rem;
        opacity: 0.7;
        color: var(--color-text);
    }
    
    .followup-action {
        flex-shrink: 0;
    }
    
    /* Recent Activity Styles - UPDATED TIMELINE */
    .activity-timeline {
        position: relative;
    }
    
    .activity-item {
        display: flex;
        gap: 1rem;
        padding: 0.75rem 0;
        position: relative;
    }
    
    /* UPDATED: Timeline line starts BELOW the icon */
    .activity-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 20px; /* Center of the icon (20px = 40px/2) */
        top: 50px; /* CHANGED: Start BELOW the 40px icon + padding */
        bottom: -10px; /* Extend to next item */
        width: 1px;
        background-color: var(--color-border);
        z-index: 1;
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 0.5rem;
        background-color: var(--color-secondary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
        z-index: 2; /* Ensure icon appears above the line */
    }
    
    .activity-icon.call { background-color: var(--color-accent); }
    .activity-icon.meeting { background-color: var(--color-primary); }
    .activity-icon.email { background-color: var(--color-secondary); }
    
    .activity-icon svg {
        width: 20px;
        height: 20px;
    }
    
    .activity-content {
        flex: 1;
        min-width: 0;
        position: relative;
        z-index: 2; /* Ensure content appears above the line */
    }
    
    .activity-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.25rem;
    }
    
    .activity-type {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--color-primary);
    }
    
    .activity-time {
        font-size: 0.75rem;
        opacity: 0.7;
        color: var(--color-text);
    }
    
    .activity-text {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
        line-height: 1.4;
        color: var(--color-text);
    }
    
    .activity-client {
        font-size: 0.75rem;
        opacity: 0.8;
    }
    
    .activity-client a {
        color: var(--color-primary);
        text-decoration: none;
    }
    
    .activity-client a:hover {
        text-decoration: underline;
    }
    
    /* Empty State Styles */
    .empty-state {
        text-align: center;
        padding: 2rem 0;
    }
    
    .empty-state svg {
        margin-bottom: 0.75rem;
        opacity: 0.5;
    }
    
    .empty-state h3 {
        font-weight: 500;
        margin-bottom: 0.25rem;
        color: var(--color-text);
    }
    
    .empty-state p {
        font-size: 0.875rem;
        opacity: 0.7;
        margin-bottom: 1rem;
        color: var(--color-text);
    }
    


    /* Quick Actions */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }
    
    .quick-action-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        border-radius: 0.75rem;
        background-color: var(--color-bg);
        border: 2px solid var(--color-border);
        color: var(--color-text);
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
    }
    
    .quick-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .primary-btn {
        border-color: var(--color-primary);
        background-color: rgba(83, 40, 93, 0.1);
    }
    
    .accent-btn {
        border-color: var(--color-accent);
        background-color: rgba(175, 75, 117, 0.1);
    }
    
    .secondary-btn {
        border-color: var(--color-secondary);
        background-color: rgba(205, 137, 181, 0.1);
    }
    
    .action-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: var(--color-border);
    }
    
    .primary-btn .action-icon {
        background-color: var(--color-primary);
        color: white;
    }
    
    .accent-btn .action-icon {
        background-color: var(--color-accent);
        color: white;
    }
    
    .secondary-btn .action-icon {
        background-color: var(--color-secondary);
        color: white;
    }
    
    .action-icon svg {
        width: 20px;
        height: 20px;
    }
    
    .action-label {
        font-weight: 500;
        flex: 1;
    }
    
    .action-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: var(--color-accent);
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    /* Button Styles */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.2s ease;
        font-size: 0.875rem;
    }
    
    .btn-small {
        padding: 0.375rem 0.75rem;
        font-size: 0.75rem;
    }
    
    .btn-primary {
        background-color: var(--color-primary);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: var(--color-accent);
    }
    
    .btn-secondary {
        background-color: var(--color-secondary);
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: var(--color-accent);
    }
    
    .btn-accent {
        background-color: var(--color-accent);
        color: white;
    }
    
    .btn-accent:hover {
        background-color: var(--color-primary);
    }
    
    .btn-outline {
        background-color: transparent;
        border-color: var(--color-primary);
        color: var(--color-primary);
    }
    
    .btn-outline:hover {
        background-color: var(--color-primary);
        color: white;
    }
    
    /* Badge Styles */
    .badge {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-active {
        background-color: rgba(83, 40, 93, 0.2);
        color: var(--color-primary);
    }
    
    .badge-inactive {
        background-color: rgba(175, 75, 117, 0.2);
        color: var(--color-accent);
    }
    
    .badge-lead {
        background-color: rgba(205, 137, 181, 0.2);
        color: var(--color-secondary);
    }
    
    /* Animations */
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(175, 75, 117, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(175, 75, 117, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(175, 75, 117, 0);
        }
    }
    
    .pulse {
        animation: pulse 2s infinite;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .dashboard-row {
            flex-direction: column;
        }
        
        .half-width {
            width: 100%;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        
        .bar-container {
            height: 150px;
        }
        
        .day-label {
            font-size: 0.75rem;
        }
        
        .date-label {
            font-size: 0.625rem;
        }

        .day-count {
            font-size: 0.625rem;
        }
        
        .summary-value {
            font-size: 1.25rem;
        }
        
        .quick-actions {
            grid-template-columns: 1fr;
        }
        
        /* Adjust timeline for mobile */
        .activity-item:not(:last-child)::after {
            top: 45px; /* Adjust for mobile */
        }
    }
    
    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .chart-bars {
            height: 180px;
        }
        
        .bar-container {
            height: 100px;
        }
        
        .bar-value {
            font-size: 0.625rem;
            padding: 1px 4px;
        }
        
        .scale-labels {
            font-size: 0.5rem;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .header-actions {
            width: 100%;
            justify-content: space-between;
        }
        
        /* Adjust timeline for smaller screens */
        .activity-item:not(:last-child)::after {
            top: 40px; /* Adjust for very small screens */
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Show bar values on hover
        const bars = document.querySelectorAll('.bar');
        bars.forEach(bar => {
            bar.addEventListener('mouseenter', () => {
                const barValue = bar.querySelector('.bar-value');
                if (barValue) {
                    barValue.style.display = 'block';
                }
            });
            
            bar.addEventListener('mouseleave', () => {
                const barValue = bar.querySelector('.bar-value');
                if (barValue) {
                    barValue.style.display = 'none';
                }
            });
        });
        
        // Add tooltips for capped warning icons
        const warnings = document.querySelectorAll('.capped-warning');
        warnings.forEach(warning => {
            warning.addEventListener('mouseenter', (e) => {
                const parent = e.target.closest('.chart-day');
                const dayLabel = parent.querySelector('.day-label').textContent;
                const dateLabel = parent.querySelector('.date-label').textContent;
                const count = parent.querySelector('.bar-value').dataset.original;
                
                // Create tooltip
                const tooltip = document.createElement('div');
                tooltip.className = 'capped-tooltip';
                tooltip.innerHTML = `
                    <strong>${dayLabel}, ${dateLabel}</strong><br>
                    ${count} follow-ups exceed the visualization limit of 15.
                `;
                tooltip.style.position = 'absolute';
                tooltip.style.background = 'var(--color-text)';
                tooltip.style.color = 'var(--color-bg)';
                tooltip.style.padding = '8px';
                tooltip.style.borderRadius = '4px';
                tooltip.style.fontSize = '0.75rem';
                tooltip.style.zIndex = '1000';
                tooltip.style.maxWidth = '200px';
                tooltip.style.boxShadow = '0 2px 8px rgba(0,0,0,0.2)';
                
                document.body.appendChild(tooltip);
                
                // Position tooltip
                const rect = warning.getBoundingClientRect();
                tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
                tooltip.style.left = (rect.left + rect.width/2 - tooltip.offsetWidth/2) + 'px';
                
                warning.tooltip = tooltip;
            });
            
            warning.addEventListener('mouseleave', (e) => {
                if (warning.tooltip) {
                    warning.tooltip.remove();
                    warning.tooltip = null;
                }
            });
        });
        
        // Today's follow-up button pulse effect
        const todayButtons = document.querySelectorAll('.btn.pulse');
        todayButtons.forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                btn.style.animationPlayState = 'paused';
            });
            
            btn.addEventListener('mouseleave', () => {
                btn.style.animationPlayState = 'running';
            });
        });
    });
</script>
@endpush
