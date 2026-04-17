<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPA') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside 
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0"
            :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
        >
            <div class="h-full flex flex-col">
                <!-- Logo -->
                <div class="px-6 py-8">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center text-white">
                            <i data-lucide="package" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-gray-900">SIPA</span>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 space-y-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="layout-dashboard">
                        Dashboard
                    </x-nav-link>

                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')
                        <div class="pt-4 pb-2 px-2">
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Manajemen</span>
                        </div>
                        <x-nav-link :href="route('admin.alat.index')" :active="request()->routeIs('admin.alat.*')" icon="box">
                            Data Alat
                        </x-nav-link>



                        @if(auth()->user()->role == 'admin')
                        <x-nav-link :href="route('admin.petugas.index')" :active="request()->routeIs('admin.petugas.*')" icon="users">
                            Data Petugas
                        </x-nav-link>
                        @endif

                        <x-nav-link :href="route('admin.persetujuan.index')" :active="request()->routeIs('admin.persetujuan.*')" icon="check-square">
                            Persetujuan
                        </x-nav-link>
                        <x-nav-link :href="route('admin.pengembalian.index')" :active="request()->routeIs('admin.pengembalian.*')" icon="undo-2">
                            Pengembalian
                        </x-nav-link>
                    @endif

                    <div class="pt-4 pb-2 px-2">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Transaksi</span>
                    </div>
                    <x-nav-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.index')" icon="clipboard-list">
                        Data Peminjaman
                    </x-nav-link>

                    @if(auth()->user()->role == 'peminjam')
                        <x-nav-link :href="route('peminjaman.create')" :active="request()->routeIs('peminjaman.create')" icon="plus-circle">
                            Pinjam Alat
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')
                        <div class="pt-4 pb-2 px-2">
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Laporan</span>
                        </div>
                        <x-nav-link :href="route('admin.pengingat.index')" :active="request()->routeIs('admin.pengingat.*')" icon="bell">
                            Pengingat
                        </x-nav-link>
                        <x-nav-link :href="route('admin.laporan.index')" :active="request()->routeIs('admin.laporan.*')" icon="file-text">
                            Laporan
                        </x-nav-link>
                    @endif
                </nav>

                <!-- User Footer -->
                <div class="p-4 border-t border-gray-100">
                    <div class="flex items-center gap-3 px-2 py-3">
                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold">
                            {{ substr(auth()->user()->name, 0, 2) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate capitalize">{{ auth()->user()->role }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-2 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md transition-colors">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Overlay -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            class="fixed inset-0 z-40 bg-black/50 lg:hidden"
            x-transition:enter="transition opacity-100 duration-300"
            x-transition:leave="transition opacity-0 duration-300"
        ></div>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Topbar (Fixed) -->
            <header class="sticky top-0 z-30 flex items-center justify-between px-6 py-4 bg-white/80 backdrop-blur-md border-bottom border-gray-200">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-md">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-gray-900">@yield('header', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <div class="flex flex-col items-end text-right hidden sm:flex">
                        <span class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 lg:p-10">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 rounded-lg flex items-center gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-green-500"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-700 rounded-lg flex items-center gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-500"></i>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
