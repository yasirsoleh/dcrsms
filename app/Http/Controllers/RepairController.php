<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('customer')) {
            $repairs = Auth::user()->customer()->repair();
            return view('Repair.index', compact('repairs'));
        }elseif (Auth::user()->hasRole('staff')) {
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
        if ($repair->status == 'repaired') {
            Payment::create([
                'repair_id' => $repair->id,
                'amount' => $repair->repair_items->sum('cost'),
                'status' => 'pending',
            ]);
        }
        return redirect()->back();
    }
}
