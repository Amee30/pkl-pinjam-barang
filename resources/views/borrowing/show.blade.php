<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Detail Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('pinjam.history') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informasi Barang -->
                        <div class="border rounded-lg p-4">
                            <h4 class="text-md font-medium mb-4 border-b pb-2">Informasi Barang</h4>
                            
                            <div class="flex items-center mb-4">
                                @if($borrowing->barang->foto)
                                    <img src="{{ asset('storage/' . $borrowing->barang->foto) }}" alt="{{ $borrowing->barang->nama_barang }}" class="w-24 h-24 object-contain mr-4 border rounded">
                                @else
                                    <div class="w-24 h-24 bg-gray-200 flex items-center justify-center rounded mr-4">
                                        <span class="text-gray-500 text-xs">Tidak ada foto</span>
                                    </div>
                                @endif
                                
                                <div>
                                    <p class="font-semibold text-lg">{{ $borrowing->barang->nama_barang }}</p>
                                    <p class="text-sm text-gray-600">Kategori: {{ $borrowing->barang->kategori }}</p>
                                    <p class="text-sm text-gray-600">Stok Saat Ini: {{ $borrowing->barang->stok }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Informasi Peminjaman -->
                        <div class="border rounded-lg p-4">
                            <h4 class="text-md font-medium mb-4 border-b pb-2">Detail Peminjaman</h4>
                            
                            <div class="mb-2 flex">
                                <span class="w-1/3 text-gray-600">Status:</span>
                                <span class="w-2/3">
                                    @if($borrowing->status == 'pending')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Persetujuan</span>
                                    @elseif($borrowing->status == 'borrowed')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Sedang Dipinjam</span>
                                    @elseif($borrowing->status == 'returned')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Dikembalikan</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Terlambat</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="mb-2 flex">
                                <span class="w-1/3 text-gray-600">Tanggal Pinjam:</span>
                                <span class="w-2/3 font-medium">{{ \Carbon\Carbon::parse($borrowing->borrowed_at)->format('d/m/Y') }}</span>
                            </div>
                            
                            <div class="mb-2 flex">
                                <span class="w-1/3 text-gray-600">Tanggal Kembali:</span>
                                <span class="w-2/3 font-medium">{{ \Carbon\Carbon::parse($borrowing->return_due_date)->format('d/m/Y') }}</span>
                            </div>

                            <div class="mb-2 flex">
                                <span class="w-1/3 text-gray-600">Sisa Waktu: </span>
                                <span class="w-2/3 font-medium">
                                    @if($borrowing->status == 'returned')
                                        <span class="text-green-600">Sudah dikembalikan</span>
                                    @else
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $dueDate = \Carbon\Carbon::parse($borrowing->return_due_date);
                                            
                                            // Gunakan interval untuk perhitungan yang lebih akurat
                                            $interval = $now->diff($dueDate);
                                            $isOverdue = !$interval->invert ? false : true;
                                            
                                            if ($isOverdue) {
                                                // Terlambat
                                                $days = $interval->days;
                                                $hours = $interval->h;
                                                $displayText = "Terlambat " . $days . " hari";
                                                if ($hours > 0) {
                                                    $displayText .= ", " . $hours . " jam";
                                                }
                                            } elseif ($interval->days == 0) {
                                                // Hari ini
                                                $hours = $interval->h;
                                                if ($hours > 0) {
                                                    $displayText = $hours . " jam lagi";
                                                } else {
                                                    $minutes = $interval->i;
                                                    if ($minutes > 0) {
                                                        $displayText = $minutes . " menit lagi";
                                                    } else {
                                                        $displayText = "Waktu habis";
                                                    }
                                                }
                                            } else {
                                                // Masih ada hari tersisa
                                                $days = $interval->days;
                                                $hours = $interval->h;
                                                
                                                if ($days == 1) {
                                                    $displayText = "1 hari";
                                                    if ($hours > 0) {
                                                        $displayText .= ", " . $hours . " jam lagi";
                                                    } else {
                                                        $displayText .= " lagi";
                                                    }
                                                } else {
                                                    $displayText = $days . " hari";
                                                    if ($hours > 0) {
                                                        $displayText .= ", " . $hours . " jam lagi";
                                                    } else {
                                                        $displayText .= " lagi";
                                                    }
                                                }
                                            }
                                        @endphp
                                        
                                        @if($isOverdue)
                                            <span class="text-red-600">{{ $displayText }}</span>
                                        @elseif($interval->days == 0)
                                            <span class="text-yellow-600">{{ $displayText }}</span>
                                        @else
                                            <span class="text-blue-600">{{ $displayText }}</span>
                                        @endif
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <!-- Detail Peminjam (hanya visible oleh admin) -->
                        @if(Auth::user()->is_admin)
                        <div class="border rounded-lg p-4 md:col-span-2">
                            <h4 class="text-md font-medium mb-4 border-b pb-2">Informasi Peminjam</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <div class="mb-2 flex">
                                        <span class="w-1/3 text-gray-600">Nama:</span>
                                        <span class="w-2/3 font-medium">{{ $borrowing->user->name }}</span>
                                    </div>
                                    
                                    <div class="mb-2 flex">
                                        <span class="w-1/3 text-gray-600">Email:</span>
                                        <span class="w-2/3 font-medium">{{ $borrowing->user->email }}</span>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="mb-2 flex">
                                        <span class="w-1/3 text-gray-600">ID Peminjaman:</span>
                                        <span class="w-2/3 font-medium">#{{ $borrowing->id }}</span>
                                    </div>
                                    
                                    <div class="mb-2 flex">
                                        <span class="w-1/3 text-gray-600">Tanggal Ajuan:</span>
                                        <span class="w-2/3 font-medium">{{ $borrowing->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-6 flex justify-end">
                        @if($borrowing->status == 'pending' && $borrowing->user_id == Auth::id())
                            <form action="{{ route('pinjam.destroy', $borrowing->id) }}" method="POST" class="ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700" onclick="return confirm('Apakah Anda yakin ingin membatalkan peminjaman ini?')">
                                    Batalkan Peminjaman
                                </button>
                            </form>
                        @endif
                        
                        @if(Auth::user()->is_admin)
                            @if($borrowing->status == 'pending')
                                <form action="{{ route('admin.peminjaman.approve', $borrowing->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                        Setujui Peminjaman
                                    </button>
                                </form>
                            @elseif($borrowing->status == 'borrowed')
                                <form action="{{ route('admin.peminjaman.return', $borrowing->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                        Tandai Dikembalikan
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>