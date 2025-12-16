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
        
        //Get clients with most notes (which is most active)
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
        
        return view('dashboard', compact(
            'stats', 
            'mostActiveClients', 
            'upcomingFollowUps', 
            'recentNotes'
        ));
    }
}