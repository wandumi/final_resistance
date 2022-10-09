<?php

namespace App\Http\Controllers;

use App\Property;
use App\AnchorTenant;
use Illuminate\Http\Request;

class AnchorTenantController extends Controller
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AnchorTenant  $anchorTenant
     * @return \Illuminate\Http\Response
     */
    public function show(AnchorTenant $anchorTenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AnchorTenant  $anchorTenant
     * @return \Illuminate\Http\Response
     */
    public function edit(AnchorTenant $anchorTenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnchorTenant  $anchorTenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnchorTenant $anchorTenant, $id)
    {
        $propertyId = $request->property_id;

        $property   = Property::findOrFail($propertyId);

        $anchors    = $request->input('anchor');


        // Notice that you should use `json()` since the data is in json format

        $clearDatas = AnchorTenant::where('property_id', $request->property_id)->get();
        foreach ($clearDatas as $data)
        {
            $data->delete();
        }


        foreach ($anchors as $anchor) {

            $anchorTenant = new AnchorTenant;
            $anchorTenant->logo_id = $anchor;
            $anchorTenant->property_id = $propertyId;
            $anchorTenant->save();
        }


        return response()->json(['message' => 'Successfully Submitted']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnchorTenant  $anchorTenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnchorTenant $anchorTenant)
    {
        //
    }
}
