@include("dashboard.header")
<div class="page-content-wrapper">
    <div class="page-content" style="min-height:1459px">
        <div class="page-head">
            <div class="page-title">
                <h1>Lost&Found
                    <small>View Users</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">View Users</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="portlet green box">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>User Information </div>
                                        <div class="actions">
                                            <a href="{{ url('edit-user-detail',['id' => $user->user_id]) }}" class="btn btn-default btn-sm">
                                                <i class="fa fa-pencil"></i> Edit </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body view-details" style="width: 100%">
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> User ID: </div><div class="col-md-6 value"> {{ $user->user_id }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> First Name: </div>
                                                <div class="col-md-6 value"> {{ $user->firstname }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Last Name: </div>
                                                <div class="col-md-6 value"> {{ $user->lastname }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Phone Number: </div>
                                                <div class="col-md-6 value"> {{ $user->phonenumber }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Email: </div>
                                                <div class="col-md-6 value"> {{ $user->email }} </div>
                                            </div>
                                        </div>
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