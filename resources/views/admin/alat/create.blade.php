@extends('layouts.dashboard')
@section('title', 'Tambah Alat')
@section('content')
<div class="bg-white p-6 max-w-2xl shadow rounded-xl">
<form action="{{ route('admin.alat.store') }}" method="POST">@csrf
<div class="mb-4"><label class="block text-sm mb-1">Nama Alat</label><input type="text" name="nama_alat" class="w-full border rounded p-2" required></div>
<div class="mb-4"><label class="block text-sm mb-1">Kategori</label><select name="kategori_id" class="w-full border rounded p-2" required>@foreach($categories as $c)<option value="{{$c->id}}">{{$c->nama_kategori}}</option>@endforeach</select></div>
<div class="mb-4"><label class="block text-sm mb-1">Stok</label><input type="number" name="stok" class="w-full border rounded p-2" required></div>
<div class="mb-4"><label class="block text-sm mb-1">Kondisi</label><input type="text" name="kondisi" value="Baik" class="w-full border rounded p-2" required></div>
<button class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button></form></div>
@endsection