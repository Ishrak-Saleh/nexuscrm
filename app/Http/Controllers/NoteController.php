<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function store(Request $request, Client $client)
    {
        $this->authorize('view', $client);
        
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'type' => 'required|in:call,meeting,email,general'
        ]);

        $client->notes()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'type' => $validated['type']
        ]);

        return redirect()->back()
            ->with('success', 'Note added successfully.');
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);
        
        $note->delete();
        
        return redirect()->back()
            ->with('success', 'Note deleted successfully.');
    }
}