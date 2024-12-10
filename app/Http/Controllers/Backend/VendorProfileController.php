<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Hash;

class VendorProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('vendor.dashboard.profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|max:25',
            'email' => 'required|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
            $image = $request->image;
            $imageName = rand() . "_" . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $path = '/uploads/' . $imageName;

            $user->image = $path;
        }

        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();

        if ($user->username != $request->username) {
            toastr()->error('Profile Updated Successfully');

            return redirect()->back();
        }

        toastr()->success('Profile Updated Successfully');
        return redirect()->back();
    }

    public function password(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required'],
            'password' => ['min:8', 'confirmed', 'required']
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            toastr()->error('Current Password Not Same To Password');
            return redirect()->back();
        }

        $user->password = Hash::make($request->current_password);
        $user->save();

        toastr('Password Changed Successfully');
        return redirect()->back();
    }
}
