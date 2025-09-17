<x-admin-layout>
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Tambah Pergerakan Barang</h3>
                        
                        <form method="POST" action="{{ route('admin.movements.store') }}">
                            @csrf
    
                            <div>
                               <label for="barang_id" :value="__('Pilih Barang')" class="text-black">Pilih Barang</label>
                                <select id="barang_id" name="barang_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach($barangs as $barang)
                                        <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                            {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('barang_id')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <label for="type" :value="__('Tipe Pergerakan')" class="text-black">Tipe Pergerakan</label>
                                <select id="type" name="type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                    <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>Masuk</option>
                                    <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>Keluar</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <label for="quantity" :value="__('Jumlah')" class="text-black">Jumlah</label>
                                <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity')" min="1" required />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                            </div>
    
                            <div class="mt-4" id="source-container">
                                <label for="source" :value="__('Sumber/Asal Barang')" class="text-black">Sumber/Asal Barang</label>
                                <x-text-input id="source" class="block mt-1 w-full" type="text" name="source" :value="old('source')" />
                                <x-input-error :messages="$errors->get('source')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <label for="reason" class="text-black">Alasan</label>
                                <x-text-input id="reason" class="block mt-1 w-full" type="text" name="reason" :value="old('reason')" required />
                                <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <label for="date" class="text-black">Tanggal</label>
                                <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <label for="notes" class="text-black">Catatan Tambahan</label>
                                <textarea id="notes" name="notes" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" rows="3">{{ old('notes') }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>
    
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('admin.movements.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                    {{ __('Batal') }}
                                </a>
                                <x-primary-button>
                                    {{ __('Simpan') }}
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