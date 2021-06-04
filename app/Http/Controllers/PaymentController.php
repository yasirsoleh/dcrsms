<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Retrieve the payment data from the MainPayment interface and pass to the model
        Payment::create([
            'service_request_id' => auth()->user()->service_request,
            'type' => $request->type,
            'amount' => $request->amount,
            'status' => $request->status
        ]);
        if ($request->type == "card") {
            // redirect to card page
            return view('Payment.BankOptions');
        } else {
            // redirect to the payment summary
            // TODO find how to include some additional data when returning to page
            // TODO jap bakpo doh, Sbb nk return object payment kot for some reason
            return view('Payment.PaymentSuccess');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Store the the status of the payment when the payment status changes
        $payment = Payment::find($request->service_request_id);
        $payment->status = $request->status;
        $payment->save();
    }
}
