<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
            <input 
                id="email" 
                class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none"
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="email" 
                placeholder="admin@sipa.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-medium text-primary-600 hover:text-primary-500 transition-colors" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>
            <input 
                id="password" 
                class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-500 focus:border-primary-500 transition-all outline-none"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="w-4 h-4 text-primary-600 border-gray-200 rounded focus:ring-primary-500" name="remember">
            <label for="remember_me" class="ms-2 text-sm text-gray-500">Ingat saya</label>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all">
                Masuk ke Akun
            </button>
        </div>

        <!-- Demo Accounts -->
        <div class="mt-8 pt-6 border-t border-gray-100">
            <p class="text-[10px] uppercase font-bold tracking-widest text-gray-400 mb-4 text-center">Akun Demo</p>
            <div class="grid grid-cols-1 gap-2">
                <div class="flex items-center justify-between p-2 rounded-lg bg-gray-50 border border-gray-100">
                    <span class="text-[11px] font-medium text-gray-500">Admin</span>
                    <code class="text-[11px] text-primary-600">admin@sipa.com</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-gray-50 border border-gray-100">
                    <span class="text-[11px] font-medium text-gray-500">Petugas</span>
                    <code class="text-[11px] text-primary-600">petugas@sipa.com</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-gray-50 border border-gray-100">
                    <span class="text-[11px] font-medium text-gray-500">Peminjam</span>
                    <code class="text-[11px] text-primary-600">budi@sipa.com</code>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>
