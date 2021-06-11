<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\RepairItem;
use App\Models\ServiceRequest;
use App\Models\Payment;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->hasRole('customer')) {
            $repairs = Auth::user()->customer->repairs;
            return view('Repair.index', compact('repairs'));
        }elseif (Auth::check() && Auth::user()->hasRole('staff')) {
            $repairs = Repair::all();
            return view('Repair.index', compact('repairs'));
        }
        return redirect()->route('login');
    }

    public function store(Request $request, ServiceRequest $service_request)
    {
        $repair = Repair::create([
            'service_request_id' => $service_request->id,
            'status' => 'pending',
        ]);
        return $repair;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function show(Repair $repair)
    {
        return view('Repair.show', compact('repair'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function edit(Repair $repair)
    {
        return view('Repair.edit', compact('repair'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repair $repair)
    {
        $repair->status = $request->status;
        $repair->save();
        if ($repair->status == 'repaired' && $repair->repair_items->sum('cost') != 0) {
            Payment::create([
                'service_request_id' => $repair->service_request->id,
                'amount' => $repair->repair_items->sum('cost'),
                'status' => 'pending',
            ]);
        }elseif ($repair->status == 'cannot_be_repaired') {
            Delivery::create([
                'service_request_id' => $repair->service_request->id,
                'address' => $repair->service_request->pick_up->address,
                'status' => 'waiting_rider',
                'cash_on_delivery' => 'no',
            ]);
            return view('Repair.reason', compact('repair'));
        }elseif ($repair->status == 'repaired' && $repair->repair_items->sum('cost') == 0) {
            Delivery::create([
                'service_request_id' => $repair->service_request->id,
                'address' => $repair->service_request->pick_up->address,
                'status' => 'waiting_rider',
                'cash_on_delivery' => 'no',
            ]);
        }
        return redirect()->back();
    }

    public function add_item(Repair $repair)
    {
        return view('Repair.add_item', compact('repair'));
    }

    public function store_item(Request $request, Repair $repair)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric',
        ]);

        RepairItem::create([
            'repair_id' => $repair->id,
            'description' => $request->description,
            'cost' => $request->cost,
        ]);

        return redirect()->route('repair.edit', ['repair' => $repair]);
    }

    public function destroy_item(RepairItem $repair_item)
    {
        $repair_item->delete();
        return redirect()->back();
    }

    public function reason(Request $request, Repair $repair)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);
        $repair->reason = $request->reason;
        $repair->save();
        return redirect()->route('repair.index');
    }
}
