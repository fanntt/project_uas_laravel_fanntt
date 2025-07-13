<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Untuk API, biasanya tidak perlu form create
        return response()->json(['message' => 'Form create mahasiswa']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:irfan_students,nim',
            'email' => 'required|email|unique:irfan_students,email',
            'phone' => 'required|string|max:20',
        ]);
        $student = Student::create($validated);
        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Untuk API, biasanya tidak perlu form edit
        return response()->json(['message' => 'Form edit mahasiswa', 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:irfan_students,nim,' . $student->id,
            'email' => 'required|email|unique:irfan_students,email,' . $student->id,
            'phone' => 'required|string|max:20',
        ]);
        $student->update($validated);
        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json(['message' => 'Mahasiswa berhasil dihapus']);
    }
}
