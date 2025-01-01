@extends('vendor.layouts.master')

@section('content')
    <h3><i class="far fa-user"></i>Edit Variant</h3>
    <div class="wsus__dashboard_profile">
        <div class="wsus__dash_pro_area">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <form action="{{ route('vendor.product-variant.update', ['product_variant' => $variant->id]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $variant->name }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="product_id" value="{{ $variant->product_id }}">
                        </div>
                        <div class="form-group">
                            <label for="">status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1" {{ $variant->status == true ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $variant->status == true ? '' : 'selected' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-2 mx-auto my-4">
                            <input type="submit" class="btn btn-primary form-control" value="Update">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    @endpush
@endsection
