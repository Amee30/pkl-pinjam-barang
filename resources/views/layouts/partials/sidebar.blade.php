<div class="w-64 h-screen bg-gray-800 text-white flex flex-col">
    <div class="h-16 flex items-center justify-center text-xl font-bold border-b border-gray-700">
        Admin Panel
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : '' }}">
            <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span>Dashboard</span>
        </a>
        
        <a href="{{ route('admin.barang.index') }}"
           class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.barang.*') ? 'bg-gray-900' : '' }}">
            <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
            </svg>
            <span>Item Management</span>
        </a>
        
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.users.*') ? 'bg-gray-900' : '' }}">
            <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span>User Management</span>
        </a>

        <a href="{{ route('admin.movements.index') }}"
           class="flex items-center px-4 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.movements.*') ? 'bg-gray-900' : '' }}">
            <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
            </svg>
            <span>Item Movement</span>
        </a>
    </nav>
    
    <div class="border-t border-gray-700 p-4">
        <div>{{ Auth::user()->name }}</div>
        <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
    </div>
</div>