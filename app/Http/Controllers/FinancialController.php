<?php

namespace App\Http\Controllers;

use App\Year;
use App\Financial;
use App\FinancialSection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\FinancialsRequest;
use App\Http\Requests\UpdateFinancialRequest;

class FinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financials     = Financial::orderBy('date_of_document', 'DESC')->get();

        $financialLists = FinancialSection::latest()->get();
        
        return view("financials.index", compact('financials', 'financialLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $financialLists = FinancialSection::all();

        $years = Year::orderBy('year','ASC')->get();

        return view("financials.create", compact('financialLists', 'years') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FinancialsRequest $request)
    {
     
        
        if($request->hasFile('pdf'))
        {
            $pdf        = $request->pdf;
            $pdfName    = time() . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdf_files/'), $pdfName);
        }

        $coverImage = "";

        if($request->hasFile('cover_image')){
            if($request->cover_image != null){
                $cover = $request->cover_image;
                $coverImage = time() .$cover->getClientOriginalName();
                $cover->move(public_path('cover_images/'), $coverImage);
            } else {
                $coverImage = "";
            }
        }

        // dd($coverImage);

        $financials = new Financial;
        $financials->financial_section_id      = $request->financial_section_id;
        $financials->name                      = $request->name;
        $financials->slug                      = Str::slug($request->name, '-');
        $financials->year                      = $request->year;
        $financials->date_of_document          = $request->date_of_document;
        $financials->pdf                       = $pdfName;
        $financials->cover_image               = $coverImage;
        $financials->save();

        return back()->with('message', 'Successfully Submitted');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function show(Financial $financial)
    {
        return $financial;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function edit(Financial $financial)
    {
       
        $financialLists = FinancialSection::all();

        $years = Year::orderBy('year','ASC')->get();
        
        $financial->load('financial_section');

        return view('financials.edit', compact('financial', 'financialLists','years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Financial $financial)
    {
        $request->validate([
            'financial_section_id'  => 'required',
            'name'                  => 'required|min:3|unique:financials,name,'.$financial->id,
            'slug'                  => 'unique:financials,slug,'.$financial->id,
            'pdf'                   => 'mimes:pdf',
            'cover_image'           => 'mimes:png,jpg,jpeg'
        ]);
       
        if($request->hasFile('pdf'))
        {
        
            if($financial->pdf != null){

                $savedPdf = 'pdf_files/'.$financial->pdf;

                if(File::exists($savedPdf)) {
                    File::delete($savedPdf);
                }

                $pdf             = $request->pdf;
                $pdfName         = time() . $pdf->getClientOriginalName();
                $pdf->move(public_path('pdf_files/'), $pdfName);
            }

            $financial->update([
                'pdf'         => $pdfName,
            ]);

            
        } 
        
        if($request->hasFile('cover_image'))
        {
            
            $savedCover = 'cover_images/'.$financial->cover_image;

            if(File::exists($savedCover)) {
                File::delete($savedCover);
            }

            $coverImage         = $request->cover_image;
            $coverName          = time() . $coverImage->getClientOriginalName();
            $coverImage->move(public_path('cover_images/'), $coverName);


            $financial->update([
                'cover_image'               => $coverName,
            ]);
            

        }

        $financial->update([
            'financial_section_id'   => $request->financial_section_id,
            'name'                   => $request->name,
            'slug'                   => $request->slug ? Str::slug($request->slug, '-') : $request->name,
            'year'                   => $request->year,
            'date_of_document'       => $request->date_of_document,
        ]);

        return back()->with("message","Successfully Updated");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Financial  $financial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Financial $financial)
    {
        $pdf         = public_path("pdf_files/") .$financial->pdf;
        $coverImage  = public_path("cover_images/") .$financial->cover_image;

        if(File::exists($pdf) && File::exists($coverImage)) {
            File::delete($pdf);
            File::delete($coverImage);
        }
        
        $financial->delete();

        return response()->json(['message' => 'Successfully Deleted']);
    }
}
