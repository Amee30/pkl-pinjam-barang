<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Hello ' . Auth::user()->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Menampilkan pesan sukses jika ada --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-white px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Available Items</h3>
                    
                    <!-- Grid View untuk Barang -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @forelse($barangs as $barang)
                            <div class="border rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col">
                                <!-- Bagian Gambar -->
                                <div class="relative">
                                    @if($barang->foto)
                                        <div class="flex justify-center items-center bg-white h-48 p-4">
                                            <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" 
                                                 class="h-48 w-48 object-contain">
                                        </div>
                                    @else
                                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                            <span class="text-gray-500 text-xs">No Image</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Bagian Detail -->
                                <div class="p-4 flex-grow flex flex-col">
                                    <div class="flex-grow">
                                        <!-- Kategori -->
                                        <p class="text-xs text-gray-500">{{ $barang->kategori }}</p>
                                        
                                        <!-- Nama Barang -->
                                        <h4 class="text-md font-semibold mt-1">{{ $barang->nama_barang }}</h4>
                                        <p class="text-sm text-gray-600"> {{ $barang->serial_number ?? '' }}</p>
                                        
                                        <!-- Informasi Stok & Status -->
                                        <div class="flex items-center justify-between mt-2">
                                            <div class="flex items-center">
                                                <span class="text-sm mr-2">Stock:</span>
                                                <span class="font-semibold text-lg">{{ $barang->stok }}</span>
                                            </div>
                                            @if($barang->stok > 0)
                                                <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-0.5 rounded-full">
                                                    Available
                                                </span>
                                            @else
                                                <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-0.5 rounded-full">
                                                    Out of Stock
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Tombol Pinjam -->
                                    <div class="mt-4">
                                        @if($barang->stok > 0)
                                            <a href="{{ route('pinjam.create', $barang->id) }}" class="w-full inline-flex justify-center items-center px-3 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 transition ease-in-out duration-150">
                                                Borrow
                                            </a>
                                        @else
                                            <button disabled class="w-full inline-flex justify-center items-center px-3 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-500 uppercase tracking-widest cursor-not-allowed">
                                                Out of Stock
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8 text-gray-500">
                                No available items.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-500 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between"> 
                <div class="mt-8 md:mt-0 flex items-center justify-center md:justify-end">
                    <div class="text-sm text-white">
                        &copy; {{ date('Y') }} Sistem Peminjaman Barang. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</x-app-layout>