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
                        <h4>Create Child Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.child-category.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ @old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sub_category">Sub Category</label>
                                <select name="sub_category" id="sub_category" class="form-control">
                                    <option value="">Select Subcategory</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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
                $('select[name="category"]').on('change', function() {
                    const categorySlug = $(this).val();
                    const subCategoryDropdown = $('select[name="sub_category"]');

                    subCategoryDropdown.empty(); // Clear existing options

                    if (categorySlug) {
                        $.ajax({
                            url: `/admin/categories/${categorySlug}/sub-categories`,
                            type: 'GET',
                            success: function(data) {
                                subCategoryDropdown.append(
                                    '<option value="">Select Subcategory</option>');
                                $.each(data, function(index, subCategory) {
                                    subCategoryDropdown.append(
                                        `<option value="${subCategory.slug}">${subCategory.name}</option>`
                                    );
                                });
                            },
                            error: function() {
                                toastr.error('Unable to fetch subcategories.');
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
