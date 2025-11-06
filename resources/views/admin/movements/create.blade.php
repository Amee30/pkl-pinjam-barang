<x-admin-layout>
    <x-slot name="title">
        Add Item Movement
    </x-slot>

    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-8 mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.movements.index') }}" 
                       class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Movement History
                    </a>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6 text-gray-900 dark:text-white">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Add Item Movement</h3>
                        </div>
                        
                        <form method="POST" action="{{ route('admin.movements.store') }}" class="space-y-6">
                            @csrf
    
                            <div>
                               <label for="barang_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                   Select Item <span class="text-red-500">*</span>
                               </label>
                                <select id="barang_id" 
                                        name="barang_id" 
                                        class="bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-green-400 focus:ring-green-500 dark:focus:ring-green-400 rounded-md shadow-sm block mt-1 w-full" 
                                        required>
                                    <option value="">-- Select Item --</option>
                                    @foreach($barangs as $barang)
                                        <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                            {{ $barang->nama_barang }} (Stock: {{ $barang->stok }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('barang_id')" class="mt-2" />
                            </div>
    
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Movement Type <span class="text-red-500">*</span>
                                </label>
                                <select id="type" 
                                        name="type" 
                                        class="bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-green-400 focus:ring-green-500 dark:focus:ring-green-400 rounded-md shadow-sm block mt-1 w-full" 
                                        required>
                                    <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>In (Item Masuk)</option>
                                    <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>Out (Item Keluar)</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>
    
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <x-text-input id="quantity" 
                                    class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-green-400 focus:ring-green-500 dark:focus:ring-green-400" 
                                    type="number" 
                                    name="quantity" 
                                    :value="old('quantity')" 
                                    min="1" 
                                    required 
                                    placeholder="Enter quantity" />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                            </div>
    
                            <div id="source-container">
                                <label for="source" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Source/Origin Item
                                </label>
                                <x-text-input id="source" 
                                    class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-green-400 focus:ring-green-500 dark:focus:ring-green-400" 
                                    type="text" 
                                    name="source" 
                                    :value="old('source')" 
                                    placeholder="Enter source location or supplier" />
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Required when movement type is "In"
                                </p>
                                <x-input-error :messages="$errors->get('source')" class="mt-2" />
                            </div>
    
                            <div>
                                <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Reason <span class="text-red-500">*</span>
                                </label>
                                <x-text-input id="reason" 
                                    class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-green-400 focus:ring-green-500 dark:focus:ring-green-400" 
                                    type="text" 
                                    name="reason" 
                                    :value="old('reason')" 
                                    required 
                                    placeholder="Enter reason for movement" />
                                <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                            </div>
    
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Date <span class="text-red-500">*</span>
                                </label>
                                <x-text-input id="date" 
                                    class="block mt-1 w-full bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-green-400 focus:ring-green-500 dark:focus:ring-green-400" 
                                    type="date" 
                                    name="date" 
                                    :value="old('date', date('Y-m-d'))" 
                                    required />
                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                            </div>
    
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Additional Notes
                                </label>
                                <textarea id="notes" 
                                    name="notes" 
                                    class="bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-green-400 focus:ring-green-500 dark:focus:ring-green-400 rounded-md shadow-sm block mt-1 w-full" 
                                    rows="3"
                                    placeholder="Enter additional notes (optional)">{{ old('notes') }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>
    
                            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('admin.movements.index') }}" 
                                   class="px-6 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-lg transition-colors">
                                    Cancel
                                </a>
                                <x-primary-button class="px-6 py-2 bg-green-600 hover:bg-green-700">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Save Movement
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>

    <script>
        // Toggle visibility of source field based on type
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const sourceContainer = document.getElementById('source-container');
            
            function toggleSourceVisibility() {
                if (typeSelect.value === 'in') {
                    sourceContainer.style.display = 'block';
                } else {
                    sourceContainer.style.display = 'none';
                }
            }
            
            toggleSourceVisibility();
            typeSelect.addEventListener('change', toggleSourceVisibility);
        });
    </script>
</x-admin-layout>