<x-admin-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Edit Barang</h3>
                    
                    <form method="POST" action="{{ route('admin.barang.update', $barang->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="nama_barang" :value="__('Nama Barang')" />
                            <x-text-input id="nama_barang" class="block mt-1 w-full" type="text" name="nama_barang" :value="old('nama_barang', $barang->nama_barang)" required autofocus />
                            <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="kategori" :value="__('Kategori')" />
                            <x-text-input id="kategori" class="block mt-1 w-full" type="text" name="kategori" :value="old('kategori', $barang->kategori)" required />
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="stok" :value="__('Stok')" />
                            <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok" :value="old('stok', $barang->stok)" required />
                            <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="foto" :value="__('Foto Barang')" />
                            
                            @if($barang->foto)
                                <div class="mt-2 mb-4">
                                    <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                            
                            <input id="foto" type="file" name="foto" class="mt-1 block w-full border p-2 rounded" accept="image/*" />
                            <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto</p>
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.barang.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button>
                                {{ __('Update Barang') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>