<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hotel Booking') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-white border-r">
            <div class="flex flex-col h-full">
                <div class="h-16 flex items-center justify-center border-b">
                    <span class="text-lg font-semibold">Admin Panel</span>
                </div>
                <nav class="flex-1 p-4">
                    <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-100">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.rooms.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-100">
                        Rooms
                    </a>
                    <a href="{{ route('admin.bookings.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-100">
                        Bookings
                    </a>
                </nav>
                <div class="p-4 border-t">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-2 px-4 text-left text-sm text-gray-700 hover:bg-gray-100 rounded">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64">
            <!-- Top Navigation -->
            <nav class="h-16 bg-white border-b flex items-center px-6">
                <span class="text-xl font-semibold">
                    @yield('header', 'Dashboard')
                </span>
            </nav>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>