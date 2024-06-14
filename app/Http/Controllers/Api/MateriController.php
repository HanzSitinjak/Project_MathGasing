<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Materi;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Mengambil semua data materi
    $materi = Materi::all();

    // Modifikasi URL gambar sebelum mengembalikan response
    $materi->transform(function ($item) {
        $item->imageCard = url($item->imageCard);
        $item->imageBackground = url($item->imageBackground);
        $item->imageCardAdmin = url($item->imageCardAdmin);
        $item->imageStatistic = url($item->imageStatistic);
        return $item;
    });

    // Mengembalikan data materi sebagai response
    return response()->json(['data' => $materi]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        "id_penggunaWeb" => "required",
        "title" => "required",
        "imageCard" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        "imageBackground" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        "imageCardAdmin" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        "imageStatistic" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
    ]);

    $imageCardPath = $request->file('imageCard')->store('public/images');
    $imageBackgroundPath = $request->file('imageBackground')->store('public/images');
    $imageCardAdminPath = $request->file('imageCardAdmin')->store('public/images');
    $imageStatisticPath = $request->file('imageStatistic')->store('public/images');

    $materi = Materi::create([
        "id_penggunaWeb" => $request->id_penggunaWeb,
        "title" => $request->title,
        "imageCard"=> Storage::url($imageCardPath), 
        "imageBackground"=> Storage::url($imageBackgroundPath),
        "imageCardAdmin"=> Storage::url($imageCardAdminPath),
        "imageStatistic"=> Storage::url($imageStatisticPath),
    ]);
    return response()->json(['message' => 'Materi created successfully', 'data' => $materi]);
}
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengambil data materi berdasarkan ID
        $materi = Materi::find($id);

        // Jika materi ditemukan, kembalikan sebagai response
        if ($materi) {
            return response()->json(['data' => $materi]);
        }

        // Jika materi tidak ditemukan, kembalikan pesan error
        return response()->json(['message' => 'Materi not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            "title" => "required",
            "imageCard" => "image|mimes:jpeg,png,jpg,gif|max:2048",
            "imageBackground" => "image|mimes:jpeg,png,jpg,gif|max:2048",
            "imageCardAdmin" => "image|mimes:jpeg,png,jpg,gif|max:2048",
            "imageStatistic" => "image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);
        
        $materi = Materi::find($id);

        // Jika materi ditemukan, update data
        if ($materi) {
            $materi->title = $request->title;

            // Jika ada file gambar baru yang diupload, simpan dan perbarui nama file
            if ($request->hasFile('imageCard')) {
                $imageCard = $request->file('imageCard')->store('public/images');
                $materi->imageCard = $imageCard;
            }

            if ($request->hasFile('imageBackground')) {
                $imageBackground = $request->file('imageBackground')->store('public/images');
                $materi->imageBackground = $imageBackground;
            }
            
            if ($request->hasFile('imageCardAdmin')) {
                $imageCardAdmin = $request->file('imageCardAdmin')->store('public/images');
                $materi->imageCardAdmin = $imageCardAdmin;
            }

            if ($request->hasFile('imageStatistic')) {
                $imageStatistic = $request->file('imageStatistic')->store('public/images');
                $materi->imageStatistic = $imageStatistic;
            }

            $materi->save();

            return response()->json(['message' => 'Materi updated successfully', 'data' => $materi]);
        }

        return response()->json(['message' => 'Materi not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mengambil data materi berdasarkan ID
        $materi = Materi::find($id);

        // Jika materi ditemukan, hapus
        if ($materi) {
            $materi->delete();

            // Mengembalikan pesan sukses
            return response()->json(['message' => 'Materi deleted successfully']);
        }

        // Jika materi tidak ditemukan, kembalikan pesan error
        return response()->json(['message' => 'Materi not found'], 404);
    }
}
