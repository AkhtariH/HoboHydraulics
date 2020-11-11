<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="" >
    <meta name="author" content="Hemran Akhtari">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Meta Responsive tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <!--Custom style.css-->
    <link rel="stylesheet" href="{{ asset('/css/quicksand.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <!--Font Awesome-->
    <link rel="stylesheet" href="{{ asset('/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fontawesome.css') }}">

    <!--Animate CSS-->
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}">
    <!--Chartist CSS-->
    <link rel="stylesheet" href="{{ asset('/css/chartist.min.css') }}">
    <!--Map-->
    <link rel="stylesheet" href="{{ asset('/css/jquery-jvectormap-2.0.2.css') }}">
    <!--Bootstrap Calendar-->
    <link rel="stylesheet" href="{{ asset('/js/calendar/bootstrap_calendar.css') }}">
    <!--Nice select -->
    <link rel="stylesheet" href="{{ asset('/css/nice-select.css') }}">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title>HoboHydrauliek BV - @yield('title')</title>
  </head>

<body>
    <!--Page loader-->
    <div class="loader-wrapper">
        <div class="loader-circle">
            <div class="loader-wave"></div>
        </div>
    </div>
    <!--Page loader-->

    <!--Page Wrapper-->

    <div class="container-fluid">

        @section('header')
        <!--Header-->
        <div class="row header shadow-sm">
            <!--Logo-->
            <div class="col-sm-3 pl-0 text-center header-logo">
                <div class="bg-theme mr-3 pt-3 pb-2 mb-0">
                    <h3 class="logo"><a href="{{ route('show.dashboard') }}" class="text-secondary logo"><i class="fa fa-dashboard"></i> HoboHydrauliek<span class="small"> Dashboard</span></a></h3>
                </div>
            </div>
            <!--Logo-->

            <!--Header Menu-->
            <div class="col-sm-9 header-menu pt-2 pb-0">
                <div class="row">
                    <!--Search box and avatar-->
                    <div class="col-sm-12 col-4 text-right flex-header-menu justify-content-end">
                        <div class="mr-4">
                            <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('/img/default-avatar.jpg') }}" alt="default-avatar" class="rounded-circle" width="40px" height="40px">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mt-13" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#"><i class="fa fa-user pr-2"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fa fa-th-list pr-2"></i> Tasks</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('user.logout') }}"><i class="fa fa-power-off pr-2"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <!--Search box and avatar-->
                </div>
            </div>
            <!--Header Menu-->
        </div>
        <!--Header-->
        @show

        <!--Main Content-->

        <div class="row main-content">
            @section('sidebar')
            <!--Sidebar left-->
            <div class="col-sm-3 col-xs-6 sidebar pl-0">
                <div class="inner-sidebar mr-3">
                    <!--Image Avatar-->
                    <div class="avatar text-center">
                        <img src="{{ asset('/img/default-avatar.jpg') }}" alt="" class="rounded-circle" />
                        <p><strong>Welcome<br>{{ ucfirst(Auth()->user()->name) }}!</strong></p>
                        <span class="text-danger small"><strong>{{ ucfirst(Auth()->user()->type) }}</strong></span>
                    </div>
                    <!--Image Avatar-->

                    <!--Sidebar Navigation Menu-->
                    <div class="sidebar-menu-container">
                        @if (Route::is('show.dashboard'))
                                @if (Auth()->user()->isAdmin())
                                    <ul class="sidebar-menu mt-4 mb-4">
                                        <li class="parent">
                                            <a href="{{ route('admin.index') }}" class=""><i class="fas fa-toolbox mr-3"></i>
                                                <span class="none">Admin Panel</span>
                                            </a>
                                        </li>
                                    </ul>                            
                                @endif
                                <ul class="sidebar-menu mt-4 mb-4">
                                    <li class="parent">
                                        <a href="#" class=""><i class="fa fa-puzzle-piece mr-3"></i>
                                            <span class="none">My Profile</span>
                                        </a>
                                    </li>
                                    <li class="parent">
                                        <a href="#" onclick="toggle_menu('dashboard'); return false" class=""><i class="fa fa-dashboard mr-3"> </i>
                                            <span class="none">Bridges<i class="fa fa-angle-down pull-right align-bottom"></i></span>
                                        </a>
                                        <ul class="children" id="dashboard">
                                            @foreach ($bridges as $bridge) 
                                                <li class="child"><a href="" class="ml-4"><i class="fa fa-angle-right mr-2"></i>{{ $bridge->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="parent">
                                        <a href="#" class=""><i class="fa fa-puzzle-piece mr-3"></i>
                                            <span class="none">Tasks</span>
                                        </a>
                                    </li>
                                </ul>
                        @endif

                        {{-- Admin Panel --}}
                        @if (Route::is('admin.*'))
                                <ul class="sidebar-menu mt-4 mb-4">
                                    <li class="parent">
                                        <a href="{{ route('admin.index') }}" class=""><i class="fas fa-tachometer-alt mr-3"></i>
                                            <span class="none">Admin Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="parent">
                                        <a href="{{ url('admin/user') }}" class=""><i class="fas fa-users mr-3"></i>
                                            <span class="none">Manage users</span>
                                        </a>
                                    </li>
                                    <li class="parent">
                                        <a href="{{ url('admin/bridge') }}" class=""><i class="fas fa-edit mr-3"></i>
                                            <span class="none">Manage bridges</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="sidebar-menu mt-4 mb-4">
                                    <li class="parent">
                                        <a href="{{ route('show.dashboard') }}" class=""><i class="fas fa-chevron-left mr-3"></i>
                                            <span class="none">Dashboard</span>
                                        </a>
                                    </li>
                                </ul>
                        @endif
                    </div>
                    <!--Sidebar Naigation Menu-->
                </div>
            </div>
            <!--Sidebar left-->
            @show


            <!--Content right-->
            <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
                @yield('content')
            </div>
            <!--Main Content-->

        </div>

        <!--Page Wrapper-->

        @section('inclusions')
        <!-- Page JavaScript Files-->
        <script src="{{ asset('/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/jquery-1.12.4.min.js') }}"></script>
        <!--Popper JS-->
        <script src="{{ asset('/js/popper.min.js') }}"></script>
        <!--Bootstrap-->
        <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
        <!--Sweet alert JS-->
        <script src="{{ asset('/js/sweetalert.js') }}"></script>
        <!--Progressbar JS-->
        <script src="{{ asset('/js/progressbar.min.js') }}"></script>
        <!--Flot.JS-->
        <script src="{{ asset('/js/charts/jquery.flot.min.js') }}"></script>
        <script src="{{ asset('/js/charts/jquery.flot.pie.min.js') }}"></script>
        <script src="{{ asset('/js/charts/jquery.flot.categories.min.js') }}"></script>
        <script src="{{ asset('/js/charts/jquery.flot.stack.min.js') }}"></script>
        <!--Chart JS-->
        <script src="{{ asset('/js/charts/chart.min.js') }}"></script>
        <!--Chartist JS-->
        <script src="{{ asset('/js/charts/chartist.min.js') }}"></script>
        <script src="{{ asset('/js/charts/chartist-data.js') }}"></script>
        <script src="{{ asset('/js/charts/demo.js') }}"></script>
        <!--Maps-->
        <script src="{{ asset('/js/maps/jquery-jvectormap-2.0.2.min.js') }}"></script>
        <script src="{{ asset('/js/maps/jquery-jvectormap-nl-merc.js') }}"></script>
        <script src="{{ asset('/js/maps/jvector-maps.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
        <script src="{{ asset('/js/maps/google-map-data.js') }}"></script>
        <!--Bootstrap Calendar JS-->
        <script src="{{ asset('/js/calendar/bootstrap_calendar.js') }}"></script>
        <script src="{{ asset('/js/calendar/demo.js') }}"></script>
        <!--Nice select-->
        <script src="{{ asset('/js/jquery.nice-select.min.js') }}"></script>

        <!--Custom Js Script-->
        <script src="{{ asset('/js/custom.js') }}"></script>
        <!--Custom Js Script-->
        <script>
            //Nice select
            $('.bulk-actions').niceSelect();
        </script>
        @show
</body>

</html>