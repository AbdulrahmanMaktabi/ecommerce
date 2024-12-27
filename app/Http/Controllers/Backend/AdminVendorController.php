<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\imageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorController extends Controller
{
    use imageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendor = Vendor::where('user_id', Auth::user()->id)->first();
        return view('admin.vendor-profile.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'store_name' => ['required'],
            'banner' => ['nullable', 'image', 'max:3000'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'status' => ['required'],
            'fb_link' => ['nullable'],
            'x_link' => ['nullable'],
            'insta_link' => ['nullable'],
            'description' => ['required'],
        ]);

        $newBanner = $this->updateImage($request, 'banner');

        $vendor = Vendor::where('user_id', Auth::user()->id)->first();

        $data['banner'] = empty($newBanner) ? $vendor->banner : $newBanner;

        $vendor->update($data);

        toastr('The Vendor Data Update Successfully');
        return redirect()->back();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
