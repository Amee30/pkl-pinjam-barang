<x-admin-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peminjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Barang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Kembali</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($borrowing as $peminjaman)
                            <tr>
                                <td class="px-6 py-4">{{ $peminjaman->user->name }}</td>
                                <td class="px-6 py-4">{{ $peminjaman->barang->nama_barang }}</td>
                                <td class="px-6 py-4">{{ $peminjaman->tanggal_kembali }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($peminjaman->status == 'pending') bg-orange-100 text-orange-800 
                                        @elseif($peminjaman->status == 'approved') bg-green-100 text-green-800 
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ $peminjaman->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex space-x-2">
                                    @if($peminjaman->status == 'pending')
                                        <form action="{{ route('admin.peminjaman.approve', $peminjaman) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900">Approve</button>
                                        </form>
                                    @elseif($peminjaman->status == 'approved')
                                        <form action="{{ route('admin.peminjaman.return', $peminjaman) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:text-blue-900">Return</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data peminjaman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>