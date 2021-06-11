<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->hasRole('customer')) {
            $service_requests = Auth::user()->service_requests;
            $service_requests = $service_requests->where('approval_status','yes');
            return view('Quotation.index', compact('service_requests'));
        }elseif (Auth::check() && Auth::user()->hasRole('staff')) {
            $service_requests = ServiceRequest::all();
            $service_requests = $service_requests->where('approval_status','yes');
            return view('Quotation.index', compact('service_requests'));
        }
        return redirect()->route('login');
    }

    public function create(ServiceRequest $service_request)
    {
        return view('Quotation.create',compact('service_request'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric',
        ]);
        $quotation = Quotation::create([
            'service_request_id' => $request->service_request_id,
            'description' => $request->description,
            'cost' => $request->cost,
        ]);

        return redirect()->route('quotation.show', ['service_request' => $request->service_request_id]);
    }

    public function show(ServiceRequest $service_request)
    {
        return view('Quotation.show',compact('service_request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        $quotation->delete();
        return redirect()->back();
    }
}
