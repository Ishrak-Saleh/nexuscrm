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
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            border: 1px solid #e5d8eb;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background-color: #f6f1f9;
        }
        
        .stat-number {
            font-size: 28px;
            font-weight: bold;
            color: #52285d;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .table th {
            background-color: #52285d;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 14px;
            font-weight: bold;
        }
        
        .table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5d8eb;
            font-size: 13px;
        }
        
        .table tr:nth-child(even) {
            background-color: #f9f7fb;
        }
        
        .table tr:hover {
            background-color: #f3eef7;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
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
        
        .chart-container {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #e5d8eb;
            border-radius: 8px;
            background-color: #f6f1f9;
        }
        
        .chart-title {
            font-size: 16px;
            color: #52285d;
            margin-bottom: 15px;
            font-weight: bold;
        }
        
        .chart-bar {
            height: 20px;
            background-color: #52285d;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: width 0.3s ease;
        }
        
        .note-item {
            border-left: 3px solid #cd89b5;
            padding-left: 10px;
            margin-bottom: 10px;
            font-size: 13px;
        }
        
        .note-meta {
            font-size: 11px;
            color: #666;
            margin-top: 3px;
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
            .no-print {
                display: none;
            }
            
            .page-break {
                page-break-before: always;
            }
            
            body {
                font-size: 12px;
            }
            
            .header {
                margin-bottom: 20px;
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
            Page 1 of 1
        </div>
    </div>
    
    <!-- Key Statistics -->
    <div class="section">
        <h2 class="section-title">Key Statistics</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total_clients'] }}</div>
                <div class="stat-label">Total Clients</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['active_clients'] }}</div>
                <div class="stat-label">Active Clients</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['leads'] }}</div>
                <div class="stat-label">Leads</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['inactive_clients'] }}</div>
                <div class="stat-label">Inactive</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total_notes'] }}</div>
                <div class="stat-label">Total Notes</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['today_followups'] }}</div>
                <div class="stat-label">Today's Follow-ups</div>
            </div>
        </div>
    </div>
    
    <!-- Client Status Distribution -->
    <div class="section">
        <h2 class="section-title">Client Status Distribution</h2>
        <div class="chart-container">
            <div class="chart-title">Status Breakdown</div>
            @foreach($statusDistribution as $status => $count)
                @php
                    $total = $stats['total_clients'];
                    $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                    $color = $status == 'active' ? '#52285d' : 
                            ($status == 'inactive' ? '#af4b75' : '#cd89b5');
                @endphp
                <div style="margin-bottom: 15px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span style="font-weight: bold; text-transform: capitalize;">{{ $status }} Clients</span>
                        <span>{{ $count }} ({{ number_format($percentage, 1) }}%)</span>
                    </div>
                    <div style="height: 20px; background-color: #e5d8eb; border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $percentage }}%; background-color: {{ $color }}; border-radius: 10px;"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Recent Clients -->
    <div class="section">
        <h2 class="section-title">Recent Clients (Last 10)</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Notes</th>
                    <th>Added On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentClients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email ?? 'N/A' }}</td>
                    <td>
                        <span class="status-badge badge-{{ $client->status }}">
                            {{ ucfirst($client->status) }}
                        </span>
                    </td>
                    <td>{{ $client->notes_count }}</td>
                    <td>{{ $client->created_at->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Recent Activity -->
    @if($recentNotes->count() > 0)
    <div class="section">
        <h2 class="section-title">Recent Activity</h2>
        @foreach($recentNotes as $note)
        <div class="note-item">
            <div style="font-weight: bold; color: #52285d; text-transform: capitalize;">
                {{ $note->type }} with {{ $note->client->name }}
            </div>
            <div style="margin-top: 5px;">{{ $note->content }}</div>
            <div class="note-meta">
                {{ $note->created_at->format('M d, Y H:i') }}
            </div>
        </div>
        @endforeach
    </div>
    @endif
    
    <!-- Footer -->
    <div class="footer">
        <p>Report generated by NexusCRM - Lightweight Client Relationship Management System</p>
        <p>This report contains confidential information intended only for {{ $user->name }}</p>
    </div>
</body>
</html>