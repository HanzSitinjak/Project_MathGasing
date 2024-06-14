<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengelola;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class PengelolaController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:penggunaweb',
            'password' => 'required|string|min:8',
            'kontak' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $user = Pengelola::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kontak' => $request->kontak,
            'role_id' => 1,
            'status' => 'active',
            'is_approved' => 2,
        ]);
    
        return response()->json(['user' => $user], 201);
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('pengelola')->attempt($credentials)) {
            $user = Auth::guard('pengelola')->user();
            $accessToken = $user->createToken('authToken')->plainTextToken; 

            switch ($user->role_id) {
                case 1:
                    $message = 'Anda berhasil masuk ke halaman admin';
                    break;
                case 2:
                    $message = 'Anda berhasil masuk ke halaman super admin';
                    break;
                default:
                    return response()->json(['message' => 'Role tidak valid'], 403);
            }

            return response()->json([
                'access_token' => $accessToken,
                'token_type' => 'Bearer',
                'expires_in' => 0, 
                'id_user' => $user->id_penggunaWeb,
                'nama' => $user->name,
                'role_id' => $user->role_id,
                'message' => $message,
                'is_approved' => $user->is_approved,
                'status' => $user->status
            ]);
        } else {
            return response()->json(['message' => 'Email atau password tidak valid'], 401);
        }
    }

    public function logout(Request $request)
{
    $user = $request->user('pengelola-api'); 
    if ($user) {
        $user->tokens()->delete(); 
    }
    return response()->json(['message' => 'Logout berhasil'], 200);
}
    
    public static function getUserNameById($userId)
    {
        $pengelola = Pengelola::find($userId);

        if ($pengelola) {
            return $pengelola->name;
        } else {
            return null;
        }
    }

    public function getDataManager(Request $request)
    {
        $dataManagers = Pengelola::all(); 
        return response()->json(['dataManagers' => $dataManagers], 200);
    }

    public function getDataManagerByID($id)
    {
        $dataManagers = Pengelola::findOrFail($id); 
        return response()->json(['dataManagers' => $dataManagers], 200);
    }

    public function updateActiveStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'is_approved' => 'required|integer|between:1,2', 
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        $admin = Pengelola::find($id);

        if (!$admin) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $admin->is_approved = $request->is_approved;
        $admin->save();

        return response()->json([
            'status' => true,
            'message' => 'Status aktifitas pengguna berhasil diperbarui',
            'user' => $admin,
        ]);
    }

    public function updateActiveAdminStatus(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'status' => 'required|in:active,non-active', 
    ]);

    if ($validator->fails()) {
        throw ValidationException::withMessages($validator->errors()->toArray());
    }

    $admin = Pengelola::find($id);

    if (!$admin) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $admin->status = $request->status; 
    $admin->save();

    return response()->json([
        'status' => true,
        'message' => 'Status aktifitas pengguna berhasil diperbarui',
        'user' => $admin,
    ]);
}

public function resetPasswordAdmin(Request $request)
{
    // Validasi permintaan
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    $email = $request->email;
    $password = $request->password;

    // Periksa apakah email cocok dengan data yang ada di database
    $user = Pengelola::where('email', $email)->first();

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'Email tidak terdaftar',
        ], 404);
    }

    // Reset password pengguna
    $user->password = Hash::make($password);
    $user->save();

    return response()->json([
        'status' => true,
        'message' => 'Password berhasil direset',
    ]);
}
public function validationUser(Request $request)
{
    $email = $request->input('email');
    $username = $request->input('username');

    $user = Pengelola::where('email', $email)->first();

    if ($user && $user->name == $username) {
        return response()->json(['valid' => true]);
    }

    return response()->json(['valid' => false]);
}
}




