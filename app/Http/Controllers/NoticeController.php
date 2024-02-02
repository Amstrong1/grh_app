<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Notifications\NewNotice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        return view('app.notice.index', [
            'notices' => $structure->notices()->get(),
            'my_actions' => $this->notice_actions(),
            'my_attributes' => $this->notice_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.notice.create', [
            'my_fields' => $this->notice_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoticeRequest $request)
    {
        $notice = new Notice();

        $notice->structure_id = Auth::id();
        $notice->title = $request->title;
        $notice->description = $request->description;

        if ($notice->save()) {
            $structure = Auth::user()->structure;
            $users = $structure->users()->where('role', '!=', 'admin')->get();
            foreach ($users as $user) {
                $user->notify(new NewNotice());
            }
            Alert::toast(Lang::get('message.success'), 'success');
            return redirect('notice');
        } else {
            Alert::toast(Lang::get('message.error'), 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        return view('app.notice.show', [
            'notice' => $notice,
            'my_fields' => $this->notice_fields(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice)
    {
        return view('app.notice.edit', [
            'notice' => $notice,
            'my_fields' => $this->notice_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        $notice->title = $request->title;
        $notice->description = $request->description;
        
        if ($notice->save()) {
            Alert::toast(Lang::get('message.edited'), 'success');
            return redirect('notice');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        try {
            $notice = $notice->delete();
            Alert::success(Lang::get('message.del_success1'), Lang::get('message.del_success2'));
            return redirect('notice');
        } catch (\Exception $e) {
            Alert::error(Lang::get('message.del_error1'), Lang::get('message.del_error2'), );
            return redirect()->back();
        }
    }

    private function notice_columns()
    {
        $columns = (object) [
            'title' => 'Titre',
            'formatted_date' => 'Date de publication'
        ];
        return $columns;
    }

    private function notice_actions()
    {
        if (Auth::user()->role == 'admin') {
            $actions = (object) array(
                'show' => 'Voir',
                'edit' => 'Modifier',
                'delete' => "Supprimer",
            );
        } else {
            $actions = (object) array(
                'show' => 'Voir',
            );
        }
        
        return $actions;
    }

    private function notice_fields()
    {
        $fields = [
            'title' => [
                'title' => 'Titre',
                'field' => 'text'
            ],
            'description' => [
                'title' => 'Information',
                'field' => 'richtext',
                'colspan' => true
            ]
        ];
        return $fields;
    }
}
