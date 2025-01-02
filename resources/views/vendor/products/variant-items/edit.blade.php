@extends('vendor.layouts.master')

@section('content')
    <section class="section">

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between">
                        <h4>Update '{{ $item->name }}'</h4>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('vendor.variant.items.update', ['variant_id' => $variant->id, 'variant_item_id' => $item->id]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group my-4">
                                <label for="">Variant Name</label>
                                <input type="text" class="form-control" name="variant_name" disabled
                                    value="{{ $variant->name }}">
                            </div>
                            <div class="form-group my-4">
                                <label for="">Item Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $item->name }}">
                            </div>
                            <div class="form-group my-4">
                                <label for="">Price</label><code>(keep it 0 by defualt)</code>
                                <input type="text" class="form-control" name="price" value="{{ $item->price }}">
                            </div>
                            <div class="form-group my-4">
                                <input type="hidden" class="form-control" name="product_variant_id"
                                    value="{{ $variant->id }}">
                            </div>
                            <div class="form-group">
                                <label for="">Default</label>
                                <select name="is_default" id="" class="form-control">
                                    <option value="1" {{ $item->status == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $item->status == '1' ? '' : 'selected' }}>No</option>
                                </select>
                            </div>
                            <div class="form-group my-4">
                                <label for="">status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1" {{ $item->status == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $item->status == '1' ? '' : 'selected' }}>Inactive</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group col-2 mx-auto my-4">
                        <input type="submit" class="btn btn-primary form-control" value="Update">
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
