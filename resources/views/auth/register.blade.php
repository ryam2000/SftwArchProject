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

                <p class="text-lg text-bold flex justify-center">We're glad to have you.</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mt-4">
                        <x-label for="name" value="{{ __('Username') }}" />
                        <x-input id="name" class="block mt-1 w-full border border-gray-500 rounded-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-label for="displayname" value="{{ __('Display Name') }}" />
                        <x-input id="displayname" class="block mt-1 w-full border border-gray-500 rounded-full" type="text" name="displayname" autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full border border-gray-500 rounded-full" type="email" name="email" :value="old('email')" required autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full border border-gray-500 rounded-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full border border-gray-500 rounded-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <div class="flex justify-center mt-8">
                        <a class="text-xs text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2" href="{{ route('login') }}">
                            {{ __('Already have an account?') }}
                        </a>
                    </div>
                    <div class="flex items-center justify-center mt-8">
                        <x-button>
                            {{ __('Register') }}
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
