@include("lostandfound.header")
<div id="loader-image-page" class="main-looader main-page-loader">
</div>
<div class="container post_adds main_content"> 

	<h2 class="text-center headings">ADD POST</h2>
	<div class="row">
		<form action="{{ route('submit-post') }}" autocomplete="off" method="post" class="post_form" id="post-form" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<fieldset>
				@if(Session::has("errors"))
				<div class="alert alert-danger alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Failure!</strong> 
					@if ($errors->any())
					@foreach ($errors->all() as $error)
					<ul style="color: red;">
						<li>
							{{ $error }}
						</li> 
					</ul>
					@endforeach
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
						$active = $_GET['type'];
						?>
						<input type="hidden" name="post_type" id="post_type" value="{{$active}}">
						<div class="col-md-1"></div>
						<div class="col-md-4 lost_found_btn" data-val='1'>
							<a @if($active == 1) class="btn col-md-12 active" @else class="btn col-md-12" @endif id="lost" data-value="1">Lost</a>
						</div>
						<div class="col-md-2"></div>
						<div class="col-md-4 lost_found_btn" data-val='2'>
							<a @if($active == 2) class="btn col-md-12 active" @else class="btn col-md-12" @endif id="found" data-value="2">Found</a>
						</div>
						<div class="col-md-1"></div>
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
									<option val="">Select Category</option>
									@foreach($categories as $c)
									<option value="{{$c->id}}" data-id="{{ $c->parent_id}}">{{$c->name}}</option>
									@endforeach
								</select>
								<span id="error_cat_id" class="display_errors same-color error-size"></span>
							</div>
						</div>
						<div class="col-md-6" id="sub_cat_hid">
							<label class="control-label">Sub-category<span>*</span></label>
							<div class="select_wrapper">
								<i class="fa fa-caret-down"></i>
								<select class="mdb-select md-form frm-actve" name="sub_cat_id" id="sub_cat_id">
									<option val="" id="sel_main_form">Select a Main category first</option>
									@foreach($sub_categories as $sub_cat)
									<option value="{{$sub_cat->id}}" data-id="{{ $sub_cat->parent_id}}" disabled>{{$sub_cat->name}}</option>
									@endforeach
								</select>
								<span id="error_sub_cat_id"  class="display_errors same-color error-size"></span>
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
								<div class="input-group"><input id="title" name="title" placeholder="Enter Title" class="form-control frm-actve" value="{{ old('title') }}" type="text"></div>
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
								<div class="input-group"><textarea name="description" id="description" placeholder="Enter Description" class="form-control frm-actve"  type="text"></textarea></div>
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
								<span id="error_state_id" class="display_errors same-color error-size">
								</span>
								<div id="loader-image-state">
								</div>
							</div>
						</div>
						<div class="col-md-6" id="city_hid" style="display: none;">
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
						if ($_GET['type'] == '1') {
							$abc = 'Lost';
						}else{
							$abc = 'Found';
						}
						?>
						<div class="col-md-6">
							<label class="control-label type_date">{{ $abc }} Date<span>*</span></label>
							<div class="inputGroupContainer">
								<div class="input-group date">
									<input class="form-control date-style frm-actve" id="datepicker" autocomplete="off" value="{{ old('date') }}" name="date" placeholder="DD/MM/YYYY" type="text"/>
								</div>

								<span id="error_date" class="display_errors same-color error-size"></span>
							</div>
						</div>
						<div class="col-md-6">
							<label class="control-label type_location">{{ $abc }} Location<span>*</span></label>
							<div class="inputGroupContainer">
								<div class="input-group">
									<input class="form-control frm-actve" id="location" autocomplete="off" value="{{ old('location') }}" name="location" placeholder="Location" type="text"/>
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
									<input class="form-control frm-actve" id="display_name" autocomplete="off" value="{{ Auth::user()->firstname.' '.Auth::user()->lastname }}" name="display_name" placeholder="Name in Post" type="text"/>
								</div>
								<span id="error_display_name" class="display_errors same-color error-size"></span>
							</div>
						</div>
						<div class="col-md-6">
							<label class="control-label">Phone Number<span>*</span></label>
							<div class="inputGroupContainer">
								<div class="input-group">
									<input type="text" readonly style="max-width: 75px" class="form-control text-center col-md-2" id="country_code" autocomplete="off" value="+{{ Session::get('country_phonecode') }}" name="country_code" placeholder="Code"/>
									<input type="number" class="form-control col-md-10 frm-actve" id="phonenumber" autocomplete="off" value="{{ Auth::user()->phonenumber }}" name="phonenumber" placeholder="Phone Number"/>
								</div>
								<span id="error_phonenumber" class="display_errors same-color error-size"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6 reward-field" style="display: @if($_GET['type'] == '2') none @endif">
							<label class="control-label">Appreciation reward</label>
							<div class="inputGroupContainer">
								<div class="input-group">
									<input type="number" class="form-control frm-actve" id="reward" autocomplete="off" value="{{ old('reward') }}" name="reward" placeholder="Reward Money"/>
								</div>
								<span id="error_phonenumber" class="display_errors same-color error-size"></span>
							</div>
						</div>

						<div class="col-md-6">
							<label>Show my phone number on my ads</label>
							<div class="inputGroupContainer">
								<div class="input-group">
									<label class="switcch">
										<input class="on-off" type="checkbox" name="show_number" value="1" checked>
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
					<label class="control-label">Upload photos</label>
					<div class="col-lg-2 avatar-upload avatar-upds">
						<div class="avatar-edit avtr-edit">
							<input type='file' class="upload_image" id="imageUpload1" name="image[]" data-id="1" accept=".png, .jpg, .jpeg" />
							<label for="imageUpload1"></label>
						</div>
						<div class="avatar-preview">
							<div id="imagePreview1" style="background-image: url('storage/app/files/static.png');">
							</div>
						</div>
					</div>
					<div class="col-lg-2 avatar-upload avatar-upds">
						<div class="avatar-edit avtr-edit">
							<input type='file' class="upload_image" id="imageUpload2" name="image[]" data-id="2" accept=".png, .jpg, .jpeg" />
							<label for="imageUpload2"></label>
						</div>
						<div class="avatar-preview">
							<div id="imagePreview2" style="background-image: url('storage/app/files/static.png');">
							</div>
						</div>
					</div>
					<div class="col-lg-2 avatar-upload avatar-upds">
						<div class="avatar-edit avtr-edit">
							<input type='file' class="upload_image" id="imageUpload3" name="image[]" data-id="3" accept=".png, .jpg, .jpeg" />
							<label for="imageUpload3"></label>
						</div>
						<div class="avatar-preview">
							<div id="imagePreview3" style="background-image: url('storage/app/files/static.png');">
							</div>
						</div>
					</div>
					<div class="col-lg-2 avatar-upload avatar-upds">
						<div class="avatar-edit avtr-edit">
							<input type='file' class="upload_image" id="imageUpload4" name="image[]" data-id="4" accept=".png, .jpg, .jpeg" />
							<label for="imageUpload4"></label>
						</div>
						<div class="avatar-preview">
							<div id="imagePreview4" style="background-image: url('storage/app/files/static.png');">
							</div>
						</div>
					</div>
					<div class="col-lg-2 avatar-upload avatar-upds">
						<div class="avatar-edit avtr-edit">
							<input type='file' class="upload_image" id="imageUpload5" name="image[]" data-id="5" accept=".png, .jpg, .jpeg" />
							<label for="imageUpload5"></label>
						</div>
						<div class="avatar-preview">
							<div id="imagePreview5" style="background-image: url('storage/app/files/static.png');">
							</div>
						</div>
					</div>
					<span class="same-color error-size">
						<ul class="display_errors same-color error-size error_image0 error_image1 error_image2 error_image3 error_image4"></ul>
					</span>
				</div>
				<div class="form-group submit_btn">
					<div class="input-group">
						<button class="btn same-bg text-white rounded" type="submit" id="post-btn">Post Now</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

