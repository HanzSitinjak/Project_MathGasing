<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\Materi;


class MateriController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('https://mathgasing.cloud/api/getMateri');

            if ($response->successful()) {
                $materi = $response->json()['data'];
                $admins = $this->getAdminData();

                foreach ($materi as &$item) {
                    $item['admin_name'] = $admins[$item['id_penggunaWeb']] ?? 'Unknown';
                }

                return view('kelola-materi.kelola-materi', compact('materi'));
            } else {
                return "Gagal mengambil data materi.";
            }
        } catch (\Exception $e) {
            return "Gagal mengambil data materi: " . $e->getMessage();
        }
    }

    // Fungsi untuk mendapatkan data admin dari endpoint tertentu
    private function getAdminData()
    {
        try {
            $response = Http::get('https://mathgasing.cloud/api/data-managers');

            if ($response->successful()) {
                $admins = $response->json()['dataManagers'];

                // Buat mapping dari id_penggunaWeb ke nama admin
                $adminMapping = [];
                foreach ($admins as $admin) {
                    $adminMapping[$admin['id_penggunaWeb']] = $admin['name'];
                }

                return $adminMapping;
            } else {
                return [];
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    public function addMateri(Request $request)
{
    $validatedData = $request->validate([
        'id_penggunaWeb' => 'required',
        'title' => 'required',
        'imageCard' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'imageBackground' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'imageCardAdmin' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'imageStatistic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Upload gambar dan persiapkan data untuk dikirimkan ke API
    $imageCard = $request->file('imageCard');
    $imageBackground = $request->file('imageBackground');
    $imageCardAdmin = $request->file('imageCardAdmin');
    $imageStatistic = $request->file('imageStatistic');

    // Anda dapat menggunakan Http::attach() untuk mengunggah gambar
    $response = Http::attach('imageCard', file_get_contents($imageCard), $imageCard->getClientOriginalName())
                    ->attach('imageBackground', file_get_contents($imageBackground), $imageBackground->getClientOriginalName())
                    ->attach('imageCardAdmin', file_get_contents($imageCardAdmin), $imageCardAdmin->getClientOriginalName())
                    ->attach('imageStatistic', file_get_contents($imageStatistic), $imageStatistic->getClientOriginalName())
                    ->post('https://mathgasing.cloud/api/addMateri', $validatedData);

    if ($response->successful()) {
        return redirect()->route('kelola-materi')->with('success', 'Materi berhasil ditambahkan');
    } else {
        return $response->status();
    }
}

    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            "title" => "required",
            "id_penggunaWeb" => "required|numeric",
            "imageCard" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "imageBackground" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "imageCardAdmin" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "imageStatistic" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        // Kirim data ke endpoint API
        $response = Http::put("https://mathgasing.cloud/api/editMateri/{$id}", $request->all());

        // Cek respon dari API
        if ($response->successful()) {
            return response()->json(['message' => 'Data materi berhasil diperbarui'], 200);
        } else {
            return response()->json(['message' => 'Gagal memperbarui data materi'], $response->status());
        }
    }

    public function destroyMateri($id)
    {
        try {
            $response = Http::delete("https://mathgasing.cloud/api/hapusMateri/{$id}");

            if ($response->successful()) {
                return redirect()->route('kelola-materi')->with('success', 'Materi berhasil dihapus');
            } else {
                return redirect()->route('kelola-materi')->with('error', 'Gagal menghapus materi');
            }
        } catch (\Exception $e) {
            return redirect()->route('kelola-materi')->with('error', 'Gagal menghapus materi: ' . $e->getMessage());
        }
    }
}

