@include("lostandfound.header")

@include("lostandfound.search_bar")

<div class="site-section-pad chat-margn">
  <div class="container">
    <div class="row h-100">
      <div class="col-3 border-chat-lightgray px-0 bordr-box" id="sidebar">
        <div id="sidebar-content" class="w-100 h-100">
          <div class="input-group p-0 d-xs-none main-sech" id="search-group">
            <input type="text" class="form-control cht-serch border-0" placeholder="Search..." id="search">
            <span class="input-group-addon">
              <button class="btn border-0 bg-white same-color hover-color-darkblue cht-srch-btn" type="button">
                <i class="fa fa-search fa-fw"></i>
              </button>
            </span>
          </div>
          <div class="w-100" id="list-group">
            <ul class=" list-group w-100" id="friend-list">
              <?php
              $chat_id = '';
              ?>
              @foreach($users as $key => $user)
              <?php
              $uploaded_images = json_decode($user->images,true);
              $img_url = image_check(isset($uploaded_images['0']) ? $uploaded_images['0'] : '');
              $content = json_decode($user->content, true);
              ?>
              
              @if($key == 0)
              <?php
              $chat_id = $user->chat_user_id;
              $data_img = $img_url;
              $data_cat = isset($content['cat'])? $content['cat'] : '' ;
              $data_title = $user->title;
              $data_user_name = $user->chat_user_name;
              $data_user_image =  social_image_check(['image' => $user->chat_image, 'avatar' => $user->social_avatar]);
              $data_post_id = $user->post_id;
              ?>
              @endif

              <li class="list-group-item p-1 side-mxg hover-bg-lightgray">
                <div class="user-msg-id" data-img="{{ $img_url }}" data-id="{{ $user->chat_user_id }}" data-cat="{{ isset($content['cat'])? $content['cat'] : '' }}" data-title="{{ $user->title }}" id="user_{{ $user->chat_user_id }}" data-user-name="{{ $user->chat_user_name }}" data-user-image="{{ social_image_check(['image' => $user->chat_image, 'avatar' => $user->social_avatar]) }}" data-post-id="{{ $user->post_id }}">
                  <div class="per-img">
                    <img src="{{ $img_url }}" class="img-fluid rounded-circle">
                  </div>
                  <div class="per-name-title get-msgs">
                    <span class="d-xs-none username">{{ $user->chat_user_name }}</span>
                    <?php
                    $new = new_msgs_count($user->chat_user_id, $user->post_id);
                    ?>
                    @if($new>0)
                    <span class="badge baadge-primary">
                      <p style="margin: 0;padding: 2px 5px;font-size: 11px;">
                       {{ ($new>0) ? $new : '' }}
                     </p>
                   </span>
                   @endif
                   <span class="d-xs-none text-truncate title-t">{{ $user->title }}</span>
                 </div>
               </div>
             </li>
             @endforeach
           </ul>
         </div>
       </div>
     </div>
     <div class="col d-flex p-0">
      <div class="card">
        <div class="card-header cht-bg text-white py-1 px-2" style="flex: 1 1">
          <div class="d-flex flex-row justify-content-start">
            <div class="col">
              <div class="msg_user">
                <span><img id="user_image" src="{{ URL::asset('storage/app/profiles/login-img.png') }}"></span>
                <span id="user_title"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body d-flex flex-column p-0">
          <div class="message-scroll">
            <div class="row">
              <div class="col-lg-12 main-title-col">
                <div class="main-title-body">
                  <div class="tile-img">
                    <img id="post_img" src="" class="img-fluid">
                  </div>
                  <div class="data-name-title">
                    <span class="username" id="post_title"></span>
                    <span class="title-tt" id="post_cat"></span>
                  </div>
                </div>
              </div>
            </div>
            <div id="msgs_content">
            </div>
          </div>
          <div class="">
            @if($users->isNotEmpty())
            <form action="" id="message-send" method="post">
              <input type="text" class="form-control border-0 typ-mxg" placeholder="Write message..." id="msg_text" />
              <span class="input-group-addon xnd-mxg-box">
                <button class="btn border-0 same-color hover-color-darkblue xnd-mxg-btn" id="send-msg" type="submit">
                  <i class="fa fa-paper-plane"></i>
                </button>
              </span>
            </form>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@include("lostandfound.footer")

