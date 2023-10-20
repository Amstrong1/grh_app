<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        foreach (auth()->user()->notifications as $notification) {
            $notification->markAsRead();
        }
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
