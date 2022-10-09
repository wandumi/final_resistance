<?php

namespace App\Http\Controllers;

use App\DmtnSection;
use Illuminate\Http\Request;

class DmtnSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dmtnLists = DmtnSection::orderBy('date_of_document', 'DESC')->get();

        return view('dmtn.section.index', compact('dmtnLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dmtn.section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DmtnSectionRequest $request)
    {
        DmtnSection::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DmtnSection  $dmtnSection
     * @return \Illuminate\Http\Response
     */
    public function show(DmtnSection $dmtnSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DmtnSection  $dmtnSection
     * @return \Illuminate\Http\Response
     */
    public function edit(DmtnSection $dmtnSection)
    {
        return view('dmtn.section.edit', compact('dmtnSection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DmtnSection  $dmtnSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DmtnSection $dmtnSection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DmtnSection  $dmtnSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(DmtnSection $dmtnSection)
    {
        $dmtnSection->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
