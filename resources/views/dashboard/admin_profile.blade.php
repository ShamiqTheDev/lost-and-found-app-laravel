@include("header")
<div class="page-content-wrapper">
    <div class="page-content" style="min-height:1459px">
        <div class="page-head">
            <div class="page-title">
                <h1>Payspace
                    <small>User Profile</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">User Profile</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            User Profile
                        </div>
                    </div>
                    <div class="portlet-body form">
                        @if(Session::has("msg_error"))
                        <div class="alert alert-danger alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failure!</strong> 
                            {{ Session::get("msg_error") }}
                        </div>
                        @endif
                        @if(Session::has("msg_success"))
                        <div class="alert alert-success alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> 
                            {{ Session::get("msg_success") }}
                        </div>
                        @endif
                        <form action="{!! route('user-profile-submit') !!}" method="post" class="form-horizontal">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email Address</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon input-circle-left">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input type="email" class="form-control input-circle-right" placeholder="Email Address" name="email" value="{{ $user->email }}"> </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">User Name</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon input-circle-left">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                                <input type="text" class="form-control input-circle-right" placeholder="User Name" name="username" value="{{ $user->username }}"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Old Password</label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="password" class="form-control input-circle-left" placeholder="Old Password" name="old_password">
                                                    <span class="input-group-addon input-circle-right">
                                                        <i class="fa fa-key"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">New Password</label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="password" class="form-control input-circle-left" placeholder="New Password" name="new_password">
                                                    <span class="input-group-addon input-circle-right">
                                                        <i class="fa fa-key"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Confirm Password</label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="password" class="form-control input-circle-left" placeholder="Confirm Password" name="new_password_confirmation">
                                                    <span class="input-group-addon input-circle-right">
                                                        <i class="fa fa-key"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-circle green">Submit</button>
                                                <button type="button" class="btn btn-circle grey-salsa btn-outline" onClick="window.location.reload()">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        @include("footer")
    </body>
    </html>