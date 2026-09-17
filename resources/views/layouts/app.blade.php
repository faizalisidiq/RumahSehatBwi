<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Sehat Banyuwangi</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<!-- flex dan h-screen akan membuat body setinggi layar dan membagi isinya -->

<body class="flex h-screen bg-gray-50 font-sans text-gray-900 overflow-hidden">

    <!-- SIDEBAR (Kiri) -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col flex-shrink-0 shadow-sm">

        <!-- Logo Area -->
        <div class="h-16 flex items-center px-6 border-b border-gray-200">

            <img src="{{ asset('images/logo.png') }}" alt="Logo Terapi" class="w-10 h-10 object-contain mr-3">

            <a href="{{ route('dashboard') }}" class="font-bold text-xl text-teal-900">Rumah Sehat Banyuwangi</a>
        </div>

        <!-- Menu Navigasi -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

            <!-- Link Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-teal-50 hover:text-
                 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-600 font-medium' : '' }}">
                <!-- Icon Home (SVG) -->
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                Dashboard
            </a>

            <!-- Link Data Pasien -->
            <a href="{{ route('admin.patients.index') }}"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition-colors {{ request()->routeIs('admin.patients.*') ? 'bg-teal-50 text-teal-600 font-medium' : '' }}">
                <!-- Icon Users (SVG) -->
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                Data Pasien
            </a>

        </nav>

        <!-- Bagian Footer Sidebar -->
        <div class="p-4 border-t border-gray-200 text-sm text-gray-500 text-center">
            &copy; {{ date('Y') }} Terapi Keluarga
        </div>
    </aside>

    <!-- AREA KONTEN UTAMA (Kanan) -->
    <!-- flex-1 membuatnya mengambil sisa ruang layar, overflow-y-auto membuatnya bisa di-scroll terpisah dari sidebar -->
    <main class="flex-1 overflow-y-auto bg-gray-50 relative">
        <div class="p-4 sm:p-6 lg:p-8">
            @yield('content')
        </div>
    </main>

</body>

</html>
