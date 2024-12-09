@extends('frontend.layouts.master')

@section('content')
    <!--============================
                                                                                                                                                                                                                                                                               LOGIN/REGISTER PAGE START
                                                                                                                                                                                                                                                                            ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item mx-auto" role="presentation">
                                <button class="nav-link active" id="pills-profile-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-profiles" type="button" role="tab"
                                    aria-controls="pills-profiles" aria-selected="true">Register</button>
                            </li>
                            <li class="nav-item mx-auto text-center" role="presentation">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                aria-labelledby="pills-home-tab2">
                                {{-- Signup --}}
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input type="text" placeholder="Name" name="name">
                                        </div>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input type="text" placeholder="Username" name="username">
                                        </div>
                                        <x-input-error :messages="$errors->get('username')" class="mt-2" />

                                        <div class="wsus__login_input">
                                            <i class="far fa-envelope"></i>
                                            <input type="text" placeholder="Email" name="email">
                                        </div>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" placeholder="Password" name="password">
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input type="password" placeholder="Confirm Password"
                                                name="password_confirmation">
                                        </div>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                                        <div class="wsus__login_input">
                                            <i class="fas fa-user"></i>
                                            <input type="file" placeholder="image" name="image">
                                        </div>
                                        <x-input-error :messages="$errors->get('image')" class="mt-2" />


                                        <button class="common_btn mt-4" type="submit">signup</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                                                                                                                                                                                                                                               LOGIN/REGISTER PAGE END
                                                                                                                                                                                                                                                                            ==============================-->
@endsection
