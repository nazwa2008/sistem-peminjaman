@extends('layouts.dashboard')
@section('title', 'Log Aktivitas Sistem')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-bold text-gray-800">Riwayat Aktivitas</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-600 bg-gray-50 uppercase border-b border-gray-100">
                <tr>
                    <th class="px-6 py-3">Waktu</th>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Aktivitas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 text-gray-500">{{ \Carbon\Carbon::parse($log->waktu)->format('d/m/Y H:i:s') }}</td>
                    <td class="px-6 py-3 font-medium">{{ $log->user->name }} ({{ $log->user->role }})</td>
                    <td class="px-6 py-3 text-gray-700">{{ $log->aktivitas }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-6 py-8 text-center text-gray-500">Tidak ada log aktivitas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 bg-gray-50">{{ $logs->links() }}</div>
</div>
@endsection
