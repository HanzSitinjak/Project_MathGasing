<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $response = Http::get('https://mathgasing.cloud/api/getUser');
        if ($response->ok()) {
            $users = $response->json()['data'];
        } else {
            $users = [];
        }
        
        return view('akun-siswa.akun-siswa', compact('users'));
    }

    public function show($id)
{
    $responseSiswa = Http::get("https://mathgasing.cloud/api/getUserById/{$id}");
    $pencapaianSiswa = Http::get("https://mathgasing.cloud/api/scores/{$id}");
    
    $siswa = null;
    $lencanaPengguna = [];
    $scorePengguna = [];

 
    if ($responseSiswa->successful()) {
        $siswa = $responseSiswa->json()['user'];
        $lencanaPengguna = $this->lencanaPengguna($siswa['id_user']);
    }

    // Periksa jika respons dari API pencapaian siswa berhasil
    if ($pencapaianSiswa->successful()) {
        $scorePengguna = $pencapaianSiswa->json()['data'];
    }

    // Kembalikan view dengan data siswa, lencana pengguna, dan pencapaian siswa
    return view('akun-siswa.detail-siswa', compact('siswa', 'lencanaPengguna', 'scorePengguna'));
}


    /**
     * Mendapatkan lencana pengguna berdasarkan ID pengguna.
     *
     * @param  int  $id_user
     * @return array
     */
    public function lencanaPengguna($id_user)
    {
        // Mendapatkan data lencana pengguna dari API berdasarkan ID pengguna
        $response = Http::get("https://mathgasing.cloud/api/lencana-pengguna/{$id_user}");

        // Periksa jika respons dari API berhasil
        if ($response->successful()) {
            return $response->json()['data'] ?? [];
        } else {
            return [];
        }
    }
    // public function pencapaianPengguna($id)
    // {
    //     $response = Http::get("https://mathgasing.cloud/api/scores/{$id}");
    //     if ($response->successful()) {
    //         return $response->json()['data'] ?? [];
    //     } else {
    //         return [];
    //     }
    // }
}
