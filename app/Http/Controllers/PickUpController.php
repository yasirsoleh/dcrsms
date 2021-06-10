<?php

namespace App\Http\Controllers;

use App\Models\PickUp;
use App\Models\ServiceRequest;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->hasRole('customer')) {
            $pick_ups = Auth::user()->customer->pick_ups;
            return view('PickUp.index', compact('pick_ups'));
        }elseif (Auth::check() && Auth::user()->hasRole('rider')) {
            $pick_ups = PickUp::all();
            return view('PickUp.index', compact('pick_ups'));
        }
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ServiceRequest $service_request)
    {
        return view('PickUp.create', compact('service_request'));
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
            'address' => 'required|string|max:255',
        ]);

        $pick_up = PickUp::create([
            'service_request_id' => $request->service_request_id,
            'address' => $request->address,
            'status' => 'waiting_rider',
            'rider_id' => null,
        ]);

        return redirect()->route('pick_up.show', ['pick_up' => $pick_up]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PickUp  $pickUp
     * @return \Illuminate\Http\Response
     */
    public function show(PickUp $pick_up)
    {
        return view('PickUp.show', compact('pick_up'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PickUp  $pickUp
     * @return \Illuminate\Http\Response
     */
    public function edit(PickUp $pick_up)
    {
        return view('PickUp.edit', compact('pick_up'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PickUp  $pickUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PickUp $pick_up)
    {
        $pick_up->status = $request->status;
        $pick_up->save();
        if ($pick_up->status == 'completed') {
            Repair::create([
                'service_request_id' => $pick_up->service_request->id,
                'status' => 'pending',
            ]);
        }
        return redirect()->route('pick_up.show', ['pick_up' => $pick_up]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PickUp  $pickUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(PickUp $pick_up)
    {
        
    }

    public function rider_accept(PickUp $pick_up)
    {
        $pick_up->rider_id = Auth::user()->rider->id;
        $pick_up->status = 'picking_up';
        $pick_up->save();
        return redirect()->back();
    }
}
