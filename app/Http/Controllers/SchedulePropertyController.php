<?php

namespace App\Http\Controllers;

use App\ScheduleProperty;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;

class SchedulePropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = ScheduleProperty::orderBy('created_at', 'desc')->get();

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        
        ScheduleProperty::create([
            "name"              => $request->name,
            'slug'              => Str::slug($request->name, '-'),
            "property_use"      => $request->property_use,
            "vacancy"           => $request->vacancy,
            "gla"               => $request->gla,
            "parking"           => $request->parking,
            "address"           => $request->address,
            "pro_rata_interest" => $request->pro_rata_interest,
            "valuation"         => $request->valuation,
            "date_of_accusion"  => $request->date_of_accusion,
            "country"           => $request->country,
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ScheduleProperty  $scheduleProperty
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleProperty $scheduleProperty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ScheduleProperty  $scheduleProperty
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleProperty $scheduleProperty, $id)
    {
        $scheduleProperty = ScheduleProperty::findOrFail($id);

     

        return view('schedules.edit', compact('scheduleProperty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScheduleProperty  $scheduleProperty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name"  => "required|unique:schedule_properties,name,".$id,
            "slug"  => "unique:schedule_properties,slug,".$id
        ]);

        $scheduleProperty = ScheduleProperty::findOrFail($id);

       
        
        $scheduleProperty->update([
            "name"              => $request->name,
            'slug'              => $request->slug ? Str::slug($request->slug, '-') : $request->name,
            "property_use"      => $request->property_use,
            "vacancy"           => $request->vacancy,
            "gla"               => $request->gla,
            "parking"           => $request->parking,
            "address"           => $request->address,
            "pro_rata_interest" => $request->pro_rata_interest,
            "valuation"         => $request->valuation,
            "date_of_accusion"  => $request->date_of_accusion,
            "country"           => $request->country,
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScheduleProperty  $scheduleProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleProperty $scheduleProperty, $id)
    {
        $scheduleProperty = ScheduleProperty::findOrFail($id);

        $scheduleProperty->delete();

        return response()->json(['message', 'Successfully Deleted']);
    }

    public function sortable(ScheduleProperty $scheduleProperty)
    {
        $schedules = ScheduleProperty::orderBy('list', 'asc')->get();

        return view('schedules.sortable', compact('schedules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {

        $scheduleData = ScheduleProperty::all();

        foreach($scheduleData as $schedules){
            $schedules->timestamps = false;

            $id = $schedules->id;
            foreach($request->scheduledata as $schedulesLoop){
                if($schedulesLoop['id'] == $id){
                    $schedules->update(['list' => $schedulesLoop['list']]);
                }
            }
        }


        return response('Update Successful', 200);
    }
}
