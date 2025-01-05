<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = GeneralSettings::first();

        return view('admin.settings.index', get_defined_vars());
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
    public function update(Request $request)
    {
        $data = $request->validate((
            [
                'store_name' => 'required',
                'contact_email' => 'required|email', // Valid email
                'layout' => 'required|in:ltr,rtl', // Either 'ltr' or 'rtl'
                'currency_name' => 'required|string|max:255', // Valid string for currency name
                'currency_icon' => 'required|string|max:10', // Currency icon (like 'S$', '€', etc.)
                'timezone' => 'required|timezone', // Valid timezone identifier
            ]
        ));

        $settings = GeneralSettings::updateOrCreate(
            ['id' => 1],
            $data
        );

        toastr('Settings Update Successfully');
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
