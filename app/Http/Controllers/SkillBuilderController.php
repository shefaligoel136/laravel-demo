<?php

namespace App\Http\Controllers;

use App\Models\Skillbuilder;
use Illuminate\Http\Request;

class SkillBuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Skillbuilder::with(['creators','reviewers'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        if($request->user()->tokenCan('create-skillbuilder'))
        {return Skillbuilder::create([            
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'points' => $request->input('points'),
        'isPublished' => $request->input('isPublished'),
        'awards' => $request->input('awards'),
        'effortTime' => $request->input('effortTime'),
        'reviewerId' => $request->user()->id,
        'creatorId' =>  $request->user()->id,
    ]);}else{
        abort(401);
    }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
