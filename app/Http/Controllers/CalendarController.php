<?php

namespace App\Http\Controllers;

use App\Calendar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $calendars = Calendar::latest()->get();

        // $events = array();

        // foreach($calendars as $calendar){
        //     $events[] = [
        //         'id'    => $calendar->id,
        //         'title' => $calendar->name,
        //         'start' => $calendar->start,
        //         'end'   => $calendar->end,
        //     ];
        // }

        // return view('calendar.index', ['events' => $events], compact('calendars'));
        return view('calendar.index', compact('calendars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'start' => 'required',
            'end'   => 'required',
        ]);
        
        $calendar = Calendar::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name, '-'),
            'start' => $request->start,
            'end'   => $request->end,
        ]);

        // return response()->json($calendar);
        return back()->with("message","Successfully Submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        return view('calendar.edit', compact('calendar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar $calendar)
    {

        $request->validate([
            'name' => 'min:3|unique:ciculars,name,'. $calendar,
            'slug' => 'unique:ciculars,slug,'.$calendar,
            'start' => 'required',
            'end'   => 'required',
        ]);

        $calendar->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name, '-'),
            'start' => $request->start,
            'end'   => $request->end,
        ]);

        //return response()->json(['message' => 'Successfully updated']);
        return back()->with("message","Successfully Submitted");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        $calendar->delete();

        return $calendar;
        
    }

 
}
