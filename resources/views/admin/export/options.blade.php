<x-admin-layout>
    <div class="flex flex-col min-h-screen">
        <div class="flex-grow py-4 sm:py-8 mt-4">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6">
                        <!-- Header -->
                        <div class="mb-4 sm:mb-6">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Export Data</h2>
                            <p class="text-sm sm:text-base text-gray-600 mt-1 sm:mt-2">Export all system data to Excel or PDF format</p>
                        </div>

                        <!-- Stats Cards -->
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6 sm:mb-8">
                            <div class="bg-blue-50 rounded-lg p-3 sm:p-4 border-l-4 border-blue-500">
                                <div class="text-blue-600 text-xs sm:text-sm font-semibold">Items</div>
                                <div class="text-xl sm:text-2xl font-bold text-gray-800">{{ $stats['items'] }}</div>
                            </div>
                            <div class="bg-green-50 rounded-lg p-3 sm:p-4 border-l-4 border-green-500">
                                <div class="text-green-600 text-xs sm:text-sm font-semibold">Users</div>
                                <div class="text-xl sm:text-2xl font-bold text-gray-800">{{ $stats['users'] }}</div>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-3 sm:p-4 border-l-4 border-purple-500">
                                <div class="text-purple-600 text-xs sm:text-sm font-semibold">Movements</div>
                                <div class="text-xl sm:text-2xl font-bold text-gray-800">{{ $stats['movements'] }}</div>
                            </div>
                            <div class="bg-orange-50 rounded-lg p-3 sm:p-4 border-l-4 border-orange-500">
                                <div class="text-orange-600 text-xs sm:text-sm font-semibold">Borrowings</div>
                                <div class="text-xl sm:text-2xl font-bold text-gray-800">{{ $stats['borrowings'] }}</div>
                            </div>
                        </div>

                        <!-- Export Options -->
                        <div class="space-y-4">
                            <!-- Excel Export -->
                            <div class="border-2 border-gray-200 rounded-lg p-4 sm:p-6 hover:border-green-500 transition-colors">
                                <div class="flex flex-col sm:flex-row items-start">
                                    <div class="flex-shrink-0 mb-3 sm:mb-0">
                                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="sm:ml-4 flex-1 w-full">
                                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">Export to Excel</h3>
                                        <p class="text-xs sm:text-sm text-gray-600 mt-1">Download all data in Excel format with multiple sheets</p>
                                        <ul class="mt-2 sm:mt-3 space-y-1 text-xs sm:text-sm text-gray-600">
                                            <li class="flex items-center">
                                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-2 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="break-words">Items data in separate sheet</span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-2 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="break-words">Users data in separate sheet</span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-2 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="break-words">Movements history in separate sheet</span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-2 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="break-words">Borrowing history in separate sheet</span>
                                            </li>
                                        </ul>
                                        <a href="{{ route('admin.export.excel') }}" 
                                           class="inline-flex items-center justify-center w-full sm:w-auto mt-3 sm:mt-4 px-4 sm:px-6 py-2.5 sm:py-3 bg-green-600 text-white text-sm sm:text-base font-semibold rounded-lg hover:bg-green-700 transition-colors">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Download Excel
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- PDF Export -->
                            <div class="border-2 border-gray-200 rounded-lg p-4 sm:p-6 hover:border-red-500 transition-colors">
                                <div class="flex flex-col sm:flex-row items-start">
                                    <div class="flex-shrink-0 mb-3 sm:mb-0">
                                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="sm:ml-4 flex-1 w-full">
                                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">Export to PDF</h3>
                                        <p class="text-xs sm:text-sm text-gray-600 mt-1">Download all data in PDF format with multiple pages</p>
                                        <ul class="mt-2 sm:mt-3 space-y-1 text-xs sm:text-sm text-gray-600">
                                            <li class="flex items-center">
                                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-2 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="break-words">Items data on page 1</span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-2 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="break-words">Users data on page 2</span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-2 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="break-words">Movements history on page 3</span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-2 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="break-words">Borrowing history on page 4</span>
                                            </li>
                                        </ul>
                                        <a href="{{ route('admin.export.pdf') }}" 
                                           class="inline-flex items-center justify-center w-full sm:w-auto mt-3 sm:mt-4 px-4 sm:px-6 py-2.5 sm:py-3 bg-red-600 text-white text-sm sm:text-base font-semibold rounded-lg hover:bg-red-700 transition-colors">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Download PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Back Button -->
                        <div class="mt-4 sm:mt-6 pt-4 sm:pt-6 border-t">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 bg-gray-600 text-white text-sm sm:text-base rounded-lg hover:bg-gray-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-xs sm:text-sm text-gray-500">
                &copy; {{ date('Y') }} Sistem Peminjaman Barang. All rights reserved.
            </div>
        </div>
    </footer>
</x-admin-layout>