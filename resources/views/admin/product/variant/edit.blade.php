@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Products</a></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between">
                        <h4>Edit Variant</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product.variant.update', ['variant' => $variant->id]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $variant->name }}">
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="product_id"
                                    value="{{ $variant->product_id }}">
                            </div>
                            <div class="form-group">
                                <label for="">status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1" {{ $variant->status == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $variant->status == '1' ? '' : 'selected' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group col-2 mx-auto">
                                <input type="submit" class="btn btn-primary form-control" value="edit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
