<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->clients()->withCount('notes');
        
        //Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }
        
        //Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        $clients = $query->latest()->paginate(10);
        
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'next_follow_up' => 'nullable|date',
            'status' => 'required|in:active,inactive,lead'
        ]);

        $validated['user_id'] = Auth::id();
        
        Client::create($validated);
        
        return redirect()->route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function show(Client $client)
    {
        $this->authorize('view', $client);
        
        $notes = $client->notes()->latest()->paginate(5);
        
        return view('clients.show', compact('client', 'notes'));
    }

    public function edit(Client $client)
    {
        $this->authorize('update', $client);
        
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'next_follow_up' => 'nullable|date',
            'status' => 'required|in:active,inactive,lead'
        ]);

        $client->update($validated);
        
        return redirect()->route('clients.show', $client)
            ->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        
        $client->delete();
        
        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully.');
    }

    public function todayFollowUps()
    {
        $clients = Auth::user()->clients()
            ->whereDate('next_follow_up', today())
            ->latest()
            ->paginate(10);
        
        return view('clients.today-followups', compact('clients'));
    }
}