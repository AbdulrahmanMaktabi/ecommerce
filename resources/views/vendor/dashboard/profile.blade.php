@extends('vendor.dashboard.layouts.master')

@section('content')
    <h3><i class="far fa-user"></i> profile</h3>
    <div class="wsus__dashboard_profile">
        <div class="wsus__dash_pro_area">
            <h4>basic information</h4>
            <div class="row">
                <div class="col-xl-9">
                    <form action="{{ route('vendor.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="col-xl-3 col-sm-6 col-md-6 my-4 max-w-4">
                            <div class="wsus__dash_pro_img">
                                <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('uploads/1087674397_02 (1).jpg') }}"
                                    alt="img" class="img-fluid w-100">
                                <input type="file" name="image">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-user-tie"></i>
                                    <input type="text" placeholder="Username" name="username"
                                        value="{{ Auth::user()->username }}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fal fa-envelope-open"></i>
                                    <input type="email" placeholder="Email" name="email"
                                        value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <input type="submit" class="common_btn mb-4 mt-2" value="submit">
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
