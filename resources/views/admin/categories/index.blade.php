@extends('layouts.dashboard')
@section('title', 'Kategori Alat')
@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Tambah Kategori</a>
</div>
<div class="bg-white rounded-xl shadow p-4"><table class="w-full text-sm">
    <tr class="border-b bg-gray-50"><th class="p-2">Nama Kategori</th><th class="p-2">Aksi</th></tr>
    @foreach($categories as $c)
    <tr class="border-b"><td class="p-2">{{ $c->nama_kategori }}</td>
    <td class="p-2"><a href="{{ route('admin.categories.edit', $c->id) }}" class="text-blue-500 mr-2">Edit</a><form action="{{ route('admin.categories.destroy', $c->id) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-500">Hapus</button></form></td></tr>
    @endforeach
</table></div>
@endsection