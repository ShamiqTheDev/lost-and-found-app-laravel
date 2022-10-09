@include("lostandfound.header")

@include("lostandfound.search_bar")


<div class="reset_container">
  <div class="reset_password">
    <!-- <h1>Reset Password Form</h1> -->
    <div class="reset_conent">
      <form action="{{ route('reset_password') }}" method="post">
        {!! csrf_field() !!}
        @if(Session::has("msg_success"))
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong>
          {{ Session::get("msg_success") }}
        </div>
        @endif
        @if(Session::has("msg_faliure"))
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Faliure!</strong>
          {{ Session::get("msg_faliure") }}
        </div>
        @endif
        <div class="text-center" style=""><!-- padding:50px 0 -->
          <div class="forgt-icn"><i class="fa fa-lock"></i></div>
          <div class="logo"><h1>forgot password</h1></div>
          <!-- Main Form -->
          <div class="login-form-1">
            <form id="forgot-password-form" class="text-left">
              <div class="etc-login-form">
                <p>When you fill in your registered email address, you will be sent instructions on how to reset your password.</p>
              </div>
              <div class="login-form-main-message"></div>
              <div class="main-login-form">
                <div class="login-group">
                  <div class="form-group">
                    <label for="fp_email" class="sr-only">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="email address">
                  </div>
                </div>
                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
              </div>
              <div class="etc-login-form">
                <p>already have an account? <a data-target="#modalLoginForm" data-toggle="modal" role="tab" href="#tab1">Login here</a></p>
                <p>new user? <a data-target="#modalLoginForm" data-toggle="modal" role="tab" href="#tab2">Create new account</a></p>
              </div>
            </form>
          </div>
          <!-- end:Main Form -->
        </div>
      </form>
    </div>
  </div>
</div>
@include("lostandfound.footer")
</body>
</html>