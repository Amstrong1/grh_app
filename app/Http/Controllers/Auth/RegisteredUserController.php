<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Structure;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use RealRashid\SweetAlert\Facades\Alert;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email_struct' => ['required', 'string', 'email', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $structure = Structure::where('email', $request->email_struct)->first();

        if ($structure !== null) {
            $user = User::create([
                'structure_id' => $structure->id,
                'name' => $request->name,
                'firstname' => $request->firstname,
                'email' => $request->email,
                'role' => 'admin',
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));
    
            Auth::login($user);
    
            Alert::toast('Administrateur enregistré', 'success');
            return redirect(RouteServiceProvider::HOME);
        }
        else {
            Alert::toast('Votre entreprise n\'est pas enregistré', 'error');
            return back()->withInput();
        }
    }
}
