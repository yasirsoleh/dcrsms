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
        if (Auth::check() && Auth::user()->hasRole('customer')) {
            $customer = Auth::user()->customer;
            return view('Account.CustomerAccount', compact('customer'));
        }elseif (Auth::check() && Auth::user()->hasRole('rider')) {
            $rider = Auth::user()->rider;
            return view('Account.RiderAccount', compact('rider'));
        }elseif (Auth::check() && Auth::user()->hasRole('staff')) {
            $staff = Auth::user()->staff;
            return view('Account.StaffAccount',compact('staff'));
        }
        return redirect()->route('login');
    }

    public function viewAllCustomerAccount()
    {
        if (Auth::check() && Auth::user()->hasRole('staff')) {
            $customers = Customer::all();
            return view('Account.ListCustomerAccount', compact('customers'));
        }
        return redirect()->route('login');
    }

    public function viewAllRiderAccount()
    {
        if (Auth::check() && Auth::user()->hasRole('staff')) {
            $riders = Rider::all();
            return view('Account.ListRiderAccount', compact('riders'));
        }
        return redirect()->route('login');
    }
    
    public function update(Request $request)
    {
        if (Auth::check() && Auth::user()->hasRole('customer')) {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ]);
            $user = Auth::user();
            $customer = $user->customer;
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->address = $request->address;
            $customer->save();
        }elseif (Auth::check() && Auth::user()->hasRole('rider')) {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                //'roadtax' => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
                //'license' => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
            ]);
            $user = Auth::user();
            $rider = $user->rider;
            $rider->first_name = $request->first_name;
            $rider->last_name = $request->last_name;
            $rider->address = $request->address;
            //$rider->roadtax = $request->file('roadtax')->store('roadtaxFile');
            //$rider->license = $request->file('license')->store('licenseFile');
            $rider->save();

        }elseif (Auth::check() && Auth::user()->hasRole('staff')) {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
            ]);
            $user = Auth::user();
            $staff = $user->staff;
            $staff->first_name = $request->first_name;
            $staff->last_name = $request->last_name;
            $staff->phone_number = $request->phone_number;
            $staff->save();
        }
        return redirect()->back();
    }

    public function customer_ban(Customer $customer)
    {
        if (Auth::check() && Auth::user()->hasRole('staff')) {
            $customer->status = 'banned';
            $customer->save();
            return redirect()->back();
        }
        return redirect()->route('login');
    }

    public function customer_unban(Customer $customer)
    {
        if (Auth::check() && Auth::user()->hasRole('staff')) {
            $customer->status = 'not_banned';
            $customer->save();
            return redirect()->back();
        }
        return redirect()->route('login');
    }

    public function rider_ban(Rider $rider)
    {
        if (Auth::check() && Auth::user()->hasRole('staff')) {
            $rider->status = 'banned';
            $rider->save();
            return redirect()->back();
        }
        return redirect()->route('login');
    }

    public function rider_unban(Rider $rider)
    {
        if (Auth::check() && Auth::user()->hasRole('staff')) {
            $rider->status = 'approved';
            $rider->save();
            return redirect()->back();
        }
        return redirect()->route('login');
    }

    public function rider_approve(Rider $rider)
    {
        if (Auth::check() && Auth::user()->hasRole('staff')) {
            $rider->status = 'approved';
            $rider->save();
            return redirect()->back();
        }
        return redirect()->route('login');
    }

    public function destroy_customer(Customer $customer)
    {
        $user = $customer->user;
        $customer->delete();
        $user->delete();
        return redirect()->back();
    }
}