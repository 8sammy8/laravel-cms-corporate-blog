<!DOCTYPE html>
<html lang="{{ \Illuminate\Support\Facades\App::getLocale() }}">

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    <meta name="description" content="{{ $meta_desc ?? '' }}"/>
    <meta name="keywords" content="{{ $keywords ?? '' }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:title" content="{{ $title ?? config('app.name') }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/ico/apple-touch-icon-144.png') }}" />
    <meta property="og:locale" content="en_GB" />
    <meta property="og:locale:alternate" content="ru_RU" />
    <meta property="og:locale:alternate" content="uz_UZ" />
    <meta property="og:locale:alternate" content="oz_UZ" />

    <!-- Load Roboto font -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet'
          type='text/css'>
    <!-- Load css styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset(config('theme.desktop')) }}/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset(config('theme.desktop')) }}/css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset(config('theme.desktop')) }}/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset(config('theme.desktop')) }}/css/pluton.css"/>
    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="{{ asset(config('theme.desktop')) }}/css/pluton-ie7.css"/>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{ asset(config('theme.desktop')) }}/css/jquery.cslider.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset(config('theme.desktop')) }}/css/jquery.bxslider.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset(config('theme.desktop')) }}/css/animate.css"/>
    <!-- Fav and touch icons -->

    @stack('css')

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/ico/apple-touch-icon-144.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/ico/apple-touch-icon-114.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/ico/apple-touch-icon-72.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/ico/apple-touch-icon-57.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/ico/favicon.ico') }}">
</head>

<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <a href="{{ route('home.index') }}" class="brand">
                <img src="{{ asset('images/logo-desktop.png') }}" width="120" height="40" alt="Logo"/>
                <!-- This is website logo -->
            </a>
            <!-- Navigation button, visible on small resolution -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <i class="icon-menu"></i>
            </button>
            <!-- Main navigation -->

                @include(config('theme.desktop') . '.layouts.navigation')

            <!-- End main navigation -->
        </div>
    </div>
</div>
<!-- Start home section -->
<div id="home">
    <!-- Start cSlider -->
       @yield('slider')
    <!-- End cSlider -->
</div>
<!-- End home section -->

<!-- Start content -->
        @stack('content')
    <!-- Blog section start -->
        @yield('blog.bar')

        @yield('blog.posts')
    <!-- Blog section end -->

    <!-- Service section start -->
        @yield('layouts.service')
    <!-- Service section end -->

        @yield('price.tariff')

        @yield('layouts.portfolio')

    <!-- About us section start -->
        @yield('layouts.about')
    <!-- About us section end -->

    <!-- About us section start -->
        @yield('layouts.purchase')
    <!-- About us section end -->

    <!-- Client section start -->
        @include(config('theme.desktop') . '.layouts.clients')
    <!-- Client section end -->


    <!-- Price section start -->
        @yield('layouts.price')
    <!-- Price section end -->
<!-- End content -->

<!-- Newsletter section start -->
    @include(config('theme.desktop') . '.layouts.newsletter')
<!-- Newsletter section end -->
<!-- Contact section start -->
    @include(config('theme.desktop') . '.layouts.contact')
<!-- Contact section edn -->
<!-- Footer section start -->
<div class="footer">
    <p>&copy; 2019 All Rights Reserved</p>
</div>
<!-- Footer section end -->
<!-- ScrollUp button start -->
<div class="scrollup">
    <a href="#">
        <i class="icon-up-open"></i>
    </a>
</div>
<!-- ScrollUp button end -->
<!-- Include javascript -->
<script src="{{ asset(config('theme.desktop')) }}/js/jquery.js"></script>
<script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/jquery.mixitup.js"></script>
<script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/bootstrap.js"></script>
<script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/modernizr.custom.js"></script>
<script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/jquery.bxslider.js"></script>
<script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/jquery.cslider.js"></script>
<script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/jquery.inview.js"></script>
<script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/jquery.navigate.js"></script>

@stack('js_bottom')

<!-- Load google maps api and call initializeMap function defined in app.js -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;callback=initializeMap"></script>
<!-- css3-mediaqueries.js for IE8 or older -->
<!--[if lt IE 9]>
<script src="{{ asset(config('theme.desktop')) }}/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/app.js"></script>
</body>
</html>