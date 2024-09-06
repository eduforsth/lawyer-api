<?php

namespace App\Http\Controllers;

use App\Models\CaseType;
use Illuminate\Http\Request;

class CaseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $caseTypes = CaseType::get();
       return response()->json([
           'status' => true,
           'data' => $caseTypes
       ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CaseType  $caseType
     * @return \Illuminate\Http\Response
     */
    public function show(CaseType $caseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CaseType  $caseType
     * @return \Illuminate\Http\Response
     */
    public function edit(CaseType $caseType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaseType  $caseType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CaseType $caseType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CaseType  $caseType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaseType $caseType)
    {
        //
    }
}
