<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" pattern="^\+62\d{9,13}$" :value="old('phone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="telepon" :value="__('Telepon')" />
            <x-text-input id="telepon" class="block mt-1 w-full" type="number" name="telepon" pattern="^\+62\d{9,13}$" :value="old('telepon')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
        </div>

        <!-- Status -->
        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />
            <x-select-input id="status" class="block mt-1 w-full" name="status" required>
                <option value="" selected disabled>{{ __('Pilih Status') }}</option>
                <option value="siswa">{{ __('Siswa') }}</option>
                <option value="mahasiswa">{{ __('Mahasiswa') }}</option>
                <option value="umum">{{ __('Umum') }}</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <!-- Jenjang Pendidikan -->
        <div class="mt-4">
            <x-input-label for="education_level" :value="__('Jenjang Pendidikan')" />
            <x-select-input id="education_level" class="block mt-1 w-full" name="education_level" required @change="showCustomEducationLevel = $event.target.value === 'other'">
                <option value="" selected disabled>{{ __('Pilih Jenjang Pendidikan') }}</option>
                <option value="SLTP">{{ __('SLTP') }}</option>
                <option value="SLTA">{{ __('SLTA') }}</option>
                <option value="PT">{{ __('PT') }}</option>
                <option value="other">{{ __('Lainnya') }}</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('education_level')" class="mt-2" />
        </div>

        <!-- Custom Jenjang Pendidikan -->
        <div class="mt-4" x-show="showCustomEducationLevel">
            <x-input-label for="custom_education_level" :value="__('Masukkan Jenjang Pendidikan')" />
            <x-text-input id="custom_education_level" class="block mt-1 w-full" type="text" name="custom_education_level" :value="old('custom_education_level')" />
            <x-input-error :messages="$errors->get('custom_education_level')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
            <x-text-input id="password" class="block mt-1 w-full pr-10"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />
            <button type="button" class="absolute inset-y-0 right-0 flex items-center px-3" onclick="togglePasswordVisibility('password')">
                <svg id="password_eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.828-.682 1.6-1.198 2.285M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative">
            <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                    type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            <button type="button" class="absolute inset-y-0 right-0 flex items-center px-3" onclick="togglePasswordVisibility('password_confirmation')">
                <svg id="password_confirmation_eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.828-.682 1.6-1.198 2.285M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <script>
            function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById(`${inputId}_eye`);
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 011.198-2.285M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';
            } else {
                input.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';
            }
            }
        </script>

        <div class="mt-4 flex items-center flex-row justify-center gap-2">
            <a class="inline-flex items-center px-4 py-2 bg-red-800 dark:bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-red-700 dark:hover:bg-pink focus:bg-red-700 dark:focus:bg-white active:bg-red-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 w-full justify-center" href="">
                    {{ __('reset') }}
            </a>
            <x-primary-button class="inline-flex items-center py-2 px-auto justify-center w-full">
                    {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>


            {{-- <button type="submit">submit</button> --}}
        </div>
    </form>
</x-guest-layout>
