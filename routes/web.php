<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\KelolaAdminController;
use App\Http\Controllers\KelolaUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelolaDataMateriController;
use App\Http\Controllers\KelolaSiswaController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\LevelBonusController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\KelolaLevelBonusController;
use App\Http\Controllers\LeaderboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('Auth.login');
})->name('login');

Route::get('/register', function () {
    return view('Auth.register');
})->name('register');

Route::post('/login', function (Request $request) {
    $response = Http::post('https://mathgasing.cloud/api/login-Pengelola', [
        'email' => $request->email,
        'password' => $request->password,
    ]);

    $errorResponse = $response->json();
    $errorMessage = isset($errorResponse['message']) ? $errorResponse['message'] : 'Terjadi kesalahan dalam menghubungi server.';

    $errorColor = ($response->status() === 401 || (isset($errorResponse['message']) && $errorResponse['message'] === 'Email tidak valid')) ? 'alert-danger' : 'alert-warning';

    if ($response->successful()) {
        $responseData = $response->json();

        if (isset($responseData['access_token'])) {
            $roleId = $responseData['role_id'];
            $isApproved = $responseData['is_approved'];
            $status = $responseData['status'];

            // Set session data
            session([
                'loginResponse' => $responseData,
                'role_id' => $roleId,
                'is_approved' => $isApproved,
                'status' => $status
            ]);

            if ($roleId == 1 || $roleId == 2) {
                if ($isApproved == 2) {
                    Session::flash('modalMessage', 'Akun kamu belum disetujui.');
                    Session::flash('modalRedirect', route('login'));
                    return view('Beranda.UnAcceptedAdmin');
                } elseif ($isApproved == 1) {
                    if ($status == 'non-active') {
                        Session::flash('modalMessage', 'Akun kamu dinonaktifkan.');
                        Session::flash('modalRedirect', route('login'));
                        return view('Beranda.UnAcceptedAdmin');
                    }
                    return redirect()->route('berandaAdmin');
                }
            }
        }
    } else {
        return redirect()->route('login')->with('error', $errorMessage)->with('color', $errorColor);
    }
})->name('login.post');

Route::post('/registerPost', function(Request $request){
    $response = Http::post('https://mathgasing.cloud/api/register-Pengelola', [
        'name' => $request->nama,
        'email' => $request->email,
        'kontak' => $request->kontak,
        'password' => $request->password,
        'is_approved' => 2,
    ]);
    
    if ($response->successful()) {
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    } else {
        $errorMessage = $response->json()['message'] ?? 'Registration failed. Please try again later.';
        return back()->withInput()->with('error', $errorMessage);
    }
})->name('register.post');

Route::post('/logout', function (Request $request) {
    session()->flush();

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . session('loginResponse.access_token'),
        'Accept' => 'application/json',
    ])->post('https://mathgasing.cloud/api/logout-Pengelola');

    if ($response->successful()) {
        return redirect()->route('login')->with('success', 'Anda telah logout dengan sukses.');
    } else {
        return redirect()->route('login')->with('error', 'Gagal melakukan logout. Silakan coba lagi.');
    }
})->name('logout');

Route::get('/validate-account', function () {
    return view('Auth.validate_user');
})->name('validate.account');

Route::post('/validate-user', function (Request $request) {
    $response = Http::post('http://mathgasing.cloud/api/validate-user', [
        'email' => $request->email,
        'username' => $request->username,
    ]);

    if ($response->successful()) {
        $responseData = $response->json();

        return response()->json(['valid' => $responseData['valid']]);
    } else {
        return response()->json(['valid' => false]);
    }
})->name('validate.user');

Route::get('/reset-password', function () {
    return view('Auth.resetpassword');
})->name('reset.password');

Route::get('/resetPassword', function () {
    return view('Auth.resetpassword');
})->name('resetPassword');

Route::post('/resetPassword', function (Request $request) {
    $response = Http::post('http://mathgasing.cloud/api/password/reset', [
        'email' => $request->email,
        'password' => $request->password,
        'password_confirmation' => $request->password_confirmation,
    ]);

    if ($response->successful()) {
        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan masuk dengan password baru.');
    } else {
        $errorResponse = $response->json();
        $errorMessage = isset($errorResponse['message']) ? $errorResponse['message'] : 'Terjadi kesalahan dalam menghubungi server.';
        return back()->withInput()->with('error', $errorMessage);
    }
})->name('password.reset');

Route::get('/beranda', function () {
    return view('Beranda.beranda');
});

Route::get('/berandaAdmin', function () {
    return view('Beranda.berandaAdmin');
})->name('berandaAdmin');

Route::get('/berandaSuperadmin', function () {
    return view('Beranda.beranda');
})->name('berandaSuperadmin');

Route::get('/UnAcceptAdmin', function () {
    return view('Beranda.UnAcceptedAdmin', ['message' => 'Akun kamu belum disetujui.'])->with('redirect', route('login'));
})->name('UnAcceptAdmin');

Route::get('/UnActiveAdmin', function () {
    return view('Beranda.UnActiveAdmin', ['message' => 'Akun kamu belum disetujui.'])->with('redirect', route('login'));
})->name('UnActiveAdmin');

Route::get('/akun-siswa', function () {
    return view('akun-siswa.akun-siswa');
});

Route::get('/akun-admin', function () {
    return view('akun-admin.akun-admin');
});

Route::get('/pencapaian-siswa', [LeaderboardController::class, 'index'])->name('pencapaian-siswa');

//Route untuk Lencana admin
Route::post('/kelola-lencana', [BadgeController::class, 'addBadge'])->name('simpan-badge.post');

Route::get('/daftar-lencana', [BadgeController::class, 'getDataMateri'])->name('daftar-lencana');
Route::get('/kelola-lencana/{id_materi}', [BadgeController::class, 'index'])->name('kelola-lencana');

// Route::get('/kelola-lencana/{id}', function ($id) {
//     $response = Http::get("http://localhost:8070/api/badgesByMateri/{$id}");
    
//     if ($response->successful()) {
//         $badges = $response->json()['data'];
        
//         $materiResponse = Http::get('http://localhost:8070/api/getMateri');
//         $materiData = $materiResponse->json()['data'];
        
//         $posttestResponse = Http::get('http://localhost:8070/api/getPosttest');
//         $posttestData = $posttestResponse->json()['data'];
        
//         // $getBadgeResponse = Http::get('http://localhost:8070/api/badges/{id}');
//         // $getBadgeData = $posttestResponse->json()['data'];
        
//         return view('kelola-lencana.kelola-lencana', compact('badges', 'materiData', 'posttestData'));
//     } else {
//         return "Gagal mengambil data lencana.";
//     }
// })->name('kelola-lencana');

Route::delete('/kelola-lencana/{id}', [BadgeController::class, 'deleteBadge'])->name('hapus-badge');

Route::get('/kelola-lencana/{id}', [BadgeController::class, 'getBadge'])->name('edit-badge');

Route::put('/badges/{id}', [BadgeController::class, 'update'])->name('update-badge');


//Route untuk Lencana Superadmin
// Route::post('/kelola-lencana-superadmin', [BadgeController::class, 'addBadge'])->name('simpan-badge.post');
// Route::get('/kelola-lencana-superadmin', function () {
//     $response = Http::get('http://localhost:8070/api/badges');
//     $badges = $response->json()['data'];

//     $materiResponse = Http::get('http://localhost:8070/api/getMateri');
//     $materiData = $materiResponse->json()['data'];

//     $posttestResponse = Http::get('http://localhost:8070/api/getPosttest');
//     $posttestData = $posttestResponse->json()['data'];

//     return view('kelola-lencana.kelola-lencana-superadmin', compact('badges', 'materiData', 'posttestData'));
// })->name('kelola-lencana');

// Route::delete('/kelola-lencana-superadmin/{id}', [BadgeController::class, 'deleteBadge'])->name('hapus-badge');

// Route::get('/kelola-lencana-superadmin/{id}', [BadgeController::class, 'getBadge'])->name('edit-badge');

// Route::put('/kelola-lencana-superadmin/{id}', [BadgeController::class, 'update'])->name('update-badge');

//materi
Route::get('/kelola-materi', [MateriController::class, 'index'])->name('kelola-materi');
Route::post('/kelola-materi/add-materi', [MateriController::class, 'addMateri'])->name('add-materi.post');
Route::delete('/kelola-materi/{id}', [MateriController::class, 'destroyMateri'])->name('destroy-materi');

//Unit 
Route::get('/kelola-unit/{id_materi}', [UnitController::class, 'index'])->name('kelola-unit');
Route::post('/kelola-unit/create', [UnitController::class, 'createUnit'])->name('kelola-unit.create');
Route::delete('/deleteUnit/{id}', [UnitController::class, 'destroy']);
Route::get('/kelola-data-materi/{id_unit}/{id_materi}', [UnitController::class, 'showDataMateri'])->name('info-unit');

//LevelBonus
Route::get('level-bonus', [LevelBonusController::class, 'index'])->name('level-bonus');

