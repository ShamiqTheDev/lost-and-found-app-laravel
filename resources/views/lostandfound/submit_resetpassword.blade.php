@include("lostandfound.header")
@include("lostandfound.search_bar")
<div class="reset_container">
  <div class="reset_password">
   <div class="reset_conent">
    <form action="{{ url('change-password') }}" method="post">
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
      <ul style="color: red;">
       @if($errors->has('password') || $errors->has('confirmpassword') )
       @foreach ($errors->all() as $error)
       <li>
         {{ $error }}
       </li>
       @endforeach
       @endif
     </ul>
     <input type="hidden" name="token" id="token" value="{{ $token }}">
     <div class="md-form form-sm create-new-pwd">
       <h1>Reset Password</h1>
       <hr>
       <input type="password" name="password" class="form-control form-control-sm validate rounded" placeholder="Enter new password">
       <br>
       <input type="password" name="confirmpassword" class="form-control form-control-sm validate rounded" placeholder="Confirm password">
     </div>
     <div class="text-center mt-3">
      <button class="col-md-4 btn-spn same-bg text-white rounded">Save</button>
    </div>
  </form>
</div>
</div>
</div>
@include("lostandfound.footer")
</body>
</html>