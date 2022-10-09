<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DmtnPriceSupplements;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProgDocumentRequest;
use App\Http\Requests\PriceSupplementRequest;

class DmtnPriceSupplementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priceSupplements = DmtnPriceSupplements::orderBy('date_of_document', 'DESC')->get();

        return view('dmtn.priceSupplements.index', compact('priceSupplements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dmtn.priceSupplements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PriceSupplementRequest $request)
    {
        if($request->hasFile('pdf'))
        {
            $pdf = $request->pdf;
            $fileName = time() . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdf_files/'), $fileName);
        }

        DmtnPriceSupplements::create([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name, '-'),
            'date_of_document'  => $request->date_of_document,
            'pdf'               => $fileName,
        ]);

        return back()->with('message','Submitted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DmtnPriceSupplements  $dmtnPriceSupplements
     * @return \Illuminate\Http\Response
     */
    public function show(DmtnPriceSupplements $dmtnPriceSupplements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DmtnPriceSupplements  $dmtnPriceSupplements
     * @return \Illuminate\Http\Response
     */
    public function edit(DmtnPriceSupplements $dmtnPriceSupplements, $id)
    {
        $priceSupplements = DmtnPriceSupplements::where('id', $id)->first();

        return view('dmtn.priceSupplements.edit', compact('priceSupplements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DmtnPriceSupplements  $dmtnPriceSupplements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|unique:dmtn_price_supplements,name,'.$id,
            'slug' => 'required|unique:dmtn_price_supplements,slug,'.$id,
            'pdf'  => 'nullable|mimes:pdf'
        ]);
       
        $price_supplement = DmtnPriceSupplements::where('id',$id)->first();

        
        if($request->hasFile('pdf'))
        {
            if($price_supplement->pdf != null){
                
                $savedPdf = 'pdf_files/'.$price_supplement->pdf;

                if(File::exists($savedPdf)) {
                    File::delete($savedPdf);
                }

                $pdf             = $request->pdf;
                $pdfName         = time() . $pdf->getClientOriginalName();
                $pdf->move(public_path('pdf_files/'), $pdfName);
            }

            $price_supplement->update([
                'pdf'            => $pdfName,
            ]);
        }

        $price_supplement->update([
            'name'              => $request->name,
            'slug'              => $request->slug ? Str::slug($request->slug, '-') : $request->name,
            'date_of_document'  => $request->date_of_document,
        ]);

        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DmtnPriceSupplements  $dmtnPriceSupplements
     * @return \Illuminate\Http\Response
     */
    public function destroy(DmtnPriceSupplements $dmtnPriceSupplements, $id)
    {
        $priceSupplements = DmtnPriceSupplements::where('id', $id)->first();

        $pdf         = public_path("pdf_files\\") . $priceSupplements->pdf;

        if(File::exists($pdf)) {
            File::delete($pdf);
        }

        $priceSupplements->delete();

        return response()->json(['message' => 'Successfully Deleted']);
    }

    public function sortable(DmtnPriceSupplements $DmtnPriceSupplements)
    {
        $DmtnPriceSupplements = DmtnPriceSupplements::orderBy('list', 'asc')->get();

        return view('dmtn.priceSupplements.sortable', compact('DmtnPriceSupplements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {

        $DmtnPriceSupplementsData = DmtnPriceSupplements::all();

        foreach($DmtnPriceSupplementsData as $DmtnPriceSupplements){
            $DmtnPriceSupplements->timestamps = false;

            $id = $DmtnPriceSupplements->id;
            foreach($request->pricedata as $DmtnPriceSupplementsLoop){
                if($DmtnPriceSupplementsLoop['id'] == $id){
                    $DmtnPriceSupplements->update(['list' => $DmtnPriceSupplementsLoop['list']]);
                }
            }
        }


        return response('Update Successful', 200);
    }

}
