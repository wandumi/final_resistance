<?php

namespace App\Http\Controllers;

use App\Logo;
use App\TheFun;
use App\Gallery;
use App\Pronvice;
use App\Property;
use App\Schedule;
use App\Portifolio;
use App\MajorTenant;
use App\AnchorTenant;
use App\PortifolioList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PropertiesRequest;
use App\Http\Requests\UpdatePropertiesRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pronvices = Pronvice::all();

        $properties = Property::latest()->get();

        return view('properties.index', compact('properties','pronvices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pronvices = Pronvice::orderBy('name', 'asc')->get();

        $logos = Logo::all();

        return view('properties.create', compact('pronvices','logos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertiesRequest $request)
    {
       
        if($request->hasFile('cover_image'))
        {
            $cover = $request->cover_image;

            $coverImage = time(). $cover->getClientOriginalName();

            $cover->move(public_path('cover_images/'), $coverImage);
        }

        if($request->hasFile('banner_image'))
        {
            $banner = $request->banner_image;

            $bannerImage = time(). $banner->getClientOriginalName();

            $banner->move(public_path('banner_images/'), $bannerImage);
        }

        if($request->featured == "on")
        {
            $featured = 1;
        } else {
            $featured = 0;
        }

        Property::create([
            'pronvice_id'   => $request->pronvice_id,
            'name'          => $request->name,
            'slug'          => Str::slug($request->name, '-'),
            'description'   => $request->description,
            'website_link'  => $request->website_link,
            'cover_image'   => $coverImage,
            'banner_image'  => $bannerImage,
            'featured'      => $featured,
            
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return $property;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {

        $pronvices  = Pronvice::all();

        $property->load('pronvice','logos');

        $galleries  = Gallery::where('properties_id', $property->id)->orderBy('list','asc')->get();

        $logos      = Logo::all();

        $anchors    = AnchorTenant::where('property_id',$property->id)->get()->toArray();

        $majors     = MajorTenant::where('property_id',$property->id)->get()->toArray();

        $followings = TheFun::where('property_id',$property->id)->get()->toArray();


        return view('properties.edit', compact('property','pronvices', 'galleries', 'logos','anchors','majors','followings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        
        $request->validate([
            'pronvice_id'   => 'required',
            'name'          => 'required|min:3|unique:properties,name,'.$property->id,
            'slug'          => 'unique:properties,slug,'.$property->id,
            'description'   => 'required',
            'website_link'  => 'required',
            'cover_image'   => 'sometimes|mimes:png,jpg,jpeg',
            'banner_image'  => 'sometimes|mimes:png,jpg,jpeg',
        ]);

        // dd($request->all());
        if($request->hasFile('cover_image'))
        {
            if($property->cover_image != null){

                $savedCover = 'cover_images/'.$property->cover_image;

                if(File::exists($savedCover)) {
                    File::delete($savedCover);
                }

                $coverImage         = $request->cover_image;
                $coverName          = time() . $coverImage->getClientOriginalName();
                $coverImage->move(public_path('cover_images/'), $coverName);

                $property->update([
                    'cover_image'               => $coverName,
                ]);
            }

        }

        if($request->hasFile('banner_image'))
        {
            if($property->banner_image != null){

                $savedBanner = 'banner_images/'.$property->banner_image;

                if(File::exists($savedBanner)) {
                    File::delete($savedBanner);
                }

                $banner = $request->banner_image;
                $bannerImage = time(). $banner->getClientOriginalName();
                $banner->move(public_path('banner_images/'), $bannerImage);

                $property->update([
                    'banner_image'               => $bannerImage,
                ]);
            }
        }

        if($request->featured == "on")
        {
            $featured = 1;
        } else {
            $featured = 0;
        }

        $property->update([
            'pronvice_id'       => $request->pronvice_id,
            'name'              => $request->name,
            'slug'              => $request->slug ? Str::slug($request->slug, '-') : $request->name,
            'description'       => $request->description,
            'website_link'      => $request->website_link,
            'featured'          => $featured,
            'gla'               => $request->gla,
            'pro_rata_interest' => $request->pro_rata_interest,
            'vacancy'           => $request->vacancy
        ]);

        $propertyId = $request->property_id;

        $fileName = " ";

        if($request->hasFile('image')){
            if($request->image != null) {
                $image    = $request->image;
                $fileName   = time() . $image->getClientOriginalName();
                $image->move(public_path('gallery/'), $fileName );

            } else {
                $fileName = " ";
            }
        }

        Gallery::create([
            'properties_id' => $propertyId,
            'name'          => $request->garalley_name,
            'slug'          => Str::slug($request->garalley_name, '-'),
            'image'         => $fileName,
        ]);



        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {

        $coverImage  = public_path("cover_images/") . $property->cover_image;

        if(File::exists($coverImage)) {
            File::delete($coverImage);
        }

        //remove relationship and delete
        $property->pronvice()->dissociate()->delete();

        return response()->json(['message' => 'Successfully Deleted']);
    }

    private function saveFile( $file )
    {
        $path = Storage::put( '/public/companies/'. $file );

        $fileURL = env('APP_URL').'/storage/'.str_replace( 'public/', '', $path );

        return $fileURL;
    }

    
    public function sortable(Property $property)
    {
        $properties = Property::orderBy('list', 'asc')->get();

        return view('properties.sortable', compact('properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {
       
        $propertyData = Property::all();

        foreach($propertyData as $property){
            $property->timestamps = false;

            $id = $property->id;

            foreach($request->propertiesdata as $propertyLoop){
                if($propertyLoop['id'] == $id){
                    $property->update(['list' => $propertyLoop['list']]);
                }
            }
        }


        return response('Update Successful', 200);
    }
}
