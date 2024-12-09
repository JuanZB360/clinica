<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Facades\ErrorFacade;
use App\Facades\UserFacade;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ErrorFacade::handleError(function () {return UserFacade::index();});
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return ErrorFacade::handleError(function () {return UserFacade::create();});
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        return ErrorFacade::handleError(function () use ($request) {return UserFacade::store($request);});
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ErrorFacade::handleError(function () use ($id) {return UserFacade::show($id);});
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return ErrorFacade::handleError(function () use ($id) {return UserFacade::edit($id);});
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        return ErrorFacade::handleError(function () use ($request, $id) {return UserFacade::update($request, $id);});
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ErrorFacade::handleError(function () use ($id) {return UserFacade::destroy($id);});
    }
}
