<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class KelolaLevelBonusController extends Controller
{
    public function index($id_materi)
    {
        try {
            $response = Http::get("https://mathgasing.cloud/api/unitbonus/getByMateri/{$id_materi}");

            if ($response->successful()) {
                $unitBonus = $response->json()['data'];
                return view('kelola-materi.kelola-unit-levelBonus', ['unitBonus' => $unitBonus, 'id_materi' => $id_materi]);
            } else {
                $errorReason = $response->json()['message'] ?? "Tidak ada informasi tentang kesalahan.";
                return view('kelola-materi.kelola-unit-levelBonus', ['unitBonus' => [], 'id_materi' => $id_materi, 'error' => "Gagal mengambil data unit. Penyebab: " . $errorReason]);
            }
        } catch (\Exception $e) {
            return view('kelola-materi.kelola-unit-levelBonus', ['unitBonus' => [], 'id_materi' => $id_materi, 'error' => "Gagal mengambil data unit: " . $e->getMessage()]);
        }
    }

    public function viewDataByID($id_unit_bonus)
    {
        try {
            $responseLevelBonus = Http::get("https://mathgasing.cloud/api/levelbonus/getByUnit/{$id_unit_bonus}");
            $levelbonus = $responseLevelBonus->json()['data'] ?? [];

            $QuestionLevelBonus = [];

            foreach ($levelbonus as $itemlevelbonus) {
                $responseLevelBonus = Http::get("https://mathgasing.cloud/api/QuestionLevelBonusByID/{$itemlevelbonus['id_level_bonus']}");
                $QuestionLevelBonus[$itemlevelbonus['id_level_bonus']] = $responseLevelBonus->json()['data'] ?? [];
            }

            return view('kelola-materi.kelola-level-levelBonus', compact('levelbonus', 'QuestionLevelBonus', 'id_unit_bonus'));
        } catch (\Exception $e) {
            return "Gagal mengambil data: " . $e->getMessage();
        }
    }

    public function delete(Request $request)
    {
        try {
            $unitId = $request->input('unit_id');
            $response = Http::delete("https://mathgasing.cloud/api/unitbonus/{$unitId}");

            if ($response->successful()) {
                return redirect()->route('level-bonus.unit', ['id_materi' => $request->input('id_materi')])->with('success', 'Unit berhasil dihapus.');
            } else {
                return redirect()->route('level-bonus.unit', ['id_materi' => $request->input('id_materi')])->with('error', 'Gagal menghapus unit.');
            }
        } catch (\Exception $e) {
            return redirect()->route('level-bonus.unit', ['id_materi' => $request->input('id_materi')])->with('error', 'Gagal menghapus unit: ' . $e->getMessage());
        }
    }

    public function createUnitLevelBonus(Request $request)
    {
        try {
            $response = Http::post("https://mathgasing.cloud/api/unitbonus/AddUnitBonus", [
                'title' => $request->title,
                'explanation' => $request->explanation,
                'id_materi' => $request->id_materi,
            ]);

            if ($response->successful()) {
                $unit = $response->json()['data'];
                $id_unit_Bonus = $unit['id_unit_Bonus'];
                $id_materi = $unit['id_materi'];
                
                return redirect()->route('level-bonus.unit', ['id_unit_Bonus' => $id_unit_Bonus, 'id_materi' => $id_materi]);
            } else {
                $errorReason = $response->json()['message'] ?? "Tidak ada informasi tentang kesalahan.";
                return "Gagal menambahkan unit level bonus. Penyebab: " . $errorReason;
            }
        } catch (\Exception $e) {
            return "Gagal menambahkan unit level bonus: " . $e->getMessage();
        }
    }

    public function addLevelBonus(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_unit_Bonus' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        try {
            // Kirim HTTP POST request ke API levelbonus
            $response = Http::post('https://mathgasing.cloud/api/levelbonus/addLevelBonus', [
                'id_unit_Bonus' => $request->id_unit_Bonus,
                'deskripsi' => $request->deskripsi,
            ]);

            // Periksa keberhasilan respons
            if ($response->successful()) {
                // Ambil data dari respons JSON
                $responseData = $response->json();

                // Redirect dengan pesan sukses
                return redirect()->back()->with('success', $responseData['message']);
            } else {
                // Ambil pesan kesalahan dari respons JSON
                $errorMessage = $response->json()['message'] ?? 'Gagal menambahkan data levelBonus.';

                // Redirect dengan pesan kesalahan
                return redirect()->back()->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            // Tangani kesalahan yang terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function addQuestionLevelBonus(Request $request)
{
    $request->validate([
        'question' => 'required|string',
        'option_1' => 'required|string',
        'option_2' => 'required|string',
        'option_3' => 'required|string',
        'option_4' => 'required|string',
        'correct_index' => 'required|string',
        'id_level_bonus' => 'required|numeric',
    ]);

        $response = Http::post('https://mathgasing.cloud/api/addQuestionLevelBonus', [
            'question' => $request->question,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'correct_index' => $request->correct_index,
            'id_level_bonus' => $request->id_level_bonus,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Soal level bonus berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan soal level bonus.');
        }
    }

}
