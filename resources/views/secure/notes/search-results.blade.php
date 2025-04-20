<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Results (Secure Implementation)
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
                        <p>This search feature only shows results from your own notes, making it safe from IDOR.</p>
                        <p>Search query: "{{ $query }}"</p>
                    </div>
                    
                    <h3 class="text-lg font-semibold mb-4 text-visible">Search Results</h3>
                    
                    @if(count($notes) > 0)
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($notes as $note)
                                <div class="border rounded-lg p-4 shadow-sm">
                                    <h3 class="text-xl font-semibold mb-2 text-visible">{{ $note->title }}</h3>
                                    <p class="text-gray-600 mb-3 text-visible">{{ Str::limit($note->content, 100) }}</p>
                                    <div class="flex justify-end mt-3">
                                        <a href="{{ route('secure.notes.show', $note->id) }}" class="action-button view">View</a>
                                        <a href="{{ route('secure.notes.edit', $note->id) }}" class="action-button edit">Edit</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-visible">No results found for "{{ $query }}"</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 