<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MaterialVideo;
use Illuminate\Http\Request;

class MaterialVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materialvideos = MaterialVideo::all();

        // Mengembalikan data materialvideos sebagai respons JSON
        return response()->json(['data' => $materialvideos]);
    }

    public function getVideoByUnit(Request $request)
    {
        $id_unit = $request->query('id_unit');

        $query = MaterialVideo::query();

        if ($id_unit) {
            $query->where('id_unit', $id_unit);
        }
    

        $materialvideos = $query->get();

        // Mengembalikan data materialvideos sebagai respons JSON
        return response()->json(['data' => $materialvideos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_unit' => 'required',
            'video_Url' => 'required|string',
            'title' => 'required|string',
            'explanation' => 'required|string',
        ], [
            'id_level.exists' => 'The selected id_level does not exist.',
        ]);

        $materialvideo = MaterialVideo::create($request->all());

        // Mengembalikan materialvideo yang baru dibuat sebagai respons JSON
        return response()->json(['message' => 'Material Video created successfully', 'data' => $materialvideo], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $materialvideo = MaterialVideo::find($id);

        // Jika materialvideo ditemukan, kembalikan sebagai respons JSON
        if ($materialvideo) {
            return response()->json(['data' => $materialvideo]);
        }

        // Jika materialvideo tidak ditemukan, kembalikan pesan error
        return response()->json(['message' => 'Material Video not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'id_unit' => 'required',
        'video_Url' => 'required|string',
        'title' => 'required|string',
        'explanation' => 'required|string',
    ], [
        'id_level.exists' => 'The selected id_level does not exist.',
    ]);

    // Find the material video by its ID
    $materialvideo = MaterialVideo::find($id);

    // Check if the material video exists
    if (!$materialvideo) {
        return response()->json(['error' => 'Material Video not found'], 404);
    }

    // Update the material video with the new data
    $materialvideo->update($request->all());

    // Return a success response
    return response()->json(['message' => 'Material Video updated successfully', 'data' => $materialvideo], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $materialvideo = MaterialVideo::find($id);

        if ($materialvideo) {
            $materialvideo->delete();

            // Mengembalikan pesan sukses
            return response()->json(['message' => 'Material Video deleted successfully']);
        }

        // Jika materialvideo tidak ditemukan, kembalikan pesan error
        return response()->json(['message' => 'Material Video not found'], 404);
    }

    public function getByUnit($id_unit)
    {
        $units =  MaterialVideo::where('id_unit', $id_unit)->get();
        return response()->json(['data' => $units]);
    }

    public function checkUserMaterialVideoStatus()
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Melakukan pengecekan apakah pengguna telah menyelesaikan material video atau tidak
        $materialVideo = MaterialVideo::where('id_unit', $user->id_unit)->first();

        if ($materialVideo && $materialVideo->is_completed) {
            return response()->json(['message' => 'User has completed the material video'], 200);
        } else {
            return response()->json(['message' => 'User has not completed the material video'], 404);
        }
    }
}
