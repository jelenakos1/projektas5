<?php

namespace App\Http\Controllers;

use App\Models\paginationSetting;
use App\Http\Requests\StorepaginationSettingRequest;
use App\Http\Requests\UpdatepaginationSettingRequest;

class PaginationSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepaginationSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepaginationSettingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\paginationSetting  $paginationSetting
     * @return \Illuminate\Http\Response
     */
    public function show(paginationSetting $paginationSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\paginationSetting  $paginationSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(paginationSetting $paginationSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepaginationSettingRequest  $request
     * @param  \App\Models\paginationSetting  $paginationSetting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepaginationSettingRequest $request, paginationSetting $paginationSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\paginationSetting  $paginationSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(paginationSetting $paginationSetting)
    {
        //
    }
}
