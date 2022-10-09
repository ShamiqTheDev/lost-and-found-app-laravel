
<?php
$current_route = '';
if (!empty(Request::route())) {
  $current_route = Request::route()->getName();
}
?>
<div class="tost">
  <div class="toast toast-style" id="lu_msg_s">
    <div class="toast-body">
      <div class="lu_msg_success"></div>
    </div>
  </div>
  <div class="toast toast-style" id="lu_msg_f">
    <div class="toast-body">
      <div class="lu_msg_failure"></div>
    </div>
  </div>
</div>
@if(!request()->is('post-form') && Auth::check() && Auth::user()->verifiy_email == 1)
<div class="main-icn">
  <div class="innr-main">
    <i class="fa fa-file-text" aria-hidden="true"></i>
  </div>
  <div class="col-lenght">
    <div class="btn-btn btn-1">
      <a href="{{ Auth::check() == 1 ? url('post-form/?type=1') :  url('postform') }}" data-toggle="{{ Auth::check() == 1 ? route('post-form') :  'modal' }}" data-target="#modalLoginForm">Report Lost</a>
    </div>
    <div class="btn-btn btn-2">
      <a href="{{ Auth::check() == 1 ? url('post-form/?type=2') :  url('postform') }}" data-toggle="{{ Auth::check() == 1 ? route('post-form') :  'modal' }}" data-target="#modalLoginForm">Report Found</a>
    </div>
  </div>
</div>
@elseif(!request()->is('post-form') && Auth::check() && Auth::user()->verifiy_email == 0)
<?php $id = Auth::id(); ?>
<div class="main-icn">
  <div class="innr-main">
    <i class="fa fa-file-text" aria-hidden="true"></i>
  </div>
  <div class="col-lenght">
    <div class="btn-btn btn-1">
      <a class="text-white" onclick="try_post({{$id}})">Report Lost</a>
    </div>
    <div class="btn-btn btn-2">
      <a class="text-white" onclick="try_post({{$id}})">Report Lost</a>
    </div>
  </div>
</div>
@endif
<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">
            <h5 class=" mb-3">Usefull Links</h5>
            <ul class="list-unstyled">
              <li class=""><a href="{{ route('index') }}">Home</a></li>
              <li class=""><a href="{{ route('about-us') }}">About Us</a></li>
              <li class=""><a href="{{ route('contact-us') }}">Contact Us</a></li>
              <li class=""><a href="{{ route('faqs') }}" target="_blank">FAQ's</a></li>
              <li class=""><a href="{{ route('privacy-policy') }}" target="_blank">Privacy</a></li>
              <li class=""><a href="{{ route('terms-and-conditions') }}" target="_blank">Terms & Conditions</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5 class=" mb-3">Follow Us</h5>
            <ul class="list-unstyled social_links">
              <li><a href="https://www.facebook.com/" target="_blank" class="pl-0 pr-3"><i class="fa fa-facebook"></i></a></li>
              <li><a href="https://twitter.com" target="_blank" class="pl-0 pr-3"><i class="fa fa-twitter"></i></a></li>
              <li><a href="https://www.instagram.com" target="_blank" class="pl-0 pr-3"><i class="fa fa-instagram"></i></a></li>
              <li><a href="https://www.linkedin.com" target="_blank" class="pl-0 pr-3"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>

          <div class="col-md-4">
            <h5 class=" mb-3">App Comming Soon</h5>
            <ul class="list-unstyled apps">
              <li><a target="_blank" href="https://play.google.com/store" class="pl-0 pr-3"><img style="padding: 2px 0;" class="img-fluid" src="{!! asset('public/images/g-play.png') !!}"></a></li>
              <li><a target="_blank" href="https://www.apple.com/ios/app-store/" class="pl-0 pr-3"><img style="padding: 2px 0;" class="img-fluid" src="{!! asset('public/images/app.png') !!}"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row text-center">
      <div class="col-md-12">
        <div class="border-top pt-2">
          <p>
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>



