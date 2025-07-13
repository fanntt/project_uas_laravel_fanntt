@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
    <h1 class="text-xl font-semibold mb-6 text-gray-800">Edit Peminjaman</h1>
    <form action="{{ url('/loans/'.$loan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block mb-1 text-gray-700">Mahasiswa</label>
            <select name="student_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" required @if(auth()->user()->role == 'mahasiswa') disabled @endif>
                <option value="">Pilih Mahasiswa</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id', $loan->student_id) == $student->id ? 'selected' : '' }}>{{ $student->name }} ({{ $student->nim }})</option>
                @endforeach
            </select>
            @error('student_id')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 text-gray-700">Produk</label>
            <select name="product_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" required @if(auth()->user()->role == 'mahasiswa') disabled @endif>
                <option value="">Pilih Produk</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $loan->product_id) == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
            @error('product_id')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 text-gray-700">Tanggal Pinjam</label>
            <input type="date" name="loan_date" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" required value="{{ old('loan_date', $loan->loan_date) }}" @if(auth()->user()->role == 'mahasiswa') disabled @endif>
            @error('loan_date')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 text-gray-700">Tanggal Kembali (opsional)</label>
            <input type="date" name="return_date" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" value="{{ old('return_date', $loan->return_date) }}">
            @error('return_date')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        @if(in_array(auth()->user()->role ?? '', ['admin','petugas']))
        <div>
            <label class="block mb-1 text-gray-700">Status</label>
            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-gray-900" required>
                <option value="pending" {{ old('status', $loan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ old('status', $loan->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="returned" {{ old('status', $loan->status) == 'returned' ? 'selected' : '' }}>Returned</option>
                <option value="rejected" {{ old('status', $loan->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            @error('status')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>
        @else
            <input type="hidden" name="status" value="{{ $loan->status }}">
        @endif
        <div class="flex justify-end">
            <a href="{{ url('/loans') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 mr-2">Batal</a>
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded hover:bg-black">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
