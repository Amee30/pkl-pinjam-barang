<!-- filepath: /d:/laragon/www/pkl-pinjam-barang/resources/views/borrowing/history.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Borrowing History') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed At</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Return Due Date</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Time Remaining</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($borrowings as $borrowing)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                         @if($borrowing->barang->foto)
                                            <img src="{{ asset('storage/' . $borrowing->barang->foto) }}" alt="{{ $borrowing->barang->nama_barang }}" class="w-20 h-20 object-contain border rounded">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-gray-500 text-xs">No Photo</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $borrowing->barang->nama_barang }}</div>
                                                <div class="text-sm text-gray-500">{{ $borrowing->barang->kategori }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($borrowing->borrowed_at)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($borrowing->return_due_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($borrowing->status == 'returned')
                                            <span class="text-green-600 font-medium">Already returned</span>
                                        @elseif($borrowing->status == 'rejected')
                                            <span class="text-red-600 font-medium">Borrowing rejected</span>
                                        @elseif($borrowing->status == 'pending')
                                            <span class="text-yellow-600 font-medium">Awaiting approval</span>
                                        @else
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $dueDate = \Carbon\Carbon::parse($borrowing->return_due_date);
                                                
                                                // Use interval for more accurate calculation
                                                $interval = $now->diff($dueDate);
                                                $isOverdue = !$interval->invert ? false : true;
                                                
                                                if ($isOverdue) {
                                                    // Overdue
                                                    $days = $interval->days;
                                                    $hours = $interval->h;
                                                    $displayText = "Overdue " . $days . " day" . ($days > 1 ? 's' : '');
                                                    if ($hours > 0) {
                                                        $displayText .= ", " . $hours . " hour" . ($hours > 1 ? 's' : '');
                                                    }
                                                    $textColor = "text-red-600";
                                                } elseif ($interval->days == 0) {
                                                    // Today
                                                    $hours = $interval->h;
                                                    if ($hours > 0) {
                                                        $displayText = $hours . " hour" . ($hours > 1 ? 's' : '') . " left";
                                                        $textColor = "text-yellow-600";
                                                    } else {
                                                        $minutes = $interval->i;
                                                        if ($minutes > 0) {
                                                            $displayText = $minutes . " minute" . ($minutes > 1 ? 's' : '') . " left";
                                                            $textColor = "text-red-500";
                                                        } else {
                                                            $displayText = "Time's up";
                                                            $textColor = "text-red-600";
                                                        }
                                                    }
                                                } else {
                                                    // Days remaining
                                                    $days = $interval->days;
                                                    $hours = $interval->h;
                                                    
                                                    if ($days == 1) {
                                                        $displayText = "1 day";
                                                        if ($hours > 0) {
                                                            $displayText .= ", " . $hours . " hour" . ($hours > 1 ? 's' : '') . " left";
                                                        } else {
                                                            $displayText .= " left";
                                                        }
                                                        $textColor = "text-yellow-600";
                                                    } else {
                                                        $displayText = $days . " days";
                                                        if ($hours > 0) {
                                                            $displayText .= ", " . $hours . " hour" . ($hours > 1 ? 's' : '') . " left";
                                                        } else {
                                                            $displayText .= " left";
                                                        }
                                                        $textColor = $days <= 3 ? "text-yellow-600" : "text-blue-600";
                                                    }
                                                }
                                            @endphp
                                            
                                            <span class="{{ $textColor }} font-medium">{{ $displayText }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($borrowing->status == 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Waiting for Approval
                                            </span>
                                        @elseif($borrowing->status == 'borrowed')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Currently Borrowed
                                            </span>
                                        @elseif($borrowing->status == 'returned')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Returned
                                            </span>
                                        @elseif($borrowing->status == 'rejected')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Rejected
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Overdue
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center justify-center space-x-3">
                                            <!-- Detail Button -->
                                            <a href="{{ route('pinjam.show', $borrowing->id) }}" 
                                               class="p-1 border border-gray-300 rounded-full text-indigo-600 hover:bg-indigo-100 hover:border-indigo-400 transition-colors duration-200"
                                               title="View Details">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            
                                            <!-- Receipt Button (untuk semua status kecuali pending dan rejected) -->
                                            <!-- @if($borrowing->status != 'pending' && $borrowing->status != 'rejected')
                                                <a href="{{ route('pinjam.receipt', $borrowing->id) }}" 
                                                   target="_blank"
                                                   class="p-1 border border-gray-300 rounded-full text-purple-600 hover:bg-purple-100 hover:border-purple-400 transition-colors duration-200"
                                                   title="Print Receipt">
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                                    </svg>
                                                </a>
                                            @endif -->
                                            
                                            @if($borrowing->status == 'pending')
                                                <!-- Cancel Button -->
                                                <form action="{{ route('pinjam.destroy', $borrowing->id) }}" 
                                                      method="POST" 
                                                      class="inline-flex"
                                                      onsubmit="return confirm('Are you sure you want to cancel this borrowing?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="p-1 border border-gray-300 rounded-full text-red-600 hover:bg-red-100 hover:border-red-400 transition-colors duration-200"
                                                            title="Cancel Borrowing">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @elseif($borrowing->status == 'borrowed')
                                                <!-- Return Button -->
                                                <form action="{{ route('pinjam.return', $borrowing->id) }}" 
                                                      method="POST" 
                                                      class="inline-flex"
                                                      onsubmit="return confirm('Are you sure you want to return this item?')">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="p-1 border border-gray-300 rounded-full text-blue-600 hover:bg-blue-100 hover:border-blue-400 transition-colors duration-200"
                                                            title="Return Item">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                       You haven't borrowed anything yet.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination if available -->
                    @if(method_exists($borrowings, 'hasPages') && $borrowings->hasPages())
                        <div class="mt-4">
                            {{ $borrowings->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-500 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between"> 
                <div class="mt-8 md:mt-0 flex items-center justify-center md:justify-end">
                    <div class="text-sm text-white">
                        &copy; {{ date('Y') }} Item Borrowing System. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</x-app-layout>