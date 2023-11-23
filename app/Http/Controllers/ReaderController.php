<?php

namespace App\Http\Controllers;

use App\Models\Reader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreReaderRequest;
use App\Http\Requests\UpdateReaderRequest;

class ReaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        return view('app.reader.index', [
            'readers' => $structure->readers()->get(),
            'my_actions' => $this->reader_actions(),
            'my_attributes' => $this->reader_columns(),
            'my_fields' => $this->reader_fields(),
        ]);
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
    public function store(StoreReaderRequest $request)
    {
        $reader = new Reader();

        $reader->structure_id = Auth::user()->structure->id;
        $reader->type = $request->type;
        $reader->installation_place = $request->installation_place;
        $reader->sens = $request->sens;

        if ($reader->save()) {
            Alert::toast(Lang::get('message.success'), 'success');
            return redirect('reader');
        } else {
            Alert::toast(Lang::get('message.error'), 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reader $reader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reader $reader)
    {
        return view('app.reader.edit', [
            'reader' => $reader,
            'my_fields' => $this->reader_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReaderRequest $request, Reader $reader)
    {
        $reader = Reader::find($reader->id);

        $reader->type = $request->type;
        $reader->installation_place = $request->installation_place;
        $reader->sens = $request->sens;

        if ($reader->save()) {
            Alert::toast(Lang::get('message.edited'), 'success');
            return redirect('reader');
        } else {
            Alert::toast(Lang::get('message.error'), 'success');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reader $reader)
    {
        try {
            $reader = $reader->delete();
            Alert::success(Lang::get('message.del_success1'), Lang::get('message.del_success2'));
            return redirect('reader');
        } catch (\Exception $e) {
            Alert::error(Lang::get('message.del_error1'), Lang::get('message.del_error2'), );
            return redirect()->back();
        }
    }

    private function reader_columns()
    {
        $columns = (object) [
            'type' => 'Type',
            'installation_place' => 'Emplacement',
            'sens' => 'sens',
        ];
        return $columns;
    }

    private function reader_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function reader_fields()
    {
        $types = ['Pointeur' => 'Pointeur', 'Empreinte' => 'Empreinte', 'Badge'=> 'Badge', 'Faciale' => 'Faciale'];
        $sens = ['Tout' => 'Tout', 'Entrée' => 'Entrée', 'Sortie'=> 'Sortie'];
        $fields = [
            'type' => [
                'title' => 'Type',
                'field' => 'select',
                'options' => $types,
            ],
            'installation_place' => [
                'title' => 'Position',
                'field' => 'text'
            ],
            'type' => [
                'title' => 'Sens',
                'field' => 'select',
                'options' => $sens,
            ],
        ];
        return $fields;
    }
}
