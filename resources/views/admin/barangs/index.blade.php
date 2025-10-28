<x-admin-layout>
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-8 mt-4">
            <div class="w-full mx-auto sm:px-6 lg:px-8 flex-grow">
                {{-- Menampilkan pesan sukses jika ada --}}
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
    
                <div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="flex justify-between mb-4">
                                <h3 class="text-lg font-medium">Item List</h3>
                                <a href="{{ route('admin.barang.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Add Item
                                </a>
                            </div>
        
                            <!-- Tabel barang dengan lebar penuh -->
                            <div class="overflow-x-auto">
                                <div class="inline-block min-w-full align-middle">
                                    <div class="p-4 sm:p-6 text-gray-900">

                                        <table class="min-w-full divide-y bg-white border-collapse">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Photo</th>
                                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Item Name</th>
                                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Category</th>
                                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Stock</th>
                                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @forelse($barangs as $barang)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                                        @if($barang->foto)
                                                            <div class="flex justify-center">
                                                                <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}" class="w-20 h-20 object-cover rounded-lg shadow-sm">
                                                            </div>
                                                        @else
                                                            <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center mx-auto">
                                                                <span class="text-gray-500 text-xs">No Image</span>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="flex justify-center text-sm font-medium text-gray-900">{{ $barang->nama_barang }}</div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <span class="flex justify-center items-center px-2.5 py-0.5 rounded-full text-sm font-medium">
                                                            {{ $barang->kategori }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <span class="flex justify-center items-center px-2.5 py-0.5 rounded-full text-sm font-medium 
                                                            {{ $barang->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                            {{ $barang->stok }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                                        <div class="flex items-center justify-center space-x-2">
                                                            <!-- Details Button -->
                                                            <button type="button" 
                                                                onclick="showModal('{{ $barang->id }}')"
                                                                class="p-1 border rounded-full text-blue-600 hover:text-blue-900"
                                                                title="View Details">
                                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg>
                                                            </button>
                                                            
                                                            <!-- Edit Button -->
                                                            <a href="{{ route('admin.barang.edit', $barang->id) }}" 
                                                               class="p-1 border rounded-full text-indigo-600 hover:text-indigo-900"
                                                               title="Edit Item">
                                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                            </a>
            
                                                            <!-- Delete Button -->
                                                            <form action="{{ route('admin.barang.destroy', $barang->id) }}" 
                                                                  method="POST" 
                                                                  class="inline-flex"
                                                                  onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="p-1 border rounded-full text-red-600 hover:text-red-900"
                                                                        title="Delete Item">
                                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                                        <div class="flex flex-col items-center">
                                                            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8l-4 4-3-3-6 6"></path>
                                                            </svg>
                                                            <h3 class="text-sm font-medium text-gray-900 mb-1">Belum ada data barang</h3>
                                                            <p class="text-sm text-gray-500">Mulai dengan menambahkan barang pertama Anda.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Pagination Links -->
                            </div>
                        </div>
                    </div> 
                    
                    @if($barangs->hasPages())
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                            <div class="p-4">
                                {{ $barangs->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Detail Barang -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex flex-col">
                <div class="flex justify-between items-center pb-4 border-b mb-4">
                    <h3 class="text-xl font-medium text-gray-900" id="modalTitle">Detail Barang</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal()">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="modalContent" class="mt-2">
                    <!-- Konten detail akan dimuat di sini -->
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-2/3">
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Item Name</p>
                                    <p class="text-lg font-semibold" id="productName">-</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Category</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800" id="productCategory">-</span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Serial Number</p>
                                    <p class="text-md" id="productSerial">-</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Stock</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" id="productStock">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 border-t pt-4">
                    <button class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md w-full sm:w-auto sm:text-sm" onclick="closeModal()">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class=" border-t border-gray-200 mt-8">
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

    <!-- JavaScript untuk Modal -->
    <script>
        function showModal(id) {
            // Ambil data barang dengan AJAX
            fetch(`/admin/barang/${id}/details`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Isi konten modal dengan data barang
                    document.getElementById('modalTitle').innerText = 'Item Details: ' + data.nama_barang;
                    document.getElementById('productName').innerText = data.nama_barang;
                    document.getElementById('productCategory').innerText = data.kategori;
                    document.getElementById('productSerial').innerText = data.serial_number || 'N/A';
                    
                    const stockElement = document.getElementById('productStock');
                    stockElement.innerText = data.stok;
                    if (data.stok > 0) {
                        stockElement.classList.add('bg-green-100', 'text-green-800');
                        stockElement.classList.remove('bg-red-100', 'text-red-800');
                    } else {
                        stockElement.classList.add('bg-red-100', 'text-red-800');
                        stockElement.classList.remove('bg-green-100', 'text-green-800');
                    }
                    
                    // Tampilkan modal
                    document.getElementById('detailModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    alert('Error: ' + error.message);
                });
        }
        
        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
        
        // Tutup modal jika mengklik area di luar modal
        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</x-admin-layout>