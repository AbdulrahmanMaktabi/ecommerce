<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();

        return view('frontend.dashboard.address.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = config('settings.countries');
        return view('frontend.dashboard.address.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        return to_route('address.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $addressID)
    {
        $countries = config('settings.countries');
        $address = UserAddress::findOrFail($addressID);

        return view('frontend.dashboard.address.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $addressID)
    {
        $address = UserAddress::findOrFail($addressID);

        $data = $request->validate([
            "name" => ['required'],
            "email" => ['required', 'email'],
            "phone" => ['required', 'numeric'],
            "country" => ['nullable'],
            "city" => ['nullable'],
            "zipcode" => ['required', 'numeric'],
            "address_type" => ['required', 'in:home,work,other'],
            "address" => ['required'],
        ]);
        $data['user_id'] = Auth::user()->id;

        if (isNull($data["country"])) {
            unset($data['country']);
            unset($data['city']);
        }

        $address->update($data);

        toastr('Address Updated Successfully');

        return to_route('address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($addressID)
    {
        $address = UserAddress::findOrFail($addressID);
        $address->delete();

        return response()->json(['status' => 'success', 'message' => 'Address Deleted Successfully']);
    }

    /**
     * Get City Base On Country
     */
    public function getCities(Request $request)
    {
        $countries = config('settings.countries');

        return response()->json($countries[$request->country] ?? []);
    }
}
