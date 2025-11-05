<x-admin-layout>
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-4 sm:py-8 mt-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('admin.movements.index') }}" 
                       class="inline-flex items-center px-3 sm:px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back
                    </a>
                </div>
    
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6 text-gray-900">
                        <h3 class="text-lg sm:text-xl font-medium mb-4 sm:mb-6">Item Movement Details</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Informasi Barang -->
                            <div class="border rounded-lg p-4">
                                <h4 class="text-sm sm:text-md font-medium mb-3 sm:mb-4 border-b pb-2">Item Information</h4>
                                
                                <div class="flex flex-col sm:flex-row items-start sm:items-center mb-4">
                                    @if($movement->barang->foto)
                                        <img src="{{ asset('storage/' . $movement->barang->foto) }}" 
                                             alt="{{ $movement->barang->nama_barang }}" 
                                             class="w-20 h-20 object-cover mb-3 sm:mb-0 sm:mr-4 border rounded mx-auto sm:mx-0">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 flex items-center justify-center rounded mb-3 sm:mb-0 sm:mr-4 mx-auto sm:mx-0">
                                            <span class="text-gray-500 text-xs">No Photo</span>
                                        </div>
                                    @endif
                                    
                                    <div class="text-center sm:text-left w-full">
                                        <p class="font-semibold text-base sm:text-lg break-words">{{ $movement->barang->nama_barang }}</p>
                                        <p class="text-xs sm:text-sm text-gray-600 mt-1">Category: {{ $movement->barang->kategori }}</p>
                                        <p class="text-xs sm:text-sm text-gray-600">Current Stock: {{ $movement->barang->stok }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Informasi Pergerakan -->
                            <div class="border rounded-lg p-4">
                                <h4 class="text-sm sm:text-md font-medium mb-3 sm:mb-4 border-b pb-2">Movement Information</h4>
                                
                                <div class="space-y-3">
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-0 sm:w-1/3">Type:</span>
                                        <span class="font-medium sm:w-2/3">
                                            @if($movement->type == 'in')
                                                <span class="inline-flex items-center text-green-600 bg-green-100 px-2 py-1 rounded-full text-xs">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                                                    </svg>
                                                    In
                                                </span>
                                            @else
                                                <span class="inline-flex items-center text-red-600 bg-red-100 px-2 py-1 rounded-full text-xs">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                                                    </svg>
                                                    Out
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-0 sm:w-1/3">Quantity:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-2/3">{{ $movement->quantity }}</span>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-0 sm:w-1/3">Date:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-2/3">{{ $movement->date->format('d/m/Y') }}</span>
                                    </div>
                                    
                                    @if($movement->type == 'in' && $movement->source)
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-0 sm:w-1/3">Source:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-2/3 break-words">{{ $movement->source }}</span>
                                    </div>
                                    @endif
                                    
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-0 sm:w-1/3">Reason:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-2/3 break-words">{{ $movement->reason }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Informasi Tambahan -->
                            <div class="border rounded-lg p-4 md:col-span-2">
                                <h4 class="text-sm sm:text-md font-medium mb-3 sm:mb-4 border-b pb-2">Additional Information</h4>
                                
                                <div class="space-y-3">
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-0 sm:w-1/4">Recorded By:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-3/4 break-words">{{ $movement->user->name }}</span>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-0 sm:w-1/4">Recording Time:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-3/4">{{ $movement->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    
                                    @if($movement->notes)
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-0 sm:w-1/4">Notes:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-3/4 break-words">{{ $movement->notes }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-xs sm:text-sm text-gray-500">
                &copy; {{ date('Y') }} Sistem Peminjaman Barang. All rights reserved.
            </div>
        </div>
    </footer>
</x-admin-layout>