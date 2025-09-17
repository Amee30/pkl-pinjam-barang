<x-admin-layout>
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-8">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
    
                <!-- Statistik Dashboard - Flexbox Layout -->
                <div class="flex flex-wrap gap-4 mb-8 mt-4">
                    <!-- Total Stok Barang -->
                    <div class="flex-1 min-w-48 bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-4">
                                <div class="h-8 w-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4zM3 8a2 2 0 00-2 2v6a2 2 0 002 2h14a2 2 0 002-2v-6a2 2 0 00-2-2H3zm6.5 4a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-1">
                                <p class="text-sm font-medium text-gray-600">Total Stok</p>
                                <p class="text-xl font-bold text-gray-900">{{ $totalBarangs }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Jenis Barang -->
                    <div class="flex-1 min-w-48 bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-4">
                                <div class="h-8 w-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-1">
                                <p class="text-sm font-medium text-gray-600">Jenis barang</p>
                                <p class="text-xl font-bold text-gray-900">{{ $totalJenisBarang }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Barang Masuk -->
                    <div class="flex-1 min-w-48 bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-4">
                                <div class="h-8 w-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-1">
                                <p class="text-sm font-medium text-gray-600">Barang masuk</p>
                                <p class="text-xl font-bold text-gray-900">{{ $barangMasuk }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Barang Keluar -->
                    <div class="flex-1 min-w-48 bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-4">
                                <div class="h-8 w-8 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" transform="rotate(180 10 10)"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-1">
                                <p class="text-sm font-medium text-gray-600">Barang keluar</p>
                                <p class="text-xl font-bold text-gray-900">{{ $barangKeluar }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Peminjaman Aktif -->
                    <div class="flex-1 min-w-48 bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-4">
                                <div class="h-8 w-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-1">
                                <p class="text-sm font-medium text-gray-600">Peminjam aktif</p>
                                <p class="text-xl font-bold text-gray-900">{{ $activeBorrowers }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Total Pengguna -->
                    <div class="flex-1 min-w-48 bg-white overflow-hidden shadow rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-4">
                                <div class="h-8 w-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-1">
                                <p class="text-sm font-medium text-gray-600">Total pengguna</p>
                                <p class="text-xl font-bold text-gray-900">{{ $totalUser }}</p>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Daftar Peminjaman -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mt-4 mb-4">Daftar Peminjaman</h2>
                    
                    <!-- Tabel Peminjaman -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-6 text-gray-900">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peminjam</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Barang</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Kembali</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alasan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($borrowing as $peminjaman)
                                    <tr>
                                        <td class="px-6 py-4">{{ $peminjaman->user->name }}</td>
                                        <td class="px-6 py-4">{{ $peminjaman->barang->nama_barang }}</td>
                                        <td class="px-6 py-4">{{ $peminjaman->return_due_date }}</td>
                                        <td class="px-6 py-4">
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
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-500">
                                                {{ Str::limit($peminjaman->reason, 50) ?? 'Tidak ada alasan' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 flex flex-col space-x-2">
                                            <a href="{{ route('pinjam.show', $peminjaman->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
            
                                            @if($peminjaman->status == 'pending')
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
                                                        class="text-green-600 hover:text-green-900">
                                                    Approve
                                                </button>
                                            @elseif($peminjaman->status == 'borrowed')
                                                <form action="{{ route('admin.peminjaman.return', $peminjaman) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-blue-600 hover:text-blue-900" onclick="return confirm('Apakah anda yakin ingin mengembalikan barang ini?')">Return</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada data peminjaman.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
        
                    <!-- Pagination links dengan styling yang konsisten -->
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
                Detail Permintaan Peminjaman
            </h2>
            
            <div class="mb-4 border rounded-lg p-4">
                <h4 class="text-md font-medium mb-2 border-b pb-2 text-white">Detail Peminjaman</h4>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Peminjam:</span>
                    <span id="modal-peminjam" class="text-sm text-white"></span>
                </div>

                <div class="mb-2">
                    <span class="font-medium text-white">Departemen:</span>
                    <span id="modal-department" class="text-sm text-white"></span>
                </div>

                <div class="mb-2">
                    <span class="font-medium text-white">Nomer Telepon:</span>
                    <span id="modal-phone_number" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Barang:</span>
                    <span id="modal-barang" class="text-sm text-white"></span>
                </div>

                <div class="mb-2">
                    <span class="font-medium text-white">Serial Number:</span>
                    <span id="modal-serial-number" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Tanggal Peminjaman:</span>
                    <span id="modal-tanggal-pinjam" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Tanggal Pengembalian:</span>
                    <span id="modal-tanggal-kembali" class="text-sm text-white"></span>
                </div>
                
                <div class="mb-2">
                    <span class="font-medium text-white">Alasan Peminjaman:</span>
                    <p id="modal-reason" class="text-sm text-white mt-1"></p>
                </div>
            </div>
            
            <!-- Tab untuk pilih approve atau reject -->
            <div class="mb-4 border-b border-gray-600">
                <div class="flex">
                    <button type="button" id="tab-approve" 
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-t-md active-tab"
                            onclick="switchTab('approve')">
                        Setujui
                    </button>
                    <button type="button" id="tab-reject" 
                            class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-t-md"
                            onclick="switchTab('reject')">
                        Tolak
                    </button>
                </div>
            </div>
            
            <!-- Form untuk approve -->
            <div id="content-approve" class="mb-4">
                <p class="text-sm text-white mb-4">
                    Apakah Anda yakin ingin menyetujui peminjaman ini? Tindakan ini akan mengurangi stok barang.
                </p>
                
                <div class="mt-6 flex justify-end space-x-4">
                    <button type="button" 
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50" 
                            x-on:click="$dispatch('close')">
                        Tutup
                    </button>

                    <form id="approval-form" method="POST" action="">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                            Ya, Setujui
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Form untuk reject -->
            <div id="content-reject" class="mb-4 hidden">
                <form id="reject-form" method="POST" action="">
                    @csrf
                    <div class="mb-4">
                        <label for="reject_reason" class="block text-sm font-medium text-white mb-1">Alasan Penolakan <span class="text-red-500">*</span></label>
                        <textarea id="reject_reason" name="reject_reason" rows="3" 
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                  placeholder="Berikan alasan mengapa peminjaman ini ditolak" required></textarea>
                    </div>
                    
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" 
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50" 
                                x-on:click="$dispatch('close')">
                            Batal
                        </button>

                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                            Tolak Peminjaman
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
            document.getElementById('modal-peminjam').textContent = peminjam || 'Tidak ada';
            document.getElementById('modal-department').textContent = department || 'Tidak ada';
            document.getElementById('modal-phone_number').textContent = phone_number || 'Tidak ada';
            document.getElementById('modal-serial-number').textContent = serialNumber || 'Tidak ada';
            document.getElementById('modal-barang').textContent = barang;
            document.getElementById('modal-tanggal-pinjam').textContent = formatDate(tanggalPinjam);
            document.getElementById('modal-tanggal-kembali').textContent = formatDate(tanggalKembali);
            document.getElementById('modal-reason').textContent = reason || 'Tidak ada alasan';
            
            // Reset form reject
            document.getElementById('reject_reason').value = '';
            
            // Open modal
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'approval-modal' }));
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
            if (!dateString) return 'Tidak ada';
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }
    </script>
    
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-8">
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