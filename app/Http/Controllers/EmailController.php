<?php

namespace App\Http\Controllers;

use App\Mail\NewTaskMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function newTask($user_mail)
    {
        Mail::to($user_mail)->send(new NewTaskMail);
    }
}
