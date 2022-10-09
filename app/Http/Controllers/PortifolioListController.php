<?php

namespace App\Http\Controllers;

use App\PortifolioList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PortifolioListRequest;

class PortifolioListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portifolioLists = PortifolioList::latest()->get();

        return view('portifolio.lists.index', compact('portifolioLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portifolio.lists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortifolioListRequest $request)
    {
        PortifolioList::create([
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-'),
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PortifolioList  $portifolioList
     * @return \Illuminate\Http\Response
     */
    public function show(PortifolioList $portifolioList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PortifolioList  $portifolioList
     * @return \Illuminate\Http\Response
     */
    public function edit(PortifolioList $portifolioList)
    {
        return view('portifolio.lists.edit', compact('portifolioList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PortifolioList  $portifolioList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PortifolioList $portifolioList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PortifolioList  $portifolioList
     * @return \Illuminate\Http\Response
     */
    public function destroy(PortifolioList $portifolioList)
    {
        $portifolioList->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
