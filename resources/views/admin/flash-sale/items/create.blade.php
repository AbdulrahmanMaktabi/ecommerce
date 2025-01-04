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
                        <h4>Add Items to -{{ $flashSale->name }}-</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.flashSale.items.store', ['flashSaleID' => $flashSale->id]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="categories">Categories</label>
                                    <select id="categories" name="category_id" class="form-control">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-4">
                                    <label for="subCategories">Subcategories</label>
                                    <select id="subCategories" name="subcategory_id" class="form-control">
                                        <option value="" disabled selected>Select Subcategory</option>
                                    </select>
                                </div>

                                <div class="form-group col-4">
                                    <label for="childCategories">Child Categories</label>
                                    <select id="childCategories" name="child_category_id" class="form-control">
                                        <option value="" disabled selected>Select Child Category</option>
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label for="products">Products</label>
                                    <select id="products" name="products[]" class="form-control select2" multiple>
                                        <option value="" disabled selected>Select Products</option>
                                        <!-- Dynamically loaded products will be added here -->
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label for="discounted_prices">Discounted Prices</label>
                                    <div id="discountedPricesContainer">
                                        <!-- Discounted price inputs will be dynamically added here -->
                                    </div>
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

                // Update discounted price inputs dynamically
                $('#products').on('change', function() {
                    const selectedProducts = $(this).val(); // Get selected product IDs
                    const container = $('#discountedPricesContainer');

                    container.empty(); // Clear the container

                    if (selectedProducts && selectedProducts.length > 0) {
                        selectedProducts.forEach(productId => {
                            container.append(`
                    <div class="form-group">
                        <label for="discounted_price_${productId}">Discounted Price for Product ID: ${productId}</label>
                        <input type="number" name="discounted_price[${productId}]" id="discounted_price_${productId}" class="form-control" placeholder="Enter discounted price">
                    </div>
                `);
                        });
                    }
                });
            });

            $('#childCategories').on('change', function() {
                let childCategoryId = $(this).val();
                if (childCategoryId) {
                    $.ajax({
                        url: `/admin/flash-sale/items/product/categories/child-categories/${childCategoryId}/products`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            let productSelect = $('#products');
                            productSelect.empty().append(
                                '<option value="" disabled selected>Select Products</option>');
                            if (data.length > 0) {
                                $.each(data, function(key, product) {
                                    productSelect.append(
                                        `<option value="${product.id}">${product.name}</option>`
                                    );
                                });
                            } else {
                                productSelect.append(
                                    '<option value="" disabled>No Products Available</option>');
                            }
                        },
                        error: function() {
                            alert('Failed to fetch products. Please try again.');
                        }
                    });
                }
            });

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
