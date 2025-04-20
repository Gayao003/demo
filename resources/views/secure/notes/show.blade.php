<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Note (Secure Implementation)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('secure.notes.index') }}" class="text-blue-500 hover:text-blue-700">
                            &larr; Back to Notes
                        </a>
                    </div>

                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p class="font-bold">Secure Implementation</p>
                        <p>This page is protected against IDOR. The controller verifies that the note belongs to the current user by using Auth::user()->notes()->findOrFail($id).</p>
                        <p class="mt-2">This note belongs to you (user ID: {{ Auth::id() }})</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <h1 class="text-2xl font-bold mb-4">{{ $note->title }}</h1>
                        <div class="prose max-w-none">
                            {{ $note->content }}
                        </div>
                        <div class="mt-6 flex space-x-4">
                            <a href="{{ route('secure.notes.edit', $note->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded">
                                Edit Note
                            </a>
                            <form action="{{ route('secure.notes.destroy', $note->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">
                                    Delete Note
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 