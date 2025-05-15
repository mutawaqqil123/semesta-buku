<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <div class="relative">
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full pr-10" autocomplete="current-password" />
            <button type="button" onclick="togglePasswordVisibility('update_password_current_password')" class="absolute inset-y-0 right-0 flex items-center pr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 3C5 3 1.73 7.11.46 9.36a1.75 1.75 0 000 1.28C1.73 12.89 5 17 10 17s8.27-4.11 9.54-6.36a1.75 1.75 0 000-1.28C18.27 7.11 15 3 10 3zM10 15c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm0-10a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
            </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <div class="relative">
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full pr-10" autocomplete="new-password" />
            <button type="button" onclick="togglePasswordVisibility('update_password_password')" class="absolute inset-y-0 right-0 flex items-center pr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 3C5 3 1.73 7.11.46 9.36a1.75 1.75 0 000 1.28C1.73 12.89 5 17 10 17s8.27-4.11 9.54-6.36a1.75 1.75 0 000-1.28C18.27 7.11 15 3 10 3zM10 15c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm0-10a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
            </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <div class="relative">
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full pr-10" autocomplete="new-password" />
            <button type="button" onclick="togglePasswordVisibility('update_password_password_confirmation')" class="absolute inset-y-0 right-0 flex items-center pr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 3C5 3 1.73 7.11.46 9.36a1.75 1.75 0 000 1.28C1.73 12.89 5 17 10 17s8.27-4.11 9.54-6.36a1.75 1.75 0 000-1.28C18.27 7.11 15 3 10 3zM10 15c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm0-10a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
            </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <script>
            function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
            }
        </script>

        <div class="flex items-center gap-4">
            <a class="inline-flex items-center px-4 py-2 bg-red-800 dark:bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-red-700 dark:hover:bg-pink focus:bg-red-700 dark:focus:bg-white active:bg-red-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 w-full justify-center" href="">
                    {{ __('reset') }}
            </a>
            <x-primary-button class="w-full inliune-flex items-center justify-center">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
