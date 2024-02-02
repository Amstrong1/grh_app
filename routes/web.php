<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AddonController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\FillerController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConflictController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserLangController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TemptationController;
use App\Http\Controllers\HoldingWageController;
use App\Http\Controllers\RegularTaskController;
use App\Http\Controllers\MaterialUserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TemptationBackController;
use App\Http\Controllers\SalaryAdvantageController;
use App\Http\Controllers\API\AttendanceLogController;
use App\Http\Controllers\RegularTaskReportController;
use App\Http\Controllers\AttendanceScheduleController;
use App\Http\Controllers\NewsletterSubscriberController;

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

Route::middleware('setLocale')->group(function () {

    Route::get('state', [StateController::class, 'indexstate'])->name('state.index');
    Route::resource('notice', NoticeController::class);

    Route::post('lang', [UserLangController::class, 'store'])->name('user_lang.store');

    Route::get('coming-soon', function () {
        return view('coming-soon');
    })->name('coming-soon');

    Route::get('contact-us', [ContactController::class, 'index']);
    Route::post('contact-us', [ContactController::class, 'store'])->name('contact');

    Route::post('subscribe', [NewsletterSubscriberController::class, 'store'])->name('subscribe');

    Route::get('password/first/{user}', [PasswordController::class, 'edit'])->name('password.first.edit');
    Route::post('password/first/update/{user}', [PasswordController::class, 'update'])->name('password.first.update');

    Route::middleware('auth')->group(function () {
        Route::get('/', HomeController::class);
        Route::get('/dashboard', HomeController::class)->name('dashboard');
        Route::post('/dashboard/filter', HomeController::class)->name('dashboard.filter');

        Route::middleware(['superadmin'])->group(function () {
            Route::resource('structure', StructureController::class);
            Route::resource('addon', AddonController::class);

            Route::get('newsletter/pending', [NewsletterController::class, 'indexPending'])->name('newsletter.pending');
            Route::resource('newsletter', NewsletterController::class);
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

            Route::get('attendance_log', [AttendanceLogController::class, 'display'])->name('attendance_log.index');
            Route::post('attendance_log/filter', [AttendanceLogController::class, 'filter'])->name('attendance_log.filter');
        });

        Route::resource('material', MaterialController::class);
        Route::resource('material_user', MaterialUserController::class);

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
        Route::post('temptation/sent/filter', [TemptationController::class, 'indexFilterSent'])->name('temptation.sent.filter');
        Route::get('temptation/sent', [TemptationController::class, 'indexSent'])->name('temptation.sent');
        Route::resource('temptation', TemptationController::class);

        Route::post('temptation_back/filter', [TemptationBackController::class, 'indexFilter'])->name('temptation_back.filter');
        Route::post('temptation_back/sent/filter', [TemptationBackController::class, 'indexFilterSent'])->name('temptation_back.sent.filter');
        Route::get('temptation_back/sent', [TemptationBackController::class, 'indexSent'])->name('temptation_back.sent');
        Route::resource('temptation_back', TemptationBackController::class);

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
