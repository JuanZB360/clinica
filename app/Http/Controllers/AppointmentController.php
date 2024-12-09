<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\AppointmentFacade;
use App\Facades\ErrorFacade;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ErrorFacade::handleError(function () {return AppointmentFacade::index();});
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return ErrorFacade::handleError(function () {return AppointmentFacade::create();});
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        return ErrorFacade::handleError(function () use ($request) {return AppointmentFacade::store($request);});
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ErrorFacade::handleError(function () use ($id) {return AppointmentFacade::show($id);});
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return ErrorFacade::handleError(function () use ($id) {return AppointmentFacade::edit($id);});
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, string $id)
    {
        return ErrorFacade::handleError(function () use ($request, $id) {return AppointmentFacade::update($request, $id);});
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ErrorFacade::handleError(function () use ($id) {return AppointmentFacade::destroy($id);});
    }
}
