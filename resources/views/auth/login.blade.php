<x-guest-layout>
    <x-jet-authentication-card class="backdrop-blur-sm">
        <x-slot name="logo">
        </x-slot>

        <x-jet-validation-errors class="mb-4 bg-rose-500/10 p-1 rounded-md" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm ">
                {{ session('status') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}" class="hue-rotate-30">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full rounded-sm" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full text-sm-sky-900 rounded-sm" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" class="rounded-sm" />
                    <span class="ml-2 text-sm ">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-5  rounded-none ring-2 ring-indigo-500 outline-offset-2">
                    {{ ('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
