<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  if (!isset($post)) {
   $post= '';
 }
 $current_route = '';
 if (!empty(Request::route())) {
  $current_route = Request::route()->getName();
}
?>
{!! meta_tags($post) !!}

<link rel="shortcut icon" href="{!! asset('public/images/fivicon.png') !!}" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700,800" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
@if( $current_route == 'index' || $current_route == 'single_post')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endif
<link rel="stylesheet" href="{!! asset('public/css/aos.css') !!}">
<link rel="stylesheet" href="{!! asset('public/css/style.css') !!}">
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Country-Selecter-with-Flags-flagstrap/dist/css/flags.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@if( $current_route == 'post-form' || $current_route == 'edit_post_detail')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
@endif
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
</head>
<body>

  <header class="site-navbar container no-pad bg-white" role="banner" style="padding: 0 !important">
    <nav id="navHome" class="site-navigation position-relative navbar-pad navbar navbar-expand-lg navbar-light sticky-top">
      <div class="container-fluid max-width-940">
        <div class="col-6 col-xl-2 col-lg-2">
          <h1 class="mb-0 site-logo"><a href="{{ url('/') }}" class="text-black mb-0"><img class="img-fluid" src="{!! asset('public/images/findwala-logo.png') !!}"></a></h1>
        </div>
        <div class="d-inline-block d-xl-none ml-auto d-lg-none text-right">
          <div class="d-xl-none d-lg-none collap-col">
            <button type="button" class="btn same-color collap-btn" data-toggle="collapse" data-target="#demo">
              @if(!request()->is('/'))
              <i class="fa fa-search" aria-hidden="true"></i>
              @endif
            </button>
          </div>
        </div>
        <button class="navbar-toggler togglerNoBorder" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse backgroundWhite" id="navbarNavDropdown">
          <ul class="site-menu navbar-nav ml-auto padng-menu">
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{ route('index') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('howitworks')) ? 'active' : '' }}" href="{{ url('howitworks') }}">How it Works</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('about-us')) ? 'active' : '' }}" href="{{ route('about-us') }}">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('contact-us')) ? 'active' : '' }}" href="{{ route('contact-us') }}">Contact Us</a>
            </li>

            @if(Auth::check() && Auth::user()->verifiy_email == 0)
            <?php
            $current_user= get_auth_data();
            $img_url = social_image_check(['image'=>$current_user->image, 'avatar'=>$current_user->social_avatar ]);
            ?>
            <li class="has-children dash-brd-li hovr-undr-line user-login-li ">
              <a onclick="myFunction()" class="img-dash dropdown-li dropbtn">                
                <img class="img-circle" style="border-radius: 100px;" alt="" height="30" width="30"  src="<?php echo url($img_url) ?>">
                {{ $current_user->firstname }}
                <i  class="fa fa-angle-down " aria-hidden="true"></i>
              </a>
              <ul class="dropdown-content-dash dropdown" id="myDropdown-dash">
                <li> <a href="{{ route('user_dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i>My Posts</a>
                </li>
                <li><a href="{{ route('remember_list') }}"><i class="fa fa-heart" aria-hidden="true"></i>Remember List</a>
                </li>
                <li><a href="{{ route('logout-user') }}"><i class="fa fa-power-off" aria-hidden="true"></i>Logout</a>
                </li>
              </ul>
            </li>
            @endif
            
            @if(Auth::check() && Auth::user()->verifiy_email == 1)
            <?php
            $current_user= get_auth_data();
            $img_url = social_image_check(['image'=>$current_user->image, 'avatar'=>$current_user->social_avatar ]);;
            ?>
            <li class="has-children dash-brd-li hovr-undr-line user-login-li ">
              <a onclick="myFunction()" class="img-dash dropdown-li dropbtn">

                <img class="img-circle" style="border-radius: 100px;" alt="" height="30" width="30"  src="<?php echo url($img_url) ?>">
                {{ $current_user->firstname }}

                <?php
                $msg_count = get_msgs_count();
                ?>
                @if( $msg_count > 0)
                <div class="msg_counter">
                  <span>{{$msg_count}}</span>
                </div>
                @endif
                <i  class="fa fa-angle-down " aria-hidden="true"></i>
              </a>
              <!-- <button onclick="myFunction()" class=""></button> -->
              <ul class="dropdown-content-dash dropdown" id="myDropdown-dash">
                <li> <a href="{{ route('user_dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i>My Posts</a>
                </li>
                <li><a href="{{ route('remember_list') }}"><i class="fa fa-heart" aria-hidden="true"></i>Remember List</a>
                </li>
                <li class="msg_container">
                  <a href="{{ route('messages') }}"><i class="fa fa-envelope" aria-hidden="true"></i>Messages
                    @if( $msg_count > 0)
                    <div class="msg_counter">
                      <span>{{ $msg_count }}</span>
                    </div>
                    @endif
                  </a>
                </li>
                <li><a href="{{ route('edit-user-profile') }}"><i class="fa fa-gear" aria-hidden="true"></i>Settings</a>
                </li>
                <li><a href="{{ route('logout-user') }}"><i class="fa fa-power-off" aria-hidden="true"></i>Logout</a>
                </li>
              </ul>
            </li>

            @elseif(!Auth::check())
            <li class="nav-item resp-nav-li {{ (request()->is('login')) ? 'active' : '' }}">
              <span class="resp-col log-col">
                <a class="nav-link" href="#tab1" data-toggle="modal" data-target="#modalLoginForm"><span class="border-left pl-xl-4"></span>Log In</a>
              </span>
              <span class="slsh">/</span>
              <span class="resp-col resgt-col">
                <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="#tab2" data-toggle="modal" data-target="#modalLoginForm">Register</a>
              </span>
            </li>

            @endif
            <li class="nav-item has-children hovr-undr-line">
              <div class="flags-btn flag-container mt-2 respnve-clas" id="basic" data-val="" data-input-name="country">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </div>
            </li>
            
            @if(Auth::check() && Auth::user()->verifiy_email == 0)
            <?php $id = Auth::id(); ?>
            <li class="nav-item hovr-undr-line">
              <a class="nav-link cta" onclick="try_post({{$id}})" ><span class="btn-spn same-bg text-white rounded">Post an Ad</span></a>
            </li>
            @else
            <li class="nav-item hovr-undr-line">
              <a class="nav-link cta" href="{{ Auth::check() == 1 ? url('post-form/?type=1') :  '' }}" data-toggle="{{ Auth::check() == 1 ? route('post-form') :  'modal' }}" data-target="#modalLoginForm" ><span class="btn-spn same-bg text-white rounded">POST NEW</span></a>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <?php
  get_country();
  ?>

