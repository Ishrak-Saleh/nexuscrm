<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $report_type }} - NexusCRM</title>
    <style>
        @page {
            margin: 50px;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            color: #160b19;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #52285d;
            padding-bottom: 20px;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #52285d;
            margin-bottom: 10px;
        }
        
        .report-title {
            font-size: 22px;
            color: #160b19;
            margin-bottom: 5px;
        }
        
        .report-meta {
            font-size: 12px;
            color: #666;
            margin-bottom: 20px;
        }
        
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        
        .section-title {
            font-size: 18px;
            color: #52285d;
            border-bottom: 2px solid #cd89b5;
            padding-bottom: 8px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        
        .summary-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .summary-card {
            border: 1px solid #e5d8eb;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background-color: #f6f1f9;
        }
        
        .summary-number {
            font-size: 24px;
            font-weight: bold;
            color: #52285d;
            margin-bottom: 5px;
        }
        
        .summary-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        
        .table th {
            background-color: #52285d;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #3a1d44;
        }
        
        .table td {
            padding: 8px 10px;
            border: 1px solid #e5d8eb;
        }
        
        .table tr:nth-child(even) {
            background-color: #f9f7fb;
        }
        
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .badge-active {
            background-color: rgba(82, 40, 93, 0.1);
            color: #52285d;
            border: 1px solid #52285d;
        }
        
        .badge-inactive {
            background-color: rgba(175, 75, 117, 0.1);
            color: #af4b75;
            border: 1px solid #af4b75;
        }
        
        .badge-lead {
            background-color: rgba(205, 137, 181, 0.1);
            color: #cd89b5;
            border: 1px solid #cd89b5;
        }
        
        .priority-high {
            background-color: rgba(175, 75, 117, 0.2);
            color: #af4b75;
            font-weight: bold;
        }
        
        .priority-medium {
            background-color: rgba(205, 137, 181, 0.2);
            color: #cd89b5;
        }
        
        .priority-low {
            background-color: rgba(82, 40, 93, 0.2);
            color: #52285d;
        }
        
        .monthly-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .month-card {
            border: 1px solid #e5d8eb;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background-color: #f6f1f9;
        }
        
        .month-card.current {
            background-color: rgba(175, 75, 117, 0.1);
            border-color: #af4b75;
        }
        
        .month-name {
            font-size: 14px;
            font-weight: bold;
            color: #52285d;
            margin-bottom: 10px;
        }
        
        .month-count {
            font-size: 24px;
            font-weight: bold;
            color: #160b19;
        }
        
        .empty-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
            background-color: #f6f1f9;
            border-radius: 8px;
            border: 1px dashed #cd89b5;
        }
        
        .action-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border: 1px solid #e5d8eb;
            border-radius: 6px;
            margin-bottom: 10px;
            background-color: #f6f1f9;
        }
        
        .action-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            flex-shrink: 0;
        }
        
        .icon-call { background-color: #af4b75; }
        .icon-email { background-color: #52285d; }
        .-icon-meeting { background-color: #cd89b5; }
        
        .action-content {
            flex: 1;
        }
        
        .action-title {
            font-weight: bold;
            color: #160b19;
            margin-bottom: 3px;
        }
        
        .action-meta {
            font-size: 11px;
            color: #666;
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5d8eb;
            font-size: 11px;
            color: #666;
        }
        
        .watermark {
            position: fixed;
            bottom: 20px;
            right: 20px;
            opacity: 0.1;
            font-size: 48px;
            color: #52285d;
            transform: rotate(-45deg);
            z-index: -1;
        }
        
        /* Print-specific styles */
        @media print {
            .page-break {
                page-break-before: always;
            }
            
            body {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <!-- Watermark -->
    <div class="watermark">NexusCRM</div>
    
    <!-- Header -->
    <div class="header">
        <div class="logo">NexusCRM</div>
        <h1 class="report-title">{{ $report_type }}</h1>
        <div class="report-meta">
            Generated for: {{ $user->name }} | 
            Date: {{ $generated_at }}
        </div>
    </div>
    
    <!-- Summary Statistics -->
    <div class="section">
        <h2 class="section-title">Follow-up Summary</h2>
        <div class="summary-stats">
            <div class="summary-card">
                <div class="summary-number">{{ $total_today }}</div>
                <div class="summary-label">Today's Follow-ups</div>
            </div>
            <div class="summary-card">
                <div class="summary-number">{{ $total_upcoming }}</div>
                <div class="summary-label">Upcoming (7 days)</div>
            </div>
            <div class="summary-card">
                <div class="summary-number">{{ $total_overdue }}</div>
                <div class="summary-label">Overdue</div>
            </div>
            <div class="summary-card">
                <div class="summary-number">{{ $total_today + $total_upcoming + $total_overdue }}</div>
                <div class="summary-label">Total Pending</div>
            </div>
        </div>
    </div>
    
    <!-- Monthly Summary -->
    <div class="section">
        <h2 class="section-title">Monthly Follow-up Summary</h2>
        <div class="monthly-summary">
            @foreach($monthlySummary as $month)
            <div class="month-card {{ $month['is_current'] ? 'current' : '' }}">
                <div class="month-name">{{ $month['month'] }}</div>
                <div class="month-count">{{ $month['count'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- Today's Follow-ups -->
    <div class="section">
        <h2 class="section-title">Today's Follow-ups ({{ $total_today }})</h2>
        @if($todayFollowUps->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Company</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Priority</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($todayFollowUps as $client)
                    <tr>
                        <td><strong>{{ $client->name }}</strong></td>
                        <td>{{ $client->company ?? 'N/A' }}</td>
                        <td>
                            {{ $client->email ?? '' }}<br>
                            {{ $client->phone ?? '' }}
                        </td>
                        <td>
                            <span class="status-badge badge-{{ $client->status }}">
                                {{ ucfirst($client->status) }}
                            </span>
                        </td>
                        <td>
                            <span class="priority-high">HIGH</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-data">No follow-ups scheduled for today. Great job!</div>
        @endif
    </div>
    
    <!-- Overdue Follow-ups -->
    @if($overdueFollowUps->count() > 0)
    <div class="section">
        <h2 class="section-title">Overdue Follow-ups ({{ $total_overdue }})</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Overdue Since</th>
                    <th>Status</th>
                    <th>Contact</th>
                    <th>Priority</th>
                </tr>
            </thead>
            <tbody>
                @foreach($overdueFollowUps as $client)
                <tr>
                    <td><strong>{{ $client->name }}</strong></td>
                    <td>
                        {{ $client->next_follow_up->format('M d, Y') }}<br>
                        <small>({{ $client->next_follow_up->diffForHumans() }})</small>
                    </td>
                    <td>
                        <span class="status-badge badge-{{ $client->status }}">
                            {{ ucfirst($client->status) }}
                        </span>
                    </td>
                    <td>
                        {{ $client->email ?? '' }}<br>
                        {{ $client->phone ?? '' }}
                    </td>
                    <td>
                        <span class="priority-high">URGENT</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    
    <!-- Upcoming Follow-ups -->
    @if($upcomingFollowUps->count() > 0)
    <div class="section">
        <h2 class="section-title">Upcoming Follow-ups (Next 7 Days)</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Follow-up Date</th>
                    <th>Days Remaining</th>
                    <th>Status</th>
                    <th>Priority</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcomingFollowUps as $client)
                @php
                    $daysRemaining = $client->next_follow_up->diffInDays(today());
                    $priority = $daysRemaining <= 1 ? 'HIGH' : 
                               ($daysRemaining <= 3 ? 'MEDIUM' : 'LOW');
                @endphp
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->next_follow_up->format('M d, Y') }}</td>
                    <td>{{ $daysRemaining }} days</td>
                    <td>
                        <span class="status-badge badge-{{ $client->status }}">
                            {{ ucfirst($client->status) }}
                        </span>
                    </td>
                    <td>
                        <span class="priority-{{ strtolower($priority) }}">{{ $priority }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    
    <!-- Recommended Actions -->
    <div class="section">
        <h2 class="section-title">Recommended Actions</h2>
        
        @if($total_overdue > 0)
        <div class="action-item">
            <div class="action-icon icon-call">!</div>
            <div class="action-content">
                <div class="action-title">Address Overdue Follow-ups</div>
                <div class="action-meta">
                    You have {{ $total_overdue }} overdue follow-up{{ $total_overdue > 1 ? 's' : '' }}. 
                    Contact these clients as soon as possible.
                </div>
            </div>
        </div>
        @endif
        
        @if($total_today > 0)
        <div class="action-item">
            <div class="action-icon icon-email">✓</div>
            <div class="action-content">
                <div class="action-title">Complete Today's Follow-ups</div>
                <div class="action-meta">
                    You have {{ $total_today }} follow-up{{ $total_today > 1 ? 's' : '' }} scheduled for today.
                    Set aside time to connect with these clients.
                </div>
            </div>
        </div>
        @endif
        
        @if($total_upcoming > 0)
        <div class="action-item">
            <div class="action-icon icon-meeting">📅</div>
            <div class="action-content">
                <div class="action-title">Plan Upcoming Follow-ups</div>
                <div class="action-meta">
                    You have {{ $total_upcoming }} follow-up{{ $total_upcoming > 1 ? 's' : '' }} scheduled for the next 7 days.
                    Consider scheduling them in your calendar.
                </div>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <p>Report generated by NexusCRM - Lightweight Client Relationship Management System</p>
        <p>This report contains confidential client information intended only for {{ $user->name }}</p>
        <p>Page 1 of 1</p>
    </div>
</body>
</html>