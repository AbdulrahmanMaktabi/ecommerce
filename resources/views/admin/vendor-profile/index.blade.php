@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vendor Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Vendor Profile</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('admin.vendor.profile.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Vendor Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Store Name</label>
                                        <input type="text" class="form-control" name="store_name"
                                            value="{{ $vendor->store_name }}">
                                        <div class="invalid-feedback">
                                            Please fill in the store name
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $vendor->email }}">
                                        <div class="invalid-feedback">
                                            Please fill in the email
                                        </div>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ $vendor->phone }}">
                                        <div class="invalid-feedback">
                                            Please fill in the phone number
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Status</label>
                                        <select class="form-control" name="status" id="">
                                            <option value="1" {{ $vendor->status == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $vendor->status == '1' ? '' : 'selected' }}>Inactive
                                            </option>
                                        </select>
                                        <x-input-error :messages="$errors->get('status')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4 col-12">
                                        <label>FaceBook Link</label>
                                        <input type="text" class="form-control" name="fb_link"
                                            value="{{ $vendor->fb_link }}">
                                        <div class="invalid-feedback">
                                            Please fill in the facebook link
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>X Link</label>
                                        <input type="text" class="form-control" name="x_link"
                                            value="{{ $vendor->x_link }}">
                                        <div class="invalid-feedback">
                                            Please fill in the X link
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Instagram Link</label>
                                        <input type="text" class="form-control" name="insta_link"
                                            value="{{ $vendor->insta_link }}">
                                        <div class="invalid-feedback">
                                            Please fill in the instagram link
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="banner">Banner</label>
                                        <img src="{{ asset($vendor->banner) }}" alt="" width="120px">
                                        <input type="file" id="banner" class="form-control" name="banner">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="description">Store Description</label>
                                        <textarea id="description" class="summernote" name="description">{{ $vendor->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Edit password --}}
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('admin.passwordUpdate') }}">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Current Password</label>
                                        <input type="password" class="form-control" name="current_password">
                                        <div class="invalid-feedback">
                                            Please fill in the current password
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password">
                                        <div class="invalid-feedback">
                                            Please fill in the password
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                        <div class="invalid-feedback">
                                            Please fill in the confirm password
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
