<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionPosttest;

class QuestionPosttestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pertanyaan pretest
        $questions = QuestionPosttest::all();

        // Mengembalikan data pertanyaan pretest sebagai respons JSON
        return response()->json(['data' => $questions]);
    }

    public function getByPosttest(Request $request)
    {
        $id_posttest = $request->query('id_posttest');

        $query = QuestionPosttest::query();

        if ($id_posttest) {
            $query->where('id_posttest', $id_posttest);
        }

        $questions = $query->get();

        // Mengembalikan data pertanyaan posttest sebagai respons JSON
        return response()->json(['data' => $questions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_posttest' => 'required',
            'question' => 'required|string',
            'posttest_option_1' => 'required|string',
            'posttest_option_2' => 'required|string',
            'posttest_option_3' => 'required|string',
            'posttest_option_4' => 'required|string',
            'posttest_correct_index' => 'required|string',
        ]);

        // Membuat record baru dalam database
        $question = QuestionPosttest::create($request->all());

        // Mengembalikan pertanyaan pretest yang baru dibuat sebagai respons JSON
        return response()->json(['message' => 'Question created successfully', 'data' => $question], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil data pertanyaan pretest berdasarkan ID
        $question = QuestionPosttest::find($id);

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
            'id_posttest' => 'required|exists:posttest,id_posttest',
            'question' => 'required|string',
            'posttest_option_1' => 'required|string',
            'posttest_option_2' => 'required|string',
            'posttest_option_3' => 'required|string',
            'posttest_option_4' => 'required|string',
            'posttest_correct_index' => 'required|string',
        ]);

        // Temukan pertanyaan pretest berdasarkan ID
        $question = QuestionPosttest::find($id);

        // Jika pertanyaan pretest ditemukan, update dengan data baru
        if ($question) {
            $question->update($request->all());
            return response()->json(['message' => 'Question updated successfully', 'data' => $question]);
        }

        // Jika pertanyaan pretest tidak ditemukan, kembalikan pesan error
        return response()->json(['message' => 'Question not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $question = QuestionPosttest::find($id);
        if ($question) {
            $question->delete();

            return response()->json(['message' => 'Question deleted successfully']);
        }

        return response()->json(['message' => 'Question not found'], 404);
    }

    public function getQuestionByID($id_posttest)
    {
        $posttest = QuestionPosttest::where('id_posttest', $id_posttest)->get();
        return response()->json(['data' => $posttest]);
    }
}

