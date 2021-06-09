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
            $data = Auth::user()->customer;
            return view('dashboard', compact('data'));
        }elseif (Auth::user()->hasRole('rider')) {
            $data = Auth::user()->rider;
            return view('dashboard', compact('data'));
        }elseif (Auth::user()->hasRole('staff')) {
            $data = Auth::user()->staff;
            return view('dashboard',compact('data'));
        }
    }
}