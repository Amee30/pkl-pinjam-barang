<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Ajukan Peminjaman Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('pinjam.store') }}">
                        @csrf
                        
                        <input type="hidden" name="barang_id" value="{{ $barangs->id }}">
                        <input type="hidden" name="borrowed_at" value="{{ date('Y-m-d') }}">
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-medium mb-2">Detail Barang</h3>
                            <div class="flex items-center mb-4">
                                @if($barangs->foto)
                                    <img src="{{ asset('storage/' . $barangs->foto) }}" alt="{{ $barangs->nama_barang }}" class="w-20 h-20 object-contain border rounded">
                                @endif
                                <div>
                                    <p class="font-semibold text-lg">{{ $barangs->nama_barang }}</p>
                                    <p class="text-sm text-gray-600">Kategori: {{ $barangs->kategori }}</p>
                                    <p class="text-sm text-gray-600">Serial Number: {{ $barangs->serial_number ?? 'Tidak Ada' }}</p>
                                    <p class="text-sm text-gray-600">Stok Tersedia: {{ $barangs->stok }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="return_due_date" :value="__('Tanggal Pengembalian')" class="text-black">Tanggal Pengembalian</label>
                            <x-text-input id="return_due_date" class="block mt-1 w-full" type="date" name="return_due_date" :value="old('return_due_date', date('Y-m-d', strtotime('now')))" required />
                            <x-input-error :messages="$errors->get('return_due_date')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="reason" :value="__('Tujuan Peminjaman')" class="text-black">Tujuan Peminjaman</label>
                            <textarea id="reason" name="reason" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('reason') }}</textarea>
                            <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button>
                                {{ __('Ajukan Peminjaman') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between"> 
                <div class="mt-8 md:mt-0 flex items-center justify-center md:justify-end">
                    <div class="text-sm text-gray-500">
                        &copy; {{ date('Y') }} Sistem Peminjaman Barang. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</x-app-layout>