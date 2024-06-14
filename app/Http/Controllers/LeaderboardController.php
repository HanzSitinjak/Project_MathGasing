<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class LeaderboardController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('https://mathgasing.cloud/api/leaderboard');

            if ($response->successful()) {
                $dataLeaderboard = $response->json()['data'];

                $dataLeaderboard = array_map(function ($item) {
                    $item['total_score_posttest'] = $item['total_score_posttest'] ?? 0;
                    $item['total_badges'] = $item['total_badges'] ?? 0;
                    return $item;
                }, $dataLeaderboard);

                return view('pencapaian-siswa.kelola-pencapaian', compact('dataLeaderboard'));
            } else {
                return "Gagal mengambil data Leaderboard.";
            }
        } catch (\Exception $e) {
            return "Gagal mengambil data Leaderboard: " . $e->getMessage();
        }
    }
}