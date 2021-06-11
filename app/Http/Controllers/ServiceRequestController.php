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
        if (Auth::check() && Auth::user()->hasRole('customer')) {
            //$service_requests = Auth::user()->customer()->service_requests();
            $service_requests = Auth::user()->service_requests;
            //dd($service_requests);
            return view('ServiceRequest.index', compact('service_requests'));
        }elseif (Auth::check() && Auth::user()->hasRole('staff')) {
            $service_requests = ServiceRequest::all();
            return view('ServiceRequest.index', compact('service_requests'));
        }
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('customer')) {
            return view('ServiceRequest.create');
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
            //'picture' => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
        ]);

        $service_request = ServiceRequest::create([
            'device_name' => $request->device_name,
            'device_description' => $request->device_description,
            'picture' => $request->file('picture')->store('pictureFile'),
            'approval_status' => 'waiting',
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
        if (Auth::check() && Auth::user()->hasRole('customer')) {
            if ($service_request->customer->id == Auth::user()->customer->id) {
                return view('ServiceRequest.show', compact('service_request'));
            }else {
                return redirect()->route('service_request.index');
            }
        }elseif (Auth::check() && Auth::user()->hasRole('staff')) {
            return view('ServiceRequest.show',compact('service_request'));
        }
        return redirect()->route('login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceRequest $service_request)
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
    public function update(Request $request, ServiceRequest $service_request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceRequest $service_request)
    {
        //
    }

    public function staff_approve(ServiceRequest $service_request)
    {
        $service_request->approval_status = 'yes';
        $service_request->save();
        return redirect()->route('quotation.show', $service_request);
    }

    public function staff_not_approve(Request $request, ServiceRequest $service_request)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:255',
        ]);
        $service_request->approval_status = 'no';
        $service_request->rejection_reason = $request->rejection_reason;
        $service_request->save();
        return redirect()->route('service_request.show', $service_request);
    }

    public function customer_approve(ServiceRequest $service_request)
    {
        $service_request->customer_approval = 'yes';
        $service_request->save();
        return redirect()->route('pick_up.create', $service_request);
    }

    public function customer_not_approve(ServiceRequest $service_request)
    {
        $service_request->customer_approval = 'no';
        $service_request->save();
        return redirect()->route('quotation.index');
    }

    public function rejection_reason(ServiceRequest $service_request)
    {
        return view('ServiceRequest.reason', compact('service_request'));
    }
}
