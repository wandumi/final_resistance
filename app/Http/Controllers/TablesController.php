<?php

namespace App\Http\Controllers;

use App\Tables;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Tables::latest()->get();

        return view('relations.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('relations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tables::create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name, '-'),
            'description'   => $request->description,
            'tables'        => $request->tables 
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tables  $tables
     * @return \Illuminate\Http\Response
     */
    public function show(Tables $tables, $id)
    {
        $tables = Tables::findOrFail($id);

        return view('relations.show', compact('tables'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tables  $tables
     * @return \Illuminate\Http\Response
     */
    public function edit(Tables $tables, $id)
    {
        $tables = Tables::findOrFail($id);

        return view('relations.edit', compact('tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tables  $tables
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tables $tables, $id)
    {
        $tables = Tables::findOrFail($id);

        $tables->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'tables'        => $request->tables 
        ]);

        return back()->with('message','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tables  $tables
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tables $tables, $id)
    {
        $tables = Tables::findOrFail($id);

        $tables->delete();

        return back()->with(['message' => 'Successfully Deleted']);
    }
}
