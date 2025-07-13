@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Daftar Peminjaman</h1>
    <a href="{{ url('/loans/create') }}" class="px-4 py-2 bg-gray-900 text-white rounded hover:bg-black transition">Tambah Peminjaman</a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
@endif

<div class="bg-white shadow rounded-lg overflow-x-auto">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Mahasiswa</th>
                <th class="px-4 py-2">Produk</th>
                <th class="px-4 py-2">Tgl Pinjam</th>
                <th class="px-4 py-2">Tgl Kembali</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $loan->student->name ?? '-' }}</td>
                <td class="px-4 py-2">{{ $loan->product->name ?? '-' }}</td>
                <td class="px-4 py-2">{{ $loan->loan_date }}</td>
                <td class="px-4 py-2">{{ $loan->return_date ?? '-' }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded text-xs
                        @if($loan->status=='pending') bg-gray-300 text-gray-700
                        @elseif($loan->status=='approved') bg-green-200 text-green-800
                        @elseif($loan->status=='returned') bg-blue-200 text-blue-800
                        @elseif($loan->status=='rejected') bg-red-200 text-red-800
                        @endif">
                        {{ ucfirst($loan->status) }}
                    </span>
                </td>
                <td class="px-4 py-2 text-center">
                    <a href="{{ url('/loans/'.$loan->id.'/edit') }}" class="text-xs px-3 py-1 bg-gray-700 text-white rounded hover:bg-black transition">Edit</a>
                    <form action="{{ url('/loans/'.$loan->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-500 hover:text-white transition ml-1" onclick="return confirm('Yakin hapus peminjaman?')">Hapus</button>
                    </form>
                    @if(in_array(auth()->user()->role ?? '', ['admin','petugas']) && $loan->status=='pending')
                        <form action="{{ url('/loans/'.$loan->id.'/approve') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-xs px-3 py-1 bg-green-700 text-white rounded hover:bg-green-900 transition ml-1">Approve</button>
                        </form>
                        <form action="{{ url('/loans/'.$loan->id.'/reject') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-xs px-3 py-1 bg-red-700 text-white rounded hover:bg-red-900 transition ml-1">Reject</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-4 py-6 text-center text-gray-400">Belum ada peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
