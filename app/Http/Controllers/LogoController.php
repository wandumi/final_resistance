<?php

namespace App\Http\Controllers;

use App\Logo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LogoRequest;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdateLogoRequest;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Logos = Logo::all();
        
        return view('Logos.index', compact('Logos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Logos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LogoRequest $request)
    {
        if($request->hasFile('image')){
         
            $image    = $request->image;
            $fileName   = time() . $image->getClientOriginalName();
            $image->move(public_path('logos/'), $fileName );
        }

        Logo::create([
            'name'      => $request->name,
            'slug'      => Str::slug($request->name, '-'),
            'image'     => $fileName
        ]);

        return back()->with("message","Successfully Submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(Logo $logo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logo $logo, $id)
    {
        $logo = Logo::findOrFail($id);

        return view('Logos.edit', compact('logo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogoRequest $request, $id)
    {
        $request->validate([
            'name'     => 'required|min:3,unique:logos,name,'.$id,
            'slug'     => 'unique:logos,slug,'.$id,
            'image'    => 'nullable|mimes:jpg,jpeg,png'
        ]);

        $logo = Logo::findOrFail($id);

        if($request->hasFile('image'))
        {
            if($logo->image != null){
                
                $savedlogo = 'logos/'.$logo->image;

                if(File::exists($savedlogo)) {
                    File::delete($savedlogo);
                }

                $pageImage      = $request->image;
                $image         = time() . $pageImage->getClientOriginalName();
                $pageImage->move(public_path('logos/'), $image);
            }

            $logo->update([
                'image'    => $image,
            ]);
        }

        $logo->update([
            'name'   => $request->name,
            'slug'   => $request->slug ? Str::slug($request->slug, '-') : $request->name,
        ]);

        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logo $logo, $id)
    {
        $logo = Logo::findOrFail($id);

        
        $logoImage  = public_path("logos/") .$logo->image;
        
        if(File::exists($logoImage)) {
            File::delete($logoImage);
        } 

        $logo->delete();
  
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
