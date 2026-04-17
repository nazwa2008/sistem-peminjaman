@extends('layouts.dashboard')
@section('title', 'Edit Alat')
@section('content')
<div class="bg-white p-6 max-w-2xl shadow rounded-xl">
<form action="{{ route('admin.alat.update', $alat->id) }}" method="POST">@csrf @method('PUT')
<div class="mb-4"><label class="block text-sm mb-1">Nama Alat</label><input type="text" name="nama_alat" value="{{ $alat->nama_alat }}" class="w-full border rounded p-2" required></div>
<div class="mb-4"><label class="block text-sm mb-1">Kategori</label><select name="kategori_id" class="w-full border rounded p-2" required>@foreach($categories as $c)<option value="{{$c->id}}" @if($alat->kategori_id==$c->id) selected @endif>{{$c->nama_kategori}}</option>@endforeach</select></div>
<div class="mb-4"><label class="block text-sm mb-1">Stok</label><input type="number" name="stok" value="{{ $alat->stok }}" class="w-full border rounded p-2" required></div>
<div class="mb-4"><label class="block text-sm mb-1">Kondisi</label><input type="text" name="kondisi" value="{{ $alat->kondisi }}" class="w-full border rounded p-2" required></div>
<div class="mb-4"><label class="block text-sm mb-1">Status</label><select name="status" class="w-full border rounded p-2" required><option value="tersedia" @if($alat->status=='tersedia') selected @endif>Tersedia</option><option value="dipinjam" @if($alat->status=='dipinjam') selected @endif>Dipinjam</option></select></div>
<button class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button></form></div>
@endsection