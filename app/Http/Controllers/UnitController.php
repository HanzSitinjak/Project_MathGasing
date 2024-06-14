<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UnitController extends Controller
{
    public function index($id_materi)
    {
        try {
            // Fetch units by materi ID
            $response = Http::get("https://mathgasing.cloud/api/getUnitByMateri/{$id_materi}");

            // Fetch all materi
            $responseMateri = Http::get("http://mathgasing.cloud/api/getMateri");

            if ($response->successful() && $responseMateri->successful()) {
                $units = $response->json()['data'];
                $allMateri = $responseMateri->json()['data'];

                // Find the specific materi by id_materi
                $materi = collect($allMateri)->firstWhere('id_materi', $id_materi);

                // Return view with units, specific materi, and all materi
                return view('kelola-materi.kelola-unit', [
                    'units' => $units,
                    'id_materi' => $id_materi,
                    'materi' => $materi,
                    'allMateri' => $allMateri
                ]);
            } else {
                $errorReason = $response->json()['message'] ?? "Tidak ada informasi tentang kesalahan.";
                return "Gagal mengambil data unit. Penyebab: " . $errorReason;
            }
        } catch (\Exception $e) {
            return "Gagal mengambil data unit: " . $e->getMessage();
        }
    }

    public function getByID($id)
    {
        try {
            $response = Http::get("https://mathgasing.cloud/api/getUnit/{$id}");
            $unitByID = $response->json()['data'];
            // Return or use $unitByID as needed
        } catch (\Exception $e) {
            return "Gagal mengambil data unit: " . $e->getMessage();
        }
    }

    public function createUnit(Request $request)
    {
        try {
            $response = Http::post("https://mathgasing.cloud/api/addUnit", [
                'title' => $request->title,
                'explanation' => $request->explanation,
                'id_materi' => $request->id_materi,
            ]);

            if ($response->successful()) {
                $unit = $response->json()['data'];
                $id_unit = $unit['id_unit'];
                $id_materi = $unit['id_materi'];
                
                return redirect()->route('data-materi', ['id_unit' => $id_unit, 'id_materi' => $id_materi]);
            } else {
                $errorReason = $response->json()['message'] ?? "Tidak ada informasi tentang kesalahan.";
                return "Gagal menambahkan unit. Penyebab: " . $errorReason;
            }
        } catch (\Exception $e) {
            return "Gagal menambahkan unit: " . $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return response()->json(['message' => 'Unit deleted successfully']);
    }

    public function showDatafromUnit($id_unit, $id_materi) {
        $data = [
            'id_unit' => $id_unit,
            'id_materi' => $id_materi,
        ];
        
        return view('kelola-materi.kelola-data-materi', $data);
    }
}
