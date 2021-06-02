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
            //$service_requests = Auth::user()->customer()->service_requests();
            $service_requests = Auth::user()->service_requests;
            //dd($service_requests);
            return view('ServiceQuotation.index', compact('service_requests'));
        }elseif (Auth::user()->hasRole('staff')) {
            $service_requests = ServiceRequest::all();
            return view('ServiceQuotation.index', compact('service_requests'));
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
            return view('ServiceQuotation.create');
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

        $service_request = ServiceRequest::create([
            'device_name' => $request->device_name,
            'device_description' => $request->device_description,
            'picture' => $request->picture,
            'customer_id' => Auth::user()->customer->id,
        ]);

        return redirect()->route('service_request.show', $service_request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceRequest $service_request)
    {
        if (Auth::user()->hasRole('customer')) {
            if ($service_request->customer->id == Auth::user()->customer->id) {
                return view('ServiceQuotation.show', compact('service_request'));
            }else {
                return redirect()->route('service_request.index');
            }
        }elseif (Auth::user()->hasRole('staff')) {
            return view('ServiceQuotation.show',compact('service_request'));
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
