<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionLevelBonus;

class QuestionLevelBonusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAll()
    {
        // Mengambil semua data pertanyaan pretest
        $questions = QuestionLevelBonus::all();

        // Mengembalikan data pertanyaan pretest sebagai respons JSON
        return response()->json(['data' => $questions]);
    }
    
    public function index(Request $request)
    {
        // Mengambil semua data pertanyaan level_bonus
        $id_level_bonus = $request->query('id_level_bonus');

        $query = QuestionLevelBonus::query();

        if ($id_level_bonus) {
            $query->where('id_level_bonus', $id_level_bonus);
        }

        $questions = $query->get();

        // Mengembalikan data pertanyaan pretest sebagai respons JSON
        return response()->json(['data' => $questions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_level_bonus' => 'required',
            'question' => 'required|string',
            'option_1' => 'required|string',
            'option_2' => 'required|string',
            'option_3' => 'required|string',
            'option_4' => 'required|string',
            'correct_index' => 'required|string',
        ]);

        // Membuat record baru dalam database
        $question = QuestionLevelBonus::create($request->all());

        // Mengembalikan pertanyaan pretest yang baru dibuat sebagai respons JSON
        return response()->json(['message' => 'Question created successfully', 'data' => $question], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil data pertanyaan pretest berdasarkan ID
        $question = QuestionLevelBonus::find($id);

        // Jika pertanyaan pretest ditemukan, kembalikan sebagai respons JSON
        if ($question) {
            return response()->json(['data' => $question]);
        }

        // Jika pertanyaan pretest tidak ditemukan, kembalikan pesan error
        return response()->json(['message' => 'Question not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'id_level_bonus' => 'required',
        'question' => 'required|string',
        'option_1' => 'required|string',
        'option_2' => 'required|string',
        'option_3' => 'required|string',
        'option_4' => 'required|string',
        'correct_index' => 'required|string',
    ]);

    // Mencari record yang akan diperbarui
    $question = QuestionLevelBonus::findOrFail($id);

    // Memperbarui record dalam database
    $question->update($request->all());

    // Mengembalikan respons JSON setelah record diperbarui
    return response()->json(['message' => 'Question updated successfully', 'data' => $question], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $question = QuestionLevelBonus::find($id);
        if ($question) {
            $question->delete();

            return response()->json(['message' => 'Question deleted successfully']);
        }

        return response()->json(['message' => 'Question not found'], 404);
    }

    public function getQuestionByID($id_level_bonus)
    {
        $levelbonus = QuestionLevelBonus::where('id_level_bonus', $id_level_bonus)->get();
        return response()->json(['data' => $levelbonus]);
    }
}

