@extends('frontend.layouts.master')

@section('content')
    <!--============================
                                                                                                                        CHANGE PASSWORD START
                                                                                                                    ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="wsus__change_password">
                            <h4>change password</h4>
                            <div class="wsus__single_pass">
                                <label>current email</label>
                                <input type="text" placeholder="Current Email" name="email"
                                    value="{{ @old('email', $request->email) }}">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            {{-- <div class="wsus__single_pass">
                                <label>current password</label>
                                <input type="password" placeholder="Current Password" name="current_password">
                            </div>
                            <x-input-error :messages="$errors->get('current_password')" class="mt-2" /> --}}

                            <div class="wsus__single_pass">
                                <label>new password</label>
                                <input type="password" placeholder="New Password" name="password">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                            <div class="wsus__single_pass">
                                <label>confirm password</label>
                                <input type="password" placeholder="Confirm Password" name="password_confirmation">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                            <button class="common_btn" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                                                                                        CHANGE PASSWORD END
                                                                                                                    ==============================-->
@endsection
