<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function Termwind\render;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return  $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => ['required', 'not_in:empty'],
            'name' => ['required', 'unique:categories,name'],
            'status' => ['required']
        ], [[
            'icon.not_in' => 'The Icon Is Empty',
        ]]);

        $data['slug'] = Str::slug($data['name']);
        Category::create($data);

        toastr('Category Created Successfully');

        return to_route('admin.category.index');
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'icon' => ['required', 'not_in:empty'],
            'name' => ['required', 'unique:categories,name,' . $id],
            'status' => ['required']
        ], [[
            'icon.not_in' => 'The Icon Is Empty',
        ]]);

        $category = Category::findOrFail($id);
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);
        toastr('Category Updated Successfully');
        return to_route('admin.category.index');
    }

    /**
     * Update the specified resource status
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'slug' => 'required|exists:categories,slug',
            'status' => 'required|boolean'
        ]);

        $category = Category::where('slug', $request->slug)->firstOrFail();
        $category->status = $request->status;
        $category->save();

        return response()->json(['message' => 'Category status updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $subCategories = SubCategory::where('category_id', $category->id)->count();

        if ($subCategories > 0) {
            return response(['title' => 'Can Not Be Deleted', 'status' => 'error', 'message' => 'the category can not be deleted becuase its have sub categories']);
        }

        $category->delete();

        toastr('The Category Deleted Successfully');
        return response(['status' => 'success', 'message' => 'the category deleted succssfully']);
    }
}
