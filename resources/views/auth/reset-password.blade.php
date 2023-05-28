<x-guest-layout>
    <div class="min-h-screen grid grid-cols-2">
        <div class="flex flex-col sm:justify-center items-center">
            <x-authentication-card>
                <x-slot name="logo">
                    <x-authentication-card-logo />
                </x-slot>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="block">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Reset Password') }}
                        </x-button>
                    </div>
                </form>
            </x-authentication-card>
        </div>
        <div class="flex flex-col sm:justify-center items-center bg-black">
            <div class="relative w-full">
                <img class="overflow-visible w-full h-full" src="/img/travelpic.gif" alt="travelpic">
                <span class="absolute box-decoration-slice px-5 py-3 bg-black bg-opacity-90 text-5xl text-white text-bold top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">Connect with the world.</span>
            </div>
        </div>
    </div>
</x-guest-layout>
