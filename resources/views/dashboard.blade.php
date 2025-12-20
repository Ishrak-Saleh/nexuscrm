@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card-header">
        <h1 class="card-title">Dashboard Overview</h1>
        <div class="header-actions">
            <!-- Add Report Download Dropdown -->
            <div class="report-download-dropdown">
                <button class="btn btn-secondary btn-small report-download-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 10L12 15L17 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 15V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Download Report
                </button>
                <div class="report-dropdown-menu">
                    <a href="{{ route('dashboard.report.download', ['type' => 'overview']) }}" class="report-option">
                        <div class="report-option-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 17H7V10H9V17ZM13 17H11V7H13V17ZM17 17H15V13H17V17ZM19 21H5V3H19V21.1V21Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="report-option-content">
                            <div class="report-option-title">Overview Report</div>
                            <div class="report-option-desc">Key stats and recent activity</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('dashboard.report.download', ['type' => 'detailed']) }}" class="report-option">
                        <div class="report-option-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM9 17H7V10H9V17ZM13 17H11V7H13V17ZM17 17H15V13H17V17Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="report-option-content">
                            <div class="report-option-title">Detailed Report</div>
                            <div class="report-option-desc">Complete client and activity data</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('dashboard.report.download', ['type' => 'followups']) }}" class="report-option">
                        <div class="report-option-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="report-option-content">
                            <div class="report-option-title">Follow-ups Report</div>
                            <div class="report-option-desc">Pending and upcoming follow-ups</div>
                        </div>
                    </a>
                </div>
            </div>
            
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
                            
                            $barColor = $index % 2 === 0 ? '#af4b75' : '#52285d';
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
                                        {{ $day['is_capped'] ? 'border-top: 3px dashed #160b19;' : '' }}">

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
    :root {
            --text: #160b19;
            --background: #f6f1f9;
            --primary: #53285d;
            --secondary: #cd89b5;
            --accent: #af4b75;
            --card: #eee9f1;
            --stat-card: #e9d1e4;
            --button: #743652;
            --button-hover: #b4507a;
    }

    [data-theme="dark"] {
            --text: #f1e6f4;
            --background: #0b060e;
            --primary: #cda2d7;
            --secondary: #76325e;
            --accent: #b4507a;
            --card: #130e16;
            --stat-card: #2b1326;
            --button: #743652;
            --button-hover: #b4507a;
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
        color: var(--color-text);
        opacity: 0.7;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .card.stat-card {
        background: var(--stat-card);
        border: 1px solid var(--stat-card);
        border-radius: 1rem;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
        border-color: var(--stat-card);
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
    .card {
        background: var(--card);
        border: 1px solid var(--card);
        border-radius: 1rem;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--color-primary);
        margin-bottom: 0.5rem;
    }

    .card-subtitle {
        font-size: 0.875rem;
        color: var(--color-text);
        opacity: 0.7;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

/* Report Download Styles */
.report-download-dropdown {
    position: relative;
    display: inline-block;
}

.report-download-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: var(--button);
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.report-download-btn:hover {
    background: var(--button-hover);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.report-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background-color: var(--color-bg);
    border: 1px solid var(--color-secondary);
    border-radius: 0.5rem;
    padding: 0.5rem;
    min-width: 300px;
    margin-top: 0.5rem;
    display: none;
    z-index: 1000;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease;
}

.report-dropdown-menu.show {
    display: block;
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Animation for dropdown */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

    .report-download-dropdown:hover .report-dropdown-menu {
        display: block;
    }

    .report-option {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
        color: var(--color-text);
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }

    .report-option:hover {
        background-color: rgba(82, 40, 93, 0.05);
        border-color: var(--color-secondary);
        transform: translateX(2px);
    }

    .report-option-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 0.5rem;
        background-color: rgba(82, 40, 93, 0.1);
        color: var(--color-primary);
        flex-shrink: 0;
    }

    .report-option-icon svg {
        width: 20px;
        height: 20px;
    }

    .report-option-content {
        flex: 1;
    }

    .report-option-title {
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--color-primary);
        margin-bottom: 0.25rem;
    }

    .report-option-desc {
        font-size: 0.75rem;
        color: var(--color-text);
        opacity: 0.7;
        line-height: 1.4;
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
        border-color: var(--color-secondary);
        background-color: rgba(82, 40, 93, 0.05);
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
        color: var(--color-bg);
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
        color: var(--color-text);
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
        background-color: rgba(82, 40, 93, 0.1);
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
        color: var(--color-text);
        opacity: 0.7;
        margin-bottom: 0.5rem;
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
        border: 1px solid var(--color-secondary);
        white-space: nowrap;
        display: none;
    }

    .day-count {
        margin-top: 0.5rem;
        font-size: 0.75rem;
        color: var(--color-text);
        opacity: 0.8;
        text-align: center;
        min-height: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
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
        color: var(--color-bg);
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
        margin-top: 1rem;
    }

    .summary-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .summary-label {
        font-size: 0.75rem;
        color: var(--color-text);
        opacity: 0.7;
        margin-bottom: 0.25rem;
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
        background-color: rgba(82, 40, 93, 0.05);
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
        color: var(--color-bg);
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
        color: var(--color-text);
        opacity: 0.7;
    }

    .followup-action {
        flex-shrink: 0;
    }

    /* Recent Activity Styles */
    .activity-timeline {
        position: relative;
    }

    .activity-item {
        display: flex;
        gap: 1rem;
        padding: 0.75rem 0;
        position: relative;
    }

    .activity-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 20px;
        top: 50px;
        bottom: -10px;
        width: 1px;
        background-color: var(--color-secondary);
        z-index: 1;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 0.5rem;
        background-color: var(--color-secondary);
        color: var(--color-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
        z-index: 2;
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
        z-index: 2;
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
        color: var(--color-text);
        opacity: 0.7;
    }

    .activity-text {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
        line-height: 1.4;
        color: var(--color-text);
    }

    .activity-client {
        font-size: 0.75rem;
        color: var(--color-text);
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
        color: var(--color-text);
    }

    .empty-state h3 {
        font-weight: 500;
        margin-bottom: 0.25rem;
        color: var(--color-text);
    }

    .empty-state p {
        font-size: 0.875rem;
        color: var(--color-text);
        opacity: 0.7;
        margin-bottom: 1rem;
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
        border: 0.75px solid var(--color-secondary);
        color: var(--color-text);
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
        cursor: pointer;
    }

    .quick-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .primary-btn {
        border-color: var(--color-primary);
        background-color: rgba(82, 40, 93, 0.1);
    }

    .accent-btn {
        border-color: var(--color-accent);
        background-color: rgba(175, 75, 117, 0.1);
    }

    .secondary-btn {
        border-color: var(--color-secondary);
        background-color: rgba(205, 137, 181, 0.1);
    }

    .report-quick-btn {
        border-color: var(--color-primary);
        background-color: rgba(82, 40, 93, 0.15);
    }

    .report-quick-btn:hover {
        background-color: rgba(82, 40, 93, 0.25);
    }

    .action-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: var(--color-secondary);
    }

    .primary-btn .action-icon {
        background-color: var(--color-primary);
        color: var(--color-bg);
    }

    .accent-btn .action-icon {
        background-color: var(--color-accent);
        color: var(--color-bg);
    }

    .secondary-btn .action-icon {
        background-color: var(--color-secondary);
        color: var(--color-bg);
    }

    .report-quick-btn .action-icon {
        background-color: var(--color-primary);
        color: var(--color-bg);
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
        color: var(--color-bg);
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .report-new-badge {
        background-color: var(--color-primary);
        color: var(--color-bg);
        padding: 0.125rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.625rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
        color: var(--color-bg);
    }

    .btn-primary:hover {
        background-color: var(--color-accent);
    }

    .btn-secondary {
        background-color: var(--color-secondary);
        color: var(--color-bg);
    }

    .btn-secondary:hover {
        background-color: var(--color-accent);
    }

    .btn-accent {
        background-color: var(--color-accent);
        color: var(--color-bg);
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
        color: var(--color-bg);
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
        background-color: rgba(82, 40, 93, 0.2);
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

    /* Report loading indicator */
    .report-loading {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .report-loading-content {
        background-color: var(--color-bg);
        padding: 2rem;
        border-radius: 1rem;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .report-loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid var(--color-secondary);
        border-top-color: var(--color-accent);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 1rem;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .report-loading-text {
        font-size: 0.875rem;
        color: var(--color-text);
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
        
        .activity-item:not(:last-child)::after {
            top: 45px;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .header-actions {
            width: 100%;
            justify-content: space-between;
        }
        
        .report-dropdown-menu {
            min-width: 250px;
            right: 0;
            left: auto;
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
        
        .activity-item:not(:last-child)::after {
            top: 40px;
        }
        
        .header-actions {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .report-download-dropdown {
            width: 100%;
        }
        
        .report-download-btn {
            width: 100%;
            justify-content: center;
        }
        
        .report-dropdown-menu {
            width: 100%;
            min-width: auto;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // ============================================
    // 1. REPORT DROPDOWN HOVER FIX
    // ============================================
    const reportDropdown = document.querySelector('.report-download-dropdown');
    const reportButton = document.querySelector('.report-download-btn');
    const reportMenu = document.querySelector('.report-dropdown-menu');
    
    if (reportDropdown && reportButton && reportMenu) {
        let hideTimeout;
        let showTimeout;
        const hideDelay = 300; // ms before hiding
        const showDelay = 100; // ms before showing
        
        // Show dropdown with delay
        reportButton.addEventListener('mouseenter', () => {
            clearTimeout(hideTimeout);
            showTimeout = setTimeout(() => {
                reportMenu.style.display = 'block';
                setTimeout(() => {
                    reportMenu.style.opacity = '1';
                    reportMenu.style.visibility = 'visible';
                    reportMenu.style.transform = 'translateY(0)';
                }, 10);
            }, showDelay);
        });
        
        // Hide dropdown with delay
        reportButton.addEventListener('mouseleave', (e) => {
            clearTimeout(showTimeout);
            
            // Check if mouse is moving to dropdown
            const relatedTarget = e.relatedTarget;
            if (relatedTarget && !reportMenu.contains(relatedTarget)) {
                hideTimeout = setTimeout(() => {
                    reportMenu.style.opacity = '0';
                    reportMenu.style.visibility = 'hidden';
                    reportMenu.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        reportMenu.style.display = 'none';
                    }, 300);
                }, hideDelay);
            }
        });
        
        // Keep dropdown open when hovering over it
        reportMenu.addEventListener('mouseenter', () => {
            clearTimeout(hideTimeout);
            clearTimeout(showTimeout);
        });
        
        // Hide dropdown when leaving it
        reportMenu.addEventListener('mouseleave', (e) => {
            // Check if mouse is moving to button
            const relatedTarget = e.relatedTarget;
            if (relatedTarget && !reportButton.contains(relatedTarget)) {
                hideTimeout = setTimeout(() => {
                    reportMenu.style.opacity = '0';
                    reportMenu.style.visibility = 'hidden';
                    reportMenu.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        reportMenu.style.display = 'none';
                    }, 300);
                }, hideDelay);
            }
        });
        
        // Toggle dropdown on click (for mobile/touch)
        reportButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            if (reportMenu.style.display === 'block') {
                reportMenu.style.opacity = '0';
                reportMenu.style.visibility = 'hidden';
                reportMenu.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    reportMenu.style.display = 'none';
                }, 300);
            } else {
                clearTimeout(hideTimeout);
                clearTimeout(showTimeout);
                reportMenu.style.display = 'block';
                setTimeout(() => {
                    reportMenu.style.opacity = '1';
                    reportMenu.style.visibility = 'visible';
                    reportMenu.style.transform = 'translateY(0)';
                }, 10);
            }
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!reportDropdown.contains(e.target)) {
                reportMenu.style.opacity = '0';
                reportMenu.style.visibility = 'hidden';
                reportMenu.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    reportMenu.style.display = 'none';
                }, 300);
            }
        });
    }
    
        // ============================================
    // 2. REPORT DOWNLOAD FUNCTIONALITY - MINIMAL FIX
    // ============================================
    const reportLinks = document.querySelectorAll('.report-option');
    const loadingOverlay = document.createElement('div');
    loadingOverlay.className = 'report-loading';
    loadingOverlay.innerHTML = `
        <div class="report-loading-content">
            <div class="report-loading-spinner"></div>
            <div class="report-loading-text">Generating report, please wait...</div>
        </div>
    `;
    document.body.appendChild(loadingOverlay);
    
    reportLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const url = link.getAttribute('href');
            
            // Show loading overlay
            loadingOverlay.style.display = 'flex';
            
            // Create hidden link for download
            const downloadLink = document.createElement('a');
            downloadLink.style.display = 'none';
            downloadLink.href = url;
            downloadLink.click();
            
            // ALWAYS hide loading after 2 seconds (guaranteed cleanup)
            setTimeout(() => {
                loadingOverlay.style.display = 'none';
                
                // Clean up
                if (downloadLink.parentNode) {
                    document.body.removeChild(downloadLink);
                }
            }, 2000);
        });
    });
    
    // ============================================
    // 3. QUICK ACTION REPORT BUTTON
    // ============================================
    const reportQuickBtn = document.querySelector('.report-quick-btn');
    if (reportQuickBtn) {
        reportQuickBtn.addEventListener('click', () => {
            if (reportButton) {
                reportButton.click();
            }
        });
    }
    
    // ============================================
    // 4. CAPPED WARNING TOOLTIPS
    // ============================================
    const warnings = document.querySelectorAll('.capped-warning');
    warnings.forEach(warning => {
        let tooltip = null;
        
        warning.addEventListener('mouseenter', (e) => {
            const parent = e.target.closest('.chart-day');
            const dayLabel = parent.querySelector('.day-label').textContent;
            const dateLabel = parent.querySelector('.date-label').textContent;
            const count = parent.querySelector('.bar-value')?.dataset.original || '0';
            
            // Remove existing tooltip if any
            if (tooltip) {
                tooltip.remove();
            }
            
            // Create tooltip
            tooltip = document.createElement('div');
            tooltip.className = 'capped-tooltip';
            tooltip.innerHTML = `
                <strong>${dayLabel}, ${dateLabel}</strong><br>
                ${count} follow-ups exceed the visualization limit of 15.
            `;
            
            // Style tooltip
            Object.assign(tooltip.style, {
                position: 'fixed',
                background: 'var(--color-text)',
                color: 'var(--color-bg)',
                padding: '8px 12px',
                borderRadius: '6px',
                fontSize: '0.75rem',
                zIndex: '9999',
                maxWidth: '200px',
                boxShadow: '0 4px 12px rgba(0,0,0,0.15)',
                pointerEvents: 'none',
                transition: 'opacity 0.2s ease'
            });
            
            document.body.appendChild(tooltip);
            
            // Position tooltip
            const rect = warning.getBoundingClientRect();
            const tooltipWidth = tooltip.offsetWidth;
            const tooltipHeight = tooltip.offsetHeight;
            
            let top = rect.top - tooltipHeight - 8;
            let left = rect.left + rect.width / 2 - tooltipWidth / 2;
            
            // Adjust if tooltip goes off screen
            if (left < 10) left = 10;
            if (left + tooltipWidth > window.innerWidth - 10) {
                left = window.innerWidth - tooltipWidth - 10;
            }
            if (top < 10) {
                top = rect.bottom + 8;
            }
            
            tooltip.style.top = `${top}px`;
            tooltip.style.left = `${left}px`;
        });
        
        warning.addEventListener('mouseleave', () => {
            if (tooltip) {
                tooltip.style.opacity = '0';
                setTimeout(() => {
                    if (tooltip && tooltip.parentNode) {
                        tooltip.remove();
                    }
                    tooltip = null;
                }, 200);
            }
        });
    });
    
    // ============================================
    // 5. TODAY'S FOLLOW-UP BUTTON PULSE EFFECT
    // ============================================
    const todayButtons = document.querySelectorAll('.btn.pulse');
    todayButtons.forEach(btn => {
        btn.addEventListener('mouseenter', () => {
            btn.style.animationPlayState = 'paused';
        });
        
        btn.addEventListener('mouseleave', () => {
            btn.style.animationPlayState = 'running';
        });
    });
    
    // ============================================
    // 6. BAR VALUE DISPLAY ON HOVER
    // ============================================
    const bars = document.querySelectorAll('.bar');
    bars.forEach(bar => {
        bar.addEventListener('mouseenter', () => {
            const value = bar.querySelector('.bar-value');
            if (value) {
                value.style.display = 'block';
                value.style.opacity = '1';
            }
        });
        
        bar.addEventListener('mouseleave', () => {
            const value = bar.querySelector('.bar-value');
            if (value) {
                value.style.opacity = '0';
                setTimeout(() => {
                    value.style.display = 'none';
                }, 200);
            }
        });
    });
    
    // ============================================
    // 7. CHART DAY HOVER EFFECTS
    // ============================================
    const chartDays = document.querySelectorAll('.chart-day');
    chartDays.forEach(day => {
        day.addEventListener('mouseenter', () => {
            const bar = day.querySelector('.bar');
            if (bar) {
                bar.style.filter = 'brightness(1.1)';
                bar.style.transform = 'scale(1.05)';
            }
            
            // Show bar value
            const barValue = day.querySelector('.bar-value');
            if (barValue) {
                barValue.style.display = 'block';
                barValue.style.opacity = '1';
            }
        });
        
        day.addEventListener('mouseleave', () => {
            const bar = day.querySelector('.bar');
            if (bar) {
                bar.style.filter = 'brightness(1)';
                bar.style.transform = 'scale(1)';
            }
            
            // Hide bar value
            const barValue = day.querySelector('.bar-value');
            if (barValue) {
                barValue.style.opacity = '0';
                setTimeout(() => {
                    barValue.style.display = 'none';
                }, 200);
            }
        });
    });
    
    // ============================================
    // 8. CLIENT ACTIVITY ITEM HOVER EFFECTS
    // ============================================
    const clientItems = document.querySelectorAll('.client-activity-item');
    clientItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            const avatar = item.querySelector('.client-avatar');
            if (avatar) {
                avatar.style.transform = 'scale(1.1)';
                avatar.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
            }
        });
        
        item.addEventListener('mouseleave', () => {
            const avatar = item.querySelector('.client-avatar');
            if (avatar) {
                avatar.style.transform = 'scale(1)';
                avatar.style.boxShadow = 'none';
            }
        });
    });
    
    // ============================================
    // 9. QUICK ACTION BUTTON HOVER EFFECTS
    // ============================================
    const quickActionBtns = document.querySelectorAll('.quick-action-btn');
    quickActionBtns.forEach(btn => {
        btn.addEventListener('mouseenter', () => {
            const icon = btn.querySelector('.action-icon');
            if (icon) {
                icon.style.transform = 'rotate(5deg) scale(1.1)';
            }
        });
        
        btn.addEventListener('mouseleave', () => {
            const icon = btn.querySelector('.action-icon');
            if (icon) {
                icon.style.transform = 'rotate(0) scale(1)';
            }
        });
    });
    
    // ============================================
    // 10. RESPONSIVE ADJUSTMENTS
    // ============================================
    function handleResponsive() {
        const isMobile = window.innerWidth <= 768;
        
        // Adjust dropdown position on mobile
        if (reportMenu && isMobile) {
            reportMenu.style.position = 'fixed';
            reportMenu.style.top = 'auto';
            reportMenu.style.bottom = '0';
            reportMenu.style.left = '0';
            reportMenu.style.right = '0';
            reportMenu.style.width = '100%';
            reportMenu.style.maxWidth = '100%';
            reportMenu.style.borderRadius = '1rem 1rem 0 0';
            reportMenu.style.marginTop = '0';
            reportMenu.style.transform = 'translateY(100%)';
            
            // Update show class for mobile
            if (reportMenu.classList.contains('show')) {
                reportMenu.style.transform = 'translateY(0)';
            }
        } else if (reportMenu) {
            // Reset for desktop
            reportMenu.style.position = 'absolute';
            reportMenu.style.top = '100%';
            reportMenu.style.bottom = 'auto';
            reportMenu.style.left = 'auto';
            reportMenu.style.right = '0';
            reportMenu.style.width = 'auto';
            reportMenu.style.maxWidth = '300px';
            reportMenu.style.borderRadius = '0.5rem';
            reportMenu.style.marginTop = '0.5rem';
            reportMenu.style.transform = reportMenu.style.display === 'block' ? 'translateY(0)' : 'translateY(-10px)';
        }
    }
    
    // Initial responsive check
    handleResponsive();
    
    // Update on window resize
    window.addEventListener('resize', handleResponsive);
    
    // ============================================
    // 11. ESCAPE KEY TO CLOSE DROPDOWN
    // ============================================
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && reportMenu && reportMenu.style.display === 'block') {
            reportMenu.style.opacity = '0';
            reportMenu.style.visibility = 'hidden';
            reportMenu.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                reportMenu.style.display = 'none';
            }, 300);
        }
    });
    
    // ============================================
    // 12. TOUCH DEVICE SUPPORT
    // ============================================
    const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    
    if (isTouchDevice) {
        // Add touch-specific styles
        const style = document.createElement('style');
        style.textContent = `
            @media (hover: none) and (pointer: coarse) {
                .report-download-btn::after {
                    content: ' ▼';
                    font-size: 0.75em;
                    opacity: 0.7;
                }
                
                .quick-action-btn {
                    min-height: 60px;
                }
                
                .bar-value {
                    display: block !important;
                    opacity: 1 !important;
                    font-size: 0.7rem;
                }
            }
        `;
        document.head.appendChild(style);
        
        // Prevent double-tap zoom on buttons
        document.querySelectorAll('button, .btn, a').forEach(element => {
            element.style.touchAction = 'manipulation';
        });
    }
});
</script>
@endpush