@extends('vendor.layouts.master')

@section('content')
    <section class="section">

        <div class="row my-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Upload Images</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('vendor.product-image-gallery.store') }}" method="post"
                            enctype="multipart/form-data" mul>
                            @csrf
                            <div class="form-group">
                                <label for="">Images</label>
                                <code>(multiple file upload)</code>
                                <input type="file" name="image[]" class="form-control" multiple>
                                <input type="hidden" name="product" value="{{ $product->id }}">
                            </div>
                            <div class="form-group my-4">
                                <div class="col-md-1">
                                    <input type="submit" value="Submit" class="form-control btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between">
                        <h4>Product Image Gallery Table</h4>
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">create new</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endsection
