<?php

namespace App\Http\Controllers;

use App\Property;
use App\MajorTenant;
use Illuminate\Http\Request;

class MajorTenantController extends Controller
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
     * @param  \App\MajorTenant  $majorTenant
     * @return \Illuminate\Http\Response
     */
    public function show(MajorTenant $majorTenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MajorTenant  $majorTenant
     * @return \Illuminate\Http\Response
     */
    public function edit(MajorTenant $majorTenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MajorTenant  $majorTenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MajorTenant $majorTenant)
    {

        $propertyId = $request->property_id;

        $property   = Property::findOrFail($propertyId);
        $clearDatas = MajorTenant::where('property_id', $request->property_id)->get();
        foreach ($clearDatas as $data)
        {
            $data->delete();
        }

        $majors    = $request->input('major');

        foreach ($majors as $major) {

            $majorTenant = new MajorTenant;
            $majorTenant->logo_id = $major;
            $majorTenant->property_id = $propertyId;
            $majorTenant->save();
        }


        return response()->json(['message' => 'Successfully Submitted']);
        // $propertyId = $request->property_id;

        // $property = Property::findOrFail($propertyId);

        // $anchors    = $request->input('major');
        // $tenants    = $request->tenant;

        //create the tenant name array
        // $tenantNames = [];
        // for ($x = 0; $x < count($anchors); $x++) {
        //     array_push($tenantNames,"major");
        // }

        /*
        *loop through the names and create key
        *make the array similar anchors
        *ready to be combined
        */
        // $extra = array_map(function($tenantId){
        //     return ['tenants' => $tenantId];
        // }, $tenantNames);


        /**combine the arrays for sync */
        // $data = array_combine($anchors, $extra);

        /**sync the data provided */
        // $property->logos()->sync($data); // [1 => ['expires' => true], 2, 3];

        // return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MajorTenant  $majorTenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(MajorTenant $majorTenant)
    {
        //
    }
}
