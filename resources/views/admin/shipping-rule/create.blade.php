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
                        <h4>Create Shipping Rule</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.shippingRule.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ @old('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{ @old('price') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Min Order Value</label>
                                        <input type="text" class="form-control" name="min_order_value"
                                            value="{{ @old('min_order_value') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Max Order Value</label>
                                        <input type="text" class="form-control" name="max_order_value"
                                            value="{{ @old('max_order_value') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Duration</label>
                                        <input type="text" class="form-control" name="duration"
                                            value="{{ @old('duration') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4"> <label for="">Type</label>
                                    <select name="type" id="" class="form-control">
                                        <option value="flat" {{ @old('type') == 'flat' ? 'selected' : '' }}>Flat
                                        </option>
                                        <option value="free" {{ @old('type') == 'free' ? 'selected' : '' }}>Free
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4"> <label for="">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="1" {{ @old('status') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ @old('status') == '0' ? 'selected' : '' }}>Inactive
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
    @endpush
@endsection
