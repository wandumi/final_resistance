<?php

namespace App\Http\Controllers;

use App\Shareholder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ShareholderRequest;

class ShareholderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shareholders = Shareholder::latest()->get();

        return view('shareholder.table.index', compact('shareholders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shareholder.table.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // if($request->hasFile('logo'))
        // {
        //     $fileName       = $request->logo;
        //     $logo           = time() . $fileName->getClientOriginalName();
        //     $fileName->move( public_path('logos/'), $logo);
        // }

        // Shareholder::create([
        //     'name'              => $request->name,
        //     'numberOfShares'    => $request->numberOfShares,
        //     'perIssueShared'    => $request->perIssueShared,
        //     // 'logo'              => $logo,
        // ]);

        Shareholder::create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name, '-'),
            'description'   => $request->description,
            'tables'        => $request->tables 
        ]);

        return back()->with("message", "Successfully Submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shareholder  $shareholder
     * @return \Illuminate\Http\Response
     */
    public function show(Shareholder $shareholder)
    {
        return view('shareholder.table.show', compact('shareholder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shareholder  $shareholder
     * @return \Illuminate\Http\Response
     */
    public function edit(Shareholder $shareholder)
    {
        return view('shareholder.table.edit', compact('shareholder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shareholder  $shareholder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shareholder $shareholder)
    {
        // if($request->hasFile('logo'))
        // {
        //     if($shareholder->logo != null){
                
        //         $savedPdf = 'logos/'.$shareholder->logo;

        //         if(File::exists($savedPdf)) {
        //             File::delete($savedPdf);
        //         }

        //         $fileName       = $request->logo;
        //         $logo           = time() . $fileName->getClientOriginalName();
        //         $fileName->move( public_path('logos/'), $logo);

        //         $shareholder->update([
        //             'logo'              => $logo,
        //         ]);
        //     }
        // }

        // $shareholder->update([
        //     'name'              => $request->name,
        //     'numberOfShares'    => $request->numberOfShares,
        //     'perIssueShared'    => $request->perIssueShared,
        // ]);

      

        $shareholder->update([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name, '-'),
            'description'   => $request->description,
            'tables'        => $request->tables 
        ]);

        return back()->with("message", "Successfully Submitted");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shareholder  $shareholder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shareholder $shareholder)
    {
        // $logo      = public_path("logos\\") . $shareholder->logo;
        
        // if(File::exists($logo)) {
        //     File::delete($logo);
        // }

        $shareholder->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function sortable(Shareholder $shareholder)
    {
        $shareholders = Shareholder::orderBy('list', 'asc')->get();

        return view('shareholder.sortable', compact('shareholders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {

        $shareholderData = Shareholder::all();

        foreach($shareholderData as $shareholder){
            $shareholder->timestamps = false;

            $id = $shareholder->id;
            foreach($request->shareholderdata as $shareholderLoop){
                if($shareholderLoop['id'] == $id){
                    $shareholder->update(['list' => $shareholderLoop['list']]);
                }
            }
        }


        return response('Update Successful', 200);
    }

}
