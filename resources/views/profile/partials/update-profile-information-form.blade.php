<section x-data="{ showCustomEducationLevel: false }">
  <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ __('Profile Information') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      {{ __("Update your account's profile information and email address.") }}
    </p>
  </header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
  </form>

  <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <!-- Avatar -->
    <div class="mt-4">
      <x-input-label for="avatar" :value="__('Avatar')" />
      <input id="avatar" name="avatar" type="file" class="block mt-1 w-full" accept="image/*"
        @change="previewImage" />
      <x-input-error :messages="$errors->get('avatar')" class="mt-2" />

      <!-- Avatar Preview -->
      <div class="mt-2">
        <img id="avatar-preview" src="{{ $user->profile->avatar ?? '' }}" alt="{{ __('Avatar Preview') }}"
          class="h-20 w-20 rounded-full object-cover">
      </div>
    </div>

    <script>
      function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('avatar-preview');
        if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = (e) => {
            preview.src = e.target.result;
          };
          reader.readAsDataURL(input.files[0]);
        }
      }
    </script>

    <div>
      <x-input-label for="name" :value="__('Name')" />
      <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required
        autofocus autocomplete="name" />
      <x-input-error class="mt-2" :messages="$errors->get('name')" />
      @error('name')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required
        autocomplete="username" />
      <x-input-error class="mt-2" :messages="$errors->get('email')" />
      @error('email')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror

      @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
        <div>
          <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
            {{ __('Your email address is unverified.') }}

            <button form="send-verification"
              class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
              {{ __('Click here to re-send the verification email.') }}
            </button>
          </p>

          @if (session('status') === 'verification-link-sent')
            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
              {{ __('A new verification link has been sent to your email address.') }}
            </p>
          @endif
        </div>
      @endif
    </div>
    <!-- Phone -->
    <div class="mt-4">
      <x-input-label for="phone" :value="__('Phone')" />
      <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" pattern="^\+62\d{9,13}$"
        :value="old('phone', $user->profile->phone)" required autocomplete="tel" />
      <x-input-error :messages="$errors->get('phone')" class="mt-2" />
      @error('phone')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Status -->
    <div class="mt-4">
      <x-input-label for="status" :value="__('Status')" />
      <x-select-input id="status" class="block mt-1 w-full" name="status" required>
        <option value="" disabled {{ old('status', $user->profile->status) == '' ? 'selected' : '' }}>
          {{ __('Pilih Status') }}</option>
        <option value="siswa" {{ old('status', $user->profile->status) == 'siswa' ? 'selected' : '' }}>
          {{ __('Siswa') }}</option>
        <option value="mahasiswa" {{ old('status', $user->profile->status) == 'mahasiswa' ? 'selected' : '' }}>
          {{ __('Mahasiswa') }}</option>
        <option value="umum" {{ old('status', $user->profile->status) == 'umum' ? 'selected' : '' }}>
          {{ __('Umum') }}</option>
      </x-select-input>
      <x-input-error :messages="$errors->get('status')" class="mt-2" />
      @error('status')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Jenjang Pendidikan -->
    <div x-data="{ showCustomEducationLevel: '{{ !in_array(old('education_level', $user->profile->jenjang), ['SLTP', 'SLTA', 'PT']) ? 'true' : 'false' }}' === 'true' }">
      <!-- Jenjang Pendidikan -->
      <div class="mt-4">
        <x-input-label for="education_level" :value="__('Jenjang Pendidikan')" />
        <x-select-input id="education_level" class="block mt-1 w-full" name="education_level" required
          @change="showCustomEducationLevel = $event.target.value === 'lainnya'">
          <option value="" disabled>{{ __('Pilih Jenjang Pendidikan') }}</option>
          <option value="SLTP" {{ old('education_level', $user->profile->jenjang) == 'SLTP' ? 'selected' : '' }}>SLTP
          </option>
          <option value="SLTA" {{ old('education_level', $user->profile->jenjang) == 'SLTA' ? 'selected' : '' }}>SLTA
          </option>
          <option value="PT" {{ old('education_level', $user->profile->jenjang) == 'PT' ? 'selected' : '' }}>PT
          </option>
          <option value="lainnya"
            {{ !in_array(old('education_level', $user->profile->jenjang), ['SLTP', 'SLTA', 'PT']) ? 'selected' : '' }}>
            Lainnya</option>
        </x-select-input>
        <x-input-error :messages="$errors->get('education_level')" class="mt-2" />
      </div>

      <!-- Custom Jenjang Pendidikan -->
      <div class="mt-4" x-show="showCustomEducationLevel" x-transition>
        <x-input-label for="custom_education_level" :value="__('Masukkan Jenjang Pendidikan')" />
        <x-text-input id="custom_education_level" class="block mt-1 w-full" type="text" name="custom_education_level"
          :value="old(
              'custom_education_level',
              !in_array($user->profile->jenjang, ['SLTP', 'SLTA', 'PT']) ? $user->profile->jenjang : '',
          )" />
        <x-input-error :messages="$errors->get('custom_education_level')" class="mt-2" />
      </div>
    </div>


    <div class="flex items-center gap-4">
        <a class="inline-flex items-center px-4 py-2 bg-red-800 dark:bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-red-700 dark:hover:bg-pink focus:bg-red-700 dark:focus:bg-white active:bg-red-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 w-full justify-center" href="">
                    {{ __('reset') }}
            </a>
      <x-primary-button class="w-full inliune-flex items-center justify-center">{{ __('Save') }}</x-primary-button>

      @if (session('status') === 'profile-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
          class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
      @endif
    </div>
  </form>
</section>
