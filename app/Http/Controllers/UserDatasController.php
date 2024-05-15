<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser_datasRequest;
use App\Http\Requests\UpdateUser_datasRequest;
use App\Models\User_datas;

class UserDatasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $user_datas = new User_datas();
        return view('admin.user_datas.index', compact('user_datas'));
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
    public function store(StoreUser_datasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User_datas $user_datas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User_datas $user_datas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser_datasRequest $request, User_datas $user_datas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User_datas $user_datas)
    {
        //
    }
}
