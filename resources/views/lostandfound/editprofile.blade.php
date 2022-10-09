@include("lostandfound.header")
@include("lostandfound.search_bar")
<div id="loader-image-page" class="main-looader main-page-loader">
</div>
<div class="container edit_profile">
	<div class="row">
		<div class="col-md-12">
			<div class="tabs">
				<ul>
					<li><a href="#section1">Profile</a></li>
					<li><a href="#section2">Password</a></li>
					<li><a href="#section3">Notification</a></li>
				</ul>
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
				<section id="section1">
					<h2 class="text-center">Profile Update</h2>
					<div class="row">
						<form action="{{ route('update-detail') }}" autocomplete="off" method="post" enctype="multipart/form-data" class="post_form" id="profile-form">
							{!! csrf_field() !!}
							<fieldset>
								<div class="form-group">
									<label class="control-label">Upload picture<span>*</span></label>
									<div class="avatar-upload">
										<div class="avatar-edit">
											<?php
											$img_url = social_image_check(['image'=>$current_user->image, 'avatar'=>$current_user->social_avatar ]);
											?>
											<input type='file' class="upload_image" id="imageUpload" name="imageUpload" value="{{Auth::check() ? Auth::user()->image : null}}" accept=".png, .jpg, .jpeg" />
											<label for="imageUpload"></label>
										</div>
										<div class="avatar-preview">
											<div id="imagePreview" style="background-image: url(<?php echo $img_url ?>);">
											</div>
											@if(!(strpos($img_url, 'login-img') !== false))
											<span class="delete_image">X</span>
											@endif
										</div>
									</div>
									<span id="error_imageUpload" class="display_errors same-color error-size"></span>
									<input type="hidden" name="remove_profile_img" id="remove_profile_img" value="">
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">First Name<span>*</span></label>
											<div class="inputGroupContainer">
												<div class="input-group">
													<input id="firstname" name="firstname" placeholder="First Name" class="form-control frm-actve" required="true" value="{{ $current_user->firstname }}" type="text">
												</div>
												<span id="error_firstname" class="display_errors same-color error-size"></span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Last Name<span>*</span></label>
											<div class="inputGroupContainer">
												<div class="input-group">
													<input id="lastname" name="lastname" placeholder="Last Name" class="form-control frm-actve" required="true" value="{{$current_user->lastname}}" type="text">
												</div>
												<span id="error_lastname" class="display_errors same-color error-size"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Phone Number<span>*</span></label>
											<div class="inputGroupContainer">
												<div class="input-group">
													<?php
													if(!empty($current_user->country_code)){
														$code = $current_user->country_code;
													}
													else{
														$code = Session::get('country_phonecode');
													}
													?>
													<input id="country_code" name="country_code" class="form-control frm-actve col-md-2" required="true" value="{{ $code }}" type="text" readonly="readonly">

													<input id="phonenumber" name="phonenumber" placeholder="Phone Number" class="form-control frm-actve col-md-10" required="true" value="{{$current_user->phonenumber}}" type="text">
												</div>
												<span id="error_country_code" class="display_errors same-color error-size"></span>
												<span id="error_phonenumber" class="display_errors same-color error-size"></span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Email Address<span>*</span></label>
											<div class="inputGroupContainer">
												<div class="input-group">
													<input readonly="readonly" id="email" name="email" placeholder="Email" class="form-control frm-actve" required="true" value="{{$current_user->email}}" type="text">
												</div>
												<span id="error_email" class="display_errors same-color error-size"></span>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="form-group submit_btn">
									<div class="input-group">
										<button class="btn txt-white same-bg" type="submit" id="profile-btn">Update Profile</button>
									</div>
								</div> 
							</fieldset>
						</form>
					</div>
				</section>

				<section id="section2">
					<h2 class="text-center">Password Update</h2>
					<div class="row">
						<form action="{{ route('update-user-password') }}" autocomplete="off" method="post" class="post_form" id="password-form">
							{!! csrf_field() !!}
							<fieldset>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Old Password<span>*</span></label>
											<div class="input-group">
												<input type="password" class="form-control frm-actve" placeholder="Enter Old Password" id="old_password" name="old_password">
											</div>
											<span id="error_old_password"  class="display_errors same-color error-size"></span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">New Password<span>*</span></label>
											<div class="input-group">
												<input autocomplete="off" type="password" class="form-control frm-actve" placeholder="Enter New Password" id="new_password" name="new_password">
											</div>
											<span id="error_new_password"  class="display_errors same-color error-size"></span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Confirm Password<span>*</span></label>
											<div class="input-group">
												<input autocomplete="off" type="password" class="form-control frm-actve" placeholder="Enter Confirm Password" id="new_password_confirmation" name="new_password_confirmation">
											</div>
											<span id="error_new_password_confirmation"  class="display_errors same-color error-size"></span>
										</div>
									</div>
								</div>
								<br>
								<div class="form-group submit_btn">
									<div class="input-group">
										<button class="btn txt-white same-bg" type="submit" id="password-btn">Update Password</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</section>

				<section id="section3">
					<h2 class="text-center">Notification</h2>
					<div class="row">
						<form action="" method="post" autocomplete="off" class="post_form" id="notification-form">
							{!! csrf_field() !!}
							<fieldset>
								<!-- <div class="alert alert-info alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Note!</strong>
									By Switching it off you will no longer get Email notifications regarding your post.
								</div> -->
								<div class="form-group">
									<div class="col-md-12">
										<label>Get Notifications</label>
										<div class="inputGroupContainer">
											<div class="input-group">
												<label class="switcch">
													<input class="on-off" type="checkbox" name="notification_email" @if($current_user->notification_email=='1') checked="checked" @else chechked="false" @endif>
													<span class="slideer roound"></span>
												</label>
											</div>
										</div>
										<div class="inputGroupContainer">
											<div class="text-center">
												<p>By Switching it off you will no longer get Email notifications regarding your posts.</p>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="form-group submit_btn">
									<div class="input-group">
										<button class="btn txt-white same-bg" type="submit" id="notification-btn">Update Settings</button>
									</div>
								</div> 
							</fieldset>
						</form>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>

