<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\ScorePosttest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ScorePosttestController extends Controller
{
    public function index()
    {
        $subquery = ScorePosttest::selectRaw('MIN(id_ScorePostTest) as min_id, id_user, id_posttest, id_unit')
            ->groupBy('id_user', 'id_posttest', 'id_unit');
    
        $scorePosttest = ScorePosttest::joinSub($subquery, 'min_scores', function ($join) {
                $join->on('score_posttest.id_ScorePostTest', '=', 'min_scores.min_id');
            })
            ->select('score_posttest.*')
            ->get();
    
        return response()->json(['data' => $scorePosttest]);
    }

    public function show($id){
        $scorePosttest = ScorePosttest::findOrFail($id);
        return response() -> json(['data' => $scorePosttest]);
    }

    public function addScore(Request $request){
        $validator = Validator::make($request->all(),[
            'id_user'=>'required|numeric',
            'id_Posttest'=>'required|numeric',
            'id_unit'=>'required|numeric',
            'score'=>'required|numeric',
        ]);

        if($validator -> fails()){
            return response() -> json(['errors' => $validator -> errors()], 400);
        }
        $scorePosttest = ScorePosttest::create([
            'id_user'=> $request->id_user,
            'id_Posttest'=> $request->id_Posttest,
            'id_unit'=> $request->id_unit,
            'score'=> $request->score,
        ]);

        return response()->json(['data' => $scorePosttest], 201);
    }

    public function updateFinalScorePosttest(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'score' => 'required|integer',
            ]);

            // Mendapatkan id_user berdasarkan pengguna yang sedang login
            $id_user = Auth::id();

            // Memastikan id_user, id_unit, dan id_posttest ada di dalam request
            $request->validate([
                'id_unit' => 'required|integer',
                'id_posttest' => 'required|integer',
            ]);

            // Membuat instance ScorePosttest
            $scorePosttest = new ScorePosttest();
            $scorePosttest->id_unit = $request->id_unit;
            $scorePosttest->id_user = $id_user;
            $scorePosttest->score = $request->score;
            $scorePosttest->id_posttest = $request->id_posttest;
            
            // Menyimpan data ScorePosttest
            $scorePosttest->save();

            // Mengembalikan pesan sukses
            return response()->json(['message' => 'Score updated successfully', 'data' => $scorePosttest]);
        } catch (\Exception $e) {
            // Menangkap dan menampilkan kesalahan
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getPosttestByUnit($unitId)
    {
        $userId = Auth::id();
        $scores = ScorePosttest::where('id_user', $userId)
                              ->where('id_unit', $unitId)
                              ->get();
        if ($scores->isEmpty()) {
            return response()->json(['message' => 'No data found'], 404);
        }
        return response()->json($scores);
    }

    public function getPosttestByUnitSmallIdScore($unitId)
    {
        $userId = Auth::id();
        
        // Query untuk mengambil data dengan id_unit tertentu yang dimiliki oleh user yang login,
        // diurutkan berdasarkan id_ScorePosttest, dan hanya mengambil baris pertama.
        $score = ScorePosttest::where('id_user', $userId)
                             ->where('id_unit', $unitId)
                             ->orderBy('id_ScorePosttest', 'asc')
                             ->first();

        if ($score) {
            return response()->json($score);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }

    public function getSmallestScorePosttestByUnit()
    {
        $userId = Auth::id();
    
        // Subquery untuk mendapatkan id_ScorePosttest terkecil di setiap unit
        $subquery = ScorePosttest::selectRaw('MIN(id_ScorePosttest) as min_id, id_unit')
            ->where('id_user', $userId)
            ->groupBy('id_unit')
            ->pluck('min_id');
    
        // Ambil detail ScorePosttest berdasarkan hasil subquery dan urutkan berdasarkan id_unit
        $scores = ScorePosttest::whereIn('id_ScorePosttest', $subquery)
            ->orderBy('id_unit')
            ->get();
    
        return response()->json($scores);
    }

    public function getTotalPosttestScoreForAllUsers()
    {
        try {
            // Subquery untuk mendapatkan id_ScorePosttest terkecil untuk setiap kombinasi id_user dan id_unit
            $subquery = ScorePosttest::selectRaw('MIN(id_ScorePosttest) as min_id')
                                    ->groupBy('id_user', 'id_unit')
                                    ->pluck('min_id');

            // Ambil detail ScorePosttest berdasarkan hasil subquery
            $scores = ScorePosttest::whereIn('id_ScorePosttest', $subquery)
                                ->get();

            // Kelompokkan hasil berdasarkan id_user dan hitung total skor untuk setiap user
            $totalScores = $scores->groupBy('id_user')->map(function ($userScores) {
                return $userScores->sum('score'); // Asumsi kolom skor bernama 'score'
            });

            return response()->json(['total_scores' => $totalScores]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getScoresPosttest()
    {
        try {
            $id_user = Auth::id();

            $scores = ScorePosttest::where('id_user', $id_user)->get();

            return response()->json(['data' => $scores]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getScoresPosttestByMateri($materiId)
    {
        try {
            $id_user = Auth::id();  
            
            // Ambil unit yang berkaitan dengan id_materi yang dipilih
            $units = DB::table('unit')
                        ->where('id_materi', $materiId)
                        ->pluck('id_unit');
    
            // Subquery untuk mendapatkan id_ScorePosttest terkecil di setiap unit yang sesuai dengan id_user dan id_unit dari materi yang dipilih
            $subquery = ScorePosttest::selectRaw('MIN(id_ScorePosttest) as min_id')
                ->where('id_user', $id_user)
                ->whereIn('id_unit', $units)
                ->groupBy('id_unit')
                ->pluck('min_id');
    
            // Ambil detail ScorePosttest berdasarkan hasil subquery
            $scores = ScorePosttest::whereIn('id_ScorePosttest', $subquery)
                ->get();
    
            return response()->json(['data' => $scores]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function checkFirstAttempt(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'id_posttest' => 'required|integer',
            ]);

            // Mendapatkan id_user berdasarkan pengguna yang sedang login
            $id_user = Auth::id();
            $id_posttest = $request->input('id_posttest');

            // Mengecek apakah pengguna telah memiliki skor posttest sebelumnya
            $attempt = ScorePosttest::where('id_user', $id_user)
                ->where('id_posttest', $id_posttest)
                ->first();

            if ($attempt) {
                return response()->json(['isFirstAttempt' => false]);
            } else {
                return response()->json(['isFirstAttempt' => true]);
            }
        } catch (\Exception $e) {
            // Menangkap dan menampilkan kesalahan
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}