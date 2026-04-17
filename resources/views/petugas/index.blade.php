@extends('layouts.app')

@section('header', 'Manajemen Data Petugas')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-gray-900">Daftar Petugas</h3>
            <p class="text-sm text-gray-500 mt-1">Kelola akun petugas yang berwenang mengelola peminjaman alat.</p>
        </div>
        <a href="{{ route('admin.petugas.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm text-sm">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            Tambah Petugas
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">Nama Petugas</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">Username</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">Email</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">Terdaftar Pada</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($petugas as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 group-hover:bg-primary-50 group-hover:text-primary-600 transition-colors">
                                        <i data-lucide="user" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $item->name }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">Role: Petugas</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-900">{{ $item->username ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600">{{ $item->email }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-gray-500">{{ $item->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.petugas.edit', $item->id) }}" class="p-2 text-gray-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all" title="Edit">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.petugas.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus" onclick="return confirm('Hapus petugas ini?')">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <i data-lucide="users" class="w-12 h-12 text-gray-200 mx-auto mb-4"></i>
                                <p class="text-sm text-gray-500">Belum ada data petugas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($petugas->hasPages())
            <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                {{ $petugas->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
