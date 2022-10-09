<?php

namespace App\Http\Controllers;

use App\Tables;
use App\InvestorRelation;
use Illuminate\Http\Request;

class InvestorRelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $investorRelations = InvestorRelation::all();

        return view('relations.index', compact('investorRelations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('relations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $investorRelation = InvestorRelation::create([
            'year'                          => $request->date_of_creation,
            'dividend'                      => $request->dividend,
            'shares_issue_ifrs'             => $request->shares_issue_ifrs,
            'shares_held_treasury'          => $request->shares_held_treasury,
            'dividend_share_calculation'    => $request->dividend_share_calculation,
            'net_per_share'                 => $request->net_per_share,
            'loan_to_ratio'                 => $request->loan_to_ratio,
            'gross_property_expense'        => $request->gross_property_expense, 
            'percentage_property_offshore'  => $request->percentage_property_offshore, 	 	 
            'value_per_share'               => $request->value_per_share,
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvestorRelation  $investorRelation
     * @return \Illuminate\Http\Response
     */
    public function show(InvestorRelation $investorRelation, $id)
    {
        $investorRelation = InvestorRelation::findOrFail($id);

        $tables = Tables::all();

        return view('relations.show', compact('investorRelation', 'tables'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvestorRelation  $investorRelation
     * @return \Illuminate\Http\Response
     */
    public function edit(InvestorRelation $investorRelation, $id)
    {
        $investorRelation = InvestorRelation::findOrFail($id);

        $tables = Tables::findOrFail($id);
        // dd($investorRelation);
        return view('relations.edit', compact('investorRelation','tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvestorRelation  $investorRelation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvestorRelation $investorRelation)
    {
        $investorRelation->update([
            'year'                          => $request->date_of_creation,
            'dividend'                      => $request->dividend,
            'shares_issue_ifrs'             => $request->shares_issue_ifrs,
            'shares_held_treasury'          => $request->shares_held_treasury,
            'dividend_share_calculation'    => $request->dividend_share_calculation,
            'net_per_share'                 => $request->net_per_share,
            'loan_to_ratio'                 => $request->loan_to_ratio,
            'gross_property_expense'        => $request->gross_property_expense, 
            'percentage_property_offshore'  => $request->percentage_property_offshore,	 	 
            'value_per_share'               => $request->value_per_share,
        ]);

        return back()->with('message','Successfully Submitted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvestorRelation  $investorRelation
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvestorRelation $investorRelation)
    {
        $investorRelation->delete();

        return response()->json(['message' => 'Successfully Deleted']);
    }
}
