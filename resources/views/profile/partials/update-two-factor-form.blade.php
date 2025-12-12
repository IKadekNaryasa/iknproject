<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Google Authenticator (2FA)') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Tambahkan lapisan keamanan ekstra ke akun Anda dengan mengaktifkan autentikasi dua faktor.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        @if(auth()->user()->google2fa_enabled)
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm font-medium text-green-600">{{ __('2FA Aktif') }}</span>
        </div>

        <form method="POST" action="{{ route('2fa.disable') }}" onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan 2FA?');">
            @csrf

            <div>
                <x-input-label for="password_disable" :value="__('Masukkan Password untuk Menonaktifkan')" />
                <x-text-input
                    id="password_disable"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4 mt-4">
                <x-danger-button>
                    {{ __('Nonaktifkan 2FA') }}
                </x-danger-button>
            </div>
        </form>
        @else
        <div class="flex items-center">
            <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm font-medium text-gray-600">{{ __('2FA Tidak Aktif') }}</span>
        </div>

        <p class="text-sm text-gray-600">
            {{ __('Dengan mengaktifkan 2FA, Anda akan diminta memasukkan kode dari aplikasi Google Authenticator setiap kali login.') }}
        </p>

        <div class="flex items-center gap-4">
            <a href="{{ route('2fa.enable') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Aktifkan 2FA') }}
            </a>
        </div>
        @endif
    </div>
</section>