<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\imageUploadTrait;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
        // return view('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'banner' => ['required', 'image', 'max:2000'],
            'type' => ['required', 'max:25'],
            'title' => ['required'],
            'starting_price' => ['required'],
            'btn_url' => ['url', 'required'],
            'serial' => ['required'],
            'status' => ['required']
        ]);

        $data['banner'] = $this->uploadImage($request, 'banner', 'uploads', 'slider');

        $slider = Slider::create($data);

        if (!$slider) {
            toastr('Error', 'error');
            return redirect()->back();
        }
        toastr('The Slide Created Successfully');
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
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'banner' => ['nullable', 'image', 'max:2000'],
            'type' => ['required', 'max:25'],
            'title' => ['required'],
            'starting_price' => ['required'],
            'btn_url' => ['url', 'required'],
            'serial' => ['required'],
            'status' => ['required']
        ]);

        $slider = Slider::findOrFail($id);

        if ($request->hasFile('banner')) {
            $data['banner'] = $this->uploadImage($request, 'banner', 'uploads', 'slider');
        }

        $slider->update($data);

        if (!$slider) {
            toastr('Error', 'error');
            return redirect()->back();
        }
        toastr('The Slide Created Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $this->deleteImage($slider->banner);

        $slider->delete();

        return response(['status' => 'success', 'message' => 'Slider Delted Successflully']);
    }
}
