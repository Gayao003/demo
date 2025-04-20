<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('IDOR Vulnerability Demo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Insecure Direct Object Reference (IDOR) Demonstration</h1>
                    
                    <div class="prose max-w-none">
                        <p class="mb-4">
                            Insecure Direct Object Reference (IDOR) is a security vulnerability that occurs when a web application exposes internal implementation objects to users without proper access control checks.
                        </p>
                        
                        <h2 class="text-xl font-semibold mt-6 mb-2">How IDOR Vulnerabilities Work</h2>
                        <p class="mb-4">
                            IDOR vulnerabilities happen when a website uses direct identifiers (like IDs, file names, or other references) to access objects, but fails to verify if the current user is authorized to access those objects.
                        </p>
                        
                        <h3 class="text-lg font-semibold mt-4 mb-2">Common IDOR Attack Patterns:</h3>
                        <ol class="list-decimal pl-6 mb-4">
                            <li class="mb-2">Manipulating parameter values in URLs (e.g., changing <code>/note/2</code> to <code>/note/3</code>)</li>
                            <li class="mb-2">Modifying hidden form fields in POST requests</li>
                            <li class="mb-2">Tampering with API endpoints that use predictable object references</li>
                            <li class="mb-2">Manipulating sequential IDs to access unauthorized resources</li>
                        </ol>
                        
                        <h2 class="text-xl font-semibold mt-6 mb-2">This Demo Application</h2>
                        <p class="mb-4">
                            This application demonstrates both vulnerable and secure implementations of a note-taking app:
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div class="border p-4 rounded-lg bg-red-50">
                                <h3 class="text-lg font-semibold text-red-700 mb-2">Vulnerable Implementation</h3>
                                <p class="mb-4">
                                    This implementation doesn't properly check if a note belongs to the current user before displaying, editing, or deleting it.
                                </p>
                                <p class="mb-4">
                                    <strong>Try:</strong> Create a note, then look at the ID in the URL. Try changing that ID to access notes from other users!
                                </p>
                                <a href="{{ route('vulnerable.notes.index') }}" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Vulnerable Notes
                                </a>
                            </div>
                            
                            <div class="border p-4 rounded-lg bg-green-50">
                                <h3 class="text-lg font-semibold text-green-700 mb-2">Secure Implementation</h3>
                                <p class="mb-4">
                                    This implementation properly verifies that a note belongs to the current user before allowing any operations on it.
                                </p>
                                <p class="mb-4">
                                    <strong>Try:</strong> Create a note, then try to change the ID in the URL as before. You'll get a 404 error because the system will only retrieve notes that belong to you.
                                </p>
                                <a href="{{ route('secure.notes.index') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Secure Notes
                                </a>
                            </div>
                        </div>
                        
                        <h2 class="text-xl font-semibold mt-6 mb-2">How to Prevent IDOR Vulnerabilities</h2>
                        <ol class="list-decimal pl-6 mb-4">
                            <li class="mb-2"><strong>Always validate access:</strong> Check if the current user has permission to access the requested resource</li>
                            <li class="mb-2"><strong>Use access control lists:</strong> Define who can access what resources</li>
                            <li class="mb-2"><strong>Implement indirect references:</strong> Use temporary or indirect references instead of direct database identifiers</li>
                            <li class="mb-2"><strong>Use proper relationships:</strong> Query objects through their relationships (e.g., <code>$user->notes->find($id)</code> instead of <code>Note::find($id)</code>)</li>
                            <li class="mb-2"><strong>Implement rate limiting:</strong> Prevent automated scanning for valid object references</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
