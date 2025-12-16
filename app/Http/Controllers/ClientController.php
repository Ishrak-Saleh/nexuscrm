<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Auth::user()->clients()->with('notes')->latest()->get();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
        ]);

        Auth::user()->clients()->create($validated);
        
        return redirect()->route('clients.index')
            ->with('success', 'Client added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //Authorization check - user can only view their own clients
        if ($client->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('clients.show', compact('client'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //Authorization check
        if ($client->user_id !== Auth::id()) {
            abort(403);
        }
        
        $client->delete();
        
        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully!');
    }
}