<script type="text/javascript">

  document.addEventListener('DOMContentLoaded', function () {
    $('.card-header').on('click', '[data-fa-i2svg]', function () {
      $("#sidebar-content")
      .removeClass("w-100")
      .width($("#sidebar").width());
      $("#sidebar").css({"flex" : "none"});
      $("#sidebar").animate({
        width: "toggle"
      }, 600, function() {
        $("#sidebar").css({"flex" : '', "width" : ''});
        $("#sidebar-content")
        .css("width", "")
        .addClass("w-100");
      });
    });

    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#friend-list li .username").filter(function() {
       $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1);
     });
    });
  });

</script>
<script type="text/javascript">

  post_id = '';
  receiver_id = '';
  @if(isset($chat_id) && !empty($chat_id))
  receiver_id = "{{$chat_id}}";
  $(document).ready(function(){
   get_user_msgs("{{ $chat_id }}","{{$data_post_id}}");

   $('#post_title').html("{{ $data_title }}");
   $('#post_cat').html("{{ $data_cat }}");
   $('#post_img').attr('src',"{{ $data_img }}");
   $('#user_title').html("{{ $data_user_name }}");
   $('#user_image').attr('src',"{{ $data_user_image }}");
   post_id = "{{ $data_post_id }}";
 });
  @endif
  $(document).on('click', '.user-msg-id',function(){
    current_badge = $(this).find('.baadge-primary');
    get_user_msgs($(this).attr('data-id'),$(this).attr('data-post-id'));
    receiver_id = $(this).attr('data-id');
    $('#post_title').html($(this).attr('data-title'));
    $('#post_cat').html($(this).attr('data-cat'));
    $('#post_img').attr('src',$(this).attr('data-img'));
    $('#user_title').html($(this).attr('data-user-name'));
    $('#user_image').attr('src',$(this).attr('data-user-image'));
    post_id = $(this).attr('data-post-id');

    setTimeout(function(){ 
     current_badge.fadeOut("slow");
   }, 1000);
  });

  function get_user_msgs($id,$post_id){

    $.ajax({
      url:"{{ url('get-user-msgs') }}/"+$id+'/'+$post_id,
      type:'GET',
      dataType: 'JSON'
    }).done(function(r){
      msgs_content = '';

      if (r.status == '1') {
        user1 = r.user1;
        user2 = r.user2;
        $.each( r.msgs, function( key, value ) {
          if (value.sender_id == $id ) {
            user_name = user2.firstname+' '+ user2.lastname;
            $class1 = 'row';
            $class2 = 'card message-card user-box m-1';
          }
          else{
           user_name = user1.firstname+' '+ user1.lastname;
           
           $class1 = 'row justify-content-end';
           $class2 = 'card message-card owner-box bg-lightblue m-1';
         }
         msgs_content +='<div class="'+$class1+'"><div class="'+$class2+'"><div class="card-body"><span class="mb-mxg" id="show-msgs">'+ value.message +'</span><span class="date-tme mx-1"><small>'+value.created_at+'<i class="chk-gren fa fa-check fa-fw"></i></small></span></div></div></div>';
       });
        $('#msgs_content').html(msgs_content);
        $('#msgs_content').addClass('msgs_content_box');
        $("#msgs_content").animate({ scrollTop: $('#msgs_content').prop("scrollHeight")}, 1000);
      }
    });
  }

  $(document).on('submit', '#message-send',function(e){
   e.preventDefault();
   $("#send-msg").attr('disabled',true);
   var msg_text = $('#msg_text').val();
   $('#msg_text').val('');
   if (msg_text != '') {
    $.ajax({
      url:"{{ url('send-message') }}",
      type:'POST',
      data: {message: msg_text
        ,post_id: post_id,receiver_id:receiver_id},
        dataType: 'json'
      }).done(function(r){
       $("#send-msg").attr('disabled',false);
       if (r.status == '1') {
         msgs_content ='<div class="row justify-content-end"><div class="card message-card bg-lightblue m-1"><div class="card-body p-2"><span class="mb-mxg" id="show-msgs">'+ r.msg_data.message +'</span><span class="date-tme mx-1"><small>'+r.msg_data.created_at+'<i class="chk-gren fa fa-check fa-fw"></i></small></span></div></div></div>';

         $('#msgs_content').append(msgs_content);
         $("#msgs_content").animate({ scrollTop: $('#msgs_content').prop("scrollHeight")}, 1000);
         
       }
       else{
        $('.lu_msg_failure').html('Something went wrong. Please refresh the page and try again');
        $("#lu_msg_f").toast({ delay: 3000 });
        $("#lu_msg_f").toast('show');
      }
    });
    }else{
     $("#send-msg").attr('disabled',false);
   }
 });

</script>

</body>
</html>