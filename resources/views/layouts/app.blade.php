<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('title')
    <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toast.style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">


    <script src="{{ asset('js/toast.script.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>

    {{-- Sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-default/default.css" id="theme-styles">
    {{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark/dark.css" id="theme-styles"> --}}
    {{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-borderless/borderless.css" id="theme-styles"> --}}
    {{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-wordpress-admin/wordpress-admin.css" id="theme-styles"> --}}

    @yield('styles')


</head>

<body>

    <div class="flex justify-between">
        <div class="h-screen w-2/12 bg-black fixed left-0 top-0">
            <ul class="text-white px-6 py-6">
                <li class="bg-purple-800 text-white text-center mb-4"><a class="menu-item" target="_blank"
                        href="{{ route('home') }}">Visit Site</a></li>
                <li class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}"><a class="menu-item"
                        href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="{{ request()->is('admin/hero*') ? 'active' : '' }}">
                    <a class="menu-item" href="{{ route('hero') }}">Hero</a>
                </li>

                <li class="{{ request()->is('admin/about*') ? 'active' : '' }}">
                    <a class="menu-item" href="{{ route('about') }}">About</a>

                </li>

                <li class="{{ request()->is('admin/service*') ? 'active' : '' }}">
                    <a class="menu-item" href="{{ route('service') }}">Services</a>

                </li>

                <li class="{{ request()->is('admin/funfacts*') ? 'active' : '' }}"><a class="menu-item"
                        href="{{ route('funfacts') }}">Funfacts</a></li>

                <li class="{{ request()->is('admin/experiences*') ? 'active' : '' }}"><a class="menu-item"
                        href="{{ route('experiences') }}">Experience</a></li>

                <li class="{{ request()->is('admin/portfolio*') ? 'active' : '' }}"><a class="menu-item"
                        href="{{ route('portfolio') }}">Portfolio</a></li>

                <li class="{{ request()->is('admin/categories*') ? 'active' : '' }}"><a class="menu-item"
                        href="{{ route('categories') }}">Categories</a></li>

            </ul>
        </div>
        <div class="w-10/12 ml-auto">
            @include('layouts.message')
            @yield('content')

        </div>
    </div>





    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable({
                searching: false,
                paging: false,
                ordering: false,
                info: false
            });
        });
    </script>

    @yield('scripts')

</body>

</html>
