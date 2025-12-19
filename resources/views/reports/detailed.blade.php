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
        
        .type-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
        }
        
        .type-call { background-color: #e3f2fd; color: #1565c0; }
        .type-meeting { background-color: #f3e5f5; color: #7b1fa2; }
        .type-email { background-color: #e8f5e9; color: #2e7d32; }
        .type-general { background-color: #fff3e0; color: #ef6c00; }
        
        .notes-distribution {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .note-type-card {
            border: 1px solid #e5d8eb;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            background-color: #f6f1f9;
        }
        
        .note-type-count {
            font-size: 20px;
            font-weight: bold;
            color: #52285d;
            margin-bottom: 5px;
        }
        
        .note-type-label {
            font-size: 11px;
            color: #666;
            text-transform: capitalize;
        }
        
        .weekly-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
            margin-bottom: 20px;
        }
        
        .day-card {
            border: 1px solid #e5d8eb;
            border-radius: 6px;
            padding: 10px;
            text-align: center;
            background-color: #f6f1f9;
        }
        
        .day-card.today {
            background-color: rgba(175, 75, 117, 0.1);
            border-color: #af4b75;
        }
        
        .day-name {
            font-size: 12px;
            font-weight: bold;
            color: #52285d;
            margin-bottom: 5px;
        }
        
        .day-date {
            font-size: 10px;
            color: #666;
            margin-bottom: 8px;
        }
        
        .day-count {
            font-size: 18px;
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
            
            .table {
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
            Date: {{ $generated_at }} | 
            Total Clients: {{ $total_clients }} | 
            Total Notes: {{ $total_notes }}
        </div>
    </div>
    
    <!-- Summary Statistics -->
    <div class="section">
        <h2 class="section-title">Summary Statistics</h2>
        <div class="summary-stats">
            <div class="summary-card">
                <div class="summary-number">{{ $total_clients }}</div>
                <div class="summary-label">Total Clients</div>
            </div>
            <div class="summary-card">
                <div class="summary-number">{{ $total_notes }}</div>
                <div class="summary-label">Total Notes</div>
            </div>
            <div class="summary-card">
                <div class="summary-number">{{ $upcomingFollowUps->count() }}</div>
                <div class="summary-label">Upcoming Follow-ups</div>
            </div>
            <div class="summary-card">
                <div class="summary-number">{{ $weeklyFollowUps[0]['count'] }}</div>
                <div class="summary-label">Today's Follow-ups</div>
            </div>
        </div>
    </div>
    
    <!-- Notes Distribution by Type -->
    <div class="section">
        <h2 class="section-title">Notes Distribution by Type</h2>
        <div class="notes-distribution">
            @foreach($notesByType as $type => $count)
                @php
                    $typeColors = [
                        'call' => 'type-call',
                        'meeting' => 'type-meeting',
                        'email' => 'type-email',
                        'general' => 'type-general'
                    ];
                @endphp
                <div class="note-type-card">
                    <div class="note-type-count">{{ $count }}</div>
                    <div class="note-type-label {{ $typeColors[$type] ?? 'type-general' }}">
                        {{ ucfirst($type) }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Weekly Follow-up Distribution -->
    <div class="section">
        <h2 class="section-title">Weekly Follow-up Distribution</h2>
        <div class="weekly-grid">
            @foreach($weeklyFollowUps as $day)
            <div class="day-card {{ $day['is_today'] ? 'today' : '' }}">
                <div class="day-name">{{ $day['day'] }}</div>
                <div class="day-date">{{ $day['date'] }}</div>
                <div class="day-count">{{ $day['count'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- All Clients -->
    <div class="section">
        <h2 class="section-title">All Clients ({{ $clients->count() }})</h2>
        @if($clients->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th>Next Follow-up</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $index => $client)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email ?? 'N/A' }}</td>
                        <td>{{ $client->phone ?? 'N/A' }}</td>
                        <td>
                            <span class="status-badge badge-{{ $client->status }}">
                                {{ ucfirst($client->status) }}
                            </span>
                        </td>
                        <td>{{ $client->notes_count }}</td>
                        <td>
                            @if($client->next_follow_up)
                                {{ $client->next_follow_up->format('M d, Y') }}
                            @else
                                Not set
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-data">No clients found in the database.</div>
        @endif
    </div>
    
    <!-- Upcoming Follow-ups -->
    @if($upcomingFollowUps->count() > 0)
    <div class="section">
        <h2 class="section-title">Upcoming Follow-ups (Next 30 Days)</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Follow-up Date</th>
                    <th>Status</th>
                    <th>Contact Info</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcomingFollowUps as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>
                        <strong>{{ $client->next_follow_up->format('M d, Y') }}</strong>
                        ({{ $client->next_follow_up->diffForHumans() }})
                    </td>
                    <td>
                        <span class="status-badge badge-{{ $client->status }}">
                            {{ ucfirst($client->status) }}
                        </span>
                    </td>
                    <td>
                        {{ $client->email ?? 'N/A' }}<br>
                        {{ $client->phone ?? '' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    
    <!-- Footer -->
    <div class="footer">
        <p>Report generated by NexusCRM - Lightweight Client Relationship Management System</p>
        <p>This report contains confidential client information intended only for {{ $user->name }}</p>
        <p>Page 1 of 1</p>
    </div>
</body>
</html>