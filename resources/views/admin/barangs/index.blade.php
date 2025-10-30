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
                            <!-- Header dengan Title, Filter, dan Add Button -->
                            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-4 gap-4">
                                <h3 class="text-lg font-medium">Item List</h3>
                                
                                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full lg:w-auto">
                                    <!-- Category Filter -->
                                    <div class="flex items-center gap-2 w-full sm:w-auto">
                                        <label for="categoryFilter" class="text-sm font-medium text-gray-700 whitespace-nowrap">
                                            Filter:
                                        </label>
                                        <form method="GET" action="{{ route('admin.barang.index') }}" id="filterForm" class="flex items-center gap-2 flex-1 sm:flex-none">
                                            <select 
                                                id="categoryFilter" 
                                                name="kategori" 
                                                onchange="document.getElementById('filterForm').submit()"
                                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm py-2 px-3 min-w-[150px]">
                                                <option value="all" {{ (!request('kategori') || request('kategori') == 'all') ? 'selected' : '' }}>
                                                    All Categories
                                                </option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                                                        {{ $category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                            @if(request('kategori') && request('kategori') !== 'all')
                                                <a href="{{ route('admin.barang.index') }}" 
                                                   class="inline-flex items-center px-2 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-medium rounded-md transition-colors duration-200"
                                                   title="Clear Filter">
                                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </form>
                                    </div>

                                    <!-- Add Item Button -->
                                    <a href="{{ route('admin.barang.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded whitespace-nowrap w-full sm:w-auto text-center">
                                        Add Item
                                    </a>
                                </div>
                            </div>

                            <!-- Filter Info Badge (Optional) -->
                            @if(request('kategori') && request('kategori') !== 'all')
                                <div class="mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                        </svg>
                                        Filtered by: {{ request('kategori') }}
                                    </span>
                                </div>
                            @endif
        
                            <!-- Tabel barang -->
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
                                                        <div class="flex items-center justify-center space-x-3">
                                                            <!-- Details Button -->
                                                            <button type="button" 
                                                                onclick="showModal('{{ $barang->id }}')"
                                                                class="p-1 border border-gray-300 rounded-full text-blue-600 hover:bg-blue-100 hover:border-blue-400 transition-colors duration-200"
                                                                title="View Details">
                                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg>
                                                            </button>
                                                            
                                                            <!-- Edit Button -->
                                                            <a href="{{ route('admin.barang.edit', $barang->id) }}" 
                                                               class="p-1 border border-gray-300 rounded-full text-indigo-600 hover:bg-indigo-100 hover:border-indigo-400 transition-colors duration-200"
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
                                                                        class="p-1 border border-gray-300 rounded-full text-red-600 hover:bg-red-100 hover:border-red-400 transition-colors duration-200"
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
                                                            <h3 class="text-sm font-medium text-gray-900 mb-1">
                                                                @if(request('kategori') && request('kategori') !== 'all')
                                                                    No items found in "{{ request('kategori') }}" category
                                                                @else
                                                                    No item data available
                                                                @endif
                                                            </h3>
                                                            <p class="text-sm text-gray-500">
                                                                @if(request('kategori') && request('kategori') !== 'all')
                                                                    Try selecting a different category or clear the filter.
                                                                @else
                                                                    Start by adding your first item.
                                                                @endif
                                                            </p>
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
                                {{ $barangs->appends(['kategori' => request('kategori')])->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Detail Barang -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex flex-col">
                <div class="flex justify-between items-center pb-4 border-b mb-4">
                    <h3 class="text-xl font-medium text-gray-900" id="modalTitle">Item Details</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal()">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Loading State -->
                <div id="modalLoading" class="text-center py-8">
                    <svg class="animate-spin h-8 w-8 mx-auto text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="mt-2 text-gray-600">Loading...</p>
                </div>
                
                <!-- Modal Content -->
                <div id="modalContent" class="mt-2 hidden">
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Item Info -->
                        <div class="md:w-1/2">
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
                                    <p class="text-base" id="productSerial">-</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Stock</p>
                                    <span id="productStockContainer"></span>
                                </div>
                            </div>
                            
                            <!-- Item Image -->
                            <div class="mt-4" id="productImageContainer">
                                <!-- Product image will be loaded here -->
                            </div>
                        </div>
                        
                        <!-- QR Code Section -->
                        <div class="md:w-1/2">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-semibold mb-3 text-gray-700">QR Code</h4>
                                <div id="qrCodeContainer" class="flex flex-col items-center">
                                    <div class="bg-white p-3 rounded shadow-sm mb-2">
                                        <!-- QR Code SVG will be loaded here -->
                                    </div>
                                    <p class="text-xs font-mono text-gray-600" id="qrCodeText">-</p>
                                </div>
                                <button onclick="printModalQr()" class="mt-3 w-full bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                    </svg>
                                    Print QR Code
                                </button>
                            </div>
                            
                            <!-- Usage Info -->
                            <div class="mt-4 bg-blue-50 p-3 rounded-lg">
                                <h5 class="font-semibold text-blue-900 text-sm mb-2">How to Use:</h5>
                                <ul class="text-xs text-blue-800 space-y-1 list-disc list-inside">
                                    <li>Scan when picking up items</li>
                                    <li>Scan when returning items</li>
                                    <li>Print and attach to physical item</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 border-t pt-4">
                    <button class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md w-full sm:w-auto hover:bg-gray-300 transition-colors" onclick="closeModal()">
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
            // Buka modal dan tampilkan loading
            const modal = document.getElementById('detailModal');
            const loading = document.getElementById('modalLoading');
            const content = document.getElementById('modalContent');
            
            modal.classList.remove('hidden');
            loading.classList.remove('hidden');
            content.classList.add('hidden');
            
            // Fetch item details
            fetch(`/admin/barang/${id}/details`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Update item details
                    document.getElementById('modalTitle').innerText = 'Item Details: ' + data.nama_barang;
                    document.getElementById('productName').innerText = data.nama_barang;
                    document.getElementById('productCategory').innerText = data.kategori;
                    document.getElementById('productSerial').innerText = data.serial_number || '-';
                    
                    // Update stock with badge
                    const stockBadgeClass = data.stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                    document.getElementById('productStockContainer').innerHTML = `
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium ${stockBadgeClass}">
                            ${data.stok}
                        </span>
                    `;
                    // Load QR Code
                    return fetch(`/admin/barang/${id}/qr-code`);
                })
                .then(response => response.json())
                .then(qrData => {
                    // Render QR Code SVG
                    const qrContainer = document.getElementById('qrCodeContainer');
                    qrContainer.querySelector('.bg-white').innerHTML = qrData.qr_code;
                    document.getElementById('qrCodeText').innerText = qrData.code;
                    
                    // Sembunyikan loading, tampilkan content
                    loading.classList.add('hidden');
                    content.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching item details:', error);
                    loading.classList.add('hidden');
                    content.innerHTML = `
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="mt-2 text-red-600">Failed to load item details</p>
                            <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                                Close
                            </button>
                        </div>
                    `;
                    content.classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
        
        function printModalQr() {
            const qrContent = document.getElementById('qrCodeContainer').innerHTML;
            const qrCode = document.getElementById('qrCodeText').innerText;
            const itemName = document.getElementById('productName').innerText;
            
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print QR Code - ' + qrCode + '</title>');
            printWindow.document.write('<style>');
            printWindow.document.write('body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }');
            printWindow.document.write('h2 { margin-bottom: 20px; }');
            printWindow.document.write('svg { max-width: 300px; height: auto; }');
            printWindow.document.write('.qr-code { margin: 20px 0; }');
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write('<h2>' + itemName + '</h2>');
            printWindow.document.write('<div class="qr-code">' + qrContent + '</div>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            
            // Tunggu sebentar agar content ter-load
            setTimeout(() => {
                printWindow.print();
            }, 250);
        }

        // Tutup modal jika mengklik area di luar modal
        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target == modal) {
                closeModal();
            }
        }
        
        // Tutup modal dengan ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</x-admin-layout>