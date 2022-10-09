<?php

namespace App\Http\Controllers;

use App\FinancialSection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FinancialSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financialLists = FinancialSection::latest()->get();

        return view("financials.sections.index", compact('financialLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("financials.sections.create");
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
            'name' => 'required|unique:financial_sections,name',
        ]);
       
        FinancialSection::create([
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-'),
        ]);

        return back()->with('message','Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinancialSection  $financialSection
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialSection $financialSection)
    {
        return $financialSection;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FinancialSection  $financialSection
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialSection $financialSection)
    {
        return view('financials.sections.edit', compact('financialSection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FinancialSection  $financialSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinancialSection $financialSection)
    {
        
        $request->validate([
            'name' => 'required|unique:financial_sections,name,'.$financialSection->id,
            'slug' => 'unique:financial_sections,slug,'. $financialSection->id,
        ]);

        $financialSection->update([
            'name'   => $request->name,
            'slug'   => $request->slug ? Str::slug($request->slug, '-') : $request->name,
        ]);
        
        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinancialSection  $financialSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialSection $financialSection)
    {
        $financialSection->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
