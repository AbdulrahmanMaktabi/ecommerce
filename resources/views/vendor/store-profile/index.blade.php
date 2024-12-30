@extends('vendor.layouts.master')

@section('content')
    <h3><i class="far fa-user"></i> profile</h3>
    <div class="wsus__dashboard_profile">
        <div class="wsus__dash_pro_area">
            <h4>basic information</h4>
            <div class="row">
                <div class="col-xl-9">
                    <form action="{{ route('vendor.store-profile.update', ['store_profile' => $vendor->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="col-xl-3 col-sm-6 col-md-6 my-4 max-w-4">
                            <div class="wsus__dash_pro_img">
                                <img src="{{ $vendor->banner }}" alt="img" class="img-fluid w-100">
                                <input type="file" name="banner">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-user-tie"></i>
                                    <input type="text" placeholder="store name" name="store_name"
                                        value="{{ $vendor->store_name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="wsus__dash_pro_single">
                                    <i class="fal fa-envelope-open"></i>
                                    <input type="email" placeholder="Email" name="email" value="{{ $vendor->email }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="wsus__dash_pro_single">
                                    <i class="fal fa-phone"></i>
                                    <input type="text" placeholder="phone" name="phone" value="{{ $vendor->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="wsus__dash_pro_single">
                                    <i class="fab fa-facebook"></i>
                                    <input type="text" placeholder="Facebook Link" name="fb_link"
                                        value="{{ $vendor->fb_link }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="wsus__dash_pro_single">
                                    <i class="fab fa-instagram"></i>
                                    <input type="text" placeholder="Instagram Link" name="insta_link"
                                        value="{{ $vendor->insta_link }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="wsus__dash_pro_single">
                                    <i class="fab fa-twitter"></i>
                                    <input type="text" placeholder="X Link" name="x_link" value="{{ $vendor->x_link }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="wsus__dash_pro_single">
                                <textarea name="description">{{ $vendor->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <input type="submit" class="common_btn mb-4 mt-2" value="Edit">
                        </div>
                    </form>

                </div>

                <form action="{{ route('vendor.password.update') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="wsus__dash_pass_change mt-2">
                        <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-unlock-alt"></i>
                                    <input type="password" placeholder="Current Password" name="current_password">
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-lock-alt"></i>
                                    <input type="password" placeholder="New Password" name="password">
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-lock-alt"></i>
                                    <input type="password" placeholder="Confirm Password" name="password_confirmation">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <input type="submit" class="common_btn" value="submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
