@extends('layouts.app')

@section('header', 'Edit Data Petugas')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Ubah Informasi Akun</h3>
            
            <form action="{{ route('admin.petugas.update', $petugas->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name', $petugas->name) }}"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" 
                            required
                        >
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email', $petugas->email) }}"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" 
                            required
                        >
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-6 mt-6 border-t border-gray-50">
                        <div class="p-4 bg-blue-50 rounded-xl mb-4">
                            <p class="text-xs text-blue-700 font-medium leading-relaxed">
                                <i data-lucide="info" class="w-3 h-3 inline-block mr-1"></i>
                                Biarkan kolom password kosong jika tidak ingin mengubah password.
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" 
                                    placeholder="••••••••"
                                >
                                @error('password')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Confirmation -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    id="password_confirmation" 
                                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" 
                                    placeholder="••••••••"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.petugas.index') }}" class="px-6 py-2.5 bg-white text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors text-sm border border-gray-100">
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-2.5 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-sm shadow-primary-500/20 text-sm">
                        Update Petugas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
