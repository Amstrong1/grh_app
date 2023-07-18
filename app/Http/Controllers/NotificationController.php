<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index() {
        return view('app.notification.index');
    }
    
    public function markAsRead() {
        foreach (auth()->user()->notifications as $notification) {
            $notification->markAsRead();
        }
        return view('app.notification.index');
    }
}
