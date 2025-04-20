<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vulnerable Notes List (Insecure Implementation)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-visible">My Notes</h3>
                        <div class="flex space-x-2">
                            <form action="{{ route('vulnerable.notes.search') }}" method="GET" class="flex">
                                <input type="text" name="query" placeholder="Search notes..." class="px-2 py-1 border rounded text-visible">
                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-1 btn-black-text">Search</button>
                            </form>
                            <a href="{{ route('vulnerable.notes.create') }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded btn-black-text">
                                Create New Note
                            </a>
                        </div>
                    </div>

                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        <p class="font-bold">Warning: Vulnerable Implementation</p>
                        <p>This section demonstrates an IDOR vulnerability. Try accessing another user's note by directly modifying the note ID in the URL.</p>
                        <p class="mt-2">Additional vulnerability:</p>
                        <ul class="list-disc ml-5">
                            <li>The search function can leak other users' notes</li>
                        </ul>
                    </div>
                    
                    @if(count($notes) > 0)
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($notes as $note)
                                <div class="border rounded-lg p-4 shadow-sm">
                                    <h3 class="text-xl font-semibold mb-2 text-visible">{{ $note->title }}</h3>
                                    <p class="text-gray-600 mb-3 text-visible">{{ Str::limit($note->content, 100) }}</p>
                                    <div class="flex justify-end mt-3">
                                        <a href="{{ route('vulnerable.notes.show', $note->id) }}" class="action-button view">View</a>
                                        <a href="{{ route('vulnerable.notes.edit', $note->id) }}" class="action-button edit">Edit</a>
                                        <form action="{{ route('vulnerable.notes.destroy', $note->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-button delete" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-visible">No notes found. Create your first note!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 