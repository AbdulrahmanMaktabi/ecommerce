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
                        <h4>Edit Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.update', ['category' => $category->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Icon</label>
                                <div>
                                    <button class="btn btn-primary" role="iconpicker" name="icon"
                                        data-icon="{{ $category->icon }}"></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1" {{ $category->status == '1' ? 'slected' : '' }}>Active</option>
                                    <option value="0" {{ $category->status == '0' ? 'slected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group col-2 mx-auto">
                                <input type="submit" class="btn btn-primary form-control" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
