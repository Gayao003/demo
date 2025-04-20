<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecureNoteController extends Controller
{
    public function index()
    {
        $notes = Auth::user()->notes;
        return view('secure.notes.index', compact('notes'));
    }

    public function create()
    {
        return view('secure.notes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        Auth::user()->notes()->create([
            'title' => $validated['title'],
            'content' => $validated['content']
        ]);

        return redirect()->route('secure.notes.index')->with('success', 'Note created successfully');
    }

    // SECURE: Only fetches notes that belong to the authenticated user
    public function show($id)
    {
        $note = Auth::user()->notes()->findOrFail($id);
        return view('secure.notes.show', compact('note'));
    }

    // SECURE: Only allows editing of notes that belong to the authenticated user
    public function edit($id)
    {
        $note = Auth::user()->notes()->findOrFail($id);
        return view('secure.notes.edit', compact('note'));
    }

    // SECURE: Only allows updating notes that belong to the authenticated user
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $note = Auth::user()->notes()->findOrFail($id);
        $note->update([
            'title' => $validated['title'],
            'content' => $validated['content']
        ]);

        return redirect()->route('secure.notes.index')->with('success', 'Note updated successfully');
    }

    // SECURE: Only allows deleting notes that belong to the authenticated user
    public function destroy($id)
    {
        $note = Auth::user()->notes()->findOrFail($id);
        $note->delete();

        return redirect()->route('secure.notes.index')->with('success', 'Note deleted successfully');
    }
}
