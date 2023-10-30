<?php

namespace App\Console;

use App\Models\Task;
use App\Models\User;
use App\Notifications\RemumberNotification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ViewNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
        
        $tasks = Task::where('status', 'A faire')->get();

        foreach ($tasks as $task) {
            $users = $task->users;
            foreach ($users as $user) {
               
                $user->notify(new RemumberNotification());
                info('Notification envoyée à : ' . $user->name);
            }
        }
            })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
