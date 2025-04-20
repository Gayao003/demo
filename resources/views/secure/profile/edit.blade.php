<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Secure Profile Update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('secure.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-green-500">
                <div class="max-w-xl">
                    <div class="bg-green-100 p-4 rounded-md mb-4">
                        <h3 class="text-lg font-bold text-green-700">Secure Implementation</h3>
                        <p class="text-green-700">
                            This page demonstrates a secure implementation that prevents IDOR vulnerabilities. The form does not include a user_id field and instead uses the authenticated user's identity from the server-side session.
                        </p>
                        <p class="text-green-700 mt-2">
                            Even if an attacker tries to manipulate the request, they cannot update another user's profile because the server ignores any user_id in the request and only updates the currently authenticated user.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 