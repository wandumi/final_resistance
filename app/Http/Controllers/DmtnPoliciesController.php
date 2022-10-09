<?php

namespace App\Http\Controllers;

use App\DmtnPolicies;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DmtnPoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policies = DmtnPolicies::orderBy('date_of_document', 'DESC')->get();

        return view('dmtn.policies.index', compact('policies') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dmtn.policies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->hasFile('pdf'))
        {
            $pdf = $request->pdf;
            $fileName = time() . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdf_files/'), $fileName);
        }

        DmtnPolicies::create([
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
     * @param  \App\DmtnPolicies  $dmtnPolicies
     * @return \Illuminate\Http\Response
     */
    public function show(DmtnPolicies $dmtnPolicies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DmtnPolicies  $dmtnPolicies
     * @return \Illuminate\Http\Response
     */
    public function edit(DmtnPolicies $dmtnPolicies, $id)
    {
        $dmtnPolicies = DmtnPolicies::where('id', $id)->first();


        return view('dmtn.policies.edit', compact('dmtnPolicies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DmtnPolicies  $dmtnPolicies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DmtnPolicies $dmtnPolicies, $id)
    {
        $request->validate([
            'name' => 'required|min:3|unique:dmtn_policies,name,'.$id,
            'slug' => 'required|unique:dmtn_policies,slug,'.$id,
            'pdf'  => 'nullable|mimes:pdf'
        ]);

        $policies = DmtnPolicies::where('id',$id)->first();


        if($request->hasFile('pdf'))
        {
            if($policies->pdf != null){
                
                $savedPdf = 'pdf_files/'.$policies->pdf;

                if(File::exists($savedPdf)) {
                    File::delete($savedPdf);
                }

                $pdf             = $request->pdf;
                $pdfName         = time() . $pdf->getClientOriginalName();
                $pdf->move(public_path('pdf_files/'), $pdfName);
            }

            $policies->update([
                'pdf'            => $pdfName,
            ]);
        }

        $policies->update([
            'name'              => $request->name,
            'slug'              => $request->slug ? Str::slug($request->slug, '-') : $request->name,
            'date_of_document'  => $request->date_of_document,
        ]);

        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DmtnPolicies  $dmtnPolicies
     * @return \Illuminate\Http\Response
     */
    public function destroy(DmtnPolicies $dmtnPolicies, $id)
    {
        $policies = DmtnPolicies::where('id', $id)->first();

        $pdf         = public_path("pdf_files\\") . $policies->pdf;

        if(File::exists($pdf)) {
            File::delete($pdf);
        }

        $policies->delete();

        return response()->json(['message' => 'Successfully Deleted']);
    }

    public function sortable(DmtnPolicies $DmtnPolicies)
    {
        $DmtnPolicies = DmtnPolicies::orderBy('list', 'asc')->get();

        return view('dmtn.policies.sortable', compact('DmtnPolicies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {


        $DmtnPoliciesData = DmtnPolicies::all();

        foreach($DmtnPoliciesData as $DmtnPolicies){
            $DmtnPolicies->timestamps = false;

            $id = $DmtnPolicies->id;
            foreach($request->policydata as $DmtnPoliciesLoop){
                if($DmtnPoliciesLoop['id'] == $id){
                    $DmtnPolicies->update(['list' => $DmtnPoliciesLoop['list']]);
                }
            }
        }


        return response('Update Successful', 200);
    }
}
