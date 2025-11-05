<!-- filepath: /d:/laragon/www/pkl-pinjam-barang/resources/views/borrowing/history.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Borrowing History') }}
        </h2>
    </x-slot>

    <div class="py-4 sm:py-12 mt-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">
                    <!-- Desktop Table View -->
                    <div class="hidden lg:block overflow-x-auto">
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
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                         @if($borrowing->barang->foto)
                                            <div class="flex justify-center">
                                                <img src="{{ asset('storage/' . $borrowing->barang->foto) }}" alt="{{ $borrowing->barang->nama_barang }}" class="w-20 h-20 object-cover border rounded">
                                            </div>
                                        @else
                                            <div class="flex justify-center">
                                                <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                                    <span class="text-gray-500 text-xs">No Photo</span>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center">
                                            <div class="text-center">
                                                <div class="text-sm font-medium text-gray-900">{{ $borrowing->barang->nama_barang }}</div>
                                                <div class="text-sm text-gray-500">{{ $borrowing->barang->kategori }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">
                                        {{ \Carbon\Carbon::parse($borrowing->borrowed_at)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">
                                        {{ \Carbon\Carbon::parse($borrowing->return_due_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
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
                                                
                                                $interval = $now->diff($dueDate);
                                                $isOverdue = !$interval->invert ? false : true;
                                                
                                                if ($isOverdue) {
                                                    $days = $interval->days;
                                                    $hours = $interval->h;
                                                    $displayText = "Overdue " . $days . " day" . ($days > 1 ? 's' : '');
                                                    if ($hours > 0) {
                                                        $displayText .= ", " . $hours . " hour" . ($hours > 1 ? 's' : '');
                                                    }
                                                    $textColor = "text-red-600";
                                                } elseif ($interval->days == 0) {
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
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($borrowing->status == 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Waiting for Approval
                                            </span>
                                        @elseif($borrowing->status == 'waiting_pickup')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                Waiting for Pickup
                                            </span>
                                        @elseif($borrowing->status == 'borrowed')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Currently Borrowed
                                            </span>
                                        @elseif($borrowing->status == 'waiting_return')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                Waiting for Return
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
                                            <a href="{{ route('pinjam.show', $borrowing->id) }}" 
                                               class="p-1 border border-gray-300 rounded-full text-indigo-600 hover:bg-indigo-100 hover:border-indigo-400 transition-colors duration-200"
                                               title="View Details">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            
                                            @if($borrowing->status == 'pending')
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
                                            @endif

                                            @if($borrowing->status == 'borrowed')
                                                <form action="{{ route('pinjam.return', $borrowing->id) }}" method="POST" class="inline" 
                                                      onsubmit="return confirm('Are you sure you want to request return for this item? Please bring the item to admin for scanning.')">
                                                    @csrf
                                                    <button type="submit"
                                                            class="p-1 border border-gray-300 rounded-full text-green-600 hover:bg-green-100 hover:border-green-400 transition-colors duration-200"
                                                            title="Request Return">
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif

                                            @if($borrowing->status == 'waiting_return')
                                                <span class="p-1 text-xs text-orange-600" title="Waiting for admin to scan return">
                                                    <svg class="h-5 w-5 inline animate-pulse" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <p>You haven't borrowed anything yet.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="lg:hidden space-y-4">
                        @forelse($borrowings as $borrowing)
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <!-- Image & Item Name -->
                            <div class="flex items-start gap-4 mb-3 pb-3 border-b border-gray-200">
                                @if($borrowing->barang->foto)
                                    <img src="{{ asset('storage/' . $borrowing->barang->foto) }}" alt="{{ $borrowing->barang->nama_barang }}" class="w-20 h-20 object-cover border rounded flex-shrink-0">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center flex-shrink-0">
                                        <span class="text-gray-500 text-xs">No Photo</span>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-900 break-words mb-1">{{ $borrowing->barang->nama_barang }}</h4>
                                    <p class="text-xs text-gray-500">{{ $borrowing->barang->kategori }}</p>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="mb-3 pb-3 border-b border-gray-200">
                                <p class="text-xs text-gray-500 mb-1">Status</p>
                                @if($borrowing->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        Waiting for Approval
                                    </span>
                                @elseif($borrowing->status == 'waiting_pickup')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                        Waiting for Pickup
                                    </span>
                                @elseif($borrowing->status == 'borrowed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        Currently Borrowed
                                    </span>
                                @elseif($borrowing->status == 'waiting_return')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800">
                                        Waiting for Return
                                    </span>
                                @elseif($borrowing->status == 'returned')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        Returned
                                    </span>
                                @elseif($borrowing->status == 'rejected')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        Rejected
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        Overdue
                                    </span>
                                @endif
                            </div>

                            <!-- Dates -->
                            <div class="grid grid-cols-2 gap-3 mb-3">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Borrowed At</p>
                                    <p class="text-sm font-medium">{{ \Carbon\Carbon::parse($borrowing->borrowed_at)->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Due Date</p>
                                    <p class="text-sm font-medium">{{ \Carbon\Carbon::parse($borrowing->return_due_date)->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            <!-- Time Remaining -->
                            <div class="mb-3 pb-3 border-b border-gray-200">
                                <p class="text-xs text-gray-500 mb-1">Time Remaining</p>
                                @if($borrowing->status == 'returned')
                                    <span class="text-sm text-green-600 font-medium">Already returned</span>
                                @elseif($borrowing->status == 'rejected')
                                    <span class="text-sm text-red-600 font-medium">Borrowing rejected</span>
                                @elseif($borrowing->status == 'pending')
                                    <span class="text-sm text-yellow-600 font-medium">Awaiting approval</span>
                                @else
                                    @php
                                        $now = \Carbon\Carbon::now();
                                        $dueDate = \Carbon\Carbon::parse($borrowing->return_due_date);
                                        
                                        $interval = $now->diff($dueDate);
                                        $isOverdue = !$interval->invert ? false : true;
                                        
                                        if ($isOverdue) {
                                            $days = $interval->days;
                                            $hours = $interval->h;
                                            $displayText = "Overdue " . $days . " day" . ($days > 1 ? 's' : '');
                                            if ($hours > 0) {
                                                $displayText .= ", " . $hours . " hour" . ($hours > 1 ? 's' : '');
                                            }
                                            $textColor = "text-red-600";
                                        } elseif ($interval->days == 0) {
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
                                    
                                    <span class="text-sm {{ $textColor }} font-medium">{{ $displayText }}</span>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <a href="{{ route('pinjam.show', $borrowing->id) }}" 
                                   class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-indigo-500 text-white text-xs font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Details
                                </a>

                                @if($borrowing->status == 'pending')
                                    <form action="{{ route('pinjam.destroy', $borrowing->id) }}" 
                                          method="POST" 
                                          class="flex-1"
                                          onsubmit="return confirm('Are you sure you want to cancel this borrowing?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-500 text-white text-xs font-semibold rounded-lg hover:bg-red-700 transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Cancel
                                        </button>
                                    </form>
                                @endif

                                @if($borrowing->status == 'borrowed')
                                    <form action="{{ route('pinjam.return', $borrowing->id) }}" 
                                          method="POST" 
                                          class="flex-1"
                                          onsubmit="return confirm('Are you sure you want to request return for this item? Please bring the item to admin for scanning.')">
                                        @csrf
                                        <button type="submit"
                                                class="w-full inline-flex items-center justify-center px-3 py-2 bg-green-500 text-white text-xs font-semibold rounded-lg hover:bg-green-700 transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                            </svg>
                                            Request Return
                                        </button>
                                    </form>
                                @endif

                                @if($borrowing->status == 'waiting_return')
                                    <div class="flex-1 flex items-center justify-center px-3 py-2 bg-orange-50 border border-orange-200 text-orange-600 text-xs font-medium rounded-lg">
                                        <svg class="w-4 h-4 mr-1 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Waiting Admin
                                    </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-gray-500">You haven't borrowed anything yet.</p>
                        </div>
                        @endforelse
                    </div>
                    
                    <!-- Pagination -->
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
        <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-sm text-white">
                &copy; {{ date('Y') }} Item Borrowing System. All rights reserved.
            </div>
        </div>
    </footer>
</x-app-layout>