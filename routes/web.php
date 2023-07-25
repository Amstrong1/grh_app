<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\FillerController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConflictController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RegularTaskController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SalaryAdvantageController;
use App\Http\Controllers\RegularTaskReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::match(['get', 'post'], '/', HomeController::class);
    Route::match(['get', 'post'], '/dashboard', HomeController::class)->name('dashboard');

    Route::middleware(['superadmin'])->group(function () {
        Route::resource('structure', StructureController::class);
    });

    Route::middleware(['admin'])->group(function () {
        Route::resource('admin', AdminController::class);
        Route::resource('department', DepartmentController::class);
        Route::resource('place', PlaceController::class);
        Route::resource('filler', FillerController::class);
        Route::resource('salary_advantage', SalaryAdvantageController::class);
        Route::resource('pay', PayController::class);
    });

    Route::resource('career', CareerController::class);

    Route::resource('conflict', ConflictController::class);

    Route::get('notification/mark', [NotificationController::class, 'markAsRead'])->name('notification.markAsRead');
    Route::get('notification/remove', [NotificationController::class, 'remove'])->name('notification.remove');
    Route::get('notification', [NotificationController::class, 'index'])->name('notification');

    Route::match(['get', 'post'], 'task/pending', [TaskController::class, 'indexPending'])->name('task.pending');
    Route::match(['get', 'post'], 'task/finished', [TaskController::class, 'indexFinished'])->name('task.finished');
    Route::resource('task', TaskController::class);

    Route::resource('regular_task', RegularTaskController::class);
    Route::resource('regular_task_report', RegularTaskReportController::class);

    Route::match(['get', 'post'], 'absence/allowed', [AbsenceController::class, 'indexAllowed'])->name('absence.allowed');
    Route::match(['get', 'post'], 'absence/denied', [AbsenceController::class, 'indexDenied'])->name('absence.denied');
    Route::resource('absence', AbsenceController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
