@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ Auth::user()->username }}!</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('admin.profileUpdate') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <img style="max-width: 100px; border-radius:50%; margin:15px;"
                                            src="{{ asset(Auth::user()->image) }}" alt="">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control" id="">
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Auth::user()->name }}">
                                        <div class="invalid-feedback">
                                            Please fill in the full name
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ Auth::user()->email }}">
                                        <div class="invalid-feedback">
                                            Please fill in the email
                                        </div>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-0 col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input"
                                                id="newsletter">
                                            <label class="custom-control-label" for="newsletter">Subscribe to
                                                newsletter</label>
                                            <div class="text-muted form-text">
                                                You will get new information about products, offers and promotions
                                            </div>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
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
