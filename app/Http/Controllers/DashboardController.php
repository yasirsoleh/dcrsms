<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Rider;
use App\Models\Staff;

use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('customer')) {
            //$customer = Customer::where('user_id', Auth::user()->id)->first();
            $customer = Auth::user()->customer();
            //$data = Customer::find(5)->user();
            dd($customer);
            return view('dashboard', compact('data'));
        }elseif (Auth::user()->hasRole('rider')) {
            $data = Rider::where('user_id', Auth::user()->id)->first();
            return view('dashboard', compact('data'));
        }elseif (Auth::user()->hasRole('staff')) {
            $data = Staff::where('user_id', Auth::user()->id)->first();
            return view('dashboard',compact('data'));
        }
    }
}
