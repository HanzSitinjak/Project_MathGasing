<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LevelBonus;

class LevelBonusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data LevelBonus
        $levelbonuss = LevelBonus::all();

        // Mengembalikan data LevelBonus sebagai respons JSON
        return response()->json(['data' => $levelbonuss]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_unit_Bonus' => 'required|exists:unit_bonus,id_unit_Bonus',
            'deskripsi' => 'required|string',
        ]);

        $levelbonus = LevelBonus::create([
            'id_unit_Bonus' => $request->input('id_unit_Bonus'),
            'level_number' => 1, // Set level_number to 1
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return response()->json(['message' => 'Pretest created successfully', 'data' => $levelbonus], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil data LevelBonus berdasarkan ID
        $levelbonus = LevelBonus::find($id);

        // Jika LevelBonus ditemukan, kembalikan sebagai respons JSON
        if ($levelbonus) {
            return response()->json(['data' => $levelbonus]);
        }

        // Jika LevelBonus tidak ditemukan, kembalikan pesan error
        return response()->json(['message' => 'Pretest not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'id_unit_Bonus' => 'required|exists:unit_bonus,id_unit_Bonus',
        'deskripsi' => 'required|string',
    ]);

    try {
        // Cari level bonus berdasarkan ID
        $levelbonus = LevelBonus::findOrFail($id);

        // Update data level bonus
        $levelbonus->update([
            'id_unit_Bonus' => $request->input('id_unit_Bonus'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        // Kirim respons sukses
        return response()->json(['message' => 'Level bonus updated successfully', 'data' => $levelbonus], 200);
    } catch (\Exception $e) {
        // Tangani kesalahan yang terjadi
        return response()->json(['message' => 'Failed to update level bonus: ' . $e->getMessage()], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mengambil data LevelBonus berdasarkan ID
        $levelbonus = LevelBonus::find($id);

        // Jika LevelBonus ditemukan, hapus
        if ($levelbonus) {
            $levelbonus->delete();

            // Mengembalikan pesan sukses
            return response()->json(['message' => 'Level Bonus deleted successfully']);
        }

        // Jika LevelBonus tidak ditemukan, kembalikan pesan error
        return response()->json(['message' => 'Level Bonus not found'], 404);
    }


    /**
 * Update the score_pretest for the specified LevelBonus.
 */
public function updateFinalScore(Request $request, $id)
{
    try {
        // Validasi input
        $request->validate([
            'score_bonus' => 'required|integer',
        ]);

        // Mengambil data LevelBonus berdasarkan ID LevelBonus
        $levelbonus = LevelBonus::find($id);

        // Jika LevelBonus ditemukan, update score_pretest
        if ($levelbonus) {
            $levelbonus->score_bonus = $request->score_bonus;
            $levelbonus->save(); // Simpan perubahan ke database

            // Mengembalikan pesan sukses
            return response()->json(['message' => 'Score updated successfully', 'data' => $levelbonus]);
        }

        // Jika LevelBonus tidak ditemukan, kembalikan pesan error
        return response()->json(['message' => 'Level Bonus not found for ID: ' . $id], 404);
    } catch (\Exception $e) {
        // Menangkap dan menampilkan kesalahan
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function getLevelBonusByUnit($id_unit_bonus)
{
    $levelBonuses = LevelBonus::where('id_unit_Bonus', $id_unit_bonus)->get();
    return response()->json(['data' => $levelBonuses]);
}

public function updateFinalScoreLevelBonus(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'score' => 'required|integer',
            ]);

            // Mendapatkan id_user berdasarkan pengguna yang sedang login
            $id_user = Auth::id();

            // Memastikan id_user, id_unit_Bonus, dan id_pretest ada di dalam request
            $request->validate([
                'id_unit_Bonus' => 'required|integer',
                'id_level_bonus' => 'required|integer',
            ]);

            // Membuat instance ScorePretest
            $scoreLevelBonus = new ScorelLevelBonus();
            $scoreLevelBonus->id_unit_Bonus = $request->id_unit_Bonus;
            $scoreLevelBonus->id_user = $id_user;
            $scoreLevelBonus->score = $request->score;
            $scoreLevelBonus->id_level_bonus = $request->id_level_bonus;
            
            // Menyimpan data ScorePretest
            $scoreLevelBonus->save();

            // Mengembalikan pesan sukses
            return response()->json(['message' => 'Score updated successfully', 'data' => $scoreLevelBonus]);
        } catch (\Exception $e) {
            // Menangkap dan menampilkan kesalahan
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}