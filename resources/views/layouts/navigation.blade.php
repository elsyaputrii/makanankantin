<!-- Pastikan Alpine.js sudah terpasang di <head> -->
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo dan Link -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <img src="/logo.png" alt="Logo" class="h-8 w-8" />
                    <span class="ms-3 font-semibold text-lg text-gray-800">KantinApp</span>
                </a>
                <div class="hidden sm:flex space-x-8 ms-10">
                    <a href="{{ route('dashboard') }}"
                       class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-orange-600' : 'text-gray-700' }} hover:text-orange-500">
                        Dashboard
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">
                        {{ Auth::user()->name }}
                        <svg class="ms-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.1 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition">
                    <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden px-4 pb-4">
        <a href="{{ route('dashboard') }}"
           class="block py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-orange-600' : 'text-gray-700' }} hover:text-orange-500">
            Dashboard
        </a>
        <div class="border-t border-gray-200 pt-4">
            <div class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</div>
            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
        </div>
        <div class="mt-3 space-y-1">
            <a href="{{ route('profile.edit') }}"
               class="block text-sm text-gray-700 hover:text-orange-500">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left text-sm text-red-600 hover:text-red-500">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</nav>
