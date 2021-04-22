<?php

namespace App\Http\Controllers;

use App\Models\DonationNews;
use Illuminate\Http\Request;

class DonationNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status'=>200, 'data'=>DonationNews::all()]);
    }

    /**
     * Display a listing of the resource based on donation ID.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return response()->json([ 'status' => 200, 
                                  'data'   => DonationNews::where('donations_id', $request->donations_id) ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $donationNews = DonationNews::create($request->all());

        return response()->json(['status'=>201, 'data'=>$donationNews]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DonationNews  $donationNews
     * @return \Illuminate\Http\Response
     */
    public function show(DonationNews $donationNews)
    {
        return response()->json(['status'=>200, 'data'=>$donationNews]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DonationNews  $donationNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DonationNews $donationNews)
    {
        $donationNews->update($request->all());

        return response()->json(['status'=>200, 'data'=>$donationNews]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DonationNews  $donationNews
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonationNews $donationNews)
    {
        $donationNews->delete();

        return response()->json(['status'=>204, 'message'=>'donation deleted succesfully']);
    }
}
