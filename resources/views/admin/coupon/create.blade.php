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
                        <h4>Create New Coupon</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.coupon.store') }}" method="post" enctype="multipart/form-data">
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
                                        <label for="">Code</label>
                                        <input type="text" class="form-control" name="code"
                                            value="{{ @old('code') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Quantity</label>
                                        <input type="text" class="form-control" name="used_count"
                                            value="{{ @old('used_count') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Max Use Per User</label>
                                        <input type="text" class="form-control" name="usage_limit"
                                            value="{{ @old('usage_limit') }}">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4"> <label for="">Discount Type</label>
                                    <select name="discount_type" id="" class="form-control">
                                        <option value="percentage" {{ @old('status') == '1' ? 'selected' : '' }}>
                                            percentage (%)
                                        </option>
                                        <option value="amount" {{ @old('status') == '1' ? '' : 'selected' }}>amount ($)
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Discount Amount</label>
                                        <input type="text" name="discount_amount" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4"> <label for="">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="1" {{ @old('status') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ @old('status') == '1' ? '' : 'selected' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Start Date</label>
                                        <input type="date" class="form-control" name="start_date"
                                            value="{{ @old('start_time') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">End Date</label>
                                        <input type="date" class="form-control" name="end_date"
                                            value="{{ @old('end_time') }}">
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
    @endpush
@endsection
