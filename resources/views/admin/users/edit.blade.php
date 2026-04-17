@extends('layouts.dashboard')
@section('title', 'Edit User')
@section('content')
<div class="bg-white rounded-xl shadow border border-gray-100 p-6 max-w-2xl">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4"><label class="block mb-1 text-sm">Nama</label><input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded p-2 text-sm" required></div>
        <div class="mb-4"><label class="block mb-1 text-sm">Email</label><input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded p-2 text-sm" required></div>
        <div class="mb-4"><label class="block mb-1 text-sm">Password (Kosongkan bila tak mengubah)</label><input type="password" name="password" class="w-full border rounded p-2 text-sm"></div>
        <div class="mb-4"><label class="block mb-1 text-sm">Role</label>
            <select name="role" class="w-full border rounded p-2 text-sm" required>
                <option value="peminjam" @if($user->role=='peminjam') selected @endif>Peminjam</option>
                <option value="petugas" @if($user->role=='petugas') selected @endif>Petugas</option>
                <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
            </select>
        </div>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection