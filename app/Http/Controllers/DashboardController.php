<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        //Get clients with most notes (most active)
        $mostActiveClients = $user->clients()
            ->withCount('notes')
            ->orderBy('notes_count', 'desc')
            ->take(5)
            ->get();
        
        //Get upcoming follow-ups
        $upcomingFollowUps = $user->clients()
            ->where('next_follow_up', '>=', today())
            ->where('next_follow_up', '<=', today()->addDays(7))
            ->orderBy('next_follow_up')
            ->take(5)
            ->get();
        
        //Get recent notes
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
}