<!--Modal: Login / Register Form-->
<div class="modal fade sign_in" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">

      <!--Modal cascading tabs-->
      <div class="modal-c-tabs">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3 md-ul" role="tablist">
          <li class="nav-item active" >
            <a id="actv-colr" class="nav-link header-login" data-toggle="tab" href="#tab1" role="tab"><i class="fa fa-user mr-1"></i>
            Login</a>
          </li>
          <li class="nav-item" >
            <a id="actv-colr" class="nav-link header-reg" data-toggle="tab" href="#tab2" role="tab"><i class="fa fa-user-plus mr-1"></i>
            Register</a>
          </li>
          <li class="offset-right">
            <button type="button" class="close md-cl" data-dismiss="modal">&times;</button>
          </li>
        </ul>

        <div class="row form_content">
         <!-- Tab panels -->
         <div class="col-md-12">
          <div class="tab-content">
            <!--Panel 7-->
            <div class="tab-pane fade in show active" id="tab1" role="tabpanel">

              <!--Body-->
              <div class="modal-body mb-1">

                <form action="{{ route('login-user') }}" autocomplete="off" id="login-form" method="POST">
                  {{ csrf_field() }}
                  <div class="md-form form-sm">
                    <!-- <i class="fa fa-envelope prefix"></i> -->
                    <input type="email" id="modalLRInput10" class="form-control form-control-sm rounded" placeholder="Your Email*" name="email">
                  </div>

                  <div class="md-form form-sm mb-4">
                    <!-- <i class="fa fa-lock prefix"></i> -->
                    <input type="password" id="modalLRInput11" class="form-control form-control-sm validate rounded" placeholder="Your Password*" name="password">
                  </div>
                  <div class="text-center">
                    <button type="submit" id="login-btn" class="btn btn-info no-pad rounded">
                      <div id="login-loader"></div>
                      <span id="lgn-btn-text">Log in
                        <i class="fa fa-sign-in ml-1"></i></span>
                      </button>
                    </div>
                  </form>

                </div>
                <!--Footer-->
                <div class="modal-footer">
                  <div class="options text-center mt-1">
                    <!-- <p>Not a member? <a href="#" class="blue-text">Sign Up</a></p> -->
                    <p>Forgot <a href="{{ route('forgot-password') }}" class="blue-text same-color">Password?</a></p>
                  </div>
                  <!-- <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button> -->
                </div>

              </div>
              <!--/.Panel 7-->

              <!--Panel 8-->
              <div class="tab-pane fade" id="tab2" role="tabpanel">
                <!--Body-->
                <div class="modal-body">
                  <form action="{{ route('register') }}" autocomplete="off" id="register-form" method="post">
                    {!! csrf_field() !!}

                    <div class="errors_div alert-danger">
                      <ul id="error_list">

                      </ul>
                    </div>
                    <div class="md-form form-sm">
                      <div class="row">
                        <div class="col-md-6">
                          <input type="text" class="form-control form-control-sm validate rounded" placeholder="First Name*" name="firstname">
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control form-control-sm validate rounded" placeholder="Last Name" name="lastname">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="input-group md-form form-sm">
                          <!--  <i class="fa fa-envelope prefix"></i> -->
                          <input type="text" readonly style="max-width: 29%; padding: 1px 1px;" class="form-control text-center col-md-2 rounded" id="country_code" autocomplete="off" value="+{{ Session::get('country_phonecode') }}" name="country_code" placeholder="Code"/>
                          <input type="number" class="form-control form-control-sm validate col-sm-10 rounded" placeholder="Phone*" name="phonenumber" onKeyPress="if(this.value.length==12) return false;">
                        </div>
                      </div>
                      <div class="col-md-6">
                       <div class="md-form form-sm">
                        <!--  <i class="fa fa-envelope prefix"></i> -->
                        <input type="text" class="form-control form-control-sm validate rounded" placeholder="Email Address*" name="email">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="md-form form-sm">
                        <!--  <i class="fa fa-lock prefix"></i> -->
                        <input type="password" id="modalLRInput13" class="form-control form-control-sm validate rounded" placeholder="Password*" name="password">
                      </div>
                    </div>
                    <div class="col-md-6">
                     <div class="md-form form-sm mb-4">
                      <!--  <i class="fa fa-lock prefix"></i> -->
                      <input type="password" id="modalLRInput14" class="form-control form-control-sm validate rounded" placeholder="Confirm Password*" name="confirmpassword">
                    </div>
                  </div>
                </div>
                <div class="text-center form-sm">
                  <button type="submit" id="register-btn" class="btn btn-info no-pad rounded">
                    <div id="register-loader"></div>
                    <span id="rgt-btn-text">Register
                      <i class="fa fa-sign-in ml-1"></i></span>
                    </button>
                  </div>
                </form>
              </div>
              <!--Footer-->
              <div class="modal-footer">
                <div class="options">
                  <p class="pt-1">Already have an account?
                    <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3 md-ul" role="tablist">
                      <li class="nav-item active">
                        <a id="actv-colr" data-toggle="tab" href="#tab1" role="tab" class="blue-text nav-link footer-login"><span class="same-color">Log in</span></a>
                      </li>
                    </ul>
                  </p>
                </div>
              </div>
            </div>
            <!--/.Panel 8-->
          </div>
        </div>
        <!-- End of col-md-7 -->
      </div>
      <div class="col-md-12 social_container">
        <div class="col-md-4 social_inr-col">
          <div class="social_login fb">
            <a href="{{ url('/auth/redirect/facebook') }}">Sign in With</a><i class="fa fa-facebook-f"></i>
          </div>
        </div>
        <div class="col-md-4 social_inr-col">
          <div class="social_login google">
            <a href="{{ url('auth/google') }}">Sign in With</a><i class="fa fa-google"></i>
          </div>
        </div>
        <div class="col-md-4 social_inr-col">
          <div class="social_login twitter">
            <a href="{{ url('/auth/redirect/twitter') }}">Sign in With</a><i class="fa fa-twitter"></i>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!--/.Content-->
