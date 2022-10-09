@include("dashboard.header")
<div class="page-content-wrapper">
    <div class="page-content" style="min-height:1459px">
        <div class="page-head">
            <div class="page-title">
                <h1>Lost&Found
                    <small>Dashboard</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Statistics | {{ date('l jS \of F, Y',strtotime($today_date) ) }}</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>

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
@include("dashboard.footer")
</body>
</html>