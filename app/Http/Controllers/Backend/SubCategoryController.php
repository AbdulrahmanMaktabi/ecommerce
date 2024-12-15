<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', '1')->get();
        return view('admin.sub-category.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:sub_categories,name'],
            'status' => ['required'],
            'category' => ['required']
        ]);
        $data['slug'] = Str::slug($data['name']);

        $categoryID = Category::where('slug', $data['category'])->first()->id;

        if (!$categoryID) {
            toastr('The Category Is Not Valid', 'error');
            return;
        }
        $data['category_id'] = $categoryID;

        unset($data['category']);

        SubCategory::create($data);
        toastr('The Sub Category Created Successfully');

        return to_route('admin.sub-category.index');
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
        $categories = Category::where('status', '1')->get();

        $subCategory = SubCategory::findOrFail($id);

        return view('admin.sub-category.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($id);
    }

    /**
     * Update the specified resource status
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'slug' => 'required|exists:sub_categories,slug',
            'status' => 'required|boolean'
        ]);

        $subCategory = SubCategory::where('slug', $request->slug)->firstOrFail();
        $subCategory->status = $request->status;
        $subCategory->save();

        return response()->json(['message' => 'Category status updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $childCategories = ChildCategory::where('sub_category', $subCategory->id)->count();

        if ($childCategories > 0) {
            return response(['title' => 'Can Not Be Deleted', 'status' => 'error', 'message' => 'the category can not be deleted becuase its have sub categories']);
        }

        $subCategory->delete();

        toastr('The Sub Category Deleted Successfully Delted');

        return response(['message' => 'The Sub Category Deleted Successfully Delted!']);
    }
}
