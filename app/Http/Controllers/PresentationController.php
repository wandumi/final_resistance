<?php

namespace App\Http\Controllers;

use App\Year;
use App\Presentation;
use Illuminate\Support\Str;
use App\PresentationSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PresentationRequest;
use App\Http\Requests\UpdatePresentationRequest;

class PresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presentations = Presentation::orderBy('date_of_document', 'DESC')->get();

        $lists = PresentationSection::all();

        return view('presentations.index', compact('presentations', 'lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $presentationLists = PresentationSection::all();

        $years = Year::orderBy('year', 'ASC')->get();
     

        return view('presentations.create', compact('presentationLists', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresentationRequest $request)
    {

        if($request->hasFile('upload'))
        {
            $upload             = $request->upload;
            $uploadName         = time() . $upload->getClientOriginalName();
            $upload->move(public_path('pdf_files/'), $uploadName);
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


        $presentations = new Presentation;
        $presentations->presentation_section_id   = $request->presentation_section_id;
        $presentations->name                      = $request->name;
        $presentations->slug                      = Str::slug($request->name, '-');
        $presentations->year                      = $request->year;
        $presentations->date_of_document          = $request->date_of_document;
        $presentations->upload                    = $uploadName;
        $presentations->cover_image               = $coverImage;
        $presentations->save();
        

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function show(Presentation $presentation)
    {
        return $presentation;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function edit(Presentation $presentation)
    {
        $presentationLists = PresentationSection::all();

        $years = Year::orderBy('year', 'ASC')->get();
        
        $presentation->load('presentation_section');

        return view('presentations.edit', compact('presentationLists', 'presentation', 'years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presentation $presentation)
    {
       $request->validate([
            'presentation_section_id'   => 'required',
            'name'                      => 'required|min:3|unique:presentations,name,'.$presentation->id,
            'slug'                      => 'unique:presentations,slug,'.$presentation->id,
            'upload'                    => 'nullable|mimes:pdf',
            'cover_image'               => 'nullable|mimes:png,jpg,jpeg',
       ]);
        
        if($request->hasFile('upload'))
        {
            if($presentation->upload != null){

                $savedPdf = 'pdf_files/'.$presentation->upload;

                if(File::exists($savedPdf)) {
                    File::delete($savedPdf);
                }

                $upload             = $request->upload;
                $uploadName         = time().$upload->getClientOriginalName();
                $upload->move(public_path('pdf_files/'), $uploadName);

                //for update in table
                $presentation->update(['upload' => $uploadName]);
            }
            
        }
        
        if($request->hasFile('cover_image'))
        {

                $savedCover = 'cover_images/'.$presentation->cover_image;

                if(File::exists($savedCover)) {
                    File::delete($savedCover);
                }

                $coverImage         = $request->cover_image;
                $coverName          = time().$coverImage->getClientOriginalName();
                $coverImage->move(public_path('cover_images/'), $coverName);

                //for update in table
                $presentation->update(['cover_image' => $coverName]);

            
                
        } 
    
        $presentations = Presentation::where('id', $presentation->id)->first();
        $presentations->presentation_section_id   = $request->presentation_section_id;
        $presentations->name                      = $request->name;
        $presentations->slug                      = $request->slug ? Str::slug($request->slug, '-') : $request->name;
        $presentations->year                      = $request->year;
        $presentations->date_of_document          = $request->date_of_document;
        $presentations->save();
        

        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presentation $presentation)
    {
        $upload      = public_path("pdf_files\\") .$presentation->upload;
        $coverImage  = public_path("cover_images\\") .$presentation->cover_image;

        if(File::exists($upload) && File::exists($coverImage)) {
            File::delete($upload);
            File::delete($coverImage);
        }

        $presentation->presentation_section()->dissociate()->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    
}
