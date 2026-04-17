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
        @foreach($users as $u)
        <tr class="border-b"><td class="px-6 py-3">{{ $u->name }}</td><td class="px-6 py-3">{{ $u->email }}</td><td class="px-6 py-3 uppercase text-xs">{{ $u->role }}</td>
        <td class="px-6 py-3">
            <a href="{{ route('admin.users.edit', $u->id) }}" class="text-blue-500 mr-2 hover:underline">Edit</a>
            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-500 hover:underline" onclick="return confirm('Hapus?')">Hapus</button></form>
        </td></tr>
        @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $users->links() }}</div>
</div>
@endsection