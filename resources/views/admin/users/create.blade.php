@extends('layouts.dashboard')
@section('title', 'Tambah User')
@section('content')
<div class="bg-white rounded-xl shadow border border-gray-100 p-6 max-w-2xl">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-4"><label class="block mb-1 text-sm">Nama</label><input type="text" name="name" class="w-full border rounded p-2 text-sm" required></div>
        <div class="mb-4"><label class="block mb-1 text-sm">Email</label><input type="email" name="email" class="w-full border rounded p-2 text-sm" required></div>
        <div class="mb-4"><label class="block mb-1 text-sm">Password</label><input type="password" name="password" class="w-full border rounded p-2 text-sm" required></div>
        <div class="mb-4"><label class="block mb-1 text-sm">Role</label>
            <select name="role" class="w-full border rounded p-2 text-sm" required><option value="peminjam">Peminjam</option><option value="petugas">Petugas</option><option value="admin">Admin</option></select>
        </div>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection