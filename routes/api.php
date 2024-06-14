<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PengelolaController;
use App\Http\Controllers\Api\MateriController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\PretestController;
use App\Http\Controllers\Api\PosttestController;
use App\Http\Controllers\Api\QuestionPretestController;
use App\Http\Controllers\Api\QuestionPosttestController;
use App\Http\Controllers\Api\MaterialVideoController;
use App\Http\Controllers\Api\ScoreController;
use App\Http\Controllers\Api\BadgeController;
use App\Http\Controllers\Api\LencanaPenggunaController;
use App\Http\Controllers\Api\ScorePretestController;
use App\Http\Controllers\Api\ScorePosttestController;
use App\Http\Controllers\Api\ScoreLevelBonusController;
use App\Http\Controllers\Api\WatchMaterialVideoController;
use App\Http\Controllers\Api\LeaderboardController;
use App\Http\Controllers\Api\LevelBonusController;
use App\Http\Controllers\Api\UnitBonusController;
use App\Http\Controllers\Api\QuestionLevelBonusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Api Routes

// API Autentikasi atau untuk user.
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('check-email-availability', [AuthController::class, 'checkEmailAvailability']);
Route::get('getUser', [AuthController::class, 'index']);
Route::get('getUsers', [AuthController::class, 'indexofUser']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/username', [AuthController::class, 'getUsername']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user/pretest-status', [PretestController::class, 'checkUserPretestStatus']);
    Route::get('/user/posttest-status', [PosttestController::class, 'checkUserPosttestStatus']);
    Route::get('/user/material-video-status', [MaterialVideoController::class, 'checkUserMaterialVideoStatus']);
    Route::put('/pretest/{id}/update-final-score-pretest', [ScorePretestController::class, 'updateFinalScorePretest']);
    Route::put('/posttest/{id}/update-final-score-posttest', [ScorePosttestController::class, 'updateFinalScorePosttest']);
    Route::put('/levelbonus/{id}/update-final-score-level-bonus', [ScoreLevelBonusController::class, 'updateFinalScoreLevelBonus']);
    Route::get('/watch-material-video/status', [WatchMaterialVideoController::class, 'checkUserVideoStatus']);
    Route::put('/watch-material-video/{id}/mark-completed', [WatchMaterialVideoController::class, 'markVideoCompleted']);
    Route::get('/user/score-pretest-by-idunit/{id_unit}', [ScorePretestController::class, 'getPretestByUnit']);
    Route::get('/user/score-pretest-by-idunit-smallid/{id_unit}', [ScorePretestController::class, 'getPretestByUnitSmallIdScore']);
    Route::get('/user/smallest-score-pretest-by-unit', [ScorePretestController::class, 'getSmallestScorePretestByUnit']);
    Route::get('/user/get-scores-pretest', [ScorePretestController::class, 'getScoresPretest']);
    Route::get('/user/get-scores-pretest-idmateri/{materiId}', [ScorePretestController::class, 'getScoresPretestByMateri']);
    Route::get('/user/score-posttest-by-idunit/{id_unit}', [ScorePosttestController::class, 'getPosttestByUnit']);
    Route::get('/user/score-posttest-by-idunit-smallid/{id_unit}', [ScorePosttestController::class, 'getPosttestByUnitSmallIdScore']);
    Route::get('user/smallest-score-posttest-by-unit', [ScorePosttestController::class, 'getSmallestScorePosttestByUnit']);
    Route::get('user/get-scores-posttest', [ScorePosttestController::class, 'getScoresPosttest']);
    Route::get('/user/get-scores-posttest-idmateri/{materiId}', [ScorePosttestController::class, 'getScoresPosttestByMateri']);
    Route::get('/user/watch-video-by-idunit/{id_unit}', [WatchMaterialVideoController::class, 'getWatchVideoByUnit']);
    Route::get('/user/watch-video-by-idunit-smallid/{id_unit}', [WatchMaterialVideoController::class, 'getWatchVideoByUnitSmallIdVideo']);
    Route::post('update-statistics', [StatisticController::class, 'updateStatistics']);
    Route::get('statistics', [StatisticController::class, 'getStatistics']);
    Route::get('checkFirstAttempt', [ScorePosttestController::class, 'checkFirstAttempt']);
});
Route::get('/user/{id}/lives', [AuthController::class, 'getLivesByUserId']);
Route::put('/users/{id}/update-lives',  [AuthController::class, 'updateLivesByUserId']);
Route::post('users/update-active-status/{id}', [AuthController::class, 'updateActiveStatus']);

Route::get('getUserById/{id}',  [AuthController::class, 'getUserById']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);


