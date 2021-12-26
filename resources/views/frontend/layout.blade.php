<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="description" content="Name of your web site">
    <meta name="author" content="Shadhin Ahmed">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Shadhin Ahmed | Full Stack Web Developer</title>

    <!-- STYLES -->
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/colors.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}" />
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/dark.css') }}" />-->
    <!--[if lt IE 9]> <script type="text/javascript" src="{{ asset('frontend/js/modernizr.custom.js') }}"></script> <![endif]-->
    <!-- /STYLES -->
    @laravelPWA
</head>

<body>

    <!-- PRELOADER -->
    {{-- <div id="preloader">
		<div class="loader_line"></div>
	</div> --}}
    <!-- /PRELOADER -->

    <!-- WRAPPER ALL -->
    <div class="myfolio__all_wrap" data-magic-cursor="show" data-color="sky">

        <!-- MAGIC CURSOR VALUES: "", hide -->
        <!-- COLOR VALUES: blue, green, brown, pink, orange, black, white, purple, sky, cadetBlue, crimson, olive, red -->

        <!-- SETTINGS -->
        <!-- <div class="myfolio__settings">
   <div class="icon">
    <img class="svg" src="{{ asset('frontend') }}/img/svg/setting.svg" alt="" />
    <a class="link" href="#"></a>
   </div>
   <div class="wrapper">
    <span class="title">Unlimited Colors</span>
    <ul class="colors">
     <li><a class="blue" href="#"></a></li>
     <li><a class="green" href="#"></a></li>
     <li><a class="brown" href="#"></a></li>
     <li><a class="pink" href="#"></a></li>
     <li><a class="orange" href="#"></a></li>
     <li class="bl"><a class="black" href="#"></a></li>
     <li class="wh"><a class="white" href="#"></a></li>
     <li><a class="purple" href="#"></a></li>
     <li><a class="sky" href="#"></a></li>
     <li><a class="cadetBlue" href="#"></a></li>
     <li><a class="crimson" href="#"></a></li>
     <li><a class="olive" href="#"></a></li>
     <li><a class="red" href="#"></a></li>
    </ul>
    <span class="title">Magic Cursor</span>
    <ul class="cursor">
     <li><a class="showme show" href="#"></a></li>
     <li><a class="hide" href="#"><img class="svg" src="img/svg/arrow.svg" alt="" /></a></li>
    </ul>
   </div>
  </div> -->
        <!-- /SETTINGS -->

        <!-- MODALBOX -->
        <div class="myfolio__modalbox">
            <div class="box_inner">
                <div class="close">
                    <a href="#"><img class="svg" src="{{ asset('frontend/img/svg/cancel.svg') }}"
                            alt="" /></a>
                </div>
                <div class="description_wrap"></div>
            </div>
        </div>
        <!-- /MODALBOX -->

        <!-- TOPBAR -->
        <div class="myfolio__topbar">
            <div class="topbar_inner">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('frontend/img/logo/logo.png') }}" alt="Logo" />
                    </a>
                </div>
                <div class="menu">
                    <div class="list">
                        <ul class="anchor_nav">
                            <li class="current"><a href="#home">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#service">Services</a></li>
                            <li><a href="#portfolio">Portfolio</a></li>
                            <li><a href="#news">News</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                    <div class="trigger">
                        <div class="hamburger hamburger--slider">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /TOPBAR -->

        @include('frontend.navbar')

        @yield('content')

        <!-- AUDIO FOR CLICK -->
        <audio id="audio1">
            <source src="{{ asset('frontend/audio/1.mp3') }}">
        </audio>
        <audio id="audio2">
            <source src="{{ asset('frontend/audio/2.mp3') }}">
        </audio>
        <!-- /AUDIO FOR CLICK -->

        <!-- MAGIC CURSOR -->
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>
        <!-- /MAGIC CURSOR -->

    </div>
    <!-- / WRAPPER ALL -->

    <!-- SCRIPTS -->
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <!--[if lt IE 10]> <script type="text/javascript" src="{{ asset('frontend/js/ie8.js') }}"></script> <![endif]-->
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>
    <script src="{{ asset('frontend/js/init.js') }}"></script>

    <!-- /SCRIPTS -->

</body>

</html>
