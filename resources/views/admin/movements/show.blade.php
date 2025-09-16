<x-admin-layout>
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-4">
                    <a href="{{ route('admin.movements.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>
    
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-6">Detail Pergerakan Barang</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Informasi Barang -->
                            <div class="border rounded-lg p-4">
                                <h4 class="text-md font-medium mb-4 border-b pb-2">Informasi Barang</h4>
                                
                                <div class="flex items-center mb-4">
                                    @if($movement->barang->foto)
                                        <img src="{{ asset('storage/' . $movement->barang->foto) }}" alt="{{ $movement->barang->nama_barang }}" class="w-20 h-20 object-contain mr-4 border rounded">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 flex items-center justify-center rounded mr-4">
                                            <span class="text-gray-500 text-xs">Tidak ada foto</span>
                                        </div>
                                    @endif
                                    
                                    <div>
                                        <p class="font-semibold text-lg">{{ $movement->barang->nama_barang }}</p>
                                        <p class="text-sm text-gray-600">Kategori: {{ $movement->barang->kategori }}</p>
                                        <p class="text-sm text-gray-600">Stok Saat Ini: {{ $movement->barang->stok }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Informasi Pergerakan -->
                            <div class="border rounded-lg p-4">
                                <h4 class="text-md font-medium mb-4 border-b pb-2">Informasi Pergerakan</h4>
                                
                                <div class="mb-2 flex">
                                    <span class="w-1/3 text-gray-600">Tipe:</span>
                                    <span class="w-2/3 font-medium">
                                        @if($movement->type == 'in')
                                            <span class="text-green-600 bg-green-100 px-2 py-1 rounded-full text-xs">Masuk</span>
                                        @else
                                            <span class="text-red-600 bg-red-100 px-2 py-1 rounded-full text-xs">Keluar</span>
                                        @endif
                                    </span>
                                </div>
                                
                                <div class="mb-2 flex">
                                    <span class="w-1/3 text-gray-600">Jumlah:</span>
                                    <span class="w-2/3 font-medium">{{ $movement->quantity }}</span>
                                </div>
                                
                                <div class="mb-2 flex">
                                    <span class="w-1/3 text-gray-600">Tanggal:</span>
                                    <span class="w-2/3 font-medium">{{ $movement->date->format('d/m/Y') }}</span>
                                </div>
                                
                                @if($movement->type == 'in' && $movement->source)
                                <div class="mb-2 flex">
                                    <span class="w-1/3 text-gray-600">Sumber:</span>
                                    <span class="w-2/3 font-medium">{{ $movement->source }}</span>
                                </div>
                                @endif
                                
                                <div class="mb-2 flex">
                                    <span class="w-1/3 text-gray-600">Alasan:</span>
                                    <span class="w-2/3 font-medium">{{ $movement->reason }}</span>
                                </div>
                            </div>
                            
                            <!-- Informasi Tambahan -->
                            <div class="border rounded-lg p-4 md:col-span-2">
                                <h4 class="text-md font-medium mb-4 border-b pb-2">Informasi Tambahan</h4>
                                
                                <div class="mb-2 flex">
                                    <span class="w-1/4 text-gray-600">Pencatat:</span>
                                    <span class="w-3/4 font-medium">{{ $movement->user->name }}</span>
                                </div>
                                
                                <div class="mb-2 flex">
                                    <span class="w-1/4 text-gray-600">Waktu Pencatatan:</span>
                                    <span class="w-3/4 font-medium">{{ $movement->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                
                                @if($movement->notes)
                                <div class="mb-2 flex">
                                    <span class="w-1/4 text-gray-600">Catatan:</span>
                                    <span class="w-3/4 font-medium">{{ $movement->notes }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
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
</x-admin-layout>