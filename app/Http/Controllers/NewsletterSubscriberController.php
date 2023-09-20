<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreNewsletterSubscriberRequest;
use App\Http\Requests\UpdateNewsletterSubscriberRequest;

class NewsletterSubscriberController extends Controller
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
    public function store(StoreNewsletterSubscriberRequest $request)
    {
        $newsletterSubscriber = new NewsletterSubscriber();

        $newsletterSubscriber->email = $request->email;

        if ( $newsletterSubscriber->save()) {
            Alert::toast("Mail enregistré", 'success');
            return redirect('/');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsletterSubscriber $newsletterSubscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsletterSubscriber $newsletterSubscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsletterSubscriberRequest $request, NewsletterSubscriber $newsletterSubscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsletterSubscriber $newsletterSubscriber)
    {
        //
    }
}
