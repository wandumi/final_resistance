<?php

namespace App\Http\Controllers;

use App\DmtnCreditRating;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CreditRatingRequest;
use App\Http\Requests\UpdateCreditRequest;

class DmtnCreditRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creditRatings = DmtnCreditRating::orderBy('date_of_document', 'DESC')->get();

        return view('dmtn.creditRating.index', compact('creditRatings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dmtn.creditRating.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreditRatingRequest $request)
    {
        if($request->hasFile('pdf'))
        {
            $pdf = $request->pdf;
            $fileName = time() . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdf_files/'), $fileName);
        }

        DmtnCreditRating::create([
            'name'             => $request->name,
            'slug'             => Str::slug($request->name, '-'),
            'date_of_document' => $request->date_of_document,
            'pdf'              => $fileName,
        ]);

        return back()->with('message','Submitted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DmtnCreditRating  $dmtnCreditRating
     * @return \Illuminate\Http\Response
     */
    public function show(DmtnCreditRating $dmtnCreditRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DmtnCreditRating  $dmtnCreditRating
     * @return \Illuminate\Http\Response
     */
    public function edit(DmtnCreditRating $dmtnCreditRating, $id)
    {
        $creditRating = DmtnCreditRating::where('id', $id)->first();

        return view('dmtn.creditRating.edit', compact('creditRating'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DmtnCreditRating  $dmtnCreditRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|unique:dmtn_credit_ratings,name,'.$id,
            'slug' => 'required|unique:dmtn_credit_ratings,slug,'.$id,
            'pdf'  => 'nullable|mimes:pdf'
        ]);

        $credit = DmtnCreditRating::where('id',$id)->first();

        
        if($request->hasFile('pdf'))
        {
            if($credit->pdf != null){
                
                $savedupload = 'pdf_files/'.$credit->pdf;

                if(File::exists($savedupload)) {
                    File::delete($savedupload);
                }

                
                $upload            = $request->pdf;
                $pdfUpload         = time() . $upload->getClientOriginalName();
                $upload->move(public_path('pdf_files/'), $pdfUpload);
            }

            $credit->update([
                'pdf'            => $pdfUpload
            ]);
        }

        $credit->update([
            'name'              => $request->name,
            'slug'              => $request->slug ? Str::slug($request->slug, '-') : $request->name,
            'date_of_document'  => $request->date_of_document,
        ]);

        return back()->with('message','Submitted Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DmtnCreditRating  $dmtnCreditRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(DmtnCreditRating $dmtnCreditRating, $id)
    {
        $creditRating = DmtnCreditRating::where('id', $id)->first();

        $pdf         = public_path("pdf_files\\") . $creditRating->pdf;

        if(File::exists($pdf)) {
            File::delete($pdf);
        }

        $creditRating->delete();

        return response()->json(['message' => 'Successfully Deleted']);
    }

    public function sortable(DmtnCreditRating $DmtnCreditRating)
    {
        $DmtnCreditRatings = DmtnCreditRating::orderBy('list', 'asc')->get();

        return view('dmtn.creditRating.sortable', compact('DmtnCreditRatings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {

        $DmtnCreditRatingData = DmtnCreditRating::all();

        foreach($DmtnCreditRatingData as $DmtnCreditRating){
            $DmtnCreditRating->timestamps = false;

            $id = $DmtnCreditRating->id;
            foreach($request->creditdata as $DmtnCreditRatingLoop){
                if($DmtnCreditRatingLoop['id'] == $id){
                    $DmtnCreditRating->update(['list' => $DmtnCreditRatingLoop['list']]);
                }
            }
        }

        return response('Update Successful', 200);
    }
}