@include("lostandfound.footer")

<script type="text/javascript">
	$('#datepicker').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		autoclose: true,
		endDate: new Date()
	});
</script>

<script type="text/javascript">
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

	$(document).on('click', '.delete_image',function(e){
		$(this).parent().parent().parent().find('.upload_image').val('');
		$(this).parent().css('background-image', 'url("storage/app/files/static.png")');
		$(this).hide();
	});
</script>

<script type="text/javascript">

	function get_subcategories(cat_id){

		$('#dynamic_form_fields').html('');
		$('#sub_cat_id option').hide();
		$('#sub_cat_id option').attr('disabled','disabled');
		$('#sub_cat_id option[data-id="'+cat_id+'"]').show();
		$('#sub_cat_id option[data-id="'+cat_id+'"]').removeAttr('disabled');
		$('#sub_cat_id').val(sub_cat_id);
	}

	$(document).on('change', '#cat_id',function(){
		get_subcategories($(this).val());
	});

	$(document).on('change', '#sub_cat_id',function(){
		$("#dynamic_form_fields").html("<img src='{{url('public/images/loader.gif')}}' alt='loader...' />");
		$("#dynamic_form_fields").load("{{ url('get-fields') }}/"+$('#cat_id').val()+"/"+$(this).val());
	});

	$(document).on('change', '#state_id',function(){
		$("#loader-image-city").html("<img class='ld-img' src='{{url('public/images/loader.gif')}}'/>");
		$.ajax({url:"{{ route('get-cities')}}/?id="+$(this).val(),
			type:'GET'
		}).done(function(r){
			$('#city_id').html(r);
			$("#loader-image-city").html('');
			$('#city_hid').show();
		});
	});

	uploaded_images = [];
	$(document).on('submit', '#post-form',function(e){
		$('#post-btn').attr('disabled',true);
		$(".main-looader").addClass("loader-after");
		$("#loader-image-page").html("<img src='{{url('public/images/findwala-loader.gif')}}' alt='loader...' />");
		
		$('#uploaded_images').val(uploaded_images);
		var formData = new FormData($('#post-form')[0]);
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: $('#post-form').attr('action'),
			enctype: 'multipart/form-data',
			data: formData,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function (data) {
				$("#post-btn").attr('disabled',false);
				if (data.status == '1') {
					window.location.replace("{{ route('user_dashboard') }}");
				}
				else{
					$("#loader-image-page").html('');
					$(".main-looader").removeClass('loader-after');
					$('.display_errors').html('');
					counter =1;

					$('.lu_msg_failure').html(data.msg);
					$("#lu_msg_f").toast({ delay: 3000 });
					$("#lu_msg_f").toast('show');
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
		$(".type_location").html($type_location+"<span>*</span>");
		$(".type_date").html($type_date+"<span>*</span>");
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