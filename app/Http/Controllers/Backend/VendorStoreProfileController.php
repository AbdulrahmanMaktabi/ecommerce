<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\imageUploadTrait;
use Illuminate\Http\Request;

class VendorStoreProfileController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendor = Vendor::where('email', 'vendor@site.com')->first();
        return view('vendor.store-profile.index', get_defined_vars());
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
        //
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
        $vendor = Vendor::FindOrFail($id);

        $data = $request->validate([
            "banner" => ['nullable', 'image'],
            "store_name" => ['required', 'unique:vendors,store_name,' . $id],
            "email" => ['required', 'email'],
            "phone" => ['required'],
            "fb_link" => ['nullable', 'url'],
            "insta_link" => ['nullable', 'url'],
            "x_link" => ['nullable', 'url'],
            "description" => ['required'],
        ]);

        if ($request->hasFile('banner')) {
            $banner = $this->uploadImage($request, 'banner');
            unset($data['banner']);
            $data['banner'] = $banner;
        }

        $vendor->update($data);

        toastr('Vendor Store Profile Updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
