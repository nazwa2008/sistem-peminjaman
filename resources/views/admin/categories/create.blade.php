@extends('layouts.dashboard')
@section('title', 'Tambah Kategori')
@section('content')
<div class="bg-white p-6 max-w-xl shadow rounded-xl">
<form action="{{ route('admin.categories.store') }}" method="POST">@csrf
<div class="mb-4"><label class="block text-sm mb-1">Nama Kategori</label><input type="text" name="nama_kategori" class="w-full border rounded p-2" required></div>
<button class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button></form></div>
@endsection