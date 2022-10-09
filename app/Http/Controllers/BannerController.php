<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdateBannerRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::paginate();

        return view('banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        
        if($request->hasFile('page_bunner')){
         
            $banner    = $request->page_bunner;
            $fileName   = time() . $banner->getClientOriginalName();
            $banner->move(public_path('banners/'), $fileName );
        }

        Banner::create([
            'page_name'     => $request->page_name,
            'slug'          => Str::slug($request->page_name, '-'),
            'page_bunner'   => $fileName
        ]);

        return back()->with("message","Successfully Submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner, $id)
    {
        $banner = Banner::findOrFail($id);

        return view('banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner, $id)
    {
        $request->validate([
            'page_name'     => 'min:3|unique:banners,page_name,'. $id,
            'slug'          => 'unique:banners,slug,'.$id,
            'page_bunner'   => 'nullable|mimes:jpg,jpeg,png'
        ]);

        $banner = Banner::findOrFail($id);

        if($request->hasFile('page_bunner'))
        {
            if($banner->page_bunner != null){
                
                $savedBanner = 'banners/'.$banner->page_bunner;

                if(File::exists($savedBanner)) {
                    File::delete($savedBanner);
                }

                $pageImage      = $request->page_bunner;
                $bunner         = time() . $pageImage->getClientOriginalName();
                $pageImage->move(public_path('banners/'), $bunner);
            }

            $banner->update([
                'page_bunner'    => $bunner,
            ]);
        }

        $banner->update([
            'page_name'   => $request->page_name,
            'slug'        => $request->slug ? Str::slug($request->slug, '-') : $request->page_name,
        ]);

        return back()->with("message","Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner, $id)
    {
        $banner = Banner::findOrFail($id);
        
        $bannerImage  = public_path("banners/") .$banner->page_banner;
        
        if(File::exists($bannerImage)) {
            File::delete($bannerImage);
        } 

        $banner->delete();
  
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
