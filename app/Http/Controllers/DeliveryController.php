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
            $deliveries = PickUp::all();
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
        return view('Delivery.show', compact('deliveries'));
    }

    public function edit(Delivery $delivery)
    {
        return view('Delivery.edit', compact('delivery'));
    }

    public function update(Request $request, Delivery $delivery)
    {
        $delivery->status = $request->status;
        $delivery->save();
        return redirect()->route('delivery.show', ['delivery' => $delivery]);
    }

    public function destroy(Delivery $delivery)
    {
        
    }

    public function rider_accept(Delivery $delivery)
    {
        $pick_up->rider_id = Auth::user()->rider->id;
        $pick_up->status = 'picking_up';
        $pick_up->save();
        return redirect()->back();
    }
}