</div>
</div>
<!--Modal: Login / Register Form-->

<script type="text/javascript" src="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@include('lostandfound.flagstrap')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{!! asset('public/js/aos.js') !!}"></script>
<script src="{!! asset('public/js/main.js') !!}"></script>

@if( $current_route == 'post-form' || $current_route == 'edit_post_detail')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
@endif


<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown-dash").classList.toggle("show");
}

//Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content-dash");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<script>
  cat_id = "";
  state_id = "";
  $("#modalLoginForm").on('shown.bs.modal', function(e) {
    var tab = e.relatedTarget.hash;
    $('.nav-tabs a[href="'+tab+'"]').tab('show')
  });
</script>

<script type="text/javascript">
  $(document).on('click', '.like_unlike',function(){
    current_span = $(this).find('span');
    wish_type=current_span.attr('class');
    if (wish_type == 'fa fa-heart'){
      wish_type = 0;
    }
    else{
      wish_type = 1;
    }
    post_id = $(this).find('span').attr('data-id');
    $.ajax({url:"{{ url('like-unlike-posts')}}/"+post_id+"/"+wish_type,

      type:'GET',
      dataType: 'json',

    }).done(function(r){
      if (r.type == 0) {
        current_span.addClass('fa-heart-o');
        current_span.removeClass('fa-heart');
        $s = 'failure';
        $su = 'f';
      }
      else{
        current_span.addClass('fa-heart');
        current_span.removeClass('fa-heart-o');
        $s = 'success';
        $su= 's';
      }
      $('.lu_msg_'+$s).html(r.msg);
      $("#lu_msg_"+$su).toast({ delay: 3000 });
      $("#lu_msg_"+$su).toast('show');

      @if ($current_route == 'remember_list')
      $('#like_post_'+post_id).slideUp('slow');
      @endif
    });
  });

  $('#basic').flagStrap();

  $(document).on('click', '.flag-options',function(){
    country_code = $(this).attr('data-val');
    $.ajax({
      url:"{{ route('set-country-code')}}/?cc="+country_code,
      type:'GET'
    }).done(function(r){
     location.reload();
   });
  });

  $('.select-country').flagStrap({
    countries: {
      "US": "USD",
      "AU": "AUD",
      "CA": "CAD",
      "SG": "SGD",
      "GB": "GBP",
    },
    buttonSize: "btn-sm",
    buttonType: "btn-info",
    labelMargin: "10px",
    scrollable: false,
    scrollableHeight: "350px"
  });

  $('#advanced').flagStrap({
    buttonSize: "btn-lg",
    buttonType: "btn-primary",
    labelMargin: "20px",
    scrollable: false,
    scrollableHeight: "350px"
  });

</script>

