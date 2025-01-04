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
                        <h4>Create Flash Sale</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.flashSale.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ @old('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Start Date</label>
                                        <input type="date" class="form-control" name="start_time"
                                            value="{{ @old('start_time') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">End Date</label>
                                        <input type="date" class="form-control" name="end_time"
                                            value="{{ @old('end_time') }}">
                                    </div>
                                </div>
                                <div class="col-md-6"> <label for="">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="1" {{ @old('status') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ @old('status') == '1' ? '' : 'selected' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6"> <label for="">Show On Home Page</label>
                                    <select name="show_on_home" id="" class="form-control">
                                        <option value="1" {{ @old('show_on_home') == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0" {{ @old('show_on_home') == '1' ? '' : 'selected' }}>No
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-2 my-5 mx-auto">
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
