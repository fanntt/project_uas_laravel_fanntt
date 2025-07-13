<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventaris Teknik Sipil')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <span class="font-bold text-xl tracking-tight text-gray-800">Inventaris Teknik Sipil</span>
                <ul class="flex space-x-6 text-sm">
                    <li><a href="/" class="hover:text-black text-gray-600">Dashboard</a></li>
                    <li><a href="/categories" class="hover:text-black text-gray-600">Kategori</a></li>
                    <li><a href="/products" class="hover:text-black text-gray-600">Produk</a></li>
                    <li><a href="/students" class="hover:text-black text-gray-600">Mahasiswa</a></li>
                    <li><a href="/loans" class="hover:text-black text-gray-600">Peminjaman</a></li>
                </ul>
            </div>
        </nav>
        <main class="flex-1 container mx-auto px-4 py-8">
            @yield('content')
        </main>
        <footer class="text-center text-xs text-gray-400 py-4 border-t border-gray-200 bg-white">
            &copy; {{ date('Y') }} Inventaris Teknik Sipil. All rights reserved.
        </footer>
    </div>
</body>
</html>
