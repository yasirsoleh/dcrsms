<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('customer')) {
            $serviceRequests = Auth::user()->customer()->service_requests();
            return view('ServiceQuotation.index',);
        }elseif (Auth::user()->hasRole('staff')) {
            $serviceRequests = ServiceRequest::all();
            return view('ServiceQuotation.StaffRequestList', $serviceRequests);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('customer')) {
            return view('ServiceQuotation.CustRequestService');
        }
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
            'device_name' => 'required|string|max:255',
            'device_description' => 'required|string|max:255',
            'picture' => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
        ]);
        $serviceRequest = ServiceRequest::create([
            'device_name' => $request->device_name,
            'device_description' => $request->device_description,
            'picture' => $request->picture,
            'customer_id' => Auth::user()->id,
        ]);
        return $serviceRequest;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceRequest $serviceRequest)
    {
        if (Auth::user()->hasRole('customer')) {
            return view('ServiceQuotation.CustRequestStatus', $serviceRequest);
        }elseif (Auth::user()->hasRole('staff')) {
            return view('ServiceQuotation.StaffManageRequest');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        //
    }
}
