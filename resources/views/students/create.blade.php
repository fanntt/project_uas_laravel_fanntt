@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
    <h1 class="text-xl font-semibold mb-6 text-gray-800">Tambah Mahasiswa</h1>
    <form action="{{ url('/students') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1 text-gray-700">Nama</label>
            <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" required value="{{ old('name') }}">
            @error('name')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 text-gray-700">NIM</label>
            <input type="text" name="nim" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" required value="{{ old('nim') }}">
            @error('nim')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 text-gray-700">Email</label>
            <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" required value="{{ old('email') }}">
            @error('email')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 text-gray-700">No HP</label>
            <input type="text" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" required value="{{ old('phone') }}">
            @error('phone')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex justify-end">
            <a href="{{ url('/students') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 mr-2">Batal</a>
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded hover:bg-black">Simpan</button>
        </div>
    </form>
</div>
@endsection
