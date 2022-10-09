@include("dashboard.header")
<div class="page-content-wrapper">
    <div class="page-content" style="min-height:1459px">
        <div class="page-head">
            <div class="page-title">
                <h1>Lost&Found
                    <small>Edit User</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Edit User</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Edit User Details
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
                        <form action="{{ route('update_user_detail',['id'=>$user->user_id]) }}" method="post" class="form-horizontal">
                            {!! csrf_field() !!}
                            <div class="form-body">
                                <div class="row employee_form_wrapper">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">User Id</label>
                                            <input type="text" readonly="readonly" class="form-control" name="user_id" value="{{ $user->user_id }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" value="{{ $user->firstname }}" class="form-control" name="firstname">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" value="{{ $user->lastname }}" class="form-control" name="lastname">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone Number</label>
                                            <input type="text" value="{{ $user->phonenumber }}" class="form-control" name="phonenumber">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" class="form-control" placeholder="Email" name="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-circle green">Update Details</button>
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
@include("dashboard.footer")
</body>
</html>