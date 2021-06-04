<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Rider;
use App\Models\Staff;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('Registration.RegisterCategory');
    }

    public function registerCustomer()
    {
        return view('Registration.RegisterCustomer');
    }

    public function registerRider()
    {
        return view('Registration.RegisterRider');
    }

    public function createCustomer(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
            //'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number, 
            'address' => $request->address,
        ]);

        $user->attachRole('customer');
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

    public function createRider(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
            //'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'roadtax' => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
            'license' => 'required|mimes:png,jpg,jpeg,pdf|max:2048',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $rider = Rider::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number, 
            'address' => $request->address,
            'roadtax' => $request->file('roadtax')->store('roadtaxFile'),
            'license' => $request->file('license')->store('licenseFile'),
        ]);

        $user->attachRole('rider');
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    } 

    public function registerStaff()
    {
        return view('Registration.RegisterStaff');
    }

    public function createStaff(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
            //'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $staff = Staff::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number, 
        ]);

        $user->attachRole('staff');
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

}
