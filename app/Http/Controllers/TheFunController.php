<?php

namespace App\Http\Controllers;

use App\TheFun;
use App\Property;
use Illuminate\Http\Request;

class TheFunController extends Controller
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
     * @param  \App\TheFun  $theFun
     * @return \Illuminate\Http\Response
     */
    public function show(TheFun $theFun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TheFun  $theFun
     * @return \Illuminate\Http\Response
     */
    public function edit(TheFun $theFun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TheFun  $theFun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TheFun $theFun)
    {
        $propertyId = $request->property_id;

        $property   = Property::findOrFail($propertyId);

        $theFuns    = $request->input('Fun');

         // Notice that you should use `json()` since the data is in json format
        $clearDatas = TheFun::where('property_id', $request->property_id)->get();
        foreach ($clearDatas as $data)
        {
            $data->delete();
        }

        foreach ($theFuns as $thefun) {

            $following = new TheFun;
            $following->logo_id = $thefun;
            $following->property_id = $propertyId;
            $following->save();
        }


        return response()->json(['message' => 'Successfully Submitted']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TheFun  $theFun
     * @return \Illuminate\Http\Response
     */
    public function destroy(TheFun $theFun)
    {
        //
    }
}
