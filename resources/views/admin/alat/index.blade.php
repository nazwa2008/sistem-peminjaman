@extends('layouts.dashboard')
@section('title', 'Data Alat')
@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.alat.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Tambah Alat</a>
</div>
<div class="bg-white rounded-xl shadow p-4 overflow-x-auto"><table class="w-full text-sm">
    <tr class="border-b bg-gray-50"><th class="p-2">Nama</th><th class="p-2">Kategori</th><th class="p-2">Stok</th><th class="p-2">Kondisi</th><th class="p-2">Status</th><th class="p-2">Aksi</th></tr>
    @foreach($alats as $a)
    <tr class="border-b"><td class="p-2">{{ $a->nama_alat }}</td><td class="p-2">{{ $a->kategori->nama_kategori }}</td><td class="p-2">{{ $a->stok }}</td><td class="p-2">{{ $a->kondisi }}</td><td class="p-2">{{ $a->status }}</td>
    <td class="p-2"><a href="{{ route('admin.alat.edit', $a->id) }}" class="text-blue-500 mr-2">Edit</a><form action="{{ route('admin.alat.destroy', $a->id) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-500" onclick="return confirm('Hapus?')">Hapus</button></form></td></tr>
    @endforeach
</table></div>
@endsection