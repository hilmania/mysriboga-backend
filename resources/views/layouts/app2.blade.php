<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title> mySriboga {{ $header }}</title>

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('public/assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('public/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('public/assets/layouts/layout/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/layouts/layout/css/themes/darkblue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset('public/assets/layouts/layout/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    
    <link rel="shortcut icon" href="favicon.ico" /> </head>

    @yield('css')
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="#" style="color: #ffffff; margin-top: 12px;">
                        <!-- <img src="" alt="" class="logo-default" /> --> 
                        <span style="color:rgb(54, 198, 211)"> MY </span> SRIBOGA
                        </a>
                    <div class="menu-toggler sidebar-toggler">
                        <span></span>
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown dropdown-user">
                            <a href="{{url('/profile') }}" data-close-others="true">
                                <span class="username username-hide-on-mobile" > {{ Auth::user()->name }} </span>
                                
                            </a>
                        </li>
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            <i class="icon-logout"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                        </li>
                        <!-- END SIDEBAR TOGGLER BUTTON -->
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        
                        <li class="nav-item <?php if ( $title == 'Dashboard' ) echo 'start active open'?>">
                            <a href="{{ url('/home') }}" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                        </li>
                        
                        <li class="nav-item <?php if ( $title == 'Approval' ) echo 'start active open'?>" style="display: <?php if ($user->tipe_user != 4) echo 'none'; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-check"></i>
                                <span class="title">Approval</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ url('/approval/user') }}" class="nav-link ">
                                        <span class="title">Approve Pengguna</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/approval/recipe') }}" class="nav-link ">
                                        <span class="title">Approve Resep</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/approval/product') }}" class="nav-link ">
                                        <span class="title">Approve Produk</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/approval/album') }}" class="nav-link ">
                                        <span class="title">Approve Album</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/approval/training') }}" class="nav-link ">
                                        <span class="title">Approve Pelatihan</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/approval/registran') }}" class="nav-link ">
                                        <span class="title">Approve Pendaftaran Pelatihan</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/approval/berita') }}" class="nav-link ">
                                        <span class="title">Approve Berita</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="heading" style="display: <?php if ($user->tipe_user == 4 || $user->tipe_user == 2 || $user->tipe_user == 3 ) echo 'none'; ?>">
                            <h3 class="uppercase">MANAGEMENT</h3>
                        </li>
                        <li class="nav-item <?php if ( $title == 'Users' || $title == 'Komunitas' ) echo 'start active open'?>" >
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">Pengguna</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ url('/user') }}" class="nav-link ">
                                        <span class="title">List Pengguna</span>
                                    </a>
                                </li>
                                <li class="nav-item" style="display: <?php if ($user->tipe_user > 0 ) echo 'none'; ?>">
                                    <a href="{{ url('/user/form') }}" class="nav-link ">
                                        <span class="title">Tambah Pengguna</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/user/community') }}" class="nav-link ">
                                        <span class="title">List Komunitas</span>
                                    </a>
                                </li>
                                <li class="nav-item" style="display: <?php if ($user->tipe_user > 0 ) echo 'none'; ?>">
                                    <a href="{{ url('/user/community/form') }}" class="nav-link ">
                                        <span class="title">Tambah Komunitas</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?php if ( $title == 'Recipe' ) echo 'start active open'?>" style="display: <?php if ($user->tipe_user > 1 ) echo 'none'; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-puzzle"></i>
                                <span class="title">Resep</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ url('/recipe') }}" class="nav-link ">
                                        <span class="title">List Resep</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/recipe/form') }}" class="nav-link ">
                                        <span class="title">Tambah Resep</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?php if ( $title == 'Product' ) echo 'start active open'?>" style="display: <?php if ($user->tipe_user > 1 ) echo 'none'; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-diamond"></i>
                                <span class="title">Produk</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ url('/product') }}" class="nav-link ">
                                        <span class="title">List Produk</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/product/form') }}" class="nav-link ">
                                        <span class="title">Tambah Produk</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/product/category') }}" class="nav-link ">
                                        <span class="title">List Kategori</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/product/category/form') }}" class="nav-link ">
                                        <span class="title">Tambah Kategori</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?php if ( $title == 'Training' ) echo 'start active open'?>" style="display: <?php if ($user->tipe_user > 1 ) echo 'none'; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-calendar"></i>
                                <span class="title">Pelatihan</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ url('/training') }}" class="nav-link ">
                                        <span class="title">List Pelatihan</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/training/form') }}" class="nav-link ">
                                        <span class="title">Tambah Pelatihan</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item <?php if ( $title == 'Gallery' ) echo 'start active open'?>" style="display: <?php if ($user->tipe_user > 1 ) echo 'none'; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-picture"></i>
                                <span class="title">Gallery </span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ url('/gallery') }}" class="nav-link ">
                                        <span class="title">List Gallery</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/gallery/form') }}" class="nav-link ">
                                        <span class="title">Tambah Gallery</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item <?php if ( $title == 'News' ) echo 'start active open'?>" style="display: <?php if ($user->tipe_user > 1 ) echo 'none'; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-puzzle"></i>
                                <span class="title">Berita</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ url('/berita') }}" class="nav-link ">
                                        <span class="title">List Berita</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/berita/form') }}" class="nav-link ">
                                        <span class="title">Tambah Berita</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?php if ( $title == 'Forum' ) echo 'start active open'?>" style="display: <?php if ($user->tipe_user > 1 ) echo 'none'; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-puzzle"></i>
                                <span class="title">Forum</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ url('/forumScc') }}" class="nav-link ">
                                        <span class="title">List Forum Scc</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/forumUkm') }}" class="nav-link ">
                                        <span class="title">List Forum Ukm</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item <?php if ( $title == 'Info' ) echo 'start active open'?>" style="display: <?php if ($user->tipe_user > 1 ) echo 'none'; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-question"></i>
                                <span class="title">Info </span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ url('/about/form') }}" class="nav-link ">
                                        <span class="title">About</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/faq') }}" class="nav-link ">
                                        <span class="title">FAQ</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item <?php if ( $title == 'General' ) echo 'start active open'?>" style="display: <?php if ($user->tipe_user > 1 ) echo 'none'; ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-wrench"></i>
                                <span class="title">General Settings </span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="{{ url('/general/kotauser') }}" class="nav-link ">
                                        <span class="title">Kota registrasi User</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/general/katresep') }}" class="nav-link ">
                                        <span class="title">Kategori Resep</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/general/katfaq') }}" class="nav-link ">
                                        <span class="title">Kategori FAQ</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/general/trainingloc') }}" class="nav-link ">
                                        <span class="title">Lokasi Pelatihan</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/general/usaha') }}" class="nav-link ">
                                        <span class="title">Jenis Usaha</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/general/industri') }}" class="nav-link ">
                                        <span class="title">Jenis Industri</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/general/kapasitas') }}" class="nav-link ">
                                        <span class="title">Kapasitas Produksi</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/general/kotabuy') }}" class="nav-link ">
                                        <span class="title">Where to Buy</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="{{ url('/kontak') }}" class="nav-link ">
                                        <span class="title">Kontak Alamat</span>
                                    </a>
                                </li>

                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE TITLE-->
                    <h1 class="page-title"> {{ $title }}
                        <small></small>
                    </h1>
                    <!-- BEGIN THEME PANEL -->
                    <!-- <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="{{ url('/home') }}">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Tables</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Datatables</span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                         
                        </div>
                    </div> -->
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                    </div>
                    <!-- END PAGE BAR --> 
                     @yield('content')

                </div>
                <!-- END CONTENT BODY -->
            </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}"></script>

    <script src="{{ asset('public/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
   
    <script src="{{ asset('public/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('public/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/horizontal-timeline/horizontal-timeline.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ asset('public/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('public/assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{ asset('public/assets/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/layouts/layout/scripts/demo.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/assets/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>
    
    @yield('js')
</body>
</html>
