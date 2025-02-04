<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSettings;
use Illuminate\Http\Request;

class PaypalSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.payments-settings.payment-settings', get_defined_vars());
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'store_name'    => 'nullable|string|max:255',
            'status'        => 'required|in:0,1',
            'layout'        => 'required|in:0,1',
            'country'       => 'required|string|in:' . implode(',', array_keys(config('settings.countries'))),
            'currency_name'  => 'required|string|in:' . implode(',', array_column(config('settings.currencies'), 'name')),
            'currency_rate'  => 'required"numeric',
            'user_id'       => 'nullable|string|max:255',
            'secret_key'    => 'nullable|string|max:255',
        ]);

        $paypal = PaypalSettings::updateOrCreate(
            ['id' => $id],
            $data
        );

        toastr('Paypla Settings Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
