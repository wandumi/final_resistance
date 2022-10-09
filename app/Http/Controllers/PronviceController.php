<?php

namespace App\Http\Controllers;

use App\Pronvice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PronviceRequest;
use App\Http\Requests\UpdatePronviceRequest;

class PronviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pronvices = Pronvice::all();

        return view("pronvices.index", compact('pronvices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pronvices.create');
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
            'name' => 'required|min:3|unique:pronvices,name',
        ]);

        Pronvice::create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name, '-'),
        ]);

        return back()->with("message","Successfully Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pronvice  $pronvice
     * @return \Illuminate\Http\Response
     */
    public function show(Pronvice $pronvice)
    {
        return $pronvice;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pronvice  $pronvice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pronvice = Pronvice::where('id', $id)->first();

        return view('pronvices.edit', compact('pronvice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pronvice  $pronvice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|unique:pronvices,name,'.$id,
            'slug' => 'unique:pronvices,slug,'.$id,
        ]);

        $pronvice = Pronvice::where('id', $id)->first();

        $pronvice->update([
            'name'   => $request->name,
            'slug'   => $request->slug ? Str::slug($request->slug, '-') : $request->name,
        ]);

        return back()->with("message", "Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pronvice  $pronvice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pronvice $pronvice)
    {
        if($pronvice->delete())
        {
            $pronvice->properties()->dissociate()->delete();
            
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } else {
            return response()->json(['error' => 'There is a relationship']);
        };

    }
}
