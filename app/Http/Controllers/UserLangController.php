<?php

namespace App\Http\Controllers;

use App\Models\UserLang;
use App\Http\Requests\StoreUserLangRequest;
use App\Http\Requests\UpdateUserLangRequest;
use Illuminate\Support\Facades\Auth;

class UserLangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserLangRequest $request)
    {        
        if (Auth::user()->locale !== null) {
            $userLang = UserLang::where('user_id', Auth::user()->id)->first();
            $userLang->lang = $request->lang;
        } else {
            $userLang = new UserLang();
            $userLang->user_id = Auth::user()->id;
            $userLang->lang = $request->lang;
        }

        $userLang->save();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(UserLang $userLang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserLang $userLang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserLangRequest $request, UserLang $userLang)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserLang $userLang)
    {
        //
    }
}
