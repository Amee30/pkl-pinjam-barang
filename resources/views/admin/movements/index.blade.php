<!-- filepath: /d:/laragon/www/pkl-pinjam-barang/resources/views/admin/movements/index.blade.php -->
<x-admin-layout>
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-8">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
    
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between mb-4">
                            <h3 class="text-lg font-medium">Riwayat Pergerakan Barang</h3>
                            <a href="{{ route('admin.movements.create') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                Tambah Pergerakan
                            </a>
                        </div>
    
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sumber/Alasan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($movements as $movement)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $movement->date->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $movement->barang->nama_barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($movement->type == 'in')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Masuk
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Keluar
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $movement->quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($movement->type == 'in')
                                            <strong>Sumber:</strong> {{ $movement->source ?: '-' }}<br>
                                        @endif
                                        <strong>Alasan:</strong> {{ $movement->reason }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-4">
                                        <a href="{{ route('admin.movements.show', $movement->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Belum ada data pergerakan barang.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4 px-4 py-3">
                            {{ $movements->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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