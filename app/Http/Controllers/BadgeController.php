<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;


class BadgeController extends Controller
{
    public function addBadge(Request $request)
    {
        $validatedData = $request->validate([
            'id_penggunaWeb' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'explanation' => 'required',
            'id_materi' => 'required|numeric',
            'id_posttest' => 'required|numeric',
        ]);

        // Attach the image file to the HTTP request
        $response = Http::attach(
            'image',
            file_get_contents($request->file('image')),
            $request->file('image')->getClientOriginalName()
        )->post('https://mathgasing.cloud/api/addBadges', [
            'id_penggunaWeb' => $validatedData['id_penggunaWeb'],
            'title' => $validatedData['title'],
            'explanation' => $validatedData['explanation'],
            'id_materi' => $validatedData['id_materi'],
            'id_posttest' => $validatedData['id_posttest'],
        ]);

        if ($response->successful()) {
            // Redirect to the kelola-lencana page with the id_materi
            return redirect()->route('kelola-lencana', ['id_materi' => $validatedData['id_materi']]);
        } else {
            // Check if the error message is "data ini sudah ada sebelumnya"
            $responseData = $response->json();
            if (isset($responseData['error']) && $responseData['error'] == 'data ini sudah ada sebelumnya') {
                // Return back with an alert message
                return redirect()->back()->with('alert', 'Data ini sudah ada sebelumnya');
            } else {
                // You can customize this to return a more user-friendly error message if needed
                return redirect()->back()->withErrors(['message' => 'Failed to add badge: ' . $response->status()]);
            }
        }
    }


public function index($id)
    {
        try {
            $response = Http::get("https://mathgasing.cloud/api/badgesByMateri/{$id}");

            if ($response->successful()) {
                $badges = $response->json()['data'] ?? [];

                $materiResponse = Http::get('https://mathgasing.cloud/api/getMateri');
                $materiData = $materiResponse->json()['data'] ?? [];

                $posttestResponse = Http::get('https://mathgasing.cloud/api/getPosttest');
                $posttestData = $posttestResponse->json()['data'] ?? [];

                $posttestoptions = [];
                foreach ($posttestData as $itemPosttest) {
                    $posttestoptions[$itemPosttest['id_posttest']] = $itemPosttest['id_posttest'];
                }

                $materiOptions = [];
                foreach ($materiData as $item) {
                    $materiOptions[$item['id_materi']] = $item['id_materi'] . ' - ' . $item['title'];
                }

                return view('kelola-lencana.kelola-lencana', compact('badges', 'materiOptions', 'posttestoptions', 'materiData', 'posttestData', 'id'));
            } else {
                // Tangani kasus "No badges found for this materi ID"
                $errorReason = $response->json()['message'] ?? "";
                if ($errorReason === "No badges found for this materi ID") {
                    $badges = [];
                    $materiResponse = Http::get('https://mathgasing.cloud/api/getMateri');
                    $materiData = $materiResponse->json()['data'] ?? [];

                    $posttestResponse = Http::get('https://mathgasing.cloud/api/getPosttest');
                    $posttestData = $posttestResponse->json()['data'] ?? [];

                    $posttestoptions = [];
                    foreach ($posttestData as $itemPosttest) {
                        $posttestoptions[$itemPosttest['id_posttest']] = $itemPosttest['id_posttest'];
                    }

                    $materiOptions = [];
                    foreach ($materiData as $item) {
                        $materiOptions[$item['id_materi']] = $item['id_materi'] . ' - ' . $item['title'];
                    }

                    return view('kelola-lencana.kelola-lencana', compact('badges', 'materiOptions', 'posttestoptions', 'materiData', 'posttestData', 'id'));
                } else {
                    return redirect()->back()->withErrors(['message' => "Gagal mengambil data lencana. Penyebab: " . $errorReason]);
                }
            }
        } catch (\Exception $e) {
            return view('kelola-lencana.kelola-lencana')->with('message', 'Gagal mengambil data lencana: ' . $e->getMessage());
        }
    }
    
    public function getBadge($id)
    {
        $response = Http::get("https://mathgasing.cloud/api/badges/{$id}");

        if ($response->successful()) {
            $getBadge = $response->json()['data']; // Perbaiki nama variabel
            return view('kelola-lencana.kelola-lencana', compact('getBadge')); 
        } else {
            return "Gagal mengambil data badge.";
        }
    }

    public function getDataMateri()
    {
        try {
            $response = Http::get('http://mathgasing.cloud/api/getMateri');

            if ($response->successful()) {
                $materiData = $response->json()['data'];
                return view('kelola-lencana.daftar-lencana', compact('materiData'));
            } else {
                return "Gagal mengambil data materi.";
            }
        } catch (\Exception $e) {
            return "Gagal mengambil data materi: " . $e->getMessage();
        }
    }

    public function deleteBadge($id)
        {
            $response = Http::delete("https://mathgasing.cloud/api/badges/{$id}");

            if ($response->successful()) {
                return redirect()->route('kelola-lencana')->with('success', 'Badge berhasil dihapus.');
            } else {
                return redirect()->route('kelola-lencana')->with('error', 'Gagal menghapus badge.');
            }
        }
}