@include("lostandfound.footer")

<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#imagePreview').css('background-image', 'url('+e.target.result+')');
				$('#imagePreview').hide();
				$('#imagePreview').fadeIn(650);
				$('#remove_profile_img').val('1');
				$('#imagePreview').append('<span class="delete_image">X</span>');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#imageUpload").change(function() {
		readURL(this);
	});

	$(document).on('click', '.delete_image',function(e){
		$('#imageUpload').val('');
		$('#imagePreview').css('background-image', 'url("storage/app/profiles/login-img.png")');
		$('#remove_profile_img').val('1');
		$(this).hide();
	});

	$(document).on('submit', '#profile-form',function(e){
		$('#profile-btn').attr('disabled',true);
		$(".main-looader").addClass("loader-after");
		$("#loader-image-page").html("<img src='{{url('public/images/findwala-loader.gif')}}' alt='loader...' />");
		var formData = new FormData($('#profile-form')[0]);
		e.preventDefault();
		$.ajax({url:"{{ route('update-detail')}}",
			type:'post',
			data: formData,
			processData: false,
			contentType: false,
			dataType:'json'
		}).done(function(r){
			$("#loader-image-page").html('');
			$('.display_errors').html('');
			$(".main-looader").removeClass("loader-after");

			if (r.status == 1){
				$(".lu_msg_success").html(r.msg);
				$("#lu_msg_s").toast({ delay: 3000 });
				$("#lu_msg_s").toast('show');
			}
			else{
				counter =1;
				$.each(r.errors, function( index, value ) {
					value = value[0];
					$('#error_'+index).html(value);
					if (counter == 1) {
						$('html, body').animate({
							scrollTop: ($('#error_'+index).first().offset().top-100)
						},500);
					}
					counter++;
				});
			}
			$('#profile-btn').attr('disabled',false);
		});
	});

	$(document).on('submit', '#password-form',function(e){
		$('#password-btn').attr('disabled',true);
		$(".main-looader").addClass("loader-after");
		$("#loader-image-page").html("<img src='{{url('public/images/findwala-loader.gif')}}' alt='loader...' />");
		var formData = new FormData($('#password-form')[0]);
		e.preventDefault();
		$.ajax({url:"{{ route('update-user-password')}}",
			type:'post',
			data: formData,
			processData: false,
			contentType: false,
			dataType:'json'
		}).done(function(r){

			$("#loader-image-page").html('');
			$('.display_errors').html('');
			$(".main-looader").removeClass("loader-after");
			$('#old_password').val('');
			$('#new_password').val('');
			$('#new_password_confirmation').val('');
			
			if (r.status == 0){

				$('.lu_msg_failure').html(r.msg);
				$("#lu_msg_f").toast({ delay: 3000 });
				$("#lu_msg_f").toast('show');
				counter =1;
				$.each(r.errors, function( index, value ) {
					$('#error_'+index).html(value);
					if (counter == 1) {
						$('html, body').animate({
							scrollTop: ($('#error_'+index).first().offset().top-100)
						},500);
					}
					counter++;
				});
			}else{
				$('#old_password').val('');
				$('#new_password').val('');
				$('#new_password_confirmation').val('');
				$('.display_errors').html('');

				$('.lu_msg_success').html(r.msg);
				$("#lu_msg_s").toast({ delay: 3000 });
				$("#lu_msg_s").toast('show');
			}
			$('#password-btn').attr('disabled',false);
		});
	});

	$(document).on('submit', '#notification-form',function(e){
		$('#notification-btn').attr('disabled',true);
		$(".main-looader").addClass("loader-after");
		$("#loader-image-page").html("<img src='{{url('public/images/findwala-loader.gif')}}' alt='loader...' />");
		var formData = new FormData($('#notification-form')[0]);
		e.preventDefault();
		$.ajax({url:"{{ route('update-notification')}}",
			type:'post',
			data: formData,
			processData: false,
			contentType: false,
			dataType:'json'
		}).done(function(r){

			$("#loader-image-page").html('');
			$(".main-looader").removeClass("loader-after");

			$('.lu_msg_success').html(r.msg);
			$("#lu_msg_s").toast({ delay: 3000 });
			$("#lu_msg_s").toast('show');
			$('#notification-btn').attr('disabled',false);
		});
	});
