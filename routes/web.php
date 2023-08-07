<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\FillerController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConflictController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TemptationController;
use App\Http\Controllers\HoldingWageController;
use App\Http\Controllers\RegularTaskController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SalaryAdvantageController;
use App\Http\Controllers\RegularTaskReportController;
use App\Http\Controllers\AttendanceScheduleController;

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

// Route::get('storage-link', function() {
//     $targetFolder = storage_path('app/public');
//     $linkFolder = $SERVER['DOCUMENT_ROOT'] . '/storage';
//     symlink($targetFolder, $linkFolder);
// });

Route::get('password/first/{user}', [PasswordController::class, 'edit'])->name('password.first.edit');
Route::post('password/first/update/{user}', [PasswordController::class, 'update'])->name('password.first.update');

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class);
    Route::get('/dashboard', HomeController::class)->name('dashboard');
    Route::post('/dashboard/filter', HomeController::class)->name('dashboard.filter');

    Route::middleware(['superadmin'])->group(function () {
        Route::resource('structure', StructureController::class);
    });

    Route::middleware(['admin'])->group(function () {
        Route::resource('admin', AdminController::class);
        Route::resource('department', DepartmentController::class);
        Route::resource('place', PlaceController::class);
        Route::resource('reader', ReaderController::class);
        Route::resource('filler', FillerController::class);
        Route::resource('holding_wage', HoldingWageController::class);
        Route::resource('salary_advantage', SalaryAdvantageController::class);
        Route::resource('attendance_schedule', AttendanceScheduleController::class);
        Route::resource('leave_type', LeaveTypeController::class);

        Route::post('leave/filter', [LeaveController::class, 'indexFilter'])->name('leave.filter');
        Route::resource('leave', LeaveController::class);

        Route::resource('pay', PayController::class);
    });

    Route::resource('career', CareerController::class);

    Route::post('conflict/filter', [ConflictController::class, 'indexFilter'])->name('conflict.filter');
    Route::resource('conflict', ConflictController::class);

    Route::get('notification/mark', [NotificationController::class, 'markAsRead'])->name('notification.markAsRead');
    Route::get('notification/remove', [NotificationController::class, 'remove'])->name('notification.remove');
    Route::get('notification', [NotificationController::class, 'index'])->name('notification');

    Route::post('task/filter', [TaskController::class, 'indexFilter'])->name('task.filter');
    Route::post('task/pending/filter', [TaskController::class, 'indexPendingFilter'])->name('task.pending.filter');
    Route::post('task/finished/filter', [TaskController::class, 'indexFinishedFilter'])->name('task.finished.filter');

    Route::get('task/pending', [TaskController::class, 'indexPending'])->name('task.pending');
    Route::get('task/finished', [TaskController::class, 'indexFinished'])->name('task.finished');

    Route::resource('task', TaskController::class);

    Route::resource('regular_task', RegularTaskController::class);
    Route::resource('regular_task_report', RegularTaskReportController::class);

    Route::post('absence/filter', [AbsenceController::class, 'indexFilter'])->name('absence.filter');
    Route::post('absence/allowed/filter', [AbsenceController::class, 'indexAllowedFilter'])->name('absence.allowed.filter');
    Route::post('absence/denied/filter', [AbsenceController::class, 'indexDeniedFilter'])->name('absence.denied.filter');

    Route::get('absence/allowed', [AbsenceController::class, 'indexAllowed'])->name('absence.allowed');
    Route::get('absence/denied', [AbsenceController::class, 'indexDenied'])->name('absence.denied');

    Route::resource('absence', AbsenceController::class);

    Route::post('temptation/filter', [TemptationController::class, 'indexFilter'])->name('temptation.filter');
    Route::resource('temptation', TemptationController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
