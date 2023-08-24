<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SendNewsController;
use App\Http\Controllers\API\AttendanceLogController;

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

Route::apiResources([
    'attendanceLogs' => AttendanceLogController::class,
    'news' => SendNewsController::class,
]);

Route::get('users/{email}', function ($email) {
    return User::where('email', $email)->first();
});

