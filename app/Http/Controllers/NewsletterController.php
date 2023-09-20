<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Requests\UpdateNewsletterRequest;
use App\Mail\NewsletterMail;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.newsletter.index', [
            'newsletters' => Newsletter::where('status', 'sent')->get(),
            'my_actions' => $this->newsletter_actions(),
            'my_attributes' => $this->newsletter_columns(),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexPending()
    {
        return view('app.newsletter.index', [
            'newsletters' => Newsletter::where('status', 'draft')->get(),
            'my_actions' => $this->newsletter_actions(),
            'my_attributes' => $this->newsletter_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.newsletter.create', [
            'my_fields' => $this->newsletter_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsletterRequest $request)
    {
        $newsletter = new newsletter();

        $newsletter->title = $request->title;
        $newsletter->message = $request->message;

        if ($request->boolean('send') === true) {
            $newsletter->status = 'sent';
        } else {
            $newsletter->status = 'draft';
        }

        if ($newsletter->save()) {
            if ($request->boolean('send') === true) {
                $subscribers = NewsletterSubscriber::all();
                // dd($subscribers);
                foreach ($subscribers as $subscriber) {
                    Mail::to($subscriber->email)->send(new NewsletterMail($newsletter));
                }

                Alert::toast("Mail enregistré et envoyé", 'success');
                return redirect('newsletter');
            } else {
                Alert::toast("Mail enregistré", 'success');
                return redirect('newsletter/pending');
            }
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Newsletter $newsletter)
    {
        return view('app.newsletter.show', [
            'newsletter' => $newsletter,
            'my_fields' => $this->newsletter_fields(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Newsletter $newsletter)
    {
        return view('app.newsletter.edit', [
            'newsletter' => $newsletter,
            'my_fields' => $this->newsletter_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsletterRequest $request, Newsletter $newsletter)
    {
        $newsletter = newsletter::find($newsletter->id);

        $newsletter->title = $request->title;
        $newsletter->message = $request->message;

        if ($request->boolean('send') === true) {
            $newsletter->status = 'sent';
        } else {
            $newsletter->status = 'draft';
        }

        if ($newsletter->save()) {
            if ($request->boolean('send') === true) {
                $subscribers = NewsletterSubscriber::all();

                foreach ($subscribers as $subscriber) {
                    Mail::to($subscriber->email)->send(new NewsletterMail($newsletter));
                }

                Alert::toast("Mail enregistré et envoyé", 'success');
                return redirect('newsletter');
            } else {
                Alert::toast("Mail enregistré", 'success');
                return redirect('newsletter/pending');
            }
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        try {
            $newsletter = $newsletter->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('newsletter');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function newsletter_columns()
    {
        if (request()->routeIs('newsletter.pending')) {
            $columns = (object) [
                'title' => 'Titre',
                'formatted_created_at' => 'Date de création',
            ];
        } else {
            $columns = (object) [
                'title' => 'Titre',
                'formatted_created_at' => 'Date de création',
                'formatted_updated_at' => 'Date de Publication',
            ];
        }
        return $columns;
    }

    private function newsletter_actions()
    {
        if (request()->routeIs('newsletter.pending')) {
            $actions = (object) array(
                'show' => 'Voir',
                'edit' => 'Modifier',
                'delete' => "Supprimer",
            );
        } else {
            $actions = (object) array(
                'show' => 'Voir',
                'delete' => "Supprimer",
            );
        }

        return $actions;
    }

    private function newsletter_fields()
    {
        if (request()->routeIs('newsletter.show')) {
            $fields = [
                'title' => [
                    'title' => 'Titre',
                    'field' => 'text'
                ],
                'message' => [
                    'title' => 'Message',
                    'field' => 'richtext',
                    'colspan' => true
                ]
            ];
        } else {
            $fields = [
                'title' => [
                    'title' => 'Titre',
                    'field' => 'text'
                ],
                'message' => [
                    'title' => 'Message',
                    'field' => 'richtext',
                    'colspan' => true
                ],
                'send' => [
                    'title' => 'Envoyer la newsletter aux abonnés',
                    'field' => 'checkbox',
                ]
            ];
        }

        return $fields;
    }
}
