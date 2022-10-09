<?php

namespace App\Http\Controllers;

use App\Bbbee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BbbeeRequest;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdateBbbeeRequest;

class BbbeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bbbees = Bbbee::all();

        return view('bbbee.index', compact('bbbees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bbbee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BbbeeRequest $request)
    {
        if($request->hasFile('pdf')){
         
            $pdfFile    = $request->pdf;
            $fileName   = time() . $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('pdf_files/'), $fileName );
        }

        Bbbee::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'pdf' => $fileName,
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bbbee  $bbbee
     * @return \Illuminate\Http\Response
     */
    public function show(Bbbee $bbbee)
    {
        return $bbbee;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bbbee  $bbbee
     * @return \Illuminate\Http\Response
     */
    public function edit(Bbbee $bbbee)
    {
        return view('bbbee.edit', compact('bbbee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bbbee  $bbbee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBbbeeRequest $request, Bbbee $bbbee)
    {
    
        if($request->hasFile('pdf'))
        {
            if($bbbee->pdf != null){
                
                $savedPdf = 'pdf_files/'.$bbbee->pdf;

                if(File::exists($savedPdf)) {
                    File::delete($savedPdf);
                }

                $pdf             = $request->pdf;
                $pdfName         = time() . $pdf->getClientOriginalName();
                $pdf->move(public_path('pdf_files/'), $pdfName);
            }

            $bbbee->update([
                'pdf'            => $pdfName,

            ]);
        }

        $bbbee->update([
            'name'   => $request->name,
            'slug'   => $request->slug ? Str::slug($request->slug, '-') : $request->name,
        ]);

        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bbbee  $bbbee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bbbee $bbbee)
    {
      
        $pdf  = public_path("pdf_files/") .$bbbee->pdf;

        if(File::exists($pdf)) {
            File::delete($pdf);
        } 

        $bbbee->delete();
  
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function sortable(Bbbee $bbbee)
    {
        $bbbees = Bbbee::orderBy('list', 'asc')->get();

        return view('bbbee.sortable', compact('bbbees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {

        $bbbeeData = Bbbee::all();

        foreach($bbbeeData as $bbbee){
            $bbbee->timestamps = false;

            $id = $bbbee->id;
            foreach($request->bbbeedata as $bbbeeLoop){
                if($bbbeeLoop['id'] == $id){
                    $bbbee->update(['list' => $bbbeeLoop['list']]);
                }
            }
        }


        return response('Update Successful', 200);
    }

}
