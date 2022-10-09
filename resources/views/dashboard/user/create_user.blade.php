@include("dashboard.header")
<div class="page-content-wrapper">
    <div class="page-content" style="min-height:1459px">
        <div class="page-head">
            <div class="page-title">
                <h1>Lost&Found
                    <small>Create User</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Create User</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            User Details
                        </div>
                    </div>
                    <div class="portlet-body form">
                        @if(Session::has("errors"))
                        <div class="alert alert-danger alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failure!</strong> 
                            @if ($errors->any())
                            {{ implode('', $errors->all(':message')) }}
                            @endif
                        </div>
                        @endif
                        @if(Session::has("msg_success"))
                        <div class="alert alert-success alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong>
                            {{ Session::get("msg_success") }}
                        </div>
                        @endif
                        <form action="{{ route('create_user_submit') }}" method="post" class="form-horizontal">
                            {!! csrf_field() !!}
                            <div class="form-body view-details">
                                <div class="row employee_form_wrapper">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name *</label>
                                            <input type="text" class="form-control" placeholder="User Name" name="firstname" value="{{ old('firstname') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">Last Name *</label>
                                            <input type="text" class="form-control" placeholder="User Name" name="lastname" value="{{ old('lastname') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone Number *</label>
                                            <input type="text" class="form-control" placeholder="User Name" name="phonenumber" value="{{ old('phonenumber') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">Email *</label>
                                            <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row employee_form_wrapper">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">Confirm Password</label>
                                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword" value="{{ old('confirmpassword') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12 text-center">
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
</div>
</div>
@include("dashboard.footer")
</body>
</html>