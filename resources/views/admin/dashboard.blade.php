<x-admin-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Statistik Dashboard dalam Satu Container -->
            <div class="bg-white overflow-hidden shadow rounded-lg mb-8">
                <div class="p-6 space-y-6">
                    <!-- Total Stok Barang -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Stok Barang</dt>
                                <dd class="text-2xl font-bold text-gray-900">{{ $totalBarangs }}</dd>
                            </dl>
                        </div>
                    </div>

                    <!-- Jenis Barang -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-100 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Jenis Barang</dt>
                                <dd class="text-2xl font-bold text-gray-900">{{ $totalJenisBarang }}</dd>
                            </dl>
                        </div>
                    </div>

                    <!-- Barang Masuk -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Barang Masuk</dt>
                                <dd class="text-2xl font-bold text-green-600">{{ $barangMasuk }}</dd>
                            </dl>
                        </div>
                    </div>

                    <!-- Barang Keluar -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-100 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Barang Keluar</dt>
                                <dd class="text-2xl font-bold text-red-600">{{ $barangKeluar }}</dd>
                            </dl>
                        </div>
                    </div>

                    <!-- Peminjaman Aktif -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Peminjaman Aktif</dt>
                                <dd class="text-2xl font-bold text-yellow-600">{{ $activeBorrowers }}</dd>
                            </dl>
                        </div>
                    </div>

                    <!-- Total Pengguna -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Pengguna</dt>
                                <dd class="text-2xl font-bold text-indigo-600">{{ $totalUser }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Judul Tabel Peminjaman dengan informasi pagination -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Peminjaman</h2>
            </div>
            
            <!-- Tabel Peminjaman dengan pagination yang benar -->
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
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($peminjaman->status == 'pending') bg-yellow-100 text-yellow-800 
                                        @elseif($peminjaman->status == 'borrowed') bg-green-100 text-green-800 
                                        @elseif($peminjaman->status == 'returned') bg-blue-100 text-blue-800
                                        @elseif($peminjaman->status == 'rejected') bg-red-100 text-red-800 
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $peminjaman->status == 'rejected' ? 'ditolak' : $peminjaman->status }}
                                    </span>
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