<?php
$base_dir = "C:\\Users\\asus\\.gemini\\antigravity\\scratch\\SistemPeminjamanAlat\\resources\\views\\admin\\";

if (!is_dir($base_dir . 'users')) mkdir($base_dir . 'users', 0777, true);
if (!is_dir($base_dir . 'categories')) mkdir($base_dir . 'categories', 0777, true);
if (!is_dir($base_dir . 'alat')) mkdir($base_dir . 'alat', 0777, true);

// Users CRUD
file_put_contents($base_dir . 'users/index.blade.php', <<<EOT
@extends('layouts.dashboard')
@section('title', 'Manajemen User')
@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.users.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">Tambah User</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="text-xs bg-gray-50 uppercase border-b"><tr><th class="px-6 py-3">Nama</th><th class="px-6 py-3">Email</th><th class="px-6 py-3">Role</th><th class="px-6 py-3">Aksi</th></tr></thead>
        <tbody>
        @foreach(\$users as \$u)
        <tr class="border-b"><td class="px-6 py-3">{{ \$u->name }}</td><td class="px-6 py-3">{{ \$u->email }}</td><td class="px-6 py-3 uppercase text-xs">{{ \$u->role }}</td>
        <td class="px-6 py-3">
            <a href="{{ route('admin.users.edit', \$u->id) }}" class="text-blue-500 mr-2 hover:underline">Edit</a>
            <form action="{{ route('admin.users.destroy', \$u->id) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-500 hover:underline" onclick="return confirm('Hapus?')">Hapus</button></form>
        </td></tr>
        @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ \$users->links() }}</div>
</div>
@endsection
EOT);

file_put_contents($base_dir . 'users/create.blade.php', <<<EOT
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
EOT);

file_put_contents($base_dir . 'users/edit.blade.php', <<<EOT
@extends('layouts.dashboard')
@section('title', 'Edit User')
@section('content')
<div class="bg-white rounded-xl shadow border border-gray-100 p-6 max-w-2xl">
    <form action="{{ route('admin.users.update', \$user->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4"><label class="block mb-1 text-sm">Nama</label><input type="text" name="name" value="{{ \$user->name }}" class="w-full border rounded p-2 text-sm" required></div>
        <div class="mb-4"><label class="block mb-1 text-sm">Email</label><input type="email" name="email" value="{{ \$user->email }}" class="w-full border rounded p-2 text-sm" required></div>
        <div class="mb-4"><label class="block mb-1 text-sm">Password (Kosongkan bila tak mengubah)</label><input type="password" name="password" class="w-full border rounded p-2 text-sm"></div>
        <div class="mb-4"><label class="block mb-1 text-sm">Role</label>
            <select name="role" class="w-full border rounded p-2 text-sm" required>
                <option value="peminjam" @if(\$user->role=='peminjam') selected @endif>Peminjam</option>
                <option value="petugas" @if(\$user->role=='petugas') selected @endif>Petugas</option>
                <option value="admin" @if(\$user->role=='admin') selected @endif>Admin</option>
            </select>
        </div>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
EOT);

// Categories
file_put_contents($base_dir . 'categories/index.blade.php', <<<EOT
@extends('layouts.dashboard')
@section('title', 'Kategori Alat')
@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Tambah Kategori</a>
</div>
<div class="bg-white rounded-xl shadow p-4"><table class="w-full text-sm">
    <tr class="border-b bg-gray-50"><th class="p-2">Nama Kategori</th><th class="p-2">Aksi</th></tr>
    @foreach(\$categories as \$c)
    <tr class="border-b"><td class="p-2">{{ \$c->nama_kategori }}</td>
    <td class="p-2"><a href="{{ route('admin.categories.edit', \$c->id) }}" class="text-blue-500 mr-2">Edit</a><form action="{{ route('admin.categories.destroy', \$c->id) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-500">Hapus</button></form></td></tr>
    @endforeach
</table></div>
@endsection
EOT);

file_put_contents($base_dir . 'categories/create.blade.php', <<<EOT
@extends('layouts.dashboard')
@section('title', 'Tambah Kategori')
@section('content')
<div class="bg-white p-6 max-w-xl shadow rounded-xl">
<form action="{{ route('admin.categories.store') }}" method="POST">@csrf
<div class="mb-4"><label class="block text-sm mb-1">Nama Kategori</label><input type="text" name="nama_kategori" class="w-full border rounded p-2" required></div>
<button class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button></form></div>
@endsection
EOT);

