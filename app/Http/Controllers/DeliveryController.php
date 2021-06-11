<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->hasRole('customer')) {
            $deliveries = Auth::user()->customer->deliveries;
            return view('Delivery.index', compact('deliveries'));
        }elseif (Auth::check() && Auth::user()->hasRole('rider')) {
            $deliveries = Delivery::all();
            return view('Delivery.index', compact('deliveries'));
        }
        return redirect()->route('login');
    }

    public function create(ServiceRequest $service_request)
    {
        return view('Delivery.create', compact('service_request'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
        ]);

        $delivery = Delivery::create([
            'service_request_id' => $request->service_request_id,
            'address' => $request->address,
            'status' => 'waiting_rider',
            'rider_id' => null,
        ]);

        return redirect()->route('delivery.show', ['delivery' => $delivery]);
    }

    public function show(Delivery $delivery)
    {
        return view('Delivery.show', compact('delivery'));
    }

    public function edit(Delivery $delivery)
    {
        return view('Delivery.edit', compact('delivery'));
    }

    public function update(Request $request, Delivery $delivery)
    {
        $delivery->status = $request->status;
        $delivery->save();
        if ($delivery->status == 'completed') {

            $payment = $delivery->service_request->payment;
            $payment->status = 'received';
            $payment->save();
        }
        return redirect()->route('delivery.show', ['delivery' => $delivery]);
    }

    public function destroy(Delivery $delivery)
    {
        
    }

    public function rider_accept(Delivery $delivery)
    {
        $delivery->rider_id = Auth::user()->rider->id;
        $delivery->status = 'delivering';
        $delivery->save();
        return redirect()->back();
    }
}
