<x-admin-layout>
    <x-slot name="title">
        Movement Details
    </x-slot>

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-4 sm:py-8 mt-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('admin.movements.index') }}" 
                       class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Movement History
                    </a>
                </div>
    
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-4 sm:p-6 text-gray-900 dark:text-white">
                        <div class="flex items-center mb-4 sm:mb-6">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 dark:text-white">Item Movement Details</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Informasi Barang -->
                            <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 bg-gray-50 dark:bg-gray-700/50">
                                <h4 class="text-sm sm:text-md font-medium mb-3 sm:mb-4 pb-2 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white">Item Information</h4>
                                
                                <div class="flex flex-col sm:flex-row items-start sm:items-center mb-4">
                                    @if($movement->barang->foto)
                                        <img src="{{ asset('storage/' . $movement->barang->foto) }}" 
                                             alt="{{ $movement->barang->nama_barang }}" 
                                             class="w-20 h-20 object-cover mb-3 sm:mb-0 sm:mr-4 border border-gray-300 dark:border-gray-600 rounded mx-auto sm:mx-0">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 dark:bg-gray-600 flex items-center justify-center rounded mb-3 sm:mb-0 sm:mr-4 mx-auto sm:mx-0">
                                            <span class="text-gray-500 dark:text-gray-400 text-xs">No Photo</span>
                                        </div>
                                    @endif
                                    
                                    <div class="text-center sm:text-left w-full">
                                        <p class="font-semibold text-base sm:text-lg break-words text-gray-900 dark:text-white">{{ $movement->barang->nama_barang }}</p>
                                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Category: {{ $movement->barang->kategori }}</p>
                                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Current Stock: {{ $movement->barang->stok }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Informasi Pergerakan -->
                            <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 bg-gray-50 dark:bg-gray-700/50">
                                <h4 class="text-sm sm:text-md font-medium mb-3 sm:mb-4 pb-2 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white">Movement Information</h4>
                                
                                <div class="space-y-3">
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-1 sm:mb-0 sm:w-1/3">Type:</span>
                                        <span class="font-medium sm:w-2/3">
                                            @if($movement->type == 'in')
                                                <span class="inline-flex items-center text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900/50 px-2 py-1 rounded-full text-xs">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                                                    </svg>
                                                    In
                                                </span>
                                            @else
                                                <span class="inline-flex items-center text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900/50 px-2 py-1 rounded-full text-xs">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                                                    </svg>
                                                    Out
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-1 sm:mb-0 sm:w-1/3">Quantity:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-2/3 text-gray-900 dark:text-white">{{ $movement->quantity }}</span>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-1 sm:mb-0 sm:w-1/3">Date:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-2/3 text-gray-900 dark:text-white">{{ $movement->date->format('d/m/Y') }}</span>
                                    </div>
                                    
                                    @if($movement->type == 'in' && $movement->source)
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-1 sm:mb-0 sm:w-1/3">Source:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-2/3 break-words text-gray-900 dark:text-white">{{ $movement->source }}</span>
                                    </div>
                                    @endif
                                    
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-1 sm:mb-0 sm:w-1/3">Reason:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-2/3 break-words text-gray-900 dark:text-white">{{ $movement->reason }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Informasi Tambahan -->
                            <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 md:col-span-2 bg-gray-50 dark:bg-gray-700/50">
                                <h4 class="text-sm sm:text-md font-medium mb-3 sm:mb-4 pb-2 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white">Additional Information</h4>
                                
                                <div class="space-y-3">
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-1 sm:mb-0 sm:w-1/4">Recorded By:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-3/4 break-words text-gray-900 dark:text-white">{{ $movement->user->name }}</span>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-1 sm:mb-0 sm:w-1/4">Recording Time:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-3/4 text-gray-900 dark:text-white">{{ $movement->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    
                                    @if($movement->notes)
                                    <div class="flex flex-col sm:flex-row">
                                        <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-1 sm:mb-0 sm:w-1/4">Notes:</span>
                                        <span class="text-sm sm:text-base font-medium sm:w-3/4 break-words text-gray-900 dark:text-white">{{ $movement->notes }}</span>
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
</x-admin-layout>