@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between">
                        <h4>Create Product</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ @old('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Thumb Image</label>
                                        <input type="file" name="thumb_image" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Quantity
                                        </label>
                                        <input type="text" class="form-control" name="qty"
                                            value="{{ @old('qty') }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{ @old('price') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price After Offer</label>
                                        <input type="text" name="offer_price" value="{{ @old('offer_price') }}"
                                            class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6"> <label for="">Product Short Description</label>
                                        <input type="text" name="short_description" class="form-control" id=""
                                            value="{{ @old('short_description') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Product Long Description</label>
                                <textarea name="long_description" class="summernote" id="" cols="30" rows="10">{{ @old('long_description') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Offer Start</label>
                                        <input type="date" class="form-control" name="offer_start_date" id="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Offer End</label>
                                        <input type="date" class="form-control" name="offer_end_date" id="">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"> <label for="">Vendor</label>
                                        <select name="vendor_id" id="" class="form-control">
                                            @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->id }}">
                                                    {{ $vendor->store_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4"> <label for="">Brand</label>
                                        <select name="brand_id" id="" class="form-control">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="1" {{ @old('status') == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ @old('status') == '1' ? '' : 'selected' }}>
                                                Inactive
                                            </option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="categories">Category</label>
                                        <select name="category_id" id="categories" class="form-control">
                                            <option value="#" disabled selected>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="subCategories">Sub Category</label>
                                        <select name="subCategory_id" id="subCategories" class="form-control">
                                            <option value="" disabled selected>Select Sub Category</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="childCategories">Child Category</label>
                                        <select name="childCategory_id" id="childCategories" class="form-control">
                                            <option value="" disabled selected>Select Child Category</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"> <label for="">is top</label>
                                        <select name="is_top" id="" class="form-control">
                                            <option value="1" {{ @old('is_top') == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ @old('is_top') == '1' ? '' : 'selected' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3"> <label for="">is best</label>
                                        <select name="is_best" id="" class="form-control">
                                            <option value="1" {{ @old('is_best') == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ @old('is_best') == '1' ? '' : 'selected' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3"> <label for="">is featured</label>
                                        <select name="is_featured" id="" class="form-control">
                                            <option value="1" {{ @old('is_featured') == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ @old('is_featured') == '1' ? '' : 'selected' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3"> <label for="">is approved</label>
                                        <select name="is_approved" id="" class="form-control">
                                            <option value="1" {{ @old('is_approved') == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ @old('is_approved') == '1' ? '' : 'selected' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">SKU</label>
                                        <input type="text" class="form-control" name="sku"
                                            value="{{ @old('sku') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Video Link</label>
                                        <input type="text" class="form-control" name="video_link"
                                            value="{{ @old('video_link') }}">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6"> <label for="">SEO Title</label>
                                        <input type="text" name="seo_title" class="form-control" id=""
                                            value="{{ @old('seo_title') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">SEO Description</label>
                                <textarea name="seo_description" class="summernote" id="" cols="30" rows="10">{{ @old('seo_description') }}</textarea>
                            </div>

                            <div class="form-group col-2 mx-auto">
                                <input type="submit" class="btn btn-primary form-control" value="create">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $(document).ready(function() {
                // Update subcategories when a category is selected
                $('#categories').on('change', function() {
                    let categoryId = $(this).val();
                    if (categoryId) {
                        $.ajax({
                            url: `/admin/product/categories/${categoryId}/sub-categories`,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                let subCategorySelect = $('#subCategories');
                                subCategorySelect.empty().append(
                                    '<option value="" disabled selected>Select Sub Category</option>'
                                );
                                if (data.length > 0) {
                                    $.each(data, function(key, subCategory) {
                                        subCategorySelect.append(
                                            `<option value="${subCategory.id}">${subCategory.name}</option>`
                                        );
                                    });
                                } else {
                                    subCategorySelect.append(
                                        '<option value="" disabled>No Subcategories Available</option>'
                                    );
                                }
                                $('#childCategories').empty().append(
                                    '<option value="" disabled selected>Select Child Category</option>'
                                );
                            },
                            error: function() {
                                console.log('error');

                                alert('Failed to fetch subcategories. Please try again.');
                            }
                        });
                    }
                });

                // Update child categories when a subcategory is selected
                $('#subCategories').on('change', function() {
                    let subCategoryId = $(this).val();
                    if (subCategoryId) {
                        $.ajax({
                            url: `/admin/product/categories/sub-categories/${subCategoryId}/child-categories`,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                let childCategorySelect = $('#childCategories');
                                // Clear and reset the child categories dropdown
                                childCategorySelect.empty().append(
                                    '<option value="" disabled selected>Select Child Category</option>'
                                );
                                if (data.length > 0) {
                                    // Populate the dropdown with child categories
                                    $.each(data, function(key, childCategory) {
                                        childCategorySelect.append(
                                            `<option value="${childCategory.id}">${childCategory.name}</option>`
                                        );
                                    });
                                } else {
                                    // No child categories available
                                    childCategorySelect.append(
                                        '<option value="" disabled>No Child Categories Available</option>'
                                    );
                                }
                            },
                            error: function() {
                                console.log('error');
                                alert('Failed to fetch child categories. Please try again.');
                            }
                        });
                    }
                });

            });
        </script>
    @endpush
@endsection
