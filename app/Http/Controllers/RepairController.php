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
            return view('Repair.CustSearchID', $repairs);
        }elseif (Auth::user()->hasRole('staff')) {
            $repairs = Repair::all();
            return view('Repair.StaffSearchID', $repairs);
        }
    }

    public function store(Request $request, ServiceRequest $serviceRequest)
    {
        $repair = Repair::create([
            'service_request_id' => $serviceRequest->id,
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
        $repair = Repair::find($repair);
        return view('Repair.CustViewRequest', $repair);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function edit(Repair $repair)
    {
        
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
        //
    }
}
