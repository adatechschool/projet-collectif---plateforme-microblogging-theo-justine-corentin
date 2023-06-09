<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-pink-700 shadow-sm focus:ring-pink-500 dark:focus:ring-pink-700 dark:focus:ring-offset-pink-700" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
            
            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 dark:focus:ring-offset-pink-700" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 dark:focus:ring-offset-pink-700" href="{{ route('register') }}">
                    {{ __('Create an account') }}
                </a>
                @endif
                
                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <!-- div identifiant compte test -->
            <div class="block mt-4">
                <label for="remember_me" class="items-center">
                    <p class=" text-sm font-semibold text-gray-600 dark:text-gray-400">Bonjour, bienvenue sur Snippet !
                        <br>
                    </p>
                    <br>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Pour accéder à la plateforme et découvrir son contenu, nous vous invitons à utiliser les identifiants suivants :
                        <br>
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Email : ada@test.com
                        <br>
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Password : rootroot
                        <br>
                    </p>
                    <br>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Bonne visite ! 🚀
                        <br>
                    </p>
                </label>
            </div>
        </form>
</x-guest-layout>