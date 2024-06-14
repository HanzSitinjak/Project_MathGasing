<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class KelolaDataMateriController extends Controller
{
    public function viewDataByID($id_unit)
    {
        try {
            $responsePretest = Http::get("https://mathgasing.cloud/api/getByUnitPretest/{$id_unit}");
            $pretest = $responsePretest->json()['data'] ?? [];

            $responsePosttest = Http::get("https://mathgasing.cloud/api/getByUnitPosttest/{$id_unit}");
            $posttest = $responsePosttest->json()['data'] ?? [];

            $responseVideoPembelajaran = Http::get("https://mathgasing.cloud/api/getByUnitVideo/{$id_unit}");
            $video = $responseVideoPembelajaran->json()['data'] ?? [];

            $QuestionPretest = [];
            $QuestionPosttest = [];

            foreach ($pretest as $itempretest) {
                $responseQuestionPretest = Http::get("https://mathgasing.cloud/api/QuestionPretestByID/{$itempretest['id_pretest']}");
                $QuestionPretest[$itempretest['id_pretest']] = $responseQuestionPretest->json()['data'] ?? [];
            }

            foreach ($posttest as $itemposttest) {
                $responseQuestionPosttest = Http::get("https://mathgasing.cloud/api/QuestionPosttestByID/{$itemposttest['id_posttest']}");
                $QuestionPosttest[$itemposttest['id_posttest']] = $responseQuestionPosttest->json()['data'] ?? [];
            }

            return view('kelola-materi.kelola_data_materi', compact('pretest', 'posttest', 'video', 'QuestionPretest', 'QuestionPosttest', 'id_unit'));
        } catch (\Exception $e) {
            return "Gagal mengambil data: " . $e->getMessage();
        }
    }

    public function viewPosttestByID($id_unit)
    {
        try {
            $response = Http::get("https://mathgasing.cloud/api/getByUnit/{$id_unit}");

            if ($response->successful()) {
                $posttest = $response->json()['data'];
                return view('kelola-materi.kelola_data_materi', compact('posttest'));
            } else {
                $errorReason = $response->json()['message'] ?? "Tidak ada informasi tentang kesalahan.";
                return "Gagal mengambil data unit. Penyebab: " . $errorReason;
            }
        } catch (\Exception $e) {
            return "Gagal mengambil data pretest: " . $e->getMessage();
        }
    }

    public function addPretest(Request $request)
    {
        $request->validate([
            'id_unit' => 'required|numeric',
            'deskripsi' => 'required',
        ]);

        $response = Http::post('https://mathgasing.cloud/api/addPretest', [
            'id_unit' => $request->id_unit,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Data pretest berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data pretest.');
        }
    }

    public function addPosttest(Request $request)
    {
        $request->validate([
            'id_unit' => 'required|numeric',
            'deskripsi' => 'required',
        ]);

        $response = Http::post('https://mathgasing.cloud/api/addPosttest', [
            'id_unit' => $request->id_unit,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Data posttest berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data posttest.');
        }
    }


    public function deleteUnit($id_unit)
    {
        try {
            $response = Http::delete("https://mathgasing.cloud/api/deleteUnit/{$id_unit}");
            
            if ($response->successful()) {
                return redirect('/kelola-materi')->with('success', 'Unit berhasil dihapus.');
            } else {
                $errorReason = $response->json()['message'] ?? "Tidak ada informasi tentang kesalahan.";
                return redirect('/data-materi')->with('error', 'Gagal menghapus unit. Penyebab: ' . $errorReason);
            }
        } catch (\Exception $e) {
            return redirect('/kelola-unit')->with('error', 'Gagal menghapus unit: ' . $e->getMessage());
        }
    }

    public function simpanVideo(Request $request)
    {
        $request->validate([
            'id_unit' => 'required',
            'video_Url' => 'required|string',
            'title' => 'required|string',
            'explanation' => 'required|string',
        ]);

        $response = Http::post('https://mathgasing.cloud/api/addMaterialVideo', [
            'id_unit' => $request->id_unit,
            'video_Url' => $request->video_Url,
            'title' => $request->title,
            'explanation' => $request->explanation,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Video berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan video.');
        }
    }

    public function addQuestionPretest(Request $request)
{
    $request->validate([
        'question' => 'required|string',
        'pretest_option_1' => 'required|string',
        'pretest_option_2' => 'required|string',
        'pretest_option_3' => 'required|string',
        'pretest_option_4' => 'required|string',
        'pretest_correct_index' => 'required|string',
        'id_pretest' => 'required|numeric',
    ]);

        $response = Http::post('https://mathgasing.cloud/api/addQuestionPretest', [
            'question' => $request->question,
            'pretest_option_1' => $request->pretest_option_1,
            'pretest_option_2' => $request->pretest_option_2,
            'pretest_option_3' => $request->pretest_option_3,
            'pretest_option_4' => $request->pretest_option_4,
            'pretest_correct_index' => $request->pretest_correct_index,
            'id_pretest' => $request->id_pretest,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Soal pretest berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan soal pretest.');
        }
    }

    public function addQuestionPosttest(Request $request)
{
    $request->validate([
        'question' => 'required|string',
        'posttest_option_1' => 'required|string',
        'posttest_option_2' => 'required|string',
        'posttest_option_3' => 'required|string',
        'posttest_option_4' => 'required|string',
        'posttest_correct_index' => 'required|string',
        'id_posttest' => 'required|numeric',
    ]);

        $response = Http::post('https://mathgasing.cloud/api/addQuestionPosttest', [
        'question' => $request->question,
        'posttest_option_1' => $request->posttest_option_1,
        'posttest_option_2' => $request->posttest_option_2,
        'posttest_option_3' => $request->posttest_option_3,
        'posttest_option_4' => $request->posttest_option_4,
        'posttest_correct_index' => $request->posttest_correct_index,
        'id_posttest' => $request->id_posttest,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Soal posttest berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan soal posttest.');
        }
    }

    public function getQuestionPretestByID($id_pretest)
    {
        try {
            $response = Http::get("https://mathgasing.cloud/api/QuestionPretestByID/{$id_pretest}");
            $QuestionPretest = $response->json()['data'] ?? [];

            return view('kelola-materi.kelola_data_materi', compact('QuestionPretest', 'id_pretest'));
        } catch (\Exception $e) {
            return "Gagal mengambil data: " . $e->getMessage();
        }
    }

    public function deleteQuestionPretest($id_QuestionPretest)
    {
        try {
            $response = Http::delete("https://mathgasing.cloud/api/deleteQuestionPretest/{$id_QuestionPretest}");

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Soal pretest berhasil dihapus.');
            } else {
                $errorReason = $response->json()['message'] ?? "Tidak ada informasi tentang kesalahan.";
                return redirect()->back()->with('error', 'Gagal menghapus soal pretest. Penyebab: ' . $errorReason);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus soal pretest: ' . $e->getMessage());
        }
    }

    public function deleteQuestionPosttest($id_QuestionPosttest)
    {
        try {
            $response = Http::delete("https://mathgasing.cloud/api/deleteQuestionPosttest/{$id_QuestionPosttest}");

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Soal posttest berhasil dihapus.');
            } else {
                $errorReason = $response->json()['message'] ?? "Tidak ada informasi tentang kesalahan.";
                return redirect()->back()->with('error', 'Gagal menghapus soal posttest. Penyebab: ' . $errorReason);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus soal posttest: ' . $e->getMessage());
        }
    }
}