</script>


<script type="text/javascript">
	var Tabs = function($) {
		return {

			init: function() {
				this.cacheDom();
				this.setupAria();
				this.bindEvents();
			},

			cacheDom: function() {
				this.$el = $('.tabs');
				this.$tabList = this.$el.find('ul');
				this.$tab = this.$tabList.find('li');
				this.$tabFirst = this.$tabList.find('li:first-child a');
				this.$tabLink = this.$tab.find('a');
				this.$tabPanel = this.$el.find('section');
				this.$tabPanelFirstContent = this.$el.find('section > *:first-child');
				this.$tabPanelFirst = this.$el.find('section:first-child');
				this.$tabPanelNotFirst = this.$el.find('section:not(:first-of-type)');
			},

			bindEvents: function() {
				this.$tabLink.on('click', function(){
					this.changeTab();
				}.bind(this));
				this.$tabLink.on('keydown', function() {
					this.changeTabKey();
				}.bind(this));
			},

			changeTab: function() {
				var self = $(event.target);
				event.preventDefault();
				this.removeTabFocus();
				this.setSelectedTab(self);
				this.hideAllTabPanels();
				this.setSelectedTabPanel(self);
			},

			changeTabKey: function() {
				var self = $(event.target),
				$target = this.setKeyboardDirection(self, event.keyCode);

				if ($target.length) {
					this.removeTabFocus(self);
					this.setSelectedTab($target);
				}
				this.hideAllTabPanels();
				this.setSelectedTabPanel($(document.activeElement));
			},

			hideAllTabPanels: function() {
				this.$tabPanel.attr('aria-hidden', 'true');
			},

			removeTabFocus: function(self) {
				var $this = self || $('[role="tab"]');

				$this.attr({
					'tabindex': '-1',
					'aria-selected': null
				});
			},

			selectFirstTab: function() {
				this.$tabFirst.attr({
					'aria-selected': 'true',
					'tabindex': '0'
				});
			},

			setupAria: function() {
				this.$tabList.attr('role', 'tablist');
				this.$tab.attr('role', 'presentation');
				this.$tabLink.attr({
					'role': 'tab',
					'tabindex': '-1'
				});
				this.$tabLink.each(function() {
					var $this = $(this);

					$this.attr('aria-controls', $this.attr('href').substring(1));
				});
				this.$tabPanel.attr({
					'role': 'tabpanel'
				});
				this.$tabPanelFirstContent.attr({
					'tabindex': '0'
				});
				this.$tabPanelNotFirst.attr({
					'aria-hidden': 'true'
				});
				this.selectFirstTab();
			},

			setKeyboardDirection: function(self, keycode) {
				var $prev = self.parents('li').prev().children('[role="tab"]'),
				$next = self.parents('li').next().children('[role="tab"]');

				switch (keycode) {
					case 37:
					return $prev;
					break;
					case 39:
					return $next;
					break;
					default:
					return false;
					break;
				}
			},
			setSelectedTab: function(self) {
				self.attr({
					'aria-selected': true,
					'tabindex': '0'
				}).focus();
			},
			setSelectedTabPanel: function(self) {
				$('#' + self.attr('href').substring(1)).attr('aria-hidden', null);
			},
		};
	}(jQuery);

	Tabs.init();
</script>
</body>

</html>