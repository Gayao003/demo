<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VulnerableNoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', Auth::id())->get();
        return view('vulnerable.notes.index', compact('notes'));
    }

    public function create()
    {
        return view('vulnerable.notes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $note = new Note();
        $note->title = $validated['title'];
        $note->content = $validated['content'];
        $note->user_id = Auth::id();
        $note->save();

        return redirect()->route('vulnerable.notes.index')->with('success', 'Note created successfully');
    }

    // VULNERABLE: No authorization check, just fetch by ID
    public function show($id)
    {
        $note = Note::findOrFail($id);
        return view('vulnerable.notes.show', compact('note'));
    }

    // VULNERABLE: No authorization check for edit
    public function edit($id)
    {
        $note = Note::findOrFail($id);
        return view('vulnerable.notes.edit', compact('note'));
    }

    // VULNERABLE: No authorization check for update
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $note = Note::findOrFail($id);
        $note->title = $validated['title'];
        $note->content = $validated['content'];
        $note->save();

        return redirect()->route('vulnerable.notes.index')->with('success', 'Note updated successfully');
    }

    // VULNERABLE: No authorization check for delete
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return redirect()->route('vulnerable.notes.index')->with('success', 'Note deleted successfully');
    }
}