<script type="text/javascript">

  $(document).on('submit', '#register-form',function(e){
    $('#register-btn').attr('disabled',true);
    $("#rgt-btn-text").html('');
    $("#register-loader").html("<img src='{{ URL::asset('public/images/login-loader.gif') }}' alt='loading...' />");
    $('#error_list').html('');
    var formData = new FormData($('#register-form')[0]);
    e.preventDefault();
    $.ajax({url:"{{ route('register') }}",
      type:'post',
      data: formData,
      processData: false,
      contentType: false,
      dataType:'json'
    }).done(function(r){
     if (r == 1){
      $('.lu_msg_success').html("You have registered successfully!");
      $("#lu_msg_s").toast({ delay: 3000 });
      $("#lu_msg_s").toast('show');
      window.location.replace("{{ route('user_dashboard') }}");
    }
    else{

      $('.lu_msg_failure').html(r.msg);
      $("#lu_msg_f").toast({ delay: 3000 });
      $("#lu_msg_f").toast('show');
      error_list = '';
      $.each(r.errors, function( index, value ) {
       value = value[0];  
       error_list += "<li>"+value+"</li>";
     });  
      $('#error_list').html(error_list);
    }
    $("#register-btn").attr('disabled',false);
    $("#register-loader").html('');
    $("#rgt-btn-text").html('Register<i class="fa fa-sign-in ml-1"></i></span>');
  });
  });

  $(document).on('submit', '#login-form',function(e){
    $('#login-btn').attr('disabled',true);
    $("#lgn-btn-text").html('');
    $("#login-loader").html("<img src='{{ URL::asset('public/images/login-loader.gif') }}' alt='loading...' />");
    var token = $('#login-form input[name="_token"]').val();
    var email = $.trim($('#login-form input[name="email"]').val());
    var password = $.trim($('#login-form input[name="password"]').val());

    e.preventDefault();
    $.ajax({url:"{{ route('login-user') }}",
      type:'post',
      data:  {_token: token, email: email,password: password,
      }
    }).done(function(r){
      if (r == '1'){
        msg = 'You are loged in successfully';
        $s = 'success';
        $su= 's';
      }
      else if(r=='2'){
        msg = 'Fill email and password fields to login.';
        $s = 'failure';
        $su = 'f';
      }
      else{
        msg = 'Invalid credentials! Please Try again.';
        $s = 'failure';
        $su = 'f';
      }

      $('.lu_msg_'+$s).html(msg);
      $("#lu_msg_"+$su).toast({ delay: 3000 });
      $("#lu_msg_"+$su).toast('show');
      if (r == '1'){
        location.reload();
      }
      $("#login-btn").attr('disabled',false);
      $("#lgn-btn-text").html('Log in<i class="fa fa-sign-in ml-1"></i></span>');
      $("#login-loader").html('');
    });
  });

  $(document).on('click', '.hovr-undr-line',function(e){
    $('.flag-container ul').toggle();
  });

  $(document).ready(function(){

    $.ajax({url:"{{ route('get-categories')}}",
      type:'GET'
    }).done(function(r){
     $('#cat_id').html(r);
     if (cat_id != '') {
       $('#cat_id').val(cat_id);
     }
   });

    @if ($current_route != 'edit_post_detail')
    $.ajax({url:"{{ url('get-states')}}",
      type:'GET'
    }).done(function(r){
     $('#state_id').html(r);
     if (state_id != '') {
       $('#state_id').val(state_id); 
     }
   });
    @endif
    $(document).on('click', '.footer-login',function(e){
      $('.header-reg').removeClass('active');
      $('.header-login').addClass('active');
    });
    $(document).on('click', '.header-reg',function(e){
      $('.footer-login').removeClass('active');
    });
  });
</script>

<script type="text/javascript">

  function try_post($id){
    swal({
      title: "Confirm Your Account",
      text: "You need to confirm your account to use all services",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#e33030',
      confirmButtonText: "Yes Resend",
      cancelButtonText: "Cancel",
      closeOnConfirm: true,
      closeOnCancel: true
    },
    function(isConfirm){
      if (isConfirm) {
      $.ajax({
        url:"{{ url('resend-verification') }}/"+$id,
        type:'GET',
        dataType:'json'
      }).done(function(r){
        if (r.status == 1) {
          window.location.reload();
          swal("Changed!", "We have sent an E-mail to your account.", "success");
        }
        else{
          swal("Cancelled", "Something went wrong :)", "warning");            
        }
      });
    }
    });
  }
</script>