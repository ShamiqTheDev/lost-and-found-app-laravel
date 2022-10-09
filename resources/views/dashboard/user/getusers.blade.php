@include("dashboard.header")
<div class="page-content-wrapper">
    <div class="page-content" style="min-height:1459px">
        <div class="page-head">
            <div class="page-title">
                <h1>Lost&Found
                    <small>Users</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Users</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Users Details
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <body>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->user_id }}</td>
                                    <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('view_user_detail',['id' => $user->user_id]) }}"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>
                                        <a href="{{ route('delete_user_detail',['id' => $user->user_id]) }}"  onclick="return confirm('Are you sure?')" ><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </body>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include("dashboard.footer")
<script type="text/javascript">
    $(document).ready( function () {
        $('.table').DataTable();
    } );
</script>
</body>
</html>