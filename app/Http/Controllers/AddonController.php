<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\StoreAddonRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UpdateAddonRequest;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.addon.index', [
            'addons' => Addon::all(),
            'my_actions' => $this->addon_actions(),
            'my_attributes' => $this->addon_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.addon.create', [
            'my_fields' => $this->addon_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddonRequest $request)
    {
        $addon = new Addon();

        $fileName = time() . '.' . $request->img->extension();
        $path = $request->file('img')->storeAs('img', $fileName, 'public');

        $addon->title = $request->title;
        $addon->url = $request->url;
        $addon->img = $path;
        $addon->autre = $request->autre;
        $addon->active = $request->active;

        if ($addon->save()) {
            Alert::toast(Lang::get('message.success'), 'success');
            return redirect('addon');
        } else {
            Alert::toast(Lang::get('message.error'), 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Addon $addon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Addon $addon)
    {
        return view('app.addon.edit', [
            'addon' => $addon,
            'my_fields' => $this->addon_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddonRequest $request, Addon $addon)
    {
        $addon = Addon::find($addon->id);

        if ($request->file !== null) {
            $fileName = time() . '.' . $request->img->extension();
            $path = $request->file('img')->storeAs('img', $fileName, 'public');
        }

        $addon->title = $request->title;
        $addon->url = $request->url;
        $addon->autre = $request->autre;
        $addon->active = $request->active;

        if (isset($path)) {
            $addon->img = $path;
        }

        if ($addon->save()) {
            Alert::toast(Lang::get('message.edited'), 'success');
            return redirect('addon');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Addon $addon)
    {
        try {
            $addon = $addon->delete();
            Alert::success(Lang::get('message.del_success1'), Lang::get('message.del_success2'));
            return redirect('addon');
        } catch (\Exception $e) {
            Alert::error(Lang::get('message.del_error1'), Lang::get('message.del_error2'),);
            return redirect()->back();
        }
    }

    private function addon_columns()
    {
        $columns = (object) [
            'img' => '',
            'title' => Lang::get('message.title'),
            'url' => Lang::get('message.url'),
            'autre' => Lang::get('message.other'),
            'formatted_active' => Lang::get('message.formatted_active'),
            'formatted_created_at' => Lang::get('message.formatted_created_at'),
        ];
        return $columns;
    }

    private function addon_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function addon_fields()
    {
        $status = ['0' => Lang::get('message.active'), '1' => Lang::get('message.not_active')];
        $fields = [
            'img' => [
                'title' => 'Image',
                'field' => 'file'
            ],
            'title' => [
                'title' => Lang::get('message.title'),
                'field' => 'text'
            ],
            'url' => [
                'title' => Lang::get('message.url'),
                'field' => 'url'
            ],
            'active' => [
                'title' => Lang::get('message.formatted_active'),
                'field' => 'select',
                'options' => $status
            ],
            'autre' => [
                'title' => Lang::get('message.other'),
                'field' => 'textarea'
            ],
        ];
        return $fields;
    }
}
