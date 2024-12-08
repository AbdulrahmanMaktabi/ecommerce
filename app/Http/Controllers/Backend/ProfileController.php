<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

class ProfileController extends Controller
{
    // show profile page
    public function index()
    {
        return view('admin.profile.index');
    }

    // Update Profile [name , password , image]
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|max:25',
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

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        toastr()->success('Profile Updated Successfully');
        return redirect()->back();
    }

    // Update Admin password after check current password
    public function password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update to the new password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}
