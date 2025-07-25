<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Student;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::with(['student', 'product'])->get();
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = \App\Models\Student::all();
        $products = \App\Models\Product::all();
        return view('loans.create', compact('students', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:irfan_students,id',
            'product_id' => 'required|exists:irfan_products,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
            'status' => 'required|in:pending,approved,returned,rejected',
        ]);
        $product = Product::findOrFail($validated['product_id']);
        if ($product->stock < 1) {
            return back()->withErrors(['product_id' => 'Stok barang tidak mencukupi'])->withInput();
        }
        $loan = Loan::create($validated);
        $product->decrement('stock');
        return redirect('/loans')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $loan = Loan::with(['student', 'product'])->findOrFail($id);
        return response()->json($loan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loan = Loan::findOrFail($id);
        $students = \App\Models\Student::all();
        $products = \App\Models\Product::all();
        return view('loans.edit', compact('loan', 'students', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        if (!$user || $user->role === 'mahasiswa') {
            return redirect('/loans')->with('success', 'Akses ditolak');
        }
        $loan = Loan::findOrFail($id);
        $validated = $request->validate([
            'student_id' => 'required|exists:irfan_students,id',
            'product_id' => 'required|exists:irfan_products,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
            'status' => 'required|in:pending,approved,returned,rejected',
        ]);
        // Hanya admin dan petugas yang boleh mengubah status
        if (isset($validated['status']) && $validated['status'] !== $loan->status) {
            if (!in_array($user->role, ['admin', 'petugas'])) {
                return redirect('/loans')->with('success', 'Hanya admin dan petugas yang dapat mengubah status peminjaman');
            }
        }
        $oldStatus = $loan->status;
        $loan->update($validated);
        // Jika status berubah dari selain 'returned' menjadi 'returned', stok produk dikembalikan
        if ($oldStatus !== 'returned' && $validated['status'] === 'returned') {
            $product = Product::find($loan->product_id);
            if ($product) {
                $product->increment('stock');
            }
        }
        return redirect('/loans')->with('success', 'Peminjaman berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        if (!$user || $user->role === 'mahasiswa') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return response()->json(['message' => 'Peminjaman berhasil dihapus']);
    }

    public function approve($id)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['admin', 'petugas'])) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }
        $loan = Loan::findOrFail($id);
        if ($loan->status !== 'pending') {
            return response()->json(['message' => 'Hanya peminjaman dengan status pending yang bisa di-approve'], 422);
        }
        $loan->status = 'approved';
        $loan->save();
        return response()->json(['message' => 'Peminjaman disetujui', 'loan' => $loan->load(['student', 'product'])]);
    }

    public function reject($id)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->role, ['admin', 'petugas'])) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }
        $loan = Loan::findOrFail($id);
        if ($loan->status !== 'pending') {
            return response()->json(['message' => 'Hanya peminjaman dengan status pending yang bisa di-reject'], 422);
        }
        $loan->status = 'rejected';
        $loan->save();
        // Kembalikan stok barang karena tidak jadi dipinjam
        $product = Product::find($loan->product_id);
        if ($product) {
            $product->increment('stock');
        }
        return response()->json(['message' => 'Peminjaman ditolak', 'loan' => $loan->load(['student', 'product'])]);
    }
}
