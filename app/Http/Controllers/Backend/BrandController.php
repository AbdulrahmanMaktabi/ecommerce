<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\imageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => ['required'],
            'name' => ['required', 'unique:brands,name'],
            'status' => ['required'],
            'featured' => ['required']
        ]);

        $image = $this->uploadImage($request, 'image');

        if ($image) $data['image'] = $image;

        $data['slug'] = Str::slug($data['name']);

        Brand::create($data);

        toastr('Brand Created Successfully');
        return to_route('admin.brand.index');
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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'image' => ['nullable'],
            'name' => ['nullable', 'unique:brands,name,' . $id],
            'status' => ['nullable'],
            'featured' => ['nullable']
        ]);

        if ($request->hasFile('image')) {
            $this->updateImage($request, 'image');
        }

        $brand = Brand::findOrFail($id);

        $data['slug'] = Str::slug($data['name']);
        $brand->update($data);

        toastr('Brand Updated Successfully');

        return to_route('admin.brand.index');
    }

    /**
     * Update the specified resource status
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'slug' => 'required|exists:brands,slug',
            'status' => 'required|boolean'
        ]);

        $brand = Brand::where('slug', $request->slug)->firstOrFail();
        $brand->status = $request->status;
        $brand->save();

        return response()->json(['message' => 'Brand status updated successfully']);
    }


    /**
     * Update the specified resource status
     */
    public function updateFeatured(Request $request)
    {
        $request->validate([
            'slug' => 'required|exists:brands,slug',
            'featured' => 'required|boolean'
        ]);

        $brand = Brand::where('slug', $request->slug)->firstOrFail();
        $brand->featured = $request->featured;
        $brand->save();

        return response()->json(['message' => 'Brand featured updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);

        $this->deleteImage($brand->image);
        $brand->delete();

        toastr('Brand Delted Succssfully');
        return response(['message' => 'deleted successfully']);
    }
}
