<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KelolaSiswaController extends Controller
{
    public function updateStatusSiswa(Request $request, $id)
    {
        $response = Http::post("https://mathgasing.cloud/api/users/update-active-status/{$id}", [
            'is_active' => $request->status 
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return redirect()->back()->with('success', $data['message']);
        } else {
            return redirect()->back()->with('error', 'Gagal mengupdate status siswa.');
        }
    }
}