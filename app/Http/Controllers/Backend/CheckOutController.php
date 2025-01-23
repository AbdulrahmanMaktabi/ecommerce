<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRules;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    public function index()
    {
        $countries = config('settings.countries');
        $shippigRules = ShippingRules::status(true)->get();

        return view('frontend.pages.checkout', get_defined_vars());
    }

    public function address(Request $request)
    {
        $data = $request->validate([
            "name" => ['required'],
            "email" => ['required', 'email'],
            "phone" => ['required', 'numeric'],
            "country" => ['required'],
            "city" => ['required'],
            "zipcode" => ['required', 'numeric'],
            "address_type" => ['required', 'in:home,work,other'],
            "address" => ['required'],
        ]);

        $data['user_id'] = Auth::user()->id;

        $address = UserAddress::create($data);
        toastr('Address Created Successfully');

        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/',
            'email' => 'required|email|max:255',
            'additional_information' => 'nullable|string|max:1000',
            'address' => 'required|string|max:500|exists:user_addresses,name',
            'shippingRule' => 'required|string|max:255|exists:shipping_rules,name',
            'rules' => 'required|in:on', // Must have "on" as value
        ]);

        $shippingRule = ShippingRules::where('name', $data['shippingRule'])->first();
        $address = UserAddress::where('name', $data['address'])->first();

        Session::put('checkout', [
            'status' => true,
            'message' => 'Checkout is done successfully',
            'shippingRule' => $shippingRule,
            'address' => $address
        ]);


        return to_route('payment.index');
        // return response()->json([
        //     'status' => true,
        //     'message' => 'Checkout is done successfully',
        //     'shippingRule' => $shippingRule,
        //     'address' => $address
        // ]);
    }
}
