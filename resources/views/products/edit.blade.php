@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
    <h1 class="text-xl font-semibold mb-6 text-gray-800">Edit Produk</h1>
    <form action="{{ url('/products/'.$product->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block mb-1 text-gray-700">Nama Produk</label>
            <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" required value="{{ old('name', $product->name) }}">
            @error('name')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 text-gray-700">Kategori</label>
            <select name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 text-gray-700">Stok</label>
            <input type="number" name="stock" min="0" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" required value="{{ old('stock', $product->stock) }}">
            @error('stock')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 text-gray-700">Deskripsi</label>
            <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex justify-end">
            <a href="{{ url('/products') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 mr-2">Batal</a>
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded hover:bg-black">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
