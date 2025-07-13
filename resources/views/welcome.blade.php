<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Inventaris & Peminjaman Barang Teknik Sipil</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div class="text-xl font-bold text-gray-800">
            Inventaris Teknik Sipil
        </div>
        <div>
            <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 mr-2">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-white border border-gray-800 text-gray-800 rounded hover:bg-gray-100">Register</a>
        </div>
    </nav>
    <main class="flex-grow flex flex-col items-center justify-center">
        <h1 class="text-3xl md:text-5xl font-bold mb-4 text-gray-800 text-center">
            Sistem Informasi Inventaris & Peminjaman Barang<br>
            <span class="text-gray-500 text-2xl">Teknik Sipil</span>
        </h1>
        <p class="text-gray-600 mb-8 text-center max-w-xl">
            Aplikasi ini digunakan untuk mengelola data inventaris barang, peminjaman, dan pengembalian barang di lingkungan Teknik Sipil.
            Tersedia fitur login untuk admin, petugas, dan mahasiswa dengan hak akses berbeda.
        </p>
        <div>
            <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-800 text-white rounded hover:bg-gray-700 mr-2 text-lg">Login</a>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-white border border-gray-800 text-gray-800 rounded hover:bg-gray-100 text-lg">Register</a>
        </div>
    </main>
    <footer class="text-center text-gray-400 py-4">
        &copy; {{ date('Y') }} Teknik Sipil - Sistem Inventaris & Peminjaman Barang
    </footer>
</body>
</html>
