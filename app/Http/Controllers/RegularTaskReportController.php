<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Career;
use App\Models\RegularTaskReport;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreRegularTaskReportRequest;
use App\Http\Requests\UpdateRegularTaskReportRequest;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class RegularTaskReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'user') {
            $regularTaskReports = Auth::user()->regularTaskReports;
        } elseif (Auth::user()->role == 'supervisor') {
            $departments = Auth::user()->departments;
            $places = new EloquentCollection();
            foreach ($departments as $department) {
                $places[] = $department->places()->get();
            }
            $places = $places->collapse();

            $careers = new EloquentCollection();
            foreach ($places as $place) {
                $careers[] = Career::where('place_id', $place->id)->get();
            }
            $careers = $careers->collapse();

            $users = new EloquentCollection();
            foreach ($careers as $career) {
                $users[] = User::where('id', $career->user_id)->get();
            }
            $users = $users->collapse();

            $regularTaskReports = new EloquentCollection();
            foreach ($users as $user) {
                $regularTaskReports[] = $user->regularTaskReports;
            }
            $regularTaskReports = $regularTaskReports->collapse();
        } else {
            $structure = Auth::user()->structure;
            $regularTaskReports = $structure->regularTaskReports()->get();
        }

        return view('app.regular-task-report.index', [
            'regularTaskReports' => $regularTaskReports,
            'my_actions' => $this->regularTaskReport_actions(),
            'my_attributes' => $this->regularTaskReport_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.regular-task-report.create', [
            'my_fields' => $this->regularTaskReport_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegularTaskReportRequest $request)
    {
        foreach ($request->tasks as $task) {
            $regularTaskReport = new RegularTaskReport();

            $regularTaskReport->structure_id = Auth::user()->structure->id;
            $regularTaskReport->user_id = Auth::user()->id;
            $regularTaskReport->report_date = $request->report_date;
            $regularTaskReport->regular_task_id = $task;
            $regularTaskReport->report = $request->report;

            if ($regularTaskReport->save()) {
                Alert::toast('Les données ont été enregistrées', 'success');
                return redirect('regular_task_report');
            } else {
                Alert::toast('Les données ont été enregistrées', 'error');
                return redirect()->back()->withInput($request->input());
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RegularTaskReport $regularTaskReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegularTaskReport $regularTaskReport)
    {
        return view('app.regular-task-report.edit', [
            'regularTaskReport' => $regularTaskReport,
            'my_fields' => $this->regularTaskReport_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegularTaskReportRequest $request, RegularTaskReport $regularTaskReport)
    {
        $regularTaskReport = RegularTaskReport::find($regularTaskReport->id);

        $regularTaskReport->structure_id = Auth::user()->structure->id;
        $regularTaskReport->user_id = Auth::user()->id;
        $regularTaskReport->report_date = $request->report_date;
        $regularTaskReport->report = $request->report;

        if ($regularTaskReport->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('regular_task_report');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegularTaskReport $regularTaskReport)
    {
        try {
            $regularTaskReport = $regularTaskReport->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('regular_task_report');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function regularTaskReport_columns()
    {
        $columns = (object) [
            'task_label' => 'Tâche',
            'report' => 'Rapport',
            'report_date' => 'Date'
        ];
        return $columns;
    }

    private function regularTaskReport_actions()
    {
        if (Auth::user()->role == 'user') {
            $actions = (object) array(
                'edit' => 'Modifier',
                'delete' => "Supprimer",
            );
        } else {
            $actions = (object) array();
        }
        return $actions;
    }

    private function regularTaskReport_fields()
    {
        if (request()->routeIs('regular_task_report.create')) {
            $fields = [
                'report_date' => [
                    'title' => 'Date',
                    'field' => 'date',
                ],
                'tasks' => [
                    'title' => 'Sélectionner tâches',
                    'field' => 'multiple-select',
                    'options' => Auth::user()->regularTasks,
                ],
                'report' => [
                    'title' => 'Rapport',
                    'field' => 'textarea',
                ],
            ];
        } else {
            $fields = [
                'report_date' => [
                    'title' => 'Date',
                    'field' => 'date',
                ],
                'report' => [
                    'title' => 'Rapport',
                    'field' => 'textarea',
                ],
            ];
        }

        return $fields;
    }
}
