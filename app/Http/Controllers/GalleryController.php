<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallaries = Gallery::all();

        $properties = Property::all();

        return view('gallery.index', compact('gallaries','properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'properties_id' => 'required',
            'name'          => 'required|unique:galleries,name,'.$gallery,
            'slug'          => 'required|unique:galleries,slug,'.$gallery,
        ]);

        if($request->hasFile('image')){
            $image    = $request->image;
            $fileName   = time() . $image->getClientOriginalName();
            $image->move(public_path('gallery/'), $fileName );
        }

        Gallery::create([
            'properties_id' => $request->id,
            'name'          => $request->name,
            'slug'          => Str::slug($request->name, '-'),
            'image'         => $fileName,
        ]);

        return response()->json('image uploaded Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
       
        // $request->validate([
        //     'properties_id' => 'required',
        //     'name'          => 'required|min:3',
        //     'slug'          => 'min:3',
        //     'image'         => 'nullable',
        // ]);

        if($request->hasFile('image')){
            if($gallery->image != null) {

                $savedImage = 'gallery/'.$gallery->name;

                if(File::exists($savedImage)) {
                    File::delete($savedImage);
                }

                $image    = $request->image;
                $fileName   = time() . $image->getClientOriginalName();
                $image->move(public_path('gallery/'), $fileName );

                $gallery->update([
                    'image' => $fileName,
                ]);
            }
        }

        $gallery->update([
            'properties_id' => $gallery->properties_id,
            'name'          => $request->name,
            'slug'          => $request->slug ? Str::slug($request->slug, '-') : $request->name,
        ]);

        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $galleryImage  = public_path("gallery_images/") . $gallery->image;

        if(File::exists($galleryImage)) {
            File::delete($galleryImage);
        }

        $gallery->property()->dissociate()->delete();

        return response()->json(['message' => 'Successfully Deleted']);
    }

    public function sortable(Gallery $gallery, $id)
    {
        $galleries = Gallery::where('properties_id', $id)->orderBy('list', 'asc')->get();

        return view('gallery.sortable', compact('galleries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {

        $galleryData = Gallery::all();

        foreach($galleryData as $gallery){
            $gallery->timestamps = false;

            $id = $gallery->id;
            foreach($request->gallerydata as $galleryLoop){
                if($galleryLoop['id'] == $id){
                    $gallery->update(['list' => $galleryLoop['list']]);
                }
            }
        }


        return response('Update Successful', 200);
    }

}
