@include("dashboard.header")
<?php $content = json_decode($post->content, true); ?>
<div class="page-content-wrapper">
    <div class="page-content" style="min-height:1459px">
        <div class="page-head">
            <div class="page-title">
                <h1>Lost&Found
                    <small>View Post</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">View Post</a>
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
                                        <i class="fa fa-cogs"></i>Post Details </div>
                                        </div>
                                        <div class="portlet-body view-details" style="width: 100%">
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> User Name: </div><div class="col-md-6 value"> {{ $user->firstname.' '.$user->lastname }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> User Email: </div><div class="col-md-6 value"> {{ $user->email }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Title: </div>
                                                <div class="col-md-6 value"> {{ $post->title }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Phone Number: </div>
                                                <div class="col-md-6 value"> {{ $post->phonenumber }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Status: </div>
                                                <div class="col-md-6 value"> {{ $post->status }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Views: </div>
                                                <div class="col-md-6 value"> {{ $post->views }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Likes: </div>
                                                <div class="col-md-6 value"> {{ $post->likes }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Description: </div>
                                                <div class="col-md-6 value"> {{ $post->description }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Created Date: </div>
                                                <div class="col-md-6 value"> {{ $post->created_at }} </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Display Name: </div>
                                                <div class="col-md-6 value">{{ $post->display_name }}
                                                </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Title: </div>
                                                <div class="col-md-6 value">{{ $post->title }}
                                                </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Title: </div>
                                                <div class="col-md-6 value">{{ $post->phonenumber }}
                                                </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Reward: </div>
                                                <div class="col-md-6 value">{{ $post->reward}}
                                                </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Found Location: </div>
                                                <div class="col-md-6 value">{{ $post->found_location }}
                                                </div>
                                            </div>
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name"> Found Date: </div>
                                                <div class="col-md-6 value">{{ $post->$date }}
                                                </div>
                                            </div>
                                            @foreach($content as $key => $value )
                                            <div class="row static-info col-md-6">
                                                <div class="col-md-6 name">{{ $key }}: </div>
                                                <div class="col-md-6 value">{{ $value }}</div>
                                            </div>
                                            @endforeach
                                            <?php
                                            $uploaded_images = json_decode($post->images,true);
                                            $img_url = image_check(isset($uploaded_images['0']) ? $uploaded_images['0'] : '');
                                            ?>
                                            <div class="row static-info col-md-6">
                                                @if(!empty($uploaded_images))
                                                @foreach( $uploaded_images as $ui)
                                                <img width="20%" src="{{ $img_url }}" alt="Image" class="img-fluid">
                                                @endforeach
                                                @endif
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