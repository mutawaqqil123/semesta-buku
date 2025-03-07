<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
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

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
            {{-- <button type="submit">submit</button> --}}
        </div>
    </form>
</x-guest-layout>
