<?php

namespace App\Http\Controllers;

use App\Dmtn;
use App\DmtnSection;
use Illuminate\Http\Request;
use App\Http\Requests\DmtnRequest;
use Illuminate\Support\Facades\File;

class DmtnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dmtns = Dmtn::paginate(10);

        $dmtnLists = DmtnSection::all();

        return view('dmtn.index', compact('dmtns', 'dmtnLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dmtnLists = DmtnSection::orderBy('name','asc')->get();

        return view('dmtn.create', compact('dmtnLists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DmtnRequest $request)
    {
        if($request->hasFile('pdf'))
        {
            $pdf = $request->pdf;
            $pdfName = time() . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdf_files/'), $pdfName);

        }

        Dmtn::create([
            'dmtn_section_id' => $request->dmtn_section_id,
            'name' => $request->name,
            'pdf' =>  $pdfName
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dmtn  $dmtn
     * @return \Illuminate\Http\Response
     */
    public function show(Dmtn $dmtn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dmtn  $dmtn
     * @return \Illuminate\Http\Response
     */
    public function edit(Dmtn $dmtn)
    {
        $dmtnLists = DmtnSection::orderBy('name','asc')->get();

        return view('dmtn.edit', compact('dmtn', 'dmtnLists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dmtn  $dmtn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dmtn $dmtn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dmtn  $dmtn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dmtn $dmtn)
    {
        $pdf = public_path("pdf_files\\") . $dmtn->pdf;
        
        if(File::exists($pdf)) {
            File::delete($pdf);
        } 

        $dmtn->delete();
        
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
