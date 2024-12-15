<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    // Display a listing of the resource
    public function index(ChildCategoryDataTable $dataTabel)
    {
        return $dataTabel->render('admin.child-category.index');
    }

    // Show the form for creating a new resource
    public function create()
    {
        $categories = Category::where('status', '1')->get();
        return view('admin.child-category.create', get_defined_vars());
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:child_categories,name'],
            'status' => ['required'],
            'sub_category' => ['required', 'exists:sub_categories,slug'],
            'category' => ['required', 'exists:categories,slug'],
        ]);

        $category = Category::where('slug', $data['category'])->firstOrFail();

        $subCategory = SubCategory::where('slug', $data['sub_category'])
            ->where('category_id', $category->id)
            ->firstOrFail();


        $data['category_id'] = $category->id;
        $data['sub_category_id'] = $subCategory->id;
        $data['slug'] = Str::slug($data['name']);

        unset($data['category'], $data['sub_category']);

        $childCategory = ChildCategory::create($data);

        toastr('The Child Category Created Successfully');
        return to_route('admin.child-category.index');
    }

    // Display the specified resource
    public function show($id)
    {
        //
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $categories = Category::where('status', '1')->get();
        $childCategory = ChildCategory::findOrFail($id);

        return view('admin.child-category.edit', get_defined_vars());
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $childCategory = ChildCategory::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'unique:child_categories,name,' . $id],
            'status' => ['required'],
            'sub_category' => ['required', 'exists:sub_categories,slug'],
            'category' => ['required', 'exists:categories,slug'],
        ]);

        $subCategory = SubCategory::where('slug', $data['sub_category'])->first();
        if (!$subCategory) {
            toastr('The Sub Category You Chose Is Not Valid');
            return redirect()->back();
        }

        $category = Category::where('slug', $data['category'])->firstOrFail();

        $subCategory = SubCategory::where('slug', $data['sub_category'])
            ->where('category_id', $category->id)
            ->firstOrFail();


        $data['category_id'] = $category->id;
        $data['sub_category_id'] = $subCategory->id;
        $data['slug'] = Str::slug($data['name']);

        unset($data['category'], $data['sub_category']);

        $childCategory->update($data);

        toastr('The Child Category Updated Successfully');
        return to_route('admin.child-category.index');
    }

    /**
     * Update the specified resource status
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'slug' => 'required|exists:child_categories,slug',
            'status' => 'required|boolean'
        ]);

        $childCategory = ChildCategory::where('slug', $request->slug)->firstOrFail();
        $childCategory->status = $request->status;
        $childCategory->save();

        return response()->json(['message' => 'Category status updated successfully']);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $childCategory = ChildCategory::findOrFail($id);

        $childCategory->delete();

        return response('The Child Category Deleted Successfully');
    }

    // get 
    public function subCategories($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)
            ->where('status', '1')
            ->with(['subCategories' => function ($query) {
                $query->where('status', '1');
            }])
            ->firstOrFail();

        return response()->json($category->subCategories);
    }
}
