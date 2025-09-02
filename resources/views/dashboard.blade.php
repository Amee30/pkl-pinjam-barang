<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard Peminjaman Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Menampilkan pesan sukses jika ada --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Daftar Barang Tersedia</h3>
                    
                    <!-- Grid View untuk Barang -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($barangs as $barang)
                            <div class="border rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                                <div class="relative">
                                    <!-- Badge untuk status barang -->
                                    <div class="absolute top-2 right-2 bg-blue-500 text-white rounded-full px-3 py-1 text-xs font-semibold">
                                        Tersedia
                                    </div>
                                    
                                    <!-- Gambar barang - menyesuaikan dengan referensi -->
                                    @if($barang->foto)
                                        <div class="flex justify-center items-center bg-white h-48 p-3">
                                            <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" 
                                                 class="h-full w-full object-contain">
                                        </div>
                                    @else
                                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                            <span class="text-gray-500">Tidak ada foto</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="p-4">
                                    <!-- Kategori -->
                                    <p class="text-sm text-gray-500">{{ $barang->kategori }}</p>
                                    
                                    <!-- Nama Barang -->
                                    <h4 class="text-lg font-semibold mt-1">{{ $barang->nama_barang }}</h4>
                                    
                                    <!-- Informasi Stok -->
                                    <div class="flex items-center mt-2">
                                        <span class="text-sm mr-2">Stok:</span>
                                        <span class="font-semibold text-xl">{{ $barang->stok }}</span>
                                    </div>
                                    
                                    <!-- Status Ketersediaan -->
                                    <div class="flex items-center mt-2">
                                        <span class="text-sm mr-2">Status:</span>
                                        <div class="flex items-center">
                                            @if($barang->stok > 0)
                                                <span class="text-sm font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">
                                                    Tersedia
                                                </span>
                                            @else
                                                <span class="text-sm font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full">
                                                    Tidak Tersedia
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Tombol Pinjam -->
                                    <div class="mt-4">
                                        @if($barang->stok > 0)
                                            <a href="{{ route('pinjam.create', $barang->id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 transition ease-in-out duration-150">
                                                Pinjam Sekarang
                                            </a>
                                        @else
                                            <button disabled class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-500 uppercase tracking-widest cursor-not-allowed">
                                                Stok Habis
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8 text-gray-500">
                                Belum ada barang yang tersedia.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>