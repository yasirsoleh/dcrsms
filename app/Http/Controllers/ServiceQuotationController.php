<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\ServiceRequest;

class ServiceQuotationController extends Controller
{

    public function index()
    {
        if (Auth::user()->hasRole('customer')) {
            $serviceRequests = ServiceRequest::where('customer_id', Auth::user()->id);
            return view('ServiceQuotation.CustRequestList', $serviceRequests);
        }elseif (Auth::user()->hasRole('staff')) {
            $serviceRequests = ServiceRequest::all();
            return view('ServiceQuotation.StaffRequestList', $serviceRequests);
        }
    }

    public function show($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        if (Auth::user()->hasRole('customer')) {
            return view('ServiceQuotation.CustRequestStatus', $serviceRequest);
        }elseif (Auth::user()->hasRole('staff')) {
            return view('ServiceQuotation.StaffRequestStatus', $serviceRequest);
        }
    }

    public function requestService()
    {
        if (Auth::user()->hasRole('customer')) {
            return view('ServiceQuotation.CustRequestService');
        }
    }

    public function saveServiceRequest(Request $request)
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

    public function addQuotation(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric',
        ]);
        $quotation = Quotation::create([
            'request_id' => $request->request_id,
            'description' => $request->description,
            'cost' => $request->cost,
        ]);

        return $quotation;
    }

    public function deleteQuotation(Request $request)
    {
        $quotation = Quotation::findOrFail($request->id);
        $quotation->delete();
    }

    public function getQuotation(Request $request)
    {
        $quotations = Quotation::where('request_id', $request->id);
        return $quotations;
    }

    public function totalQuotationCost(Request $request)
    {
        $total_cost = Quotation::('request_id',$request->request_id)->sum('cost');
        return $total_cost;
    }

    public function staffApproval(Request $request)
    {
        $request->validate([
            ServiceRequest::findOrFail($request->id);
        ]);
        $serviceRequest = ServiceRequest::where('id',$request->id)->first();
        if ($request->approval_status=='yes') {
            $serviceRequest->approval_status = 'yes'
        }else {
            $serviceRequest->approval_status = 'no'
            $serviceRequest->rejection_reason = $request->rejection_reason;
        }
        $serviceRequest->save();
    }

    public function customerApproval(Request $request)
    {
        $request->validate([
            ServiceRequest::findOrFail($request->id);
        ]);
        $serviceRequest = ServiceRequest::where('id',$request->id)->first();
        if ($request->customer_approval=='yes') {
            $serviceRequest->customer_approval = 'yes'
        }else {
            $serviceRequest->customer_approval = 'no'
        }
        return $serviceRequest;
    }

    public function approval(Request $request)
    {
        $request->validate([
            ServiceRequest::findOrFail($request->id);
        ]);
        $serviceRequest = ServiceRequest::where('id',$request->id)->first();
        if (Auth::user()->hasRole('customer')) {
            if ($request->customer_approval=='yes') {
                $serviceRequest->customer_approval = 'yes'
            }else {
                $serviceRequest->customer_approval = 'no'
            }
        }elseif (Auth::user()->hasRole('staff')) {
            if ($request->approval_status=='yes') {
                $serviceRequest->approval_status = 'yes'
            }else {
                $serviceRequest->approval_status = 'no'
                $serviceRequest->rejection_reason = $request->rejection_reason;
            }
        }
        $serviceRequest->save();
        return $serviceRequest;
    }
}
