<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\ServerErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use PhpParser\Node\Stmt\TryCatch;
use Stripe\Charge;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->hasRole('customer')) {
            $payments = Auth::user()->customer->payments;
            return view('Payment.index', compact('payments'));
        }elseif (Auth::check() && Auth::user()->hasRole('staff')) {
            $payments = Payment::all();
            return view('Payment.index', compact('payments'));
        }
        return redirect()->route('login');
    }

    public function edit(Payment $payment)
    {
        return view('Payment.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        try {
            //dd($request->stripeToken);
            $charge = Stripe::charges()->create([
                'amount' => $payment->amount,
                'currency' => 'MYR',
                'source' => $request->stripeToken,
                'description' => 'Order'
            ]);
            $payment->status = 'received';
            $payment->type = 'online';
            $payment->save();
            Delivery::create([
                'service_request_id' => $payment->service_request->id,
                'address' => $payment->service_request->pick_up->address,
                'status' => 'waiting_rider',
                'rider_id' => null,
                'cash_on_delivery' => 'no',
            ]);
            return redirect()->route('payment.index')->with('success-message', 'Thank you! Your payment has been excepted');
        } catch (CardErrorException $e) {
            return redirect()->route('payment.index')->withErrors('Error!', $e->getMessage());
        }
    }

    public function cash_on_delivery(Payment $payment)
    {
        $payment->type = 'cash_on_delivery';
        $payment->save();
        Delivery::create([
            'service_request_id' => $payment->service_request->id,
            'address' => $payment->service_request->pick_up->address,
            'status' => 'waiting_rider',
            'rider_id' => null,
            'cash_on_delivery' => 'yes',
        ]);
        return redirect()->back();
    }
}