//Pengelola
Route::post("register-Pengelola", [PengelolaController::class,"register"]);
Route::post("login-Pengelola", [PengelolaController::class,"login"]);
Route::post('/logout-Pengelola', [PengelolaController::class, 'logout']);
Route::get('getPengelola/{id}', [PengelolaController::class, 'getUserNameById']);
Route::get('/data-managers', [PengelolaController::class, 'getDataManager']);
Route::post('/StatusAdmins/{id}', [PengelolaController::class, 'updateActiveStatus']);
Route::get('/data-managers/{id}', [PengelolaController::class, 'getDataManagerByID']);
Route::post('/UpdateStatusAdmin/{id}', [PengelolaController::class, 'updateActiveAdminStatus']);

Route::post('password/reset', [PengelolaController::class, 'resetPasswordAdmin'])->name('password.update');

Route::get('resetpasswordForm', [PengelolaController::class, 'showResetPasswordForm'])->name('password.request');

Route::post('/validate-user', [PengelolaController::class, 'validationUser']);

// API Materi 
Route::post("addMateri",[MateriController::class, "store"]);
Route::get('getMateri', [MateriController::class, 'index']);
Route::post('editMateri/{id}', [MateriController::class, 'update']);
Route::delete('hapusMateri/{id}', [MateriController::class, 'destroy']);
Route::get('/materi/{id}', [MateriController::class, 'show']);

// API Unit
Route::post("addUnit",[UnitController::class, "store"]);
Route::get("getUnit",[UnitController::class, "index"]);
Route::get("getUnitByMateri",[UnitController::class, "getByIdMateri"]);
Route::get("getUnit/{id}",[UnitController::class, "show"]);
Route::delete("deleteUnit/{id}",[UnitController::class, "destroy"]);
Route::get('getUnitByMateri/{id_materi}',[UnitController::class, "getUnitsByMateri"]);
Route::post('/editUnit/{id}', [UnitController::class, 'update']);

// API Level
Route::post("addLevel",[LevelController::class, "store"]);
Route::get("getLevel",[LevelController::class, "index"]);

// API Pretest 
Route::post("addPretest",[PretestController::class, "store"]);
Route::post("editPretest/{id}",[PretestController::class, "update"]);
Route::get("getPretest",[PretestController::class, "index"]);
Route::get("getPretestByUnit",[PretestController::class, "getByIdUnit"]);
Route::delete("deletePretest/{id}",[PretestController::class, "destroy"]);
Route::put('/pretest/{id}/update-final-score', [PretestController::class, 'updateFinalScore']);
Route::get('getByUnitPretest/{id_unit}',[PretestController::class, "getByUnit"]);

// API QuestionPretest
Route::post("addQuestionPretest",[QuestionPretestController::class, "store"]);
Route::post("editQuestionPretest/{id}",[QuestionPretestController::class, "update"]);
Route::get("getQuestionPretest",[QuestionPretestController::class, "index"]);
Route::get("getQuestionByPretest",[QuestionPretestController::class, "getByPretest"]);
Route::delete("deleteQuestionPretest/{id}",[QuestionPretestController::class, "destroy"]);
Route::get("QuestionPretestByID/{id_pretest}",[QuestionPretestController::class,"getQuestionByID"]);

// API Posttest
Route::post("addPosttest",[PosttestController::class, "store"]);
Route::post("editPosttest/{id}",[PosttestController::class, "update"]);
Route::get("getPosttest",[PosttestController::class, "index"]);
Route::get("getPosttestByUnit",[PosttestController::class, "getByIdUnit"]);
Route::delete("deletePosttest/{id}",[PosttestController::class, "destroy"]);
Route::put('/posttest/{id}/update-final-score', [PosttestController::class, 'updateFinalScore']);
Route::get('getByUnitPosttest/{id_unit}',[PosttestController::class, "getByUnit"]);

// API QuestionPosttest
Route::post("addQuestionPosttest",[QuestionPosttestController::class, "store"]);
Route::post("editQuestionPosttest/{id}",[QuestionPosttestController::class, "update"]);
Route::get('getQuestionPosttest', [QuestionPosttestController::class, 'index']);
Route::get("getQuestionByPosttest",[QuestionPosttestController::class, "getByPosttest"]);
Route::delete("deleteQuestionPosttest/{id}",[QuestionPosttestController::class, "destroy"]);
Route::get("QuestionPosttestByID/{id_posttest}",[QuestionPosttestController::class,"getQuestionByID"]);

// API QuestionLevelBonus
Route::post("addQuestionLevelBonus",[QuestionLevelBonusController::class, "store"]);
Route::post("editQuestionLevelBonus/{id}",[QuestionLevelBonusController::class, "update"]);
Route::get('getQuestionLevelBonusAll', [QuestionLevelBonusController::class, 'indexAll']);
Route::get('getQuestionLevelBonus', [QuestionLevelBonusController::class, 'index']);
Route::delete("deleteQuestionLevelBonus/{id}",[QuestionLevelBonusController::class, "destroy"]);
Route::get("QuestionLevelBonusByID/{id_level_bonus}",[QuestionLevelBonusController::class,"getQuestionByID"]);

