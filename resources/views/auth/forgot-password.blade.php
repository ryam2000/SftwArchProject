<x-guest-layout>
    <div class="min-h-screen grid grid-cols-2">
        <div class="flex flex-col sm:justify-center items-center">
            <x-authentication-card>
                <x-slot name="logo">
                    <a href="/home">
                        <img class="block h-20 w-auto" src="/img/humminglogo.png" alt="Hummingbird">
                    </a>
                </x-slot>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <x-validation-errors class="mb-4" />

                <p class="text-lg text-bold flex justify-center">No worries. We'll sort it out.</p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="block">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <p class="text-xs flex justify-center text-center mt-4">
                        Put in the email associated with your account and we'll send over a password reset link.
                    </p>

                    <div class="flex items-center justify-center mt-8">
                        <a class="text-xs text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300" href="{{ route('login') }}">
                            {{ __('Return to login') }}
                        </a>

                        <a class="ml-4 text-xs">
                            or
                        </a>

                        <a class="ml-4 text-xs text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300" href="{{ route('register') }}">
                            {{ __('Create a new account') }}
                        </a>
                    </div>
                    <div class="flex items-center justify-center mt-8">
                        <x-button>
                            {{ __('Send') }}
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
