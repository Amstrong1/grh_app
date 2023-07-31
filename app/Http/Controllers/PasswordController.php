<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StorePasswordRequest;

class PasswordController extends Controller
{
    public function edit($user)
    {
        // dd($user);
        $user = User::find($user);
        // dd($user);
        return view('app.password.create', compact('user'));
    }

    public function update(StorePasswordRequest $request, $user)
    {
        $user = User::find($user);
        $user->password = $request->password;

        if ($user->save()) {
            return redirect('dashboard');
        }
    }
}
