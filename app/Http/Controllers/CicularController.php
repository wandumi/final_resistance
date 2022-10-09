<?php

namespace App\Http\Controllers;

use App\Cicular;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CircularRequest;
use App\Http\Requests\UpdateCircularRequest;

class CicularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $circulars = Cicular::latest()->paginate();

        return view('circulars.index', compact('circulars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('circulars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CircularRequest $request)
    {

        if($request->hasFile('pdf'))
        {
            $pdf = $request->pdf;
            $fileName = time() . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdf_files/'), $fileName);
        }

        
        Cicular::create([
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
     * @param  \App\Cicular  $cicular
     * @return \Illuminate\Http\Response
     */
    public function show(Cicular $cicular)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cicular  $cicular
     * @return \Illuminate\Http\Response
     */
    public function edit(Cicular $cicular, $id)
    {
        $circulars = Cicular::where('id', $id)->first();

        return view('circulars.edit', compact('circulars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cicular  $cicular
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Cicular $cicular)
    {
        $request->validate([
            'name' => 'min:3|unique:ciculars,name,'. $id,
            'slug' => 'unique:ciculars,slug,'.$id,
            'pdf' => 'nullable|mimes:pdf'
        ]);

        $cicular = Cicular::where('id',$id)->first();

        if($request->hasFile('pdf'))
        {
            if($cicular->pdf != null){
                
                $savedPdf = 'pdf_files/'.$cicular->pdf;

                if(File::exists($savedPdf)) {
                    File::delete($savedPdf);
                }

                $pdf             = $request->pdf;
                $pdfName         = time() . $pdf->getClientOriginalName();
                $pdf->move(public_path('pdf_files/'), $pdfName);
            }

            $cicular->update([
                'pdf'            => $pdfName,
            ]);
        }

        $cicular->update([
            'name'              => $request->name,
            'slug'              => $request->slug ? Str::slug($request->slug) : $request->name,
            'date_of_document'  => $request->date_of_document,
        ]);

        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cicular  $cicular
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cicular $cicular, $id)
    {
        $circulars = Cicular::where('id', $id)->first();



        $pdf         = public_path("pdf_files\\") . $circulars->pdf;

        if(File::exists($pdf)) {
            File::delete($pdf);
        }

        $circulars->delete();

        return response()->json(['message' => 'Successfully Deleted']);
    }

    public function sortable(Cicular $Cicular)
    {
        $circulars= Cicular::orderBy('list', 'asc')->get();

        return view('circulars.sortable', compact('circulars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {

        $CicularData = Cicular::all();

        foreach($CicularData as $Cicular){
            $Cicular->timestamps = false;

            $id = $Cicular->id;
            foreach($request->circulardata as $CicularLoop){
                if($CicularLoop['id'] == $id){
                    $Cicular->update(['list' => $CicularLoop['list']]);
                }
            }
        }

        return response('Update Successful', 200);
    }
}
