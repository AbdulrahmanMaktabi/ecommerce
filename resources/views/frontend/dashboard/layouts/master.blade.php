<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    <link rel="icon" type="{{ asset('frontend/assets') }}/images/png"
        href="{{ asset('frontend/assets') }}/images/favicon.png">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/slick.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/jquery.nice-number.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/jquery.calendar.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/add_row_custon.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/mobile_menu.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/jquery.exzoom.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/multiple-image-video.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/ranger_style.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/jquery.classycountdown.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/venobox.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/responsive.css">
    <!-- <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/rtl.css"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>


    <!--=============================
    DASHBOARD MENU START
  ==============================-->
    @include('frontend.dashboard.layouts.menu')
    <!--=============================
    DASHBOARD MENU END
  ==============================-->


    <!--=============================
    DASHBOARD START
  ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
    DASHBOARD START
  ==============================-->


    <!--============================
      SCROLL BUTTON START
    ==============================-->
    <div class="wsus__scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--============================
    SCROLL BUTTON  END
  ==============================-->


    @include('frontend.dashboard.layouts.scripts')
</body>

</html>
