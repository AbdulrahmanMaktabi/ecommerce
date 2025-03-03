@extends('frontend.layouts.master')

@section('content')
    <!--============================
                                                                                    FORGET PASSWORD START
                                                                                ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__forget_area">
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        @if (session('status'))
                            @php
                                toastr()->success(session('status'));
                            @endphp
                        @endif
                        <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                        <h4>forget password ?</h4>
                        <p>enter the email address to register with <span>e-shop</span></p>
                        <div class="wsus__login">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="wsus__login_input">
                                    <i class="fal fa-envelope"></i>
                                    <input type="text" placeholder="Your Email" name="email">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                <button class="common_btn" type="submit">send</button>
                            </form>
                        </div>
                        <a class="see_btn mt-4" href="{{ route('login') }}">go to login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                                                    FORGET PASSWORD END
                                                                                ==============================-->
@endsection
