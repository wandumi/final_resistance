<?php

namespace App\Http\Controllers;

use App\PortifolioBanner;
use Illuminate\Http\Request;

class PortifolioBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portifolioBanners = PortifolioBanner::orderBy('created_at','ASC')->get();

        return view('portifolio.banners.index',compact('portifolioBanners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portifolio.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PortifolioBanner::create([
            'total_GLA'         => $request->total_GLA,
            'total_vacancy'     => $request->total_vacancy,
            'total_valuation'   => $request->total_valuation,
            'total_weighted'    => $request->total_weighted,
        ]);

        return back()->with('message','Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PortifolioBanner  $portifolioBanner
     * @return \Illuminate\Http\Response
     */
    public function show(PortifolioBanner $portifolioBanner)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PortifolioBanner  $portifolioBanner
     * @return \Illuminate\Http\Response
     */
    public function edit(PortifolioBanner $portifolioBanner)
    {
        //$portifolioBanner = PortifolioBanner::findOrFail($id);

        return view('portifolio.banners.edit', compact('portifolioBanner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PortifolioBanner  $portifolioBanner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PortifolioBanner $portifolioBanner)
    {
        $portifolioBanner->update([
            'total_GLA'         => $request->total_GLA,
            'total_vacancy'     => $request->total_vacancy,
            'total_valuation'   => $request->total_valuation,
            'total_weighted'    => $request->total_weighted,
        ]);

        return back()->with('message', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PortifolioBanner  $portifolioBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(PortifolioBanner $portifolioBanner)
    {
        $portifolioBanner->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
