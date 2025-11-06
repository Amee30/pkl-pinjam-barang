<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight">
            {{ __('Submit Borrowing Request') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-white">
                    <form method="POST" action="{{ route('pinjam.store') }}">
                        @csrf
                        
                        <input type="hidden" name="barang_id" value="{{ $barangs->id }}">
                        <input type="hidden" name="borrowed_at" value="{{ date('Y-m-d') }}">
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-medium mb-2 text-gray-900 dark:text-white">Item Details</h3>
                            <div class="flex items-center mb-4 gap-4">
                                @if($barangs->foto)
                                    <img src="{{ asset('storage/' . $barangs->foto) }}" alt="{{ $barangs->nama_barang }}" class="w-20 h-20 object-contain border border-gray-300 dark:border-gray-600 rounded">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center">
                                        <span class="text-gray-500 dark:text-gray-400 text-xs">No Photo</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-lg text-gray-900 dark:text-white">{{ $barangs->nama_barang }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Category: {{ $barangs->kategori }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Serial Number: {{ $barangs->serial_number ?? 'No Serial Number' }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Available Stock: {{ $barangs->stok }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="return_due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Date Returning <span class="text-red-500">*</span>
                            </label>
                            <x-text-input id="return_due_date" 
                                class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400" 
                                type="date" 
                                name="return_due_date" 
                                :value="old('return_due_date', date('Y-m-d', strtotime('now')))" 
                                required />
                            <x-input-error :messages="$errors->get('return_due_date')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Purpose of Borrowing <span class="text-red-500">*</span>
                            </label>
                            <textarea id="reason" 
                                name="reason" 
                                rows="4" 
                                class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-md shadow-sm" 
                                required 
                                placeholder="Enter the purpose of borrowing">{{ old('reason') }}</textarea>
                            <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-6 gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('dashboard') }}" 
                               class="px-6 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-lg transition-colors">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button class="px-6 py-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ __('Submit Borrowing Request') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>