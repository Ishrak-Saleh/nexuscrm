<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Note;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $stats = [
            'total_clients' => $user->clients()->count(),
            'today_followups' => $user->clients()
                ->whereDate('next_follow_up', today())
                ->count(),
            'active_clients' => $user->clients()
                ->where('status', 'active')
                ->count(),
            'leads' => $user->clients()
                ->where('status', 'lead')
                ->count(),
        ];
        
        // Get clients with most notes (most active)
        $mostActiveClients = $user->clients()
            ->withCount('notes')
            ->orderBy('notes_count', 'desc')
            ->take(5)
            ->get();
        
        // Get upcoming follow-ups
        $upcomingFollowUps = $user->clients()
            ->where('next_follow_up', '>=', today())
            ->where('next_follow_up', '<=', today()->addDays(7))
            ->orderBy('next_follow_up')
            ->take(5)
            ->get();
        
        // Get recent notes
        $recentNotes = $user->notes()
            ->with('client')
            ->latest()
            ->take(5)
            ->get();
        
        $weeklyData = [];
        $maxWeekly = 0;
        
        for ($i = 0; $i < 7; $i++) {
            $date = now()->addDays($i);
            $count = $user->clients()
                ->whereDate('next_follow_up', $date)
                ->count();
            
            $cappedCount = min($count, 15);
            $maxWeekly = max($maxWeekly, $cappedCount);
            
            $weeklyData[] = [
                'day' => $date->format('D'),
                'full_day' => $date->format('l'),
                'date' => $date->format('M d'),
                'count' => $count, 
                'capped_count' => $cappedCount, 
                'is_capped' => $count > 15, 
                'is_today' => $date->isToday(),
                'is_tomorrow' => $date->isTomorrow(),
            ];
        }
        
        return view('dashboard', compact(
            'stats', 
            'mostActiveClients', 
            'upcomingFollowUps', 
            'recentNotes',
            'weeklyData',
            'maxWeekly'
        ));
    }

    /**
     * Generate and download PDF report
     */
    public function downloadReport(Request $request)
    {
        $user = Auth::user();
        $reportType = $request->get('type', 'overview'); // overview, detailed, followups
        
        switch ($reportType) {
            case 'detailed':
                $data = $this->getDetailedReportData($user);
                $pdf = Pdf::loadView('reports.detailed', $data);
                $filename = 'NexusCRM_Detailed_Report_' . date('Y-m-d') . '.pdf';
                break;
                
            case 'followups':
                $data = $this->getFollowupsReportData($user);
                $pdf = Pdf::loadView('reports.followups', $data);
                $filename = 'NexusCRM_Followups_Report_' . date('Y-m-d') . '.pdf';
                break;
                
            default: // overview
                $data = $this->getOverviewReportData($user);
                $pdf = Pdf::loadView('reports.overview', $data);
                $filename = 'NexusCRM_Overview_Report_' . date('Y-m-d') . '.pdf';
        }
        
        return $pdf->download($filename);
    }

    /**
     * Get data for overview report
     */
    private function getOverviewReportData($user)
    {
        $stats = [
            'total_clients' => $user->clients()->count(),
            'active_clients' => $user->clients()->where('status', 'active')->count(),
            'inactive_clients' => $user->clients()->where('status', 'inactive')->count(),
            'leads' => $user->clients()->where('status', 'lead')->count(),
            'total_notes' => $user->notes()->count(),
            'today_followups' => $user->clients()->whereDate('next_follow_up', today())->count(),
        ];
        
        // Status distribution
        $statusDistribution = [
            'active' => $user->clients()->where('status', 'active')->count(),
            'inactive' => $user->clients()->where('status', 'inactive')->count(),
            'lead' => $user->clients()->where('status', 'lead')->count(),
        ];
        
        // Activity summary
        $recentClients = $user->clients()
            ->withCount('notes')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        $recentNotes = $user->notes()
            ->with('client')
            ->latest()
            ->take(10)
            ->get();
        
        return [
            'user' => $user,
            'stats' => $stats,
            'statusDistribution' => $statusDistribution,
            'recentClients' => $recentClients,
            'recentNotes' => $recentNotes,
            'generated_at' => now()->format('F j, Y H:i'),
            'report_type' => 'Overview Report',
        ];
    }

    /**
     * Get data for detailed report
     */
    private function getDetailedReportData($user)
    {
        // Get all clients with their notes count
        $clients = $user->clients()
            ->withCount('notes')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get notes by type
        $notesByType = [
            'call' => $user->notes()->where('type', 'call')->count(),
            'meeting' => $user->notes()->where('type', 'meeting')->count(),
            'email' => $user->notes()->where('type', 'email')->count(),
            'general' => $user->notes()->where('type', 'general')->count(),
        ];
        
        // Get upcoming follow-ups for next 30 days
        $upcomingFollowUps = $user->clients()
            ->where('next_follow_up', '>=', today())
            ->where('next_follow_up', '<=', today()->addDays(30))
            ->orderBy('next_follow_up')
            ->get();
        
        // Weekly follow-up distribution
        $weeklyFollowUps = [];
        for ($i = 0; $i < 7; $i++) {
            $date = now()->addDays($i);
            $count = $user->clients()
                ->whereDate('next_follow_up', $date)
                ->count();
            
            $weeklyFollowUps[] = [
                'day' => $date->format('D'),
                'date' => $date->format('M d'),
                'count' => $count,
                'is_today' => $date->isToday(),
            ];
        }
        
        return [
            'user' => $user,
            'clients' => $clients,
            'notesByType' => $notesByType,
            'upcomingFollowUps' => $upcomingFollowUps,
            'weeklyFollowUps' => $weeklyFollowUps,
            'total_clients' => $clients->count(),
            'total_notes' => $user->notes()->count(),
            'generated_at' => now()->format('F j, Y H:i'),
            'report_type' => 'Detailed Report',
        ];
    }

    /**
     * Get data for follow-ups report
     */
    private function getFollowupsReportData($user)
    {
        // Today's follow-ups
        $todayFollowUps = $user->clients()
            ->whereDate('next_follow_up', today())
            ->orderBy('next_follow_up')
            ->get();
        
        // Upcoming follow-ups (next 7 days)
        $upcomingFollowUps = $user->clients()
            ->where('next_follow_up', '>', today())
            ->where('next_follow_up', '<=', today()->addDays(7))
            ->orderBy('next_follow_up')
            ->get();
        
        // Overdue follow-ups
        $overdueFollowUps = $user->clients()
            ->where('next_follow_up', '<', today())
            ->whereNotNull('next_follow_up')
            ->orderBy('next_follow_up')
            ->get();
        
        // Monthly follow-up summary
        $monthlySummary = [];
        $currentDate = today();
        for ($i = 0; $i < 3; $i++) { // Current month + next 2 months
            $month = $currentDate->copy()->addMonths($i);
            $startOfMonth = $month->copy()->startOfMonth();
            $endOfMonth = $month->copy()->endOfMonth();
            
            $count = $user->clients()
                ->whereBetween('next_follow_up', [$startOfMonth, $endOfMonth])
                ->count();
            
            $monthlySummary[] = [
                'month' => $month->format('F Y'),
                'count' => $count,
                'is_current' => $i === 0,
            ];
        }
        
        return [
            'user' => $user,
            'todayFollowUps' => $todayFollowUps,
            'upcomingFollowUps' => $upcomingFollowUps,
            'overdueFollowUps' => $overdueFollowUps,
            'monthlySummary' => $monthlySummary,
            'total_today' => $todayFollowUps->count(),
            'total_upcoming' => $upcomingFollowUps->count(),
            'total_overdue' => $overdueFollowUps->count(),
            'generated_at' => now()->format('F j, Y H:i'),
            'report_type' => 'Follow-ups Report',
        ];
    }
}