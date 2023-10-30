<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ViewNotification;

class NotificationController extends Controller
{
    public function index()
    {
        foreach (auth()->user()->notifications as $notification) {
            $notification->markAsRead();
        }

        $users = User::where('structure_id', Auth::user()->structure_id)->where('role', 'admin')->get();
        $user = auth()->user();
       // $schedule->command('inspire')->hourlyAt(45)->timezone('Europe/Paris');
        foreach ($users as $user) {
            $user->notify(new ViewNotification($user->name));
        };


        return view('app.notification.index');
    }

    public function markAsRead()
    {
        foreach (auth()->user()->notifications as $notification) {
            $notification->markAsRead();
        }
        return redirect('notification');
    }

    public function remove()
    {
        foreach (auth()->user()->notifications as $notification) {
            $notification->delete();
        }
        return redirect('notification');
    }
}
