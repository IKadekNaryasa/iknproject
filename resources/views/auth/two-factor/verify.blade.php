<x-guest-layout>
    <form method="POST" action="{{ route('2fa.verify.post') }}">
        @csrf

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Masukkan kode OTP dari Google Authenticator Anda') }}
        </div>

        @if (session('error'))
        <div class="mb-4 text-sm text-red-600">
            {{ session('error') }}
        </div>
        @endif

        <!-- OTP Code -->
        <div>
            <x-input-label for="one_time_password" :value="__('Kode OTP (6 digit)')" />
            <x-text-input id="one_time_password"
                class="block mt-1 w-full"
                type="text"
                name="one_time_password"
                maxlength="6"
                required
                autofocus
                autocomplete="off" />
            <x-input-error :messages="$errors->get('one_time_password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verifikasi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>