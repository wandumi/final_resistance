<?php

namespace App\Http\Controllers;

use App\DmtnProgDocuments;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProgDocumentRequest;
use App\Http\Requests\UpdateProgDocumentRequest;

class DmtnProgDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $progDocuments = DmtnProgDocuments::orderBy('date_of_document', 'DESC')->get();

        return view('dmtn.programDocuments.index', compact('progDocuments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dmtn.programDocuments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgDocumentRequest $request)
    {
        if($request->hasFile('pdf'))
        {
            $pdf = $request->pdf;
            $fileName = time() . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdf_files/'), $fileName);
        }
        DmtnProgDocuments::create([
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
     * @param  \App\DmtnProgDocuments  $dmtnProgDocuments
     * @return \Illuminate\Http\Response
     */
    public function show(DmtnProgDocuments $dmtnProgDocuments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DmtnProgDocuments  $dmtnProgDocuments
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dmtnProgDocuments = DmtnProgDocuments::where('id', $id)->first();

        return view('dmtn.programDocuments.edit', compact('dmtnProgDocuments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DmtnProgDocuments  $dmtnProgDocuments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|min:3|unique:dmtn_prog_documents,name,'.$id,
            'slug'  => 'unique:dmtn_prog_documents,slug,'.$id,
            'pdf'   => 'nullable|mimes:pdf'
        ]);

        $programDocument = DmtnProgDocuments::where('id',$id)->first();

        if($request->hasFile('pdf'))
        {
            if($programDocument->pdf != null){
                
                $savedPdf = 'pdf_files/'.$programDocument->pdf;

                if(File::exists($savedPdf)) {
                    File::delete($savedPdf);
                }

                $pdf             = $request->pdf;
                $pdfName         = time() . $pdf->getClientOriginalName();
                $pdf->move(public_path('pdf_files/'), $pdfName);
            }

            $programDocument->update([
                'pdf'            => $pdfName,
            ]);
        }

        $programDocument->update([
            'name'              => $request->name,
            'slug'              => $request->slug ? Str::slug($request->slug, '-') : $request->name,
            'date_of_document'  => $request->date_of_document,
        ]);

        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DmtnProgDocuments  $dmtnProgDocuments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $progDocuments = DmtnProgDocuments::where('id', $id)->first();

        $pdf         = public_path("pdf_files\\") . $progDocuments->pdf;

        if(File::exists($pdf)) {
            File::delete($pdf);
        }

        $progDocuments->delete();

        return response()->json(['message' => 'Successfully Deleted']);
    }

    public function sortable(DmtnProgDocuments $DmtnProgDocuments)
    {
        $DmtnProgDocuments = DmtnProgDocuments::orderBy('list', 'asc')->get();

        return view('dmtn.programDocuments.sortable', compact('DmtnProgDocuments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {

        $DmtnProgDocumentsData = DmtnProgDocuments::all();

        foreach($DmtnProgDocumentsData as $DmtnProgDocuments){
            $DmtnProgDocuments->timestamps = false;

            $id = $DmtnProgDocuments->id;
            foreach($request->programdata as $DmtnProgDocumentsLoop){
                if($DmtnProgDocumentsLoop['id'] == $id){
                    $DmtnProgDocuments->update(['list' => $DmtnProgDocumentsLoop['list']]);
                }
            }
        }


        return response('Update Successful', 200);
    }

}
