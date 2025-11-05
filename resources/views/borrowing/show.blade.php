<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Borrowing Details') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-4">
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
                            <h4 class="text-md font-medium mb-4 border-b pb-2">Item Information</h4>
                            
                            <div class="flex items-center mb-4">
                                @if($borrowing->barang->foto)
                                    <img src="{{ asset('storage/' . $borrowing->barang->foto) }}" alt="{{ $borrowing->barang->nama_barang }}" class="w-20 h-20 object-contain mr-8 border rounded">
                                @else
                                    <div class="w-24 h-24 bg-gray-200 flex items-center justify-center rounded mr-8">
                                        <span class="text-gray-500 text-xs">No Image</span>
                                    </div>
                                @endif
                                
                                <div>
                                    <p class="font-semibold text-lg">{{ $borrowing->barang->nama_barang }}</p>
                                    <p class="text-sm text-gray-600">Category: {{ $borrowing->barang->kategori }}</p>
                                    <p class="text-sm text-gray-600">Serial Number: {{ $borrowing->barang->serial_number ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600">Current Stock: {{ $borrowing->barang->stok }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Informasi Peminjaman -->
                        <div class="border rounded-lg p-4 mt-4">
                            <h4 class="text-md font-medium mb-4 border-b pb-2">Borrowing Details</h4>
                            
                            <div class="mb-2 flex">
                                <span class="w-1/3 text-gray-600">Status:</span>
                                <span class="w-2/3">
                                    @if($borrowing->status == 'pending')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Waiting for Approval</span>
                                    @elseif($borrowing->status == 'waiting_pickup')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Waiting for Pickup</span>
                                    @elseif($borrowing->status == 'borrowed')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Currently Borrowed</span>
                                    @elseif($borrowing->status == 'returned')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Returned</span>
                                    @elseif($borrowing->status == 'rejected')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Overdue</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="mb-2 flex">
                                <span class="w-1/3 text-gray-600">Borrowing Date:</span>
                                <span class="w-2/3 font-medium">{{ \Carbon\Carbon::parse($borrowing->borrowed_at)->format('d/m/Y') }}</span>
                            </div>
                            
                            <div class="mb-2 flex">
                                <span class="w-1/3 text-gray-600">Return Date:</span>
                                <span class="w-2/3 font-medium">{{ \Carbon\Carbon::parse($borrowing->return_due_date)->format('d/m/Y') }}</span>
                            </div>

                            <div class="mb-2 flex">
                                <span class="w-1/3 text-gray-600">Remaining Time:</span>
                                <span class="w-2/3 font-medium">
                                    @if($borrowing->status == 'returned')
                                        <span class="text-green-600">Returned</span>
                                    @elseif($borrowing->status == 'rejected')
                                        <span class="text-red-600">Borrowing Rejected</span>
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
                                                $displayText = "Overdue " . $days . " days";
                                                if ($hours > 0) {
                                                    $displayText .= ", " . $hours . " hours";
                                                }
                                            } elseif ($interval->days == 0) {
                                                // Hari ini
                                                $hours = $interval->h;
                                                if ($hours > 0) {
                                                    $displayText = $hours . " hours left";
                                                } else {
                                                    $minutes = $interval->i;
                                                    if ($minutes > 0) {
                                                        $displayText = $minutes . " minutes left";
                                                    } else {
                                                        $displayText = "Time's up";
                                                    }
                                                }
                                            } else {
                                                // Masih ada hari tersisa
                                                $days = $interval->days;
                                                $hours = $interval->h;
                                                
                                                if ($days == 1) {
                                                    $displayText = "1 day";
                                                    if ($hours > 0) {
                                                        $displayText .= ", " . $hours . " hours left";
                                                    } else {
                                                        $displayText .= " left";
                                                    }
                                                } else {
                                                    $displayText = $days . " days";
                                                    if ($hours > 0) {
                                                        $displayText .= ", " . $hours . " hours left";
                                                    } else {
                                                        $displayText .= " left";
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

                            <div class="mb-2 flex">
                                <span class="w-1/3 text-gray-600">Reason:</span>
                                <span class="w-2/3 font-medium">
                                    {{ $borrowing->reason ?? 'No reason provided' }}
                                </span>
                            </div>

                            <!-- Tambahkan informasi alasan penolakan jika status rejected -->
                            @if($borrowing->status == 'rejected')
                            <div class="mb-2 flex">
                                <span class="w-1/3 text-gray-600">Reason for Rejection:</span>
                                <span class="w-2/3 font-medium text-red-600">
                                    {{ $borrowing->reject_reason }}
                                </span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Detail Peminjam (Admin Only View) -->
                        @if(Auth::user()->role == 'admin')
                        <div class="border rounded-lg p-4 md:col-span-2 mt-4">
                            <h4 class="text-md font-medium mb-4 border-b pb-2">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                                    </svg>
                                    Borrower Details
                                    <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Admin Only</span>
                                </div>
                            </h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <!-- Informasi Personal -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h5 class="font-medium text-sm text-gray-700 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                        Personal Data
                                    </h5>
                                    <div class="space-y-2">
                                        <div>
                                            <span class="text-xs text-gray-500 block">Full Name</span>
                                            <span class="font-medium text-sm">{{ $borrowing->user->name }}</span>
                                        </div>
                                        <div>
                                            <span class="text-xs text-gray-500 block">Email</span>
                                            <span class="font-medium text-sm">{{ $borrowing->user->email }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Kontak & Departemen -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h5 class="font-medium text-sm text-gray-700 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                        </svg>
                                        Contact & Department
                                    </h5>
                                    <div class="space-y-2">
                                        <div>
                                            <span class="text-xs text-gray-500 block">Department</span>
                                            <span class="font-medium text-sm">{{ $borrowing->user->department ?? 'Not Specified' }}</span>
                                        </div>
                                        <div>
                                            <span class="text-xs text-gray-500 block">Phone Number</span>
                                            <span class="font-medium text-sm">{{ $borrowing->user->phone_number ?? 'Not Provided' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Peminjaman -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h5 class="font-medium text-sm text-gray-700 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                        </svg>
                                        Borrowing History
                                    </h5>
                                    <div class="space-y-2">
                                        <div>
                                            <span class="text-xs text-gray-500 block">Borrowing ID</span>
                                            <span class="font-medium text-sm">#{{ $borrowing->id }}</span>
                                        </div>
                                        <div>
                                            <span class="text-xs text-gray-500 block">Date of Submission</span>
                                            <span class="font-medium text-sm">{{ $borrowing->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistik Peminjaman User -->
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <h5 class="font-medium text-sm text-gray-700 mb-3">User Borrowing Statistics</h5>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @if(Auth::user()->role == 'admin' && !empty($userStats))
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-blue-600">{{ $userStats['total'] }}</div>
                                            <div class="text-xs text-gray-500">Total Borrowing</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-yellow-600">{{ $userStats['active'] }}</div>
                                            <div class="text-xs text-gray-500">Currently Borrowed</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-green-600">{{ $userStats['completed'] }}</div>
                                            <div class="text-xs text-gray-500">Completed</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-red-600">{{ $userStats['rejected'] }}</div>
                                            <div class="text-xs text-gray-500">Rejected</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                    @if(Auth::user()->role == 'admin' && $borrowing->status != 'pending' && $borrowing->status != 'rejected')
                    <div class="mt-6 flex space-x-4">
                        <a href="{{ route('pinjam.receipt', $borrowing->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Print Receipt
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between"> 
                <div class="mt-8 md:mt-0 flex items-center justify-center md:justify-end">
                    <div class="text-sm text-white">
                        &copy; {{ date('Y') }} Sistem Peminjaman Barang. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</x-app-layout>