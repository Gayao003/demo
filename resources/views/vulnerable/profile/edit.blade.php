<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vulnerable Profile Update (IDOR Demo)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('vulnerable.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-red-500">
                <div class="max-w-xl">
                    <div class="bg-red-100 p-4 rounded-md mb-4">
                        <h3 class="text-lg font-bold text-red-700">IDOR Vulnerability Warning</h3>
                        <p class="text-red-700">
                            This page demonstrates an Insecure Direct Object Reference (IDOR) vulnerability. The form includes a hidden user_id field that can be manipulated to update another user's profile.
                        </p>
                        <p class="text-red-700 mt-2">
                            To exploit: Inspect the form, change the user_id value, and submit the form.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 