//kelolaLevelBonus
Route::get('kelola-unit-levelBonus/{id_materi}', [KelolaLevelBonusController::class, 'index'])->name('level-bonus.unit');
Route::get('/data_levelbonus/{id_unit_Bonus}', [KelolaLevelBonusController::class, 'viewDataByID'])->name('data-levelbonus');
Route::post('/unit/delete', [KelolaLevelBonusController::class, 'delete'])->name('unit.delete');
Route::post('/kelola-unitLevelBonus/create', [KelolaLevelBonusController::class, 'createUnitLevelBonus'])->name('kelola-unitLevelBonus.create');
Route::post('/kelola_levelbonus/tambah-levelBonus', [KelolaLevelBonusController::class, 'addLevelBonus'])->name('tambah-levelbonus.post');
Route::post('/kelola_levelbonus/tambah-questionLevelBonus', [KelolaLevelBonusController::class, 'addQuestionLevelBonus'])->name('tambah-levelBonus.question');

//Akun-siswa
Route::get('/akun-siswa', [UserController::class,'index'])->name('Data-akun-siswa'); 
Route::get('/detail-siswa', function () {
    return view('akun-siswa.detail-siswa');
});
Route::get('/detail-siswa/{id}', [UserController::class,'show'])->name('detail-siswa');
Route::get('/lencana-pengguna/{id_user}', [UserController::class, 'lencanaPengguna'])->name('lencana-pengguna');
Route::get('/pencapaian-pengguna/{id_user}', [UserController::class, 'pencapaianPengguna'])->name('pencapaian-pengguna');

// Pretest/Posttest
//Soal
Route::get('/soal_pretest', function () {
    return view('kelola-materi.detail_soal_pretest');
})->name('soal_pretest');

Route::get('/soal_posttest', function () {
    return view('kelola-materi.detail_soal_posttest');
})->name('soal_posttest');

//Pages
Route::post('/kelola_data_materi/add-pretest', [KelolaDataMateriController::class, 'addPretest'])->name('add-pretest.post');
Route::post('/kelola_data_materi/add-posttest', [KelolaDataMateriController::class, 'addPosttest'])->name('add-posttest.post');
Route::get('/data_materi/{id_unit}', [KelolaDataMateriController::class, 'viewDataByID'])->name('data-materi');
Route::delete('/delete-unit/{id_unit}', [KelolaDataMateriController::class, 'deleteUnit'])->name('kelola-unit.delete');
Route::post('/kelola_data_materi/simpan-video', [KelolaDataMateriController::class, 'simpanVideo'])->name('simpan-video.post');
Route::post('/kelola_pretest/tambah-question', [KelolaDataMateriController::class, 'addQuestionPretest'])->name('tambah-pretest.post');
Route::post('/kelola_posttest/tambah-question', [KelolaDataMateriController::class, 'addQuestionPosttest'])->name('tambah-posttest.post');
Route::get('/kelola_pretest/{id_pretest}', [KelolaDataMateriController::class, 'getQuestionPretestByID'])->name('kelola_pretest.get');
Route::delete('/delete-QuestionPretest/{id_QuestionPretest}', [KelolaDataMateriController::class, 'deleteQuestionPretest'])->name('kelola-QuestionPretest.delete');
Route::delete('/delete-QuestionPosttest/{id_QuestionPosttest}', [KelolaDataMateriController::class, 'deleteQuestionPosttest'])->name('kelola-QuestionPosttest.delete');

//KelolaSiswa||Admin
Route::post('/kelola-siswa/update-status/{id}', [KelolaSiswaController::class, 'updateStatusSiswa'])->name('update-status-siswa');

//Kelola-admin
Route::get('/akun-admin', [SuperAdminController::class,'index'])->name('kelola-superadmin');
Route::post('/kelola-admin/update-status/{id}', [SuperAdminController::class, 'updateIsApproved'])->name('update-admin.isApproved');
Route::post('/kelola-admin/updatestatusadmin/{id}', [SuperAdminController::class, 'updateStatus'])->name('update-admin.status');
Route::post('/kirim-laporan/{id}', 'App\Http\Controllers\ReportController@kirimLaporan')->name('kirim-laporan');

Route::get('/create-report/{id_user}', [ReportController::class, 'createReport'])->name('create-report');


// Route::get('/data_materi', function () {
//     return view('kelola-materi.kelola_data_materi');
// })->name('data_materi');


// Route::get('/akun-siswa', [UserController::class,'index'])->name('Data-akun-siswa'); 
// Route::get('/akun-siswa', function () {
//     return view('akun-siswa.akun-siswa');
// })->name('akun-siswa');


// Route::get('/Tambahdata-materi', function () {
//     return view('Tambahdata-materi');
// });
