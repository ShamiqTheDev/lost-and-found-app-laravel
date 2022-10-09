@include("lostandfound.header")
@include("lostandfound.search_bar")
<div class="container lost_ads">

	@if(Session::has("msg_success"))
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong>
		{{ Session::get("msg_success") }}
	</div>
	@endif

	@if(Auth::user()->verifiy_email == 1)

	<h2 class="text-center headings">MY REPORTS</h2>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a @if(!Session::has("msg_success")) class="nav-link active" @else class="nav-link" @endif id="active-posts" data-toggle="tab" onclick="set_status('active')" href="#ac-posts" role="tab" aria-controls="ac-posts" aria-selected="true">Active</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="inactive-posts" data-toggle="tab" onclick="set_status('inactive')" href="#inac-posts" role="tab" aria-controls="inac-posts" aria-selected="false">Inactive</a>
				</li>
				<li class="nav-item">
					<a @if(Session::has("msg_success")) class="nav-link active" @else class="nav-link" @endif id="pending-posts" data-toggle="tab" onclick="set_status('pending')" href="#pen-posts" role="tab" aria-controls="pen-posts" aria-selected="false">Pending</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="inactive-posts" data-toggle="tab" onclick="set_status('rejected')" href="#rej-posts" role="tab" aria-controls="rej-posts" aria-selected="false">Rejected</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div @if(!Session::has("msg_success")) class="tab-pane fade show active" @else class="tab-pane fade" @endif id="ac-posts" role="tabpanel" aria-labelledby="active-posts">
					<div class="ads_wraper">
						<div class="ads_detail row" id="active-div">
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="inac-posts" role="tabpanel" aria-labelledby="inactive-posts">
					<div class="ads_wraper">
						<div class="ads_detail row" id="inactive-div">
						</div>
					</div>
				</div>
				<div  @if(Session::has("msg_success")) class="tab-pane fade show active" @else class="tab-pane fade" @endif id="pen-posts" role="tabpanel" aria-labelledby="pending-posts">
					<div class="ads_wraper">
						<div class="ads_detail row" id="pending-div">
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="rej-posts" role="tabpanel" aria-labelledby="rejected-posts">
					<div class="ads_wraper">
						<div class="ads_detail row" id="rejected-div">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="alert alert-info alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Note!</strong>
		Please Check Your Mail to Activate Account.
	</div>

	@endif
	<div class="row">
		<div class="pagination">
			<nav aria-label="...">
			</nav>
		</div>
	</div>
</div>

@include("lostandfound.footer")

<script type="text/javascript">

	status = 'active';
	$(document).ready(function(){
		@if(Session::has("msg_success"))
		status = 'pending';
		@endif
		get_dashboard_posts();
	});

	function set_status(status_new){
		status = status_new;
		get_dashboard_posts();
	}
	function get_dashboard_posts(){
		$.ajax({
			url:"{{ url('get-dashboard-posts')}}"+"/"+status,
			type:'GET'
		}).done(function(r){
			$('#'+status+'-div').html(r);
		});
	}

	$("#radioBtn a").click(function () {
		$("#radioBtn a").removeClass("active");
		$(this).addClass("notActive");
		$("#radioBtn a").removeClass("notActive");
		$(this).addClass("active");
		$('#post_type').val($("#radioBtn a.active").attr('data-value'));
	});
</script>

<script type="text/javascript">

	function delete_confirm(id, status){
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this post!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#e33030',
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: "Cancel",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm){
				$.ajax({
					url:"{{ url('delete-post-detail') }}/"+id+"/"+status,
					type:'GET',
					dataType:'json'
				}).done(function(r){
					if (r.status == '1') {
						swal("Deleted!", "Your post has been deleted!", "success");
						$('#post_'+status+id).slideUp();
					}
					else{
						swal("Cancelled", "Something went wrong :)", "warning");            
					}
				});
			}
		});
	};

	function change_status(id, status){
		if (status == 'active') {
			var alert_msg = "You want to de-activate your post?";
			var alert_tex = "Yes de-activate it!";
		}else{
			var alert_msg = "You want to activate your post?";
			var alert_tex = "Yes activate it!";
		}
		swal({
			title: "Are you sure?",
			text: alert_msg,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#e33030',
			confirmButtonText: alert_tex,
			cancelButtonText: "Cancel",
			closeOnConfirm: true,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm){
				$.ajax({
					url:"{{ url('change-post-status') }}/"+id+"/"+status,
					type:'GET',
					dataType:'json'
				}).done(function(r){
					if (r.status == 1) {
						swal("Changed!", "Your post status has been changed!", "success");
						$('#post_'+status+id).slideUp();
					}
					else{
						swal("Cancelled", "Something went wrong :)", "warning");            
					}
				});
			}
		});
	};
</script>
</body>
</html>