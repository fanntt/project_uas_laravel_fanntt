<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Student;
use App\Models\Product;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::with(['student', 'product'])->get();
        return response()->json($loans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Untuk API, biasanya tidak perlu form create
        return response()->json(['message' => 'Form create peminjaman']);
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
        $loan = Loan::create($validated);
        return response()->json($loan->load(['student', 'product']), 201);
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
        // Untuk API, biasanya tidak perlu form edit
        return response()->json(['message' => 'Form edit peminjaman', 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);
        $validated = $request->validate([
            'student_id' => 'required|exists:irfan_students,id',
            'product_id' => 'required|exists:irfan_products,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
            'status' => 'required|in:pending,approved,returned,rejected',
        ]);
        $loan->update($validated);
        return response()->json($loan->load(['student', 'product']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return response()->json(['message' => 'Peminjaman berhasil dihapus']);
    }
}
