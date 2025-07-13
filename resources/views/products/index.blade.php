@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Daftar Produk</h1>
    <a href="{{ url('/products/create') }}" class="px-4 py-2 bg-gray-900 text-white rounded hover:bg-black transition">Tambah Produk</a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
@endif

<div class="bg-white shadow rounded-lg overflow-x-auto">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Nama Produk</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Stok</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                <td class="px-4 py-2">{{ $product->stock }}</td>
                <td class="px-4 py-2 text-center">
                    <a href="{{ url('/products/'.$product->id.'/edit') }}" class="text-xs px-3 py-1 bg-gray-700 text-white rounded hover:bg-black transition">Edit</a>
                    <form action="{{ url('/products/'.$product->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-500 hover:text-white transition ml-1" onclick="return confirm('Yakin hapus produk?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-6 text-center text-gray-400">Belum ada produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
