<?php

namespace App\Http\Controllers;

use App\Models\Donations;
use App\Models\DonationTransactions;
use Illuminate\Http\Request;

class DonationTransactionsController extends Controller
{
    /**
     * Display a listing of the donation transaction based on donation ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        $donationTransactions = DonationTransactions::where('donations_id', $request->donations_id)->get();
        return response()->json([ 'status' => 200, 'data'   => $donationTransactions ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['payment_status' => 'waiting', 'unique_digit' => rand(1,99)]);
        $donationTransaction = DonationTransactions::create($request->all(), ['payment_status' => 'waiting', 
                                                                                'unique_digit' => rand(1,99)]);

        return response()->json(['status'=>201, 'data'=>$donationTransaction]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DonationTransactions  $donationTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(DonationTransactions $donationTransaction)
    {
        return response()->json(['status'=>201, 'data'=>$donationTransaction]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DonationTransactions  $donationTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DonationTransactions $donationTransaction)
    {
        $donationTransaction->update($request->all());

        return response()->json(['status'=>200, 'data'=>$donationTransaction]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DonationTransactions  $donationTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonationTransactions $donationTransaction)
    {
        $donationTransaction->delete();

        return response()->json(['status'=>204, 'message'=>'donation transaction deleted succesfully']);
    }
    
    /**
     * Claim a waiting donation has been paid.
     *
     * @param  donations_id
     * @return \Illuminate\Http\Response
     */
    public function claim(Request $request)
    {
        $donationTransactions = DonationTransactions::findOrFail($request->donation_transaction_id)->first();
        $donationTransactions->payment_status = 'paid';
        $donationTransactions->save();

        $donations = Donations::findOrFail($donationTransactions->donations_id)->first();
        $donations->current_donation = $donations->current_donation + $donationTransactions->donation_amount;
        $donations->save();

        return response()->json(['status'=>200, 'data'=>$donationTransactions]);
    }
    
    /**
     * Expire a waiting donation.
     *
     * @param  donations_id
     * @return \Illuminate\Http\Response
     */
    public function expire(Request $request)
    {
        $donationTransaction = DonationTransactions::findOrFail($request->donations_id)->first();
        $donationTransaction->payment_status = 'expire';
        $donationTransaction-save();
        
        return response()->json(['status'=>200, 'data'=>$donationTransaction]);
    }
}
