<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<html lang="{{ config('app.locale') }}">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="current-route" content="{{$current_route = Route::currentRouteName()}}">
    <meta name="base-url" content="{{$base_url = URL::to('/')}}">
    <meta content="Marlind Parllaku" name="author" />
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(), ]) !!}; var super_path = '{{URL::to('/')}}';</script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{URL::asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    @yield('page_level_plugins_head')
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{URL::asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{URL::asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    @yield('page_level_styles_head')
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{URL::asset('assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{URL::asset('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/custom/custom.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.html">
                <img src="{{URL::asset('assets/layouts/layout/img/logo.png')}}" alt="logo" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler"> </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="{{URL::asset('assets/pages/img/avatars/user_avatar.png')}}" />
                        <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li><a href=""> <i class="icon-user"></i> My Profile </a></li>
                        <li><a  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-key"></i> Log Out </a></li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
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
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler"> </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                <li class="nav-item start @if($current_route == '/' or $current_route == 'home')  active open  @endif">
                    <a href="" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Faqja Kryesore</span>
                    </a>
                </li>
                <li class="nav-item @if($current_route == 'users')  active open  @endif">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-users"></i>
                        <span class="title">Perdoruesit</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="" class="nav-link ">
                                <span class="title"><i class="fa fa-list"></i> Lista e Perdoruesave</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="" class="nav-link ">
                                <span class="title"><i class="fa fa-plus"></i> Shto Perdorues</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if($current_route == 'clients')  active open  @endif">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class= "fa fa-handshake-o"></i>
                        <span class="title">Klientet</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{url('clients')}}" class="nav-link ">
                                <span class="title"><i class="fa fa-list"></i> Lista e Klienteve</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('create_client')}}" class="nav-link ">
                                <span class="title"><i class="fa fa-plus"></i> Shto Klient</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if($current_route == 'categories')  active open  @endif">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-tags"></i>
                        <span class="title">Kategorite e Aritkujve</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item ">
                            <a href="{{url('categories')}}" class="nav-link ">
                                <span class="title"><i class="fa fa-list"></i> Lista e Kategorive</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('create_category')}}" class="nav-link ">
                                <span class="title"><i class="fa fa-plus"></i> Shto Kategori</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if($current_route == 'products')  active open  @endif">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-cubes"></i>
                        <span class="title">Artikujt</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{url('products')}}" class="nav-link ">
                                <span class="title"><i class="fa fa-list"></i> Listimi i Artikujve</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('create_product')}}" class="nav-link ">
                                <span class="title"><i class="fa fa-plus"></i> Shto Artikull</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if($current_route == 'orders')  active open  @endif">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="title">Porosite</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="" class="nav-link ">
                                <span class="title"> <i class="fa fa-archive"></i> Arkiva e Porosive</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{url('create_order')}}" class="nav-link ">
                                <span class="title"><i class="fa fa-plus"></i> Porosi e Re</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if($current_route == 'debits')  active open  @endif">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-usd"></i>
                        <span class="title">Debitet</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="" class="nav-link ">
                                <span class="title"><i class="fa fa-building-o"></i> Debitet e Dyqanit</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="" class="nav-link ">
                                <span class="title"><i class="fa fa-users"></i> Debitet e Klienteve</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if($current_route == 'debits')  active open  @endif">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-usd"></i>
                        <span class="title">Shpenzimet</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="" class="nav-link ">
                                <span class="title"><i class="fa fa-building-o"></i> Lista e Shpenzimeve</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="" class="nav-link ">
                                <span class="title"><i class="fa fa-users"></i> Shto Shpenzim</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        @yield('content')
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2017 &copy; Panel Demo
        <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }}</form>
    <div id="toast-container" class="toast-top-right" aria-live="polite" role="alert">@include('partials.messages')</div>
</div>
<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="{{URL::asset('assets/global/plugins/respond.min.js')}}')}}"></script>
<script src="{{URL::asset('assets/global/plugins/excanvas.min.js')}}')}}"></script>
<![endif]-->

<!-- BEGIN CORE PLUGINS -->
<script src="{{URL::asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{URL::asset('assets/global/plugins/bootstrap-toastr/toastr.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/custom/custom.js')}}" type="text/javascript"></script>
@yield('page_level_plugins_foot')
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{URL::asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{URL::asset('assets/pages/scripts/ui-toastr.min.js')}}" type="text/javascript"></script>

@yield('page_level_scripts_foot')
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{URL::asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

</body>

</html>