//Material Video
Route::post("addMaterialVideo",[MaterialVideoController::class, "store"]);
Route::post("editMaterialVideo/{id}",[MaterialVideoController::class, "update"]);
Route::delete("deleteMaterialVideo/{id}",[MaterialVideoController::class, "destroy"]);
Route::get("getMaterialVideo",[MaterialVideoController::class,"index"]);
Route::get("getMaterialVideoByUnit",[MaterialVideoController::class,"getVideoByUnit"]);
Route::get('getByUnitVideo/{id_unit}',[MaterialVideoController::class, "getByUnit"]);

//ScorePretest||Posttest
Route::get('/scores', [ScoreController::class, 'index']);
Route::get('/averageScoresPretestByMateri', [ScoreController::class, 'averageScoresPretestByMateri']);
Route::get('/averageScoresPosttestByMateri', [ScoreController::class, 'averageScoresPosttestByMateri']);
Route::get('/scores/{id}', [ScoreController::class, 'show']);

// API untuk lencana
Route::get('/badges', [BadgeController::class, 'index']);
Route::get('/badges/{id}', [BadgeController::class, 'show']);
Route::get('/badgesByMateri/{id}', [BadgeController::class, 'showByMateri']);
Route::post('/addBadges', [BadgeController::class, 'store']);
Route::post('/badges/{id}', [BadgeController::class, 'update']);
Route::delete('/badges/{id}', [BadgeController::class, 'destroy']);
Route::get('/images/{filename}', function ($filename) {
    $path = storage_path('images/' . $filename); 
    if (!file_exists($path)) {
        return Response::json(['error' => 'File not found'], 404); 
    }

    // Jika file gambar ada, kembalikan respons dengan file gambar
    return response()->file($path);
})->name('image');
Route::get('/badges/by-posttest/{id_posttest}', [BadgeController::class, 'getByPosttestId']);

//lencanaPengguna

Route::get('/lencana-pengguna/{id_user}', [LencanaPenggunaController::class, 'index']);
Route::get('/total-badge-user', [LencanaPenggunaController::class, 'getTotalBadgesUser']);
Route::post('/addLencanaPengguna', [LencanaPenggunaController::class, 'store']);

//ScorePretest
Route::get('/scorePretests', [ScorePretestController::class, 'index']);
Route::post('/addScorePretest', [ScorePretestController::class, 'addScore']);
Route::get('/scorePretests/{id}', [ScorePretestController::class, 'show']);

//ScorePosttest
Route::get('/scorePosttests', [ScorePosttestController::class, 'index']);
Route::get('/scorePosttests/{id}', [ScorePosttestController::class, 'show']);
Route::post('/addScorePosttest', [ScorePosttestController::class, 'addScore']);

//Route untuk ScorePretestController
Route::get('/total-score-pretest-all-user', [ScorePretestController::class, 'getTotalPretestScoreForAllUsers']);

//Route untuk ScorePosttestController
Route::get('/total-score-posttest-all-user', [ScorePosttestController::class, 'getTotalPosttestScoreForAllUsers']);
Route::get('/leaderboard-posttest-all-user', [ScorePosttestController::class, 'getLeaderboardScorePosttest']);

//LeaderBoard
Route::get('/leaderboard', [LeaderboardController::class, 'dataLeaderboardAll']);
Route::get('/dataLeaderboard', [LeaderboardController::class, 'dataLeaderboard']);

//Report
Route::get('/create-report/{id_user}', [LaporanController::class, 'createReport'])->name('create-report');

Route::prefix('levelbonus')->group(function () {
    Route::get('/', [LevelBonusController::class, 'index']);
    Route::post('/addLevelBonus', [LevelBonusController::class, 'store']);
    Route::get('/{id}', [LevelBonusController::class, 'show']);
    Route::post('/editLevelBonus/{id}', [LevelBonusController::class, 'update']);
    Route::delete('/{id}', [LevelBonusController::class, 'destroy']);
    Route::patch('/{id}/score', [LevelBonusController::class, 'updateFinalScore']);
    Route::get('/getByUnit/{id_unit_bonus}', [LevelBonusController::class, 'getLevelBonusByUnit']);
});
Route::put('/levelbonus/{id}/update-final-score', [LevelBonusController::class, 'updateFinalScore']);


Route::prefix('unitbonus')->group(function () {
    Route::get('/', [UnitBonusController::class, 'index']);
    Route::get('/getByMateri/{id_materi}', [UnitBonusController::class, 'getUnitBonusByMateri']);
    Route::post('/AddUnitBonus', [UnitBonusController::class, 'store']);
    Route::get('/{id}', [UnitBonusController::class, 'show']);
    Route::post('/editUnitBonus/{id}', [UnitBonusController::class, 'update']);
    Route::delete('/{id}', [UnitBonusController::class, 'destroy']);
});
