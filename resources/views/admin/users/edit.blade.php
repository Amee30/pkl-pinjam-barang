<x-admin-layout>
    <div class="flex flex-col min-h-screen">
        <div class="py-8 mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Edit Users</h3>
                        
                        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
    
                            <div>
                                <label for="name" class="text-black" :value="__('Nama')">Name</label>
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <label for="email" class="text-black" :value="__('Email')">Email</label>
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <label for="department" class="text-black" :value="__('Department')">Department</label>
                                <x-text-input id="department" class="block mt-1 w-full" type="text" name="department" :value="old('department', $user->department)" required />
                                <x-input-error :messages="$errors->get('department')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <label for="phone_number" class="text-black" :value="__('Phone')">Phone</label>
                                <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number', $user->phone_number)" required />
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <label for="role" class="text-black" :value="__('Role')">Role</label>
                                <select id="role" name="role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <label for="password" class="text-black" :value="__('Password Baru (kosongkan jika tidak diubah)')">New Password (leave blank if not changed)</label>
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
    
                            <div class="mt-4">
                                <label for="password_confirmation" class="text-black" :value="__('Konfirmasi Password')">Confirm Password</label>
                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
    
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                    {{ __('Cancel') }}
                                </a>
                                <x-primary-button>
                                    {{ __('Update User') }}
                                </x-primary-button>
                            </div>
                        </form>
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