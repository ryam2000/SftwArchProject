<x-guest-layout>
    <div class="min-h-screen grid grid-cols-2">
        <div class="flex flex-col sm:justify-center items-center">
            <x-authentication-card>
                <x-slot name="logo">
                    <a href="/home">
                        <img class="block h-20 w-auto" src="/img/humminglogo.png" alt="Hummingbird">
                    </a>
                </x-slot>

                <x-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <p class="text-lg text-bold flex justify-center">Welcome back.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mt-4 text-sm">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-2 w-full border-opacity-100 border-gray-500 rounded-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4 text-sm">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-2 w-full border border-gray-500 rounded-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-xs text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-center mt-8">
                        @if (Route::has('password.request'))
                            <a class="text-xs text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-300" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <a class="ml-4 text-xs">
                            or
                        </a>

                        <a class="ml-4 text-xs text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-300" href="{{ route('register') }}">
                            {{ __('Create a new account') }}
                        </a>
                    </div>
                    <div class="flex items-center justify-center mt-8">
                        <x-button>
                            {{ __('Log in') }}
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
