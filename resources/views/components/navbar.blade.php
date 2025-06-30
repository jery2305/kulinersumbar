@php
    $cartCount = session('cart') ? count(session('cart')) : 0;
@endphp

<nav class="sticky top-0 z-50 backdrop-blur-md bg-white/80 border-b border-gray-200 shadow">
    <div class="max-w-screen-xl mx-auto px-6 md:px-10">
        <div class="flex justify-between items-center py-6">
           <!-- Logo -->
            <a href="/" class="flex items-center space-x-3">
                <span class="text-2xl md:text-3xl font-extrabold italic tracking-tight text-red-600">
                    Kuliner<span class="text-yellow-500">Sumbar</span>.
                </span>
            </a>

            <!-- Toggle Button (Mobile) -->
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none" aria-controls="navbar-default" aria-expanded="false">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 5h14a1 1 0 010 2H3a1 1 0 010-2z" clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Desktop Menu -->
        <div class="hidden md:flex items-center justify-end w-full space-x-10" id="navbar-default">
            <!-- Menu Link -->
            <ul class="flex items-center space-x-8 font-medium text-gray-700 text-base">
                <li><a href="/" class="hover:text-blue-700">Home</a></li>
                <li><a href="/menu" class="hover:text-blue-700">Menu</a></li>
                <li><a href="/contact" class="hover:text-blue-700">Contact</a></li>
                <li><a href="{{ route('orders.history') }}" class="hover:text-blue-700">History</a></li>
            </ul>

            <!-- Action -->
            <div class="flex items-center gap-8">
                <!-- Cart -->
                <a href="/cart" class="relative text-gray-700 hover:text-red-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 3h2l.4 2M7 13h14l-1.35 6.45a2 2 0 01-2 1.55H7a2 2 0 01-2-2v-11h16M16 16a2 2 0 110 4 2 2 0 010-4zM8 16a2 2 0 110 4 2 2 0 010-4z"/>
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-semibold px-1.5 py-0.5 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- Auth -->
                @guest
                    <a href="{{ route('login') }}"
                        class="text-gray-700 hover:text-blue-700 font-medium">
                        Login
                    </a>
                @else
                    <div class="relative">
                        <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                            class="flex items-center gap-2 focus:outline-none">
                            <div class="w-9 h-9 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm uppercase">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden md:inline text-sm font-medium">{{ Auth::user()->name }}</span>
                        </button>

                        <!-- Dropdown -->
                        <div id="dropdownAvatar" class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 mt-2">
                            <div class="px-4 py-3 text-sm text-gray-900">
                                <div class="font-medium">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                            </div>
                            <ul class="py-2 text-sm text-gray-700">
                                <li>
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Edit Profil</a>
                                </li>
                            </ul>
                            <div class="py-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
