<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data unit
        $units = Unit::all();

        // Mengembalikan data unit sebagai respons JSON
        return response()->json(['data' => $units]);
    }

    public function getByIdMateri(Request $request)
    {
        // Mendapatkan id_materi dari query parameter
        $id_materi = $request->query('id_materi');

        // Membuat query untuk mengambil semua data unit
        $query = Unit::query();

        // Jika id_materi diberikan, filter unit berdasarkan id_materi
        if ($id_materi) {
            $query->where('id_materi', $id_materi);
        }

        // Mengambil data unit sesuai dengan query yang telah dibuat
        $units = $query->get();

        // Mengembalikan data unit sebagai respons JSON
        return response()->json(['data' => $units]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_materi' => 'required|exists:materi,id_materi',
            'title' => 'required',
            'explanation' => 'required',
        ]);

        $unit = Unit::create([
            'id_materi' => $request->id_materi,
            'title' => $request->title,
            'explanation' => $request->explanation,
        ]);

        return response()->json(['message' => 'Unit created successfully', 'data' => $unit]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengambil data unit berdasarkan ID
        $unit = Unit::findOrFail($id);

        // Mengembalikan data unit sebagai respons JSON
        return response()->json(['data' => $unit]);
    }

    public function getUnitsByMateri($id_materi)
    {
        $units = Unit::where('id_materi', $id_materi)->get();
        return response()->json(['data' => $units]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_materi' => 'required|exists:materi,id_materi',
            'title' => 'required',
            'explanation' => 'required',
        ]);

        $unit = Unit::findOrFail($id);
        $unit->update([
            'id_materi' => $request->id_materi,
            'title' => $request->title,
            'explanation' => $request->explanation,
        ]);

        return response()->json(['message' => 'Unit updated successfully', 'data' => $unit]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::find($id);
        if ($unit) {
            $unit->delete();
            return response()->json(['message' => 'Unit deleted successfully']);
        }
        return response()->json(['message' => 'Unit not found'], 404);
    }
}
