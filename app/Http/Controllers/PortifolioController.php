<?php

namespace App\Http\Controllers;

use App\Portifolio;
use App\PortifolioList;
use Illuminate\Http\Request;
use App\Http\Requests\PortifolioRequest;

class PortifolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portifolios = Portifolio::latest()->get();

        $portifolioLists = PortifolioList::all();

        return view('portifolio.index', compact('portifolios', 'portifolioLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $portifolioLists = PortifolioList::all();

        return view('portifolio.create', compact('portifolioLists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortifolioRequest $request)
    {
       

        if($request->hasFile('cover_image'))
        {
            $cover = $request->cover_image;
            $fileName = time().$cover->getClientOriginalName();
            $cover->move(public_path('cover_images'), $fileName);
        }
        
        Portifolio::create([
            'portifolio_lists_id'   => $request->lists,
            'numberOfShared'        => $request->numberOfShares,
            'perOfIssueShares'      => $request->perIssueShared,
            'cover_image'           => $fileName,
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Portifolio  $portifolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portifolio $portifolio)
    {
        return $portifolio;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portifolio  $portifolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portifolio $portifolio)
    {
        $portifolioLists = PortifolioList::all();

        return view('portifolio.edit', compact('portifolio', 'portifolioLists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portifolio  $portifolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portifolio $portifolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portifolio  $portifolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portifolio $portifolio)
    {
        $portifolio->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
