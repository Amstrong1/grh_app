<?php

namespace App\Http\Controllers;

use App\Models\DepartmentUser;
use App\Http\Requests\StoreDepartmentUserRequest;
use App\Http\Requests\UpdateDepartmentUserRequest;

class DepartmentAdminController extends Controller
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
    public function store(StoreDepartmentUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DepartmentUser $departmentUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DepartmentUser $departmentUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentUserRequest $request, DepartmentUser $departmentUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepartmentUser $departmentUser)
    {
        //
    }
}
