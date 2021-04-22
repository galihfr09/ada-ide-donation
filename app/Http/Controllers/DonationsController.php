<?php

namespace App\Http\Controllers;

use App\Models\Donations;
use App\Models\DonationNews;
use App\Models\DonationTransactions;
use Illuminate\Http\Request;

class DonationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status'=>200, 'data'=>Donations::all()->sortByDesc('created_at')]);
    }

    /**
     * Filter a listing of the resource based on donation name.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        return response()->json(['status'=>200, 'data'=>Donations::where('name','like','%' .$request->name. '%')->sortByDesc('created_at')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $donation = Donations::create($request->all());

        return response()->json(['status'=>201, 'data'=>$donation]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donations  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donations $donation)
    {
        $donation->donation_news = DonationNews::where('donations_id', $donation->id)->get();
        $donation->donation_transactions = DonationTransactions::where('donations_id', $donation->id)->get();
        
        return response()->json(['status'=>200, 'data'=>$donation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donations  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donations $donation)
    {
        $donation = Donations::findOrFail($id);
        $donation->update($request->all());

        return response()->json(['status'=>200, 'data'=>$donation]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donations  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donations $donation)
    {
        $donation = Donations::findOrFail($id);
        $donation->delete();

        return response()->json(['status'=>204,'message'=>'donation news deleted succesfully']);
    }
}
