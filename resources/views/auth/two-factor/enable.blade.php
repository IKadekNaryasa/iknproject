<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aktifkan Google Authenticator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Scan QR Code dengan Google Authenticator</h3>

                    <div class="mb-6">
                        <img src="data:image/svg+xml;base64,{{ $qrCodeImage }}" alt="QR Code">
                    </div>

                    <p class="mb-4">Atau masukkan kode manual ini:</p>
                    <div class="bg-gray-100 p-4 rounded mb-6">
                        <code class="text-lg">{{ $secret }}</code>
                    </div>

                    <form method="POST" action="{{ route('2fa.confirm') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="one_time_password" class="block text-sm font-medium text-gray-700">
                                Masukkan Kode OTP (6 digit)
                            </label>
                            <input type="text"
                                name="one_time_password"
                                id="one_time_password"
                                maxlength="6"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            @error('one_time_password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Verifikasi & Aktifkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>