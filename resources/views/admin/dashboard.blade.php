<x-admin-layout>
    <div class="flex flex-col">
        <div class="flex-grow py-4 sm:py-8 mt-2 sm:mt-4">
            <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
    
                <!-- Statistik Dashboard -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-6 sm:mb-8 mt-4">
                    <!-- Total Stok Barang -->
                    <div class="bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-3">
                                <div class="h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4zM3 8a2 2 0 00-2 2v6a2 2 0 002 2h14a2 2 0 002-2v-6a2 2 0 00-2-2H3zm6.5 4a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-gray-600 truncate">Total Stock</p>
                                <p class="text-lg sm:text-xl font-bold text-gray-900">{{ $totalBarangs }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Jenis Barang -->
                    <div class="bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-3">
                                <div class="h-10 w-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-gray-600 truncate">Item Type</p>
                                <p class="text-lg sm:text-xl font-bold text-gray-900">{{ $totalJenisBarang }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Barang Masuk -->
                    <div class="bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-3">
                                <div class="h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-gray-600 truncate">Items In</p>
                                <p class="text-lg sm:text-xl font-bold text-gray-900">{{ $barangMasuk }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Barang Keluar -->
                    <div class="bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-3">
                                <div class="h-10 w-10 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" transform="rotate(180 10 10)"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-gray-600 truncate">Items Out</p>
                                <p class="text-lg sm:text-xl font-bold text-gray-900">{{ $barangKeluar }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Peminjaman Aktif -->
                    <div class="bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-3">
                                <div class="h-10 w-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-gray-600 truncate">Active Borrowers</p>
                                <p class="text-lg sm:text-xl font-bold text-gray-900">{{ $activeBorrowers }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Total Pengguna -->
                    <div class="bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-3">
                                <div class="h-10 w-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-6 w-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-gray-600 truncate">Total User</p>
                                <p class="text-lg sm:text-xl font-bold text-gray-900">{{ $totalUser }}</p>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Daftar Peminjaman -->
                <div>
                    <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">List of Borrowers</h2>
                    
                    <!-- Tabel Peminjaman -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <div class="p-4 sm:p-6 text-gray-900">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Borrower</th>
                                                <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Item</th>
                                                <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Return Date</th>
                                                <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase hidden lg:table-cell">Reason</th>
                                                <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                                <th class="px-3 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse($borrowing as $peminjaman)
                                            <tr>
                                                <td class="px-3 sm:px-6 py-4">
                                                    <div class="flex justify-center text-xs sm:text-sm font-medium">{{ $peminjaman->user->name }}</div>
                                                </td>
                                                <td class="px-3 sm:px-6 py-4">
                                                    <div class="flex justify-center text-xs sm:text-sm font-medium">{{ $peminjaman->barang->nama_barang }}</div>
                                                </td>
                                                <td class="px-3 sm:px-6 py-4 hidden md:table-cell">
                                                    <div class="flex justify-center text-xs sm:text-sm font-medium">{{ \Carbon\Carbon::parse($peminjaman->return_due_date)->format('d/m/Y') }}</div>
                                                </td>
                                                <td class="px-3 sm:px-6 py-4 hidden lg:table-cell">
                                                    <div class="flex justify-center">
                                                        <span class="text-xs sm:text-sm text-gray-500">
                                                            {{ Str::limit($peminjaman->reason, 30) ?? 'No reason' }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-3 sm:px-6 py-4">
                                                    <div class="flex justify-center">
                                                    @if($peminjaman->status == 'pending')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            Pending
                                                        </span>
                                                    @elseif($peminjaman->status == 'borrowed')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            Borrowed
                                                        </span>
                                                    @elseif($peminjaman->status == 'returned')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            Returned
                                                        </span>
                                                    @elseif($peminjaman->status == 'rejected')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            Rejected
                                                        </span>
                                                    @endif
                                                    </div>
                                                </td>
                                                <td class="px-3 sm:px-6 py-4">
                                                    <div class="flex items-center justify-center space-x-2 sm:space-x-3">
                                                        <!-- Detail Button -->
                                                        <a href="{{ route('pinjam.show', $peminjaman->id) }}" 
                                                           class="p-1 border border-gray-300 rounded-full text-indigo-600 hover:bg-indigo-100 hover:border-indigo-400 transition-colors duration-200" 
                                                           title="View Details">
                                                            <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                        </a>
                        
                                                        @if($peminjaman->status == 'pending')
                                                            <!-- Approve Button -->
                                                            <button type="button" 
                                                                    onclick="openApprovalModal(
                                                                    '{{ $peminjaman->id }}', 
                                                                    '{{ $peminjaman->user->name }}', 
                                                                    '{{ $peminjaman->user->department }}', 
                                                                    '{{ $peminjaman->user->phone_number }}', 
                                                                    '{{ $peminjaman->barang->serial_number }}', 
                                                                    '{{ $peminjaman->barang->nama_barang }}', 
                                                                    '{{ $peminjaman->borrowed_at }}', 
                                                                    '{{ $peminjaman->return_due_date }}', 
                                                                    '{{ $peminjaman->reason }}')" 
                                                                    class="p-1 border border-gray-300 rounded-full text-green-600 hover:bg-green-100 hover:border-green-400 transition-colors duration-200"
                                                                    title="Approve Borrowing">
                                                                <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </button>
                                                            
                                                            <!-- Reject Button -->
                                                            <button type="button" 
                                                                    onclick="openRejectModal(
                                                                    '{{ $peminjaman->id }}', 
                                                                    '{{ $peminjaman->user->name }}', 
                                                                    '{{ $peminjaman->user->department }}', 
                                                                    '{{ $peminjaman->user->phone_number }}', 
                                                                    '{{ $peminjaman->barang->serial_number }}', 
                                                                    '{{ $peminjaman->barang->nama_barang }}', 
                                                                    '{{ $peminjaman->borrowed_at }}', 
                                                                    '{{ $peminjaman->return_due_date }}', 
                                                                    '{{ $peminjaman->reason }}')" 
                                                                    class="p-1 border border-gray-300 rounded-full text-red-600 hover:bg-red-100 hover:border-red-400 transition-colors duration-200"
                                                                    title="Reject Borrowing">
                                                                <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </button>
                                                        @elseif($peminjaman->status == 'borrowed')
                                                            <!-- Return Button -->
                                                            <form action="{{ route('admin.peminjaman.return', $peminjaman) }}" method="POST" class="inline-flex">
                                                                @csrf
                                                                <button type="submit" 
                                                                        class="p-1 border border-gray-300 rounded-full text-blue-600 hover:bg-blue-100 hover:border-blue-400 transition-colors duration-200" 
                                                                        title="Mark as Returned"
                                                                        onclick="return confirm('Are you sure you want to return this item?')">
                                                                    <svg class="h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="px-3 sm:px-6 py-4 text-center text-gray-500 text-xs sm:text-sm">
                                                    No borrowing data available.
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Pagination -->
                    @if($borrowing->hasPages())
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-4">
                                {{ $borrowing->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Approval -->
    <x-modal name="approval-modal" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-white mb-4">
                <span id="modalTitle">Approve Borrowing</span>
            </h2>
            
            <div class="mb-4 border rounded-lg p-4">
                <h4 class="text-md font-medium mb-2 border-b pb-2 text-white">Borrowing Details</h4>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Borrower:</span>
                    <span id="modal-peminjam" class="text-sm text-white"></span>
                </div>

                <div class="mb-2">
                    <span class="font-medium text-white">Department:</span>
                    <span id="modal-department" class="text-sm text-white"></span>
                </div>

                <div class="mb-2">
                    <span class="font-medium text-white">Phone Number:</span>
                    <span id="modal-phone_number" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Item:</span>
                    <span id="modal-barang" class="text-sm text-white"></span>
                </div>

                <div class="mb-2">
                    <span class="font-medium text-white">Serial Number:</span>
                    <span id="modal-serial-number" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Borrowing Date:</span>
                    <span id="modal-tanggal-pinjam" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Return Date:</span>
                    <span id="modal-tanggal-kembali" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Reason for Borrowing:</span>
                    <p id="modal-reason" class="text-sm text-white mt-1"></p>
                </div>
            </div>
            
            <!-- Tab untuk pilih approve atau reject -->
            <div class="mb-4 border-b border-gray-600">
                <div class="flex">
                    <button type="button" id="tab-approve" 
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-t-md active-tab"
                            onclick="switchTab('approve')">
                        Approve
                    </button>
                    <button type="button" id="tab-reject" 
                            class="px-4 py-2 ml-3 text-sm font-medium text-white bg-gray-600 rounded-t-md"
                            onclick="switchTab('reject')">
                        Reject
                    </button>
                </div>
            </div>
            
            <!-- Form untuk approve -->
            <div id="content-approve" class="mb-4">
                <p class="text-sm text-white mb-4">
                    Are you sure you want to approve this borrowing? This action will reduce the item stock.
                </p>
                
                <div class="mt-6 flex justify-end space-x-4">
                    <button type="button" 
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50" 
                            x-on:click="$dispatch('close')">
                        Close
                    </button>

                    <form id="approval-form" method="POST" action="">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                            Approve
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Form untuk reject -->
            <div id="content-reject" class="mb-4 hidden">
                <form id="reject-form" method="POST" action="">
                    @csrf
                    <div class="mb-4">
                        <label for="reject_reason" class="block text-sm font-medium text-white mb-1">Reason for Rejection <span class="text-red-500">*</span></label>
                        <textarea id="reject_reason" name="reject_reason" rows="3" 
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                  placeholder="Provide a reason for rejecting this borrowing" required></textarea>
                    </div>
                    
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" 
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50" 
                                x-on:click="$dispatch('close')">
                            Close
                        </button>

                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                            Reject Borrowing
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-modal>

    <script>
        function openApprovalModal(id, peminjam, department, phone_number, serialNumber, barang, tanggalPinjam, tanggalKembali, reason) {
            // Reset ke tab approve
            switchTab('approve');
            
            // Set form action
            document.getElementById('approval-form').action = '{{ url("admin/peminjaman") }}/' + id + '/approve';
            document.getElementById('reject-form').action = '{{ url("admin/peminjaman") }}/' + id + '/reject';
            
            // Populate modal data
            populateModalData(peminjam, department, phone_number, serialNumber, barang, tanggalPinjam, tanggalKembali, reason);
            
            // Open modal
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'approval-modal' }));
        }
        
        function openRejectModal(id, peminjam, department, phone_number, serialNumber, barang, tanggalPinjam, tanggalKembali, reason) {
            // Set form action
            document.getElementById('approval-form').action = '{{ url("admin/peminjaman") }}/' + id + '/approve';
            document.getElementById('reject-form').action = '{{ url("admin/peminjaman") }}/' + id + '/reject';
            
            // Populate modal data
            populateModalData(peminjam, department, phone_number, serialNumber, barang, tanggalPinjam, tanggalKembali, reason);
            
            // Langsung switch ke tab reject
            switchTab('reject');
            
            // Open modal
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'approval-modal' }));
        }
        
        function populateModalData(peminjam, department, phone_number, serialNumber, barang, tanggalPinjam, tanggalKembali, reason) {
            // Populate modal data
            document.getElementById('modal-peminjam').textContent = peminjam || 'N/A';
            document.getElementById('modal-department').textContent = department || 'N/A';
            document.getElementById('modal-phone_number').textContent = phone_number || 'N/A';
            document.getElementById('modal-serial-number').textContent = serialNumber || 'N/A';
            document.getElementById('modal-barang').textContent = barang;
            document.getElementById('modal-tanggal-pinjam').textContent = formatDate(tanggalPinjam);
            document.getElementById('modal-tanggal-kembali').textContent = formatDate(tanggalKembali);
            document.getElementById('modal-reason').textContent = reason || 'N/A';

            // Reset form reject
            document.getElementById('reject_reason').value = '';
        }
        
        function switchTab(tab) {
            // Update tab buttons
            document.getElementById('tab-approve').classList.remove('bg-green-600', 'bg-gray-600');
            document.getElementById('tab-reject').classList.remove('bg-red-600', 'bg-gray-600');
            
            if (tab === 'approve') {
                document.getElementById('tab-approve').classList.add('bg-green-600');
                document.getElementById('tab-reject').classList.add('bg-gray-600');
                document.getElementById('content-approve').classList.remove('hidden');
                document.getElementById('content-reject').classList.add('hidden');
            } else {
                document.getElementById('tab-approve').classList.add('bg-gray-600');
                document.getElementById('tab-reject').classList.add('bg-red-600');
                document.getElementById('content-approve').classList.add('hidden');
                document.getElementById('content-reject').classList.remove('hidden');
            }
        }
        
        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }
    </script>
    
    <!-- Footer -->
    <footer class="w-full border-t border-gray-200 mt-8">
        <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between"> 
                <div class="mt-4 md:mt-0 flex items-center justify-center md:justify-end">
                    <div class="text-xs sm:text-sm text-gray-500">
                        &copy; {{ date('Y') }} Sistem Peminjaman Barang. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</x-admin-layout>