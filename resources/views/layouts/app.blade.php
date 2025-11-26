<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Book Management System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Navigation Bar - Fixed at Top -->
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-lg z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('books.index') }}" class="text-xl sm:text-2xl font-bold text-indigo-600 whitespace-nowrap">
                        📚 Library Master
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-1">
                    <a href="{{ route('books.index') }}" class="px-3 py-2 rounded-md text-xs sm:text-sm font-medium @if(request()->routeIs('books.*')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif transition">
                        Books
                    </a>
                    <a href="{{ route('categories.index') }}" class="px-3 py-2 rounded-md text-xs sm:text-sm font-medium @if(request()->routeIs('categories.*')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif transition">
                        Categories
                    </a>
                    <a href="{{ route('users.index') }}" class="px-3 py-2 rounded-md text-xs sm:text-sm font-medium @if(request()->routeIs('users.*')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif transition">
                        Users
                    </a>
                    <a href="{{ route('borrow.issue') }}" class="px-3 py-2 rounded-md text-xs sm:text-sm font-medium @if(request()->routeIs('borrow.issue')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif transition">
                        Issue
                    </a>
                    <a href="{{ route('borrow.return') }}" class="px-3 py-2 rounded-md text-xs sm:text-sm font-medium @if(request()->routeIs('borrow.return')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif transition">
                        Return
                    </a>
                    <a href="{{ route('borrow.logs') }}" class="px-3 py-2 rounded-md text-xs sm:text-sm font-medium @if(request()->routeIs('borrow.logs')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif transition">
                        Logs
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden border-t border-gray-200 bg-white">
                <a href="{{ route('books.index') }}" class="block px-3 py-2 rounded-md text-sm font-medium @if(request()->routeIs('books.*')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif">
                    Books
                </a>
                <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded-md text-sm font-medium @if(request()->routeIs('categories.*')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif">
                    Categories
                </a>
                <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded-md text-sm font-medium @if(request()->routeIs('users.*')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif">
                    Users
                </a>
                <a href="{{ route('borrow.issue') }}" class="block px-3 py-2 rounded-md text-sm font-medium @if(request()->routeIs('borrow.issue')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif">
                    Issue Book
                </a>
                <a href="{{ route('borrow.return') }}" class="block px-3 py-2 rounded-md text-sm font-medium @if(request()->routeIs('borrow.return')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif">
                    Return Book
                </a>
                <a href="{{ route('borrow.logs') }}" class="block px-3 py-2 rounded-md text-sm font-medium @if(request()->routeIs('borrow.logs')) bg-indigo-100 text-indigo-600 @else text-gray-700 hover:bg-gray-100 @endif">
                    Logs
                </a>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        @include('components.alert', ['type' => 'success', 'message' => session('success')])
    @endif

    @if(session('error'))
        @include('components.alert', ['type' => 'error', 'message' => session('error')])
    @endif

    <!-- Main Content -->
    <main class="grow w-full px-2 sm:px-4 lg:px-8 py-6 sm:py-8 pt-20 sm:pt-28 pb-32">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </main>

    <!-- Footer - Fixed at Bottom -->
    <footer class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-40">
        <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-5">
            <p class="text-center text-gray-600 text-xs sm:text-sm">
                &copy; 2025 Library Book Management System. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
