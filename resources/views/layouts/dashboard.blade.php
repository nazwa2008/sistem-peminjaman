<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Peminjaman Alat') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Icons -->
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900 flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
            
            <!-- Topbar (Optional, minimal) -->
            <header class="bg-white border-b border-gray-100 flex items-center justify-between px-6 py-4 shadow-sm z-10 w-full shrink-0">
                <h1 class="text-xl font-semibold text-gray-800 hidden md:block">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center space-x-4 ml-auto">
                    <span class="text-sm text-gray-600 font-medium">Halo, {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors font-medium flex items-center gap-2">
                            <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50 relative pb-20">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded shadow-sm flex items-start">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0"></i>
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded shadow-sm flex items-start">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mr-2 flex-shrink-0"></i>
                        <p class="text-red-700 text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
        
        <script>
          lucide.createIcons();
        </script>
        @stack('scripts')
    </body>
</html>
