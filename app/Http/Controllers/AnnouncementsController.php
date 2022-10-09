<?php

namespace App\Http\Controllers;

use App\Announcements;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AnnouncementsRequest;
use App\Http\Requests\AnnouncementUpdateRequest;

class AnnouncementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcements::all();

        return view('announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementsRequest $request)
    {
        
        if($request->hasFile('pdf'))
        {
            $pdf = $request->pdf;
            $fileName = time() . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdf_files/'), $fileName);
        }

        Announcements::create([
            'name'                      => $request->name,
            'slug'                      => Str::slug($request->name, '-'),
            'date_of_document'          => $request->date_of_document,
            'year'                      => $request->year,
            'pdf'                       => $fileName,
        ]);

        
        return back()->with('message','Submitted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcements  $announcements
     * @return \Illuminate\Http\Response
     */
    public function show(Announcements $announcements, $id)
    {
        $announcement = Announcements::findOrFail($id);

        return view('announcements.table.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcements  $announcements
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcements $announcements, $id)
    {
        $announcement = Announcements::where('id', $id)->first();

        return view('announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcements  $announcements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
        $request->validate([
            'page_name'     => 'min:3|unique:announcements,name,'. $id,
            'slug'          => 'unique:announcements,slug,'.$id,
            'pdf'           => 'mimes:pdf'
        ]);

        $announcements = Announcements::where('id',$id)->first();

        if($request->hasFile('pdf'))
        {
            if($announcements->pdf != null){
                
                $savedPdf = 'pdf_files/'.$announcements->pdf;

                if(File::exists($savedPdf)) {
                    File::delete($savedPdf);
                }

                $pdf             = $request->pdf;
                $pdfName         = time() . $pdf->getClientOriginalName();
                $pdf->move(public_path('pdf_files/'), $pdfName);
            }

            $announcements->update([
                'pdf'            => $pdfName,
            ]);
        }

        $announcements->update([
            'name'              => $request->name,
            'slug'              => $request->slug ? Str::slug($request->slug, '-') : $request->name,
            'date_of_document'  => $request->date_of_document,
            'year'              => $request->year,
        ]);

        
        
        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcements  $announcements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcements $announcements, $id)
    {
        $announcement = Announcements::where('id', $id)->first();

        $pdf         = public_path("pdf_files\\") . $announcement->pdf;

        if(File::exists($pdf)) {
            File::delete($pdf);
        }

        $announcement->delete();

        return response()->json(['message' => 'Successfully Deleted']);
    }
}
