<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title> سامانه بانک اطلاعاتی املاک </title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/dashbord/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dashbord/dist/css/adminlte.min.css">
    {{--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="/dashbord/dist/css/bootstrap-rtl.min.css">
    @yield('css')
    <!-- template rtl version -->
    <link rel="stylesheet" href="/dashbord/dist/css/custom-style.css">
    <link rel="stylesheet" href="/dashbord/dist/css/lastcss.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars fa-lg"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <h5 class="nav-link">@yield('title2')</h5>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
{{--                <h5 class="nav-link">@yield('pagetitle')</h5>--}}
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="{{ route('logout') }}" style="color:gray;" onclick="event.preventDefault();
                document.getElementById('frm-logout').submit();">
                    <div class="btn btn-outline-info m-0 p-1">
                        <span>خروج</span>
                        <i class="fa fa-sign-out"></i>
                    </div>
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/home" class="brand-link">
            <img src="/dashbord/dist/img/mylogo.png" alt="املاک نیاوران" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="font-weight-light">پنل
                {{auth()->user()->role->title}}
            </span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <div>
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!--<img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">-->
                    </div>
                    <div class="info text-light">
                         {{auth()->user()->name}} {{auth()->user()->family}}
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/home" class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    داشبورد
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview {{ Route::currentRouteName() == 'listfile' ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Route::currentRouteName() == 'listfile' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-search"></i>
                                <p>
                                    جستجوی فایل
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @cannot('isEjare')
                                    <li class="nav-item">
                                        <a href="/listfile?forosh=1&maskoni=1" class="nav-link {{ Route::currentRouteName() == 'listfile' && $forosh == 1 && $maskoni == 1 ? 'active' : '' }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>فروش مسکونی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/listfile?forosh=1&maskoni=0" class="nav-link {{ Route::currentRouteName() == 'listfile' && $forosh == 1 && $maskoni == 0 ? 'active' : '' }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>فروش تجاری</p>
                                        </a>
                                    </li>
                                @endcannot
                                @cannot('isForosh')
                                    <li class="nav-item">
                                        <a href="/listfile?forosh=0&maskoni=1" class="nav-link {{ Route::currentRouteName() == 'listfile' && $forosh == 0 && $maskoni == 1 ? 'active' : '' }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>اجاره مسکونی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/listfile?forosh=0&maskoni=0" class="nav-link {{ Route::currentRouteName() == 'listfile' && $forosh == 0 && $maskoni == 0 ? 'active' : '' }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>اجاره تجاری</p>
                                        </a>
                                    </li>
                                @endcannot
                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{ Route::currentRouteName() == 'registerfile' ? 'menu-open' : '' }}">
                            <a href="/registerfile" class="nav-link {{ Route::currentRouteName() == 'registerfile' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-file"></i>
                                <p>
                                    ثبت فایل
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/registerfile?forosh=1&maskoni=1" class="nav-link {{ Route::currentRouteName() == 'registerfile' && $forosh == 1 && $maskoni == 1 ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>فروش مسکونی</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/registerfile?forosh=1&maskoni=0" class="nav-link {{ Route::currentRouteName() == 'registerfile' && $forosh == 1 && $maskoni == 0 ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>فروش تجاری</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/registerfile?forosh=0&maskoni=1" class="nav-link {{  Route::currentRouteName() == 'registerfile' && $forosh == 0 && $maskoni == 1 ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>اجاره مسکونی</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/registerfile?forosh=0&maskoni=0" class="nav-link {{  Route::currentRouteName() == 'registerfile' && $forosh == 0 && $maskoni == 0 ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>اجاره تجاری</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{ Route::currentRouteName() == 'listmoshtari' ? 'menu-open' : '' }}">
                            <a href="/listmoshtari" class="nav-link {{ Route::currentRouteName() == 'listmoshtari' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-search"></i>
                                <p>
                                    جستجوی مشتری
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/listmoshtari?forosh=1" class="nav-link {{ Route::currentRouteName() == 'listmoshtari' && $forosh == 1 ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p> جستجو در فروش </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/listmoshtari?forosh=0" class="nav-link {{ Route::currentRouteName() == 'listmoshtari' && $forosh == 0 ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p> جستجو در اجاره </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{ Route::currentRouteName() == 'registercustomer' ? 'menu-open' : '' }}">
                            <a href="/registercustomer" class="nav-link {{ Route::currentRouteName() == 'registercustomer' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-address-book"></i>
                                <p>
                                    ثبت مشتری
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/registercustomer?forosh=1" class="nav-link {{ Route::currentRouteName() == 'registercustomer' && $forosh == 1 ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p> ثبت در فروش </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/registercustomer?forosh=0" class="nav-link {{ Route::currentRouteName() == 'registercustomer' && $forosh == 0 ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p> ثبت در اجاره </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @can('isModir')
                            <li class="nav-item has-treeview {{ (Route::currentRouteName() == 'registerpersonel' or Route::currentRouteName() == 'listpersonel') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ (Route::currentRouteName() == 'registerpersonel' or Route::currentRouteName() == 'listpersonel') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-user"></i>
                                    <p>
                                        مدیریت پرسنل
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/registerpersonel" class="nav-link {{ Route::currentRouteName() == 'registerpersonel' ? 'active' : '' }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p> ثبت پرسنل </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/listpersonel" class="nav-link {{ Route::currentRouteName() == 'listpersonel' ? 'active' : '' }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p> لیست پرسنل </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a href="/changepassword" class="nav-link {{ Route::currentRouteName() == 'passwordchange' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-key"></i>
                                <p>
                                    تغییر رمز
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 row">
                        {{--<h5 class="m-0 text-dark page-title"> @yield('title2') </h5>--}}
                        <h5 class="m-0 text-dark page-title"> @yield('pagetitle') </h5>
                        <ol class="breadcrumb float-sm-left text-sm mr-3">
                            {{--<li class="breadcrumb-item">@yield('pagetitle')</li>--}}
                            {{--<li class="breadcrumb-item active">@yield('maskoni')</li>--}}
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>CopyLeft &copy; 2020 <a href="hosghf@gmail.clom">09398454623</a>.</strong>
    </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="/dashbord/plugins/jquery/jquery.min.js"></script>
@yield('js')
<!-- Bootstrap 4 -->
<script src="/dashbord/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dashbord/dist/js/adminlte.min.js"></script>

</body>
</html>
