<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\Rider;

class AccountController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('customer')) {
            $customer = Auth::user()->customer();
            return view('Account.CustomerAccount', $customer);
        }elseif (Auth::user()->hasRole('rider')) {
            $rider = Auth::user()->rider();
            return view('Account.RiderAccount', $rider);
        }elseif (Auth::user()->hasRole('staff')) {
            $staff = Auth::user()->staff();
            return view('Account.StaffAccount',$staff);
        }
    }

    public function viewAllCustomerAccount()
    {
        if (Auth::user()->hasRole('staff')) {
            $customers = Customer::all();
            return view('Account.ListCustomerAccount', $customers);
        }
    }

    public function viewAllRiderAccount()
    {
        if (Auth::user()->hasRole('staff')) {
            $riders = Rider::all();
            return view('Account.ListRiderAccount', $riders);
        }
    }
    
    public function editAccount(Request $request)
    {
        if (Auth::user()->hasRole('customer')) {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
            ]);
            $user = Auth::user();
            $user->email = $request->email;
            $user->Hash::make($request->password);
            $user->save();
            $customer = $user->customer();
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->address = $request->address;
            $customer->save();
        }elseif (Auth::user()->hasRole('rider')) {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'address' => 'required|string|max:255',
                'roadtax' => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
                'license' => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
            ]);
            $user = Auth::user();
            $user->email = $request->email;
            $user->Hash::make($request->password);
            $user->save();
            $rider = $user->rider();
            $rider->first_name = $request->first_name;
            $rider->last_name = $request->last_name;
            $rider->address = $request->address;
            $rider->roadtax = $request->file('roadtax')->store('roadtaxFile');
            $rider->license = $request->file('license')->store('licenseFile');
            $rider->save();

        }elseif (Auth::user()->hasRole('staff')) {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Rules\Password::min(8)],
            ]);
            $user = Auth::user();
            $user->email = $request->email;
            $user->Hash::make($request->password);
            $user->save();
            $staff = $user->staff();
            $staff->first_name = $request->first_name;
            $staff->last_name = $request->last_name;
            $staff->save();
        }
    }

    public function changeStatus(Request $request)
    {
        if (Auth::user()-hasRole('staff')) {
            $user = User::find($request->id);
            $user->status = $request->status;
        }
    }
}