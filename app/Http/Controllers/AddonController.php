<?php

namespace App\Http\Controllers;

use App\Models\Addon;
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
            Alert::toast("Données enregistrées", 'success');
            return redirect('addon');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
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
            Alert::toast('Les informations ont été modifiées', 'success');
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
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('addon');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function addon_columns()
    {
        $columns = (object) [
            'img' => '',
            'title' => 'Titre',
            'url' => 'URL',
            'autre' => 'Autre',
            'formatted_active' => 'Statut',
            'formatted_created_at' => 'Date d\'enregistrement',
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
        $status = ['0' => 'Non Actif', '1' => 'Actif'];
        $fields = [
            'img' => [
                'title' => 'Image',
                'field' => 'file'
            ],
            'title' => [
                'title' => 'Titre',
                'field' => 'text'
            ],
            'url' => [
                'title' => 'URL',
                'field' => 'url'
            ],
            'active' => [
                'title' => 'Statut',
                'field' => 'select',
                'options' => $status
            ],
            'autre' => [
                'title' => 'Autre',
                'field' => 'textarea'
            ],
        ];
        return $fields;
    }
}
