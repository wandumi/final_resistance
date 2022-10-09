<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\PresentationSection;
use Illuminate\Http\Request;

class PresentationSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = PresentationSection::latest()->get();

        return view("presentations.sections.index", compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('presentations.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:presentation_sections,name',
        ]);

        PresentationSection::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PresentationSection  $presentationSection
     * @return \Illuminate\Http\Response
     */
    public function show(PresentationSection $presentationSection)
    {
        return $presentationSection;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PresentationSection  $presentationSection
     * @return \Illuminate\Http\Response
     */
    public function edit(PresentationSection $presentationSection)
    {
        return view('presentations.sections.edit', compact('presentationSection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PresentationSection  $presentationSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PresentationSection $presentationSection)
    {
        $request->validate([
            'name' => 'required|min:3|unique:presentation_sections,name,'.$presentationSection->id,
            'slug' => 'unique:presentation_sections,slug,'.$presentationSection->id,
        ]);

        $presentationSection->update([
            'name'   => $request->name,
            'slug'   => $request->slug ? Str::slug($request->slug, '-') : $request->name,
        ]);
        
        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PresentationSection  $presentationSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(PresentationSection $presentationSection)
    {
        $presentationSection->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
