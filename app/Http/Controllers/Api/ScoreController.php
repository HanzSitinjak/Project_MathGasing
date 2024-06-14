<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ScoreUser;
use App\Models\ScorePretest;

class ScoreController extends Controller
{
    
 public function index()
{
    // Gabungkan tabel utama dengan subquery untuk mencari nilai minimum
    $scores = DB::table('users')
        ->leftJoin('unit', 'users.id_user', '=', 'unit.id_user')
        ->leftJoin('score_pretest', function ($join) {
            $join->on('unit.id_unit', '=', 'score_pretest.id_unit');
        })
        ->leftJoin('score_posttest', function ($join) {
            $join->on('unit.id_unit', '=', 'score_posttest.id_unit');
        })
        ->leftJoin('materi', 'unit.id_materi', '=', 'materi.id_materi')
        ->select(
            'materi.id_materi', 
            'materi.title as materi_title',
            'users.id_user',
            DB::raw('COALESCE(score_pretest.score, 0) as score_pretest'),
            DB::raw('COALESCE(score_posttest.score, 0) as score_posttest')
        )
        ->get();

    // Jika data kosong, tambahkan nilai default untuk setiap user
    if ($scores->isEmpty()) {
        $users = DB::table('users')
            ->select('id_user')
            ->get();

        $defaultScores = [];

        foreach ($users as $user) {
            // Periksa apakah user memiliki nilai atau tidak
            $existingScore = DB::table('unit')
                ->where('id_user', $user->id_user)
                ->exists();

            if (!$existingScore) {
                $defaultScores[] = [
                    'id_materi' => 1, // Misalnya, ID materi default
                    'materi_title' => 'Pengurangan', // Misalnya, judul materi default
                    'id_user' => $user->id_user,
                    'score_pretest' => 0,
                    'score_posttest' => 0,
                ];
            }
        }

        if (empty($defaultScores)) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json(['data' => $defaultScores]);
    }

    return response()->json(['data' => $scores]);
}



public function show($id)
{
    // Subquery untuk mendapatkan id_ScorePreTest terkecil
    $pretestSubquery = DB::table('score_pretest')
        ->selectRaw('MIN(id_ScorePreTest) as min_pretest_id, id_user, id_unit')
        ->groupBy('id_user', 'id_unit');

    // Subquery untuk mendapatkan id_ScorePostTest terkecil
    $posttestSubquery = DB::table('score_posttest')
        ->selectRaw('MIN(id_ScorePostTest) as min_posttest_id, id_user, id_unit')
        ->groupBy('id_user', 'id_unit');

    // Gabungkan subquery dengan tabel utama dan filter berdasarkan id_user
    $scores = DB::table('score_pretest')
        ->joinSub($pretestSubquery, 'min_pretests', function ($join) {
            $join->on('score_pretest.id_ScorePreTest', '=', 'min_pretests.min_pretest_id');
        })
        ->joinSub($posttestSubquery, 'min_posttests', function ($join) {
            $join->on('score_pretest.id_user', '=', 'min_posttests.id_user')
                ->on('score_pretest.id_unit', '=', 'min_posttests.id_unit');
        })
        ->join('score_posttest', function ($join) {
            $join->on('min_posttests.min_posttest_id', '=', 'score_posttest.id_ScorePostTest');
        })
        ->join('unit', 'score_pretest.id_unit', '=', 'unit.id_unit')
        ->join('materi', 'unit.id_materi', '=', 'materi.id_materi')
        ->select(
            'materi.id_materi', 'materi.title as materi_title',
            'score_pretest.id_user', 'score_pretest.id_unit',
            'score_pretest.score as score_pretest',
            'score_posttest.score as score_posttest'
        )
        ->where('score_pretest.id_user', $id)
        ->get();

    if ($scores->isEmpty()) {
        return response()->json(['message' => 'Data not found'], 404);
    }

    return response()->json(['data' => $scores], 201);
}


    public function averageScoresPretestByMateri()
    {
        $averageScoresPretest = DB::table('materi')
            ->leftJoin('unit', 'materi.id_materi', '=', 'unit.id_materi')
            ->leftJoin('score_pretest', 'unit.id_unit', '=', 'score_pretest.id_unit')
            ->select('materi.id_materi', 'materi.title', DB::raw('AVG(score_pretest.score) as average_score'))
            ->groupBy('materi.id_materi', 'materi.title')
            ->get();

        
        return response()->json($averageScoresPretest);
    }
    
    public function averageScoresPosttestByMateri()
    {
        $averageScoresPosttest = DB::table('materi')
            ->leftJoin('unit', 'materi.id_materi', '=', 'unit.id_materi')
            ->leftJoin('score_posttest', 'unit.id_unit', '=', 'score_posttest.id_unit') // Mengganti score_pretest menjadi score_posttest
            ->select('materi.id_materi', 'materi.title', DB::raw('AVG(score_posttest.score) as average_score')) // Menghitung rata-rata skor dari score_posttest
            ->groupBy('materi.id_materi', 'materi.title')
            ->get();

        
        return response()->json($averageScoresPosttest);
    }

    public function updateFinalScorePretest(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'score_pretest' => 'required|integer',
            ]);
    
            // Mencari atau membuat data skor berdasarkan ID
            $scorePretest = ScorePretest::firstOrNew(['id_pretest' => $id]);
    
            // Mengisi atau memperbarui skor
            $scorePretest->id_pretest = $id;
            $scorePretest->id_unit = $request->input('id_unit'); // Sesuaikan dengan input yang diterima
            $scorePretest->id_user = $request->input('id_user'); // Sesuaikan dengan input yang diterima
            $scorePretest->score = $request->input('score_pretest');
            $scorePretest->save(); // Simpan perubahan ke database
    
            // Mengembalikan pesan sukses
            return response()->json(['message' => 'Score updated successfully', 'data' => $scorePretest]);
        } catch (\Exception $e) {
            // Menangkap dan menampilkan kesalahan
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } 
}
