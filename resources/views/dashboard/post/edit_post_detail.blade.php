@include("dashboard.header")
<div class="page-content-wrapper">
    <div class="page-content" style="min-height:1459px">
        <div class="page-head">
            <div class="page-title">
                <h1>Lost&Found
                    <small>Edit Post</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="#">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Edit Post</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Edit Post Details
                        </div>

                        <div class="actions">
                            <a href="{{ route('single_post',['id'=>$post->id, 'title' => str_replace('+','-',urlencode($post->title)) ]) }}" class="btn btn-default btn-sm">
                                <i class="fa fa-pencil"></i> View Post </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form action="{{ url('ad-update-submit-post') }}" method="post" class="post_form" id="post_form" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <fieldset>
                                @if(Session::has("errors"))
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Failure!</strong> 
                                    @if ($errors->any())
                                    {{ implode('', $errors->all(':message')) }}
                                    @endif
                                </div>
                                @endif

                                @if(Session::has("msg_success"))
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success!</strong>
                                    {{ Session::get("msg_success") }}
                                </div>
                                @endif
                                <div id="radioBtn">
                                    <div class="row">
                                        <?php
                                        $active = $post->type;
                                        ?>
                                        <input type="hidden" name="post_type" id="post_type" value="{{$post->type}}">
                                        <div class="col-md-6 lost_found_btn" data-val='1'>
                                            <a @if($post->type == '1') class="btn col-md-12 active" @else class="btn col-md-12" @endif id="lost" data-value="1">Lost</a>
                                        </div>
                                        <div class="col-md-6 lost_found_btn" data-val='2'>
                                            <a @if($post->type == '2') class="btn col-md-12 active" @else class="btn col-md-12" @endif id="found" data-value="2">Found</a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Category<span>*</span></label>
                                            <div class="select_wrapper">
                                                <i class="fa fa-caret-down"></i>
                                                <select class="mdb-select md-form frm-actve" name="cat_id" id="cat_id">
                                                    <option value=""></option>
                                                </select>
                                                <span id="error_cat_id" class="display_errors same-color error-size"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="sub_cat_hid">
                                            <label class="control-label">Sub-category<span>*</span></label>
                                            <div class="select_wrapper">
                                                <i class="fa fa-caret-down"></i>
                                                <select class="mdb-select md-form frm-actve" name="sub_cat_id" id="sub_cat_id">
                                                    <option value=""></option>
                                                </select>
                                                <span id="error_sub_cat_id" class="display_errors same-color error-size"></span>
                                                <div id="loader-image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <label class="control-label">Title<span>*</span></label>
                                            <div class="inputGroupContainer">
                                                <div class="input-group"><input id="title" name="title" placeholder="Enter Title" class="form-control frm-actve" value="{{ $post->title }}" type="text">
                                                </div>
                                                <span id="error_title" class="display_errors same-color error-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label">Description<span>*</span></label>
                                            <div class="inputGroupContainer">
                                                <div class="input-group"><textarea name="description" id="description" placeholder="Enter Description" class="form-control frm-actve" type="text" rows="10" cols="12">{!! str_replace('<br />', "\n", $post->description); !!}</textarea>
                                                </div>
                                                <span id="error_description" class="display_errors same-color error-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">State/Province<span>*</span></label>
                                            <div class="select_wrapper">
                                                <i class="fa fa-caret-down"></i>
                                                <select class="mdb-select md-form frm-actve" name="state_id" id="state_id">
                                                    <option value=""></option>
                                                </select>
                                                <span id="error_state_id" class="display_errors same-color error-size"></span>
                                                <div id="loader-image-state">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">City<span>*</span></label>
                                            <div class="select_wrapper">
                                                <i class="fa fa-caret-down"></i>
                                                <select class="mdb-select md-form frm-actve" name="city_id" id="city_id">
                                                    <option value=""></option>
                                                </select>
                                                <span id="error_city_id" class="display_errors same-color error-size"></span>
                                                <div id="loader-image-city">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <?php
                                        if ($post->type == '1') {
                                            $abc = 'Lost';
                                        }else{
                                            $abc = 'Found';
                                        }
                                        ?>
                                        <div class="col-md-6">
                                            <label class="control-label type_date">{{ $abc }} Date<span>*</span></label>
                                            <div class="inputGroupContainer">
                                                <div class="input-group">
                                                    <input class="form-control frm-actve" id="datepicker" autocomplete="off" value="{{ $post->found_date }}" name="date" placeholder="DD/MM/YYYY" type="text"/>
                                                </div>
                                                <span id="error_date" class="display_errors same-color error-size"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label type_location">{{ $abc}} Location<span>*</span></label>
                                            <div class="inputGroupContainer">
                                                <div class="input-group">
                                                    <input class="form-control frm-actve" id="location" autocomplete="off" value="{{ $post->found_location }}" name="location" placeholder="Location" type="text"/>
                                                </div>
                                                <span id="error_location" class="display_errors same-color error-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Contact Name<span>*</span></label>
                                            <div class="inputGroupContainer">
                                                <div class="input-group">
                                                    <input class="form-control frm-actve" id="display_name" autocomplete="off" value="{{ $post->display_name }}" name="display_name" placeholder="Name in Post" type="text"/>
                                                </div>
                                                <span id="error_display_name" class="display_errors same-color error-size"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Phone Number<span>*</span></label>
                                            <div class="inputGroupContainer">
                                                <div class="input-group">
                                                    <input type="number" class="form-control frm-actve" id="phonenumber" autocomplete="off" value="{{ $post->phonenumber }}" name="phonenumber" placeholder="Phone Number"/>
                                                </div>
                                                <span id="error_phonenumber" class="display_errors same-color error-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <?php
                                        if ($post->type == '1') {
                                            ?>
                                            <div class="col-md-6 reward-field">
                                                <label class="control-label">Appreciation reward</label>
                                                <div class="inputGroupContainer">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control frm-actve" id="reward" autocomplete="off" value="{{ $post->reward }}" name="reward" placeholder="Appreciation reward"/>
                                                    </div>
                                                    <span id="error_phonenumber" class="display_errors same-color error-size"></span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                      
                                        ?>
                                        <div class="col-md-6">
                                            <label>Show my phone number on my ads</label>
                                            <div class="inputGroupContainer">
                                                <div class="input-group">
                                                    <label class="switcch">
                                                        <input class="on-off" type="checkbox" name="show_number" @if($post->show_number == "1")  checked @endif  value="1">
                                                        <span class="slideer roound"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="dynamic_form_fields" class="main-inner-loader">
                                    </div>
                                </div>
                                <div class="form-group upload_img">
                                    <label class="control-label">Upload photos<span>*</span></label>

                                    <?php
                                    $uploaded_images = json_decode($post->images,true);
                                    ?>

                                    @for ($i = 0; $i < 5; $i++)
                                    <?php
                                    $j = $i+1;
                                    ?>
                                    @if(isset($uploaded_images[$i]))
                                    <?php

                                    $img_url2 = image_check($uploaded_images[$i]);
                                    ?>
                                    <div class="col-lg-2 avatar-upload avatar-upds">
                                        <div class="avatar-edit avtr-edit">
                                            <input type='file' class="upload_image" id="imageUpload{{ $j }}" name="image[]" data-id="{{ $j }}"  accept=".png, .jpg, .jpeg" value="1" />
                                            <label for="imageUpload{{ $j }}"></label>

                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview{{ $j }}" style="background-image: url({{ $img_url2 }});">
                                                <span class="delete_image" data-name="{{ $uploaded_images[$i] }}">X</span>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-lg-2 avatar-upload avatar-upds">
                                        <div class="avatar-edit avtr-edit">
                                            <input type='file' class="upload_image" id="imageUpload{{ $j }}" name="image[]" data-id="{{ $j }}" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload{{ $j }}"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview{{ $j }}" style="background-image: url({{ URL::asset('storage/app/files/static.png') }});">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endfor
                                    <span class="same-color error-size">
                                        <ul class="display_errors same-color error-size error_image0 error_image1 error_image2 error_image3 error_image4"></ul>
                                    </span>
                                </div>
                                <input type="hidden" name="remove_images" id="remove_images">
                                <input id="id" name="id" class="form-control" value="{{ $post->id }}" type="hidden">

                                <div class="form-group submit_btn">
                                    <div class="input-group">
                                        <button class="btn same-bg text-white " type="submit" id="post_btn">Update Post</button>
                                    </div>
                                </div> 
                            </ieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("dashboard.footer")
<script type="text/javascript">
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
        endDate: new Date()
    });
