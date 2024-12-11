@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Slider</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between">
                        <h4>Edit Slider</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.slider.update', ['slider' => $slider->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            @if ($slider->banner)
                                <div class="form-group">
                                    <img src="{{ asset($slider->banner) }}" width="165px" alt="">
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="">banner</label>
                                <input type="file" class="form-control" name="banner">
                            </div>
                            <div class="form-group">
                                <label for="">type</label>
                                <input type="text" class="form-control" name="type" value="{{ $slider->type }}">
                            </div>
                            <div class="form-group">
                                <label for="">title</label>
                                <input type="text" class="form-control" name="title" value="{{ $slider->title }}">
                            </div>
                            <div class="form-group">
                                <label for="">starting price</label>
                                <input type="text" class="form-control" name="starting_price"
                                    value="{{ $slider->starting_price }}">
                            </div>
                            <div class="form-group">
                                <label for="">button url</label>
                                <input type="text" class="form-control" name="btn_url" value="{{ $slider->btn_url }}">
                            </div>
                            <div class="form-group">
                                <label for="">serial</label>
                                <input type="text" class="form-control" name="serial" value="{{ $slider->serial }}">
                            </div>
                            <div class="form-group">
                                <label for="">status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1" {{ $slider->status == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $slider->status == '0' ? 'selected' : '' }}>Inactive</option>
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
@endsection