file_put_contents($base_dir . 'categories/edit.blade.php', <<<EOT
@extends('layouts.dashboard')
@section('title', 'Edit Kategori')
@section('content')
<div class="bg-white p-6 max-w-xl shadow rounded-xl">
<form action="{{ route('admin.categories.update', \$category->id) }}" method="POST">@csrf @method('PUT')
<div class="mb-4"><label class="block text-sm mb-1">Nama Kategori</label><input type="text" name="nama_kategori" value="{{ \$category->nama_kategori }}" class="w-full border rounded p-2" required></div>
<button class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button></form></div>
@endsection
EOT);

// Alat
file_put_contents($base_dir . 'alat/index.blade.php', <<<EOT
@extends('layouts.dashboard')
@section('title', 'Data Alat')
@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.alat.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Tambah Alat</a>
</div>
<div class="bg-white rounded-xl shadow p-4 overflow-x-auto"><table class="w-full text-sm">
    <tr class="border-b bg-gray-50"><th class="p-2">Nama</th><th class="p-2">Kategori</th><th class="p-2">Stok</th><th class="p-2">Kondisi</th><th class="p-2">Status</th><th class="p-2">Aksi</th></tr>
    @foreach(\$alats as \$a)
    <tr class="border-b"><td class="p-2">{{ \$a->nama_alat }}</td><td class="p-2">{{ \$a->kategori->nama_kategori }}</td><td class="p-2">{{ \$a->stok }}</td><td class="p-2">{{ \$a->kondisi }}</td><td class="p-2">{{ \$a->status }}</td>
    <td class="p-2"><a href="{{ route('admin.alat.edit', \$a->id) }}" class="text-blue-500 mr-2">Edit</a><form action="{{ route('admin.alat.destroy', \$a->id) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-500" onclick="return confirm('Hapus?')">Hapus</button></form></td></tr>
    @endforeach
</table></div>
@endsection
EOT);

file_put_contents($base_dir . 'alat/create.blade.php', <<<EOT
@extends('layouts.dashboard')
@section('title', 'Tambah Alat')
@section('content')
<div class="bg-white p-6 max-w-2xl shadow rounded-xl">
<form action="{{ route('admin.alat.store') }}" method="POST">@csrf
<div class="mb-4"><label class="block text-sm mb-1">Nama Alat</label><input type="text" name="nama_alat" class="w-full border rounded p-2" required></div>
<div class="mb-4"><label class="block text-sm mb-1">Kategori</label><select name="kategori_id" class="w-full border rounded p-2" required>@foreach(\$categories as \$c)<option value="{{\$c->id}}">{{\$c->nama_kategori}}</option>@endforeach</select></div>
<div class="mb-4"><label class="block text-sm mb-1">Stok</label><input type="number" name="stok" class="w-full border rounded p-2" required></div>
<div class="mb-4"><label class="block text-sm mb-1">Kondisi</label><input type="text" name="kondisi" value="Baik" class="w-full border rounded p-2" required></div>
<button class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button></form></div>
@endsection
EOT);

file_put_contents($base_dir . 'alat/edit.blade.php', <<<EOT
@extends('layouts.dashboard')
@section('title', 'Edit Alat')
@section('content')
<div class="bg-white p-6 max-w-2xl shadow rounded-xl">
<form action="{{ route('admin.alat.update', \$alat->id) }}" method="POST">@csrf @method('PUT')
<div class="mb-4"><label class="block text-sm mb-1">Nama Alat</label><input type="text" name="nama_alat" value="{{ \$alat->nama_alat }}" class="w-full border rounded p-2" required></div>
<div class="mb-4"><label class="block text-sm mb-1">Kategori</label><select name="kategori_id" class="w-full border rounded p-2" required>@foreach(\$categories as \$c)<option value="{{\$c->id}}" @if(\$alat->kategori_id==\$c->id) selected @endif>{{\$c->nama_kategori}}</option>@endforeach</select></div>
<div class="mb-4"><label class="block text-sm mb-1">Stok</label><input type="number" name="stok" value="{{ \$alat->stok }}" class="w-full border rounded p-2" required></div>
<div class="mb-4"><label class="block text-sm mb-1">Kondisi</label><input type="text" name="kondisi" value="{{ \$alat->kondisi }}" class="w-full border rounded p-2" required></div>
<div class="mb-4"><label class="block text-sm mb-1">Status</label><select name="status" class="w-full border rounded p-2" required><option value="tersedia" @if(\$alat->status=='tersedia') selected @endif>Tersedia</option><option value="dipinjam" @if(\$alat->status=='dipinjam') selected @endif>Dipinjam</option></select></div>
<button class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button></form></div>
@endsection
EOT);

echo "Success";
