<aside class="w-64 bg-gray-900 border-r border-gray-800 text-white flex-shrink-0 relative h-full flex flex-col">
    <div class="h-16 flex items-center px-6 border-b border-gray-800 shrink-0">
        <i data-lucide="box" class="w-6 h-6 text-indigo-400 mr-3"></i>
        <span class="text-xl font-bold tracking-tight text-white">Sipa<span class="text-indigo-400">App</span></span>
    </div>

    <div class="px-4 py-6 flex-1 overflow-y-auto w-full">
        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400' }}"></i>
                Dashboard
            </a>

            @if(Auth::user()->role === 'admin')
            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Master Data</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i data-lucide="tags" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-gray-400' }}"></i>
                Kategori Alat
            </a>
            <a href="{{ route('admin.alat.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.alat.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i data-lucide="tool" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.alat.*') ? 'text-white' : 'text-gray-400' }}"></i>
                Data Alat
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i data-lucide="users" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400' }}"></i>
                Manajemen User
            </a>
            @endif

            @if(in_array(Auth::user()->role, ['admin', 'petugas']))
            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Transaksi</p>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('peminjaman.index') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i data-lucide="arrow-up-right-from-square" class="w-5 h-5 mr-3 {{ request()->routeIs('peminjaman.index') ? 'text-white' : 'text-gray-400' }}"></i>
                Peminjaman
            </a>
            <a href="{{ route('admin.pengembalian.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.pengembalian.index') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i data-lucide="corner-down-left" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.pengembalian.index') ? 'text-white' : 'text-gray-400' }}"></i>
                Pengembalian
            </a>
            <a href="{{ route('admin.laporan.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.laporan.index') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i data-lucide="printer" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.laporan.index') ? 'text-white' : 'text-gray-400' }}"></i>
                Laporan PDF
            </a>
            @endif

            {{-- 
            @if(Auth::user()->role === 'admin')
            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Sistem</p>
            </div>
            <a href="{{ route('admin.logs.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.logs.index') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i data-lucide="activity" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.logs.index') ? 'text-white' : 'text-gray-400' }}"></i>
                Log Aktivitas
            </a>
            @endif
            --}}

            @if(Auth::user()->role === 'peminjam')
            <div class="pt-4 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Menu Peminjam</p>
            </div>
            <a href="{{ route('peminjam.katalog') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('peminjam.katalog') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i data-lucide="grid" class="w-5 h-5 mr-3 {{ request()->routeIs('peminjam.katalog') ? 'text-white' : 'text-gray-400' }}"></i>
                Katalog Alat
            </a>
            <a href="{{ route('peminjam.riwayat') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('peminjam.riwayat') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <i data-lucide="clock" class="w-5 h-5 mr-3 {{ request()->routeIs('peminjam.riwayat') ? 'text-white' : 'text-gray-400' }}"></i>
                Riwayat Saya
            </a>
            @endif

        </nav>
    </div>
    <div class="p-4 border-t border-gray-800 text-xs text-gray-500 tracking-wide text-center shrink-0">
        &copy; 2026 SipaApp
    </div>
</aside>
