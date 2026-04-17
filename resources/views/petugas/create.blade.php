@extends('layouts.app')

@section('header', 'Tambah Petugas Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Informasi Akun Petugas</h3>
            
            <form action="{{ route('admin.petugas.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="space-y-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name') }}"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" 
                            placeholder="Contoh: Ahmad Petugas"
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
                            value="{{ old('email') }}"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" 
                            placeholder="petugas@sipa.com"
                            required
                        >
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-50">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" 
                                placeholder="••••••••"
                                required
                            >
                            @error('password')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" 
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>
                </div>

                <div class="pt-6 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.petugas.index') }}" class="px-6 py-2.5 bg-white text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors text-sm border border-gray-100">
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-2.5 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-sm shadow-primary-500/20 text-sm">
                        Simpan Petugas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
