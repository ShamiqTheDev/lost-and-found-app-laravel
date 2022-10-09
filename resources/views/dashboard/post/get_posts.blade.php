@include("dashboard.header")
<div class="page-content-wrapper">
    <div class="page-content" style="min-height:1459px">
        <div class="page-head">
            <div class="page-title">
                <h1>Lost&Found
                    <small>Posts</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Posts</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Post Details
                        </div>
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
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Email</th>
                                    <th>Post Type</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <body>
                                @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->email }}</td>
                                    <td>{{ ($post->type==1 ? 'Lost' : 'Found') }}</td>
                                    <td>
                                        <?php
                                        $uploaded_images = json_decode($post->images,true);
                                        $img_url = image_check(isset($uploaded_images['0']) ? $uploaded_images['0'] : '');
                                        ?>
                                        @if(!empty($uploaded_images))
                                        <img width="50px" src="{{ $img_url }}" alt="Image" class="img-fluid">
                                        @endif
                                    </td>
                                    <td class="btn-action">
                                        <div class="btn-group">
                                            <button class="btn green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>

                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a target="_blank" href="{{ route('single_post',['id'=>$post->id, 'title' => str_replace('+','-',urlencode($post->title)) ]) }}">
                                                        <i class="fa fa-eye"></i> View Post
                                                    </a>
                                                </li>
                                                <li>
                                                    <a target="_blank" href="{{ route('ad_edit_post_detail',['id' => $post->id]) }}">
                                                        <i class="fa fa-eye"></i> Edit Post
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('ad_delete_post_detail',['id' => $post->id]) }}" onclick="return confirm('Are you sure?')">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('update_post_status',['id'=>$post->id]) }}">
                                                        <i class="fa fa-check"></i> Approve
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('reject_post_status',['id'=>$post->id]) }}">
                                                        <i class="fa fa-ban"></i> Reject
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
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