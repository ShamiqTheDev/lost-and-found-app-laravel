<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Schedule Panel System</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/assets/global/plugins/datatables/datatables.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/assets/global/css/components-md.min.css') !!}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{!! asset('public/assets/global/css/plugins-md.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/assets/layouts/layout4/css/layout.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/assets/layouts/layout4/css/themes/default.min.css') !!}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{!! asset('public/assets/layouts/layout4/css/custom.min.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('public/assets/layouts/layout4/css/dashboard-style.css') !!}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="favicon.ico" /> 
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
</head>

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
    <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">
            <div class="page-logo">
                <a href="#">
                    <img src="{{ asset('public/assets/layouts/layout4/img/logo-light.png') }}" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler">

                    </div>
                </div>

                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

                <div class="page-actions">
                    <div class="btn-group">
                        <button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="hidden-sm hidden-xs">Actions&nbsp;</span>
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('get-users') }}">
                                    <i class="icon-list"></i> View Users
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="page-top">
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="separator hide"> </li>

                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile">
                                    </span>

                                    <img alt="" class="img-circle" src="{{ asset('public/assets/layouts/layout4/img/avatar9.jpg') }}" /> </a>
                                    <ul class="dropdown-menu dropdown-menu-default">
                                        <li class="divider"> </li>
                                        <li>
                                            <a href="{{ route('user-profile') }}">
                                                <i class="icon-user"></i>User Profile </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('generate-sitemap') }}" onclick="return confirm('Are you sure?')">
                                                    <i class="icon-settings"></i>Generate Sitemap
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('logout') }}">
                                                    <i class="icon-key"></i> Log Out
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-container">
                    <div class="page-sidebar-wrapper">
                        <div class="page-sidebar navbar-collapse collapse">
                            <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                                <li class="nav-item start">
                                    <a href="{{ url('dashboard') }}" class="nav-link nav-toggle">
                                        <i class="icon-home"></i>
                                        <span class="title">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item start">
                                    <a href="" class="nav-link nav-toggle">
                                        <i class="fa fa-user"></i>
                                        <span class="title">Users</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item start ">
                                            <a href="{{ url('create-user') }}" class="nav-link ">
                                                <i class="icon-list"></i>
                                                <span class="title">Add User</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="{{ url('get-users') }}" class="nav-link ">
                                                <i class="icon-list"></i>
                                                <span class="title">View All</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item start">
                                    <a href="" class="nav-link nav-toggle">
                                        <i class="fa fa-users"></i>
                                        <span class="title">Posts</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item start ">
                                            <a href="{{ route('get-posts',['status'=>'active']) }}" class="nav-link ">
                                                <i class="icon-list"></i>
                                                <span class="title">Active</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="{{ route('get-posts',['status'=>'inactive']) }}" class="nav-link ">
                                                <i class="icon-list"></i>
                                                <span class="title">In-Active</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="{{ route('get-posts',['status'=>'pending']) }}" class="nav-link ">
                                                <i class="icon-list"></i>
                                                <span class="title">Pending</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="{{route('get-posts',['status'=>'rejected']) }}" class="nav-link ">
                                                <i class="icon-list"></i>
                                                <span class="title">Rejected</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item start">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-settings"></i>
                                        <span class="title">Settings</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item start ">
                                            <a href="{{ route('user-profile') }}" class="nav-link ">
                                                <i class="icon-user"></i>
                                                <span class="title">User Profile</span>
                                            </a>
                                        </li>
                                        <li class="nav-item start ">
                                            <a href="{{ route('generate-sitemap') }}" onclick="return confirm('Are you sure?')" class="nav-link ">
                                                <i class="icon-settings"></i>
                                                <span class="title">Generate Sitemap</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>