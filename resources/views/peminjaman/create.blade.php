<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Form Peminjaman Barang: {{ $barang->nama_barang }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('pinjam.store') }}">
                        @csrf

                        {{-- Input tersembunyi untuk ID barang --}}
                        <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                        <div>
                            <x-input-label for="name" :value="__('Nama Peminjam')" />
                            <x-text-input id="name" class="block mt-1 w-full bg-gray-100" type="text" name="name" :value="Auth::user()->name" required readonly />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="department" :value="__('Departemen')" />
                            <x-text-input id="department" class="block mt-1 w-full bg-gray-100" type="text" name="department" :value="Auth::user()->department" required readonly />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="tanggal_kembali" :value="__('Tanggal Pengembalian')" />
                            <x-text-input id="tanggal_kembali" class="block mt-1 w-full" type="date" name="tanggal_kembali" required />
                            <x-input-error :messages="$errors->get('tanggal_kembali')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Batal') }}
                            </a>

                            <x-primary-button>
                                {{ __('Kirim Request Pinjam') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>