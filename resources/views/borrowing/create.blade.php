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
                                    <img src="{{ asset('storage/' . $barangs->foto) }}" alt="{{ $barangs->nama_barang }}" class="w-24 h-24 object-contain mr-4">
                                @endif
                                <div>
                                    <p class="font-semibold text-lg">{{ $barangs->nama_barang }}</p>
                                    <p class="text-sm text-gray-600">Kategori: {{ $barangs->kategori }}</p>
                                    <p class="text-sm text-gray-600">Stok Tersedia: {{ $barangs->stok }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <x-input-label for="return_due_date" :value="__('Tanggal Pengembalian')" />
                            <x-text-input id="return_due_date" class="block mt-1 w-full" type="date" name="return_due_date" :value="old('return_due_date', date('Y-m-d', strtotime('+7 days')))" required />
                            <x-input-error :messages="$errors->get('return_due_date')" class="mt-2" />
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
</x-app-layout>