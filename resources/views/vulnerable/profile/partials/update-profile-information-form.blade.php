<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Vulnerable Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('vulnerable.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        
        <!-- VULNERABLE: Hidden user_id field that can be manipulated -->
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif

            @if (session('message'))
                <p class="text-sm text-green-600">{{ session('message') }}</p>
            @endif

            @if (session('error'))
                <p class="text-sm text-red-600">{{ session('error') }}</p>
            @endif
        </div>
    </form>
</section> 