</script>

<?php
$filters = ["state_id", "cat_id", "sub_cat_id","city_id", "make", "model"];
$filter_values = [];
foreach ($filters as $filter) {
    if (isset($post->$filter)&& !empty($post->$filter)) {
        $$filter = $post->$filter;
        $filter_values[$filter] = $post->$filter;
    }
    else{ 
        $$filter = '';
        $filter_values[$filter] =  '';
    }
}
$dynamic_filters = $post->content;

?>

<script type="text/javascript">

    uploaded_images = <?php echo $post->images; ?>;
    deleted_images = [];
    static_image = "{{ URL::asset('storage/app/files/static.png') }}";
    $(document).ready(function()
    {
        $(document).on('click', '.delete_image',function(e){
            $(this).parent().parent().parent().find('.upload_image').val('');
            if ($(this).attr('data-name') != '' && typeof $(this).attr('data-name') != 'undefined') {
                deleted_images.push($(this).attr('data-name'));
                $('#remove_images').val(deleted_images);
            }
            $(this).parent().css('background-image', 'url('+static_image +')');
            $(this).remove();
        });

        function readURL(input,counter) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview'+counter).css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview'+counter).append('<span class="delete_image">X</span>');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".upload_image").change(function() {
            counter = $(this).attr('data-id');
            readURL(this,counter);
        });
    });

    cat_id = "<?php echo $cat_id; ?>";
    state_id = "<?php echo $state_id; ?>";
    sub_cat_id = "<?php echo $sub_cat_id; ?>";
    city_id = "<?php echo $city_id; ?>";


    $(document).ready(function(){

        dynamic_filters = JSON.parse('<?php echo $dynamic_filters;  ?>');

        if(cat_id != "") {
            $("#dynamic_form_fields").html("<img src='{{url('public/images/loader.gif')}}' alt='loading...' />");
            $("#dynamic_form_fields").load("{{url('get-fields').'/'.$cat_id.'/'.$sub_cat_id.'?dynamic_filters='.urlencode($dynamic_filters) }}");
        }

        if(cat_id != ""){

            get_subcategories(cat_id);
        }
        if(state_id != ""){

            get_cities(state_id);
        }

        $.ajax({url:"{{ route('get-categories')}}",
            type:'GET'
        }).done(function(r){

            $('#cat_id').html(r);
            $('#cat_id').val(cat_id);
        });

        function get_subcategories(cat_id){
            $.ajax({url:"{{ route('get-subcategories')}}/?id="+cat_id,
                type:'GET'
            }).done(function(r){

                $('#sub_cat_id').html(r);
                $('#sub_cat_id').val(sub_cat_id);
            });
        }
        function get_cities(state_id){
            $.ajax({url:"{{ route('get-cities')}}/?id="+state_id,
                type:'GET'
            }).done(function(r){

                $('#city_id').html(r);
                $("#city_id").val(city_id);
            });
        }
    });

    $(document).on('change', '#sub_cat_id',function(){
        $("#dynamic_form_fields").html("<img src='{{url('public/images/loader.gif')}}' alt='loading...' />");
        $("#dynamic_form_fields").load("{{ url('get-fields') }}/"+$('#cat_id').val()+"/"+$(this).val());

    });

    $(document).on('change', '#cat_id',function(){
        $("#loader-image").html("<img class='ld-img' src='{{url('public/images/loader.gif')}}'/>");
        $.ajax({url:"{{ route('get-subcategories')}}/?id="+$(this).val(),
            type:'GET'
        }).done(function(r){

            $('#sub_cat_id').html(r);
            $('#sub_cat_id').val(sub_cat_id);
            $("#loader-image").html('');
            $("#dynamic_form_fields").html('');
        });
    });

    $(document).on('change', '#state_id',function(){
        $("#loader-image-city").html("<img class='ld-img' src='{{url('public/images/loader.gif')}}'/>");
        $.ajax({url:"{{ route('get-cities')}}/?id="+$(this).val(),
            type:'GET'
        }).done(function(r){
            $('#city_id').html(r);
            $('#city_id').val(city_id);
            $("#loader-image-city").html('');
        });
    });


    $(document).on('click', '#post_btn',function(e){

        $(".main-looader").addClass("loader-after");
        $("#loader-image-page").html("<img src='{{url('public/images/loader.gif')}}' alt='loader...' />");
        $('#uploaded_images').val(uploaded_images);
        var formData = new FormData($('#post_form')[0]);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $('#post_form').attr('action'),
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (data) {
                if (data.status == '1') {
                    window.location.reload();
                }
                else{
                    $("#loader-image-page").html('');
                    $('.display_errors').html('');
                    counter =1;
                    $.each(data.errors, function( index, value ) {
                        value = value[0];
                        index =  index.replace('.','');
                        $('#error_'+index).html(value);
                        $('.error_'+index).append('<li>'+value+'</li>');
                        if (counter == 1) {
                            $('html, body').animate({
                                scrollTop: ($('#error_'+index).first().offset().top-100)
                            },500);
                        }
                        counter++;
                    });
                }
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.lost_found_btn',function(e){
            $("#radioBtn a").removeClass("active");
            $(this).find('a').addClass("active");
            $("#post_type").val($(this).attr('data-val'));
            if ($(this).attr('data-val') == 2) {
                $type_date = 'Found Date';
                $type_location = 'Found Location';
                $(".reward-field").hide();
            }
            else{
                $type_date = 'Lost Date';
                $type_location = 'Lost Location';
                $(".reward-field").show();
            }
            $(".type_location").text($type_location);
            $(".type_date").text($type_date);
        });
        $.ajax({url:"{{ url('get-admin-states').'/'.$post->country_id }}",
            type:'GET'
        }).done(function(r){
            $('#state_id').html(r);
            if (state_id != '') {
                $('#state_id').val(state_id); 
            }
        });
    });
    $(document).on('change', '#make',function(){
      $.ajax({url:"{{ route('get-brands')}}/?id="+$(this).val(),
        type:'GET'
    }).done(function(r){
        $('#model').html(r);
    });
});
</script>
</body>
</html>
