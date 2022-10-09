@include("lostandfound.header")
@include("lostandfound.search_bar")

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.4/css/lg-transitions.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.4/css/lightgallery.min.css">

<div class="pt-5">

  <div class="container-fluid single_listing">
  	<?php $liked_posts = get_liked_posts(); ?>
    @if(!empty($post)) 
    <?php $rel_class = "col-lg-8";

    $content = json_decode($post->content, true);
    $remove = ['country', 'state', 'city'];
    $detail_content = array_filter(array_diff_key($content, array_flip($remove)));

    ?>
    <!-- if post exists starts -->
    @if($post->status != 'active')
    <div class="row pt-0 pb-3 status-margin">
      <div class="col-md-6 mb-4 m-auto alert alert-warning alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Note!</strong> This post is not visible to other users. The status is {{ ucfirst($post->status) }}.
      </div>
    </div>
    @endif
    
    <div class="row">
      <div class="col-lg-8">
        <div class="listing_slider">
          <div class="ribbon">
            <?php 
            $type = ($post->type == '1' ) ? 'danger':'success';
            $value = ($post->type == '1' ) ? 'Lost':'Found';
            ?>
            <span class="ribbon-{{ $type }}">{{$value}}</span>
          </div>
          <?php
          $uploaded_images = json_decode($post->images,true);
          $img_url = image_check_l(isset($uploaded_images['0']) ? $uploaded_images['0'] : '', $post->sub_cat_id);
          $liked=(in_array($post->id, $liked_posts)) ? 'fa fa-heart' : 'fa fa-heart-o';
          ?>
          <div class="custom-tooltip">
            @if(Auth::check())
            <a href="javascript:void(0)" class="bookmark s-li-p like_unlike">
              @else
              <a href="#tab1" data-toggle="modal" data-target="#modalLoginForm" class="s-li-p bookmark">
                @endif
                <span class="{{ $liked }}" data-id="{{$post->id}}">
                  @if($liked === 'fa fa-heart-o')
                  <p class="tooltiptext">Add in remember list</p>
                  @else($liked === 'fa fa-heart')
                  <p class="tooltiptext">Remove from remember list</p>
                  @endif
                </span>
              </a>
            </div>
            <div id="aniimated-thumbnials" class="slider-for">

              @if(!empty($uploaded_images))
              @foreach( $uploaded_images as $ui)

              <?php
              $img_url2 = image_check($ui,$post->sub_cat_id);
              ?>
              <a href="{{ $img_url2 }}">
                <img src="{{ $img_url2 }}" />
              </a>
              @endforeach
              @else
              <a href="{{ $img_url }}">
                <img src="{{ $img_url }}" />
              </a>
              @endif
            </div>
            <div class="slider-nav" style="display: flex;">
              @if(!empty($uploaded_images))
              @foreach( $uploaded_images as $ui)
              <?php
              $img_url = image_check('th_'.$ui,$post->sub_cat_id);
              ?>
              <div class="item-slick">
                <img src="{{ $img_url }}" alt="Alt">
              </div>
              @endforeach
              @else
              <div class="item-slick">
                <img src="{{ $img_url }}" alt="Alt">
              </div>
              @endif
            </div>
          </div>
          <!-- slider end -->
        </div>
        <!-- 8-col end -->
        <div class="col-lg-4 side-col-info-main">
          <div class="col-lg-12 col-md-12 col-sm-12 side-main-info mb-1">
            <div class="col-lg-12 col-md-12 col-sm-12 side-botom-info">
              <span class="loctin-botm-left">@if($date == 'Today' || $date == 'Yesterday') {{ $date }}
              @else {{ date('d-M-Y', strtotime($date)) }} @endif</span>
            </div>

            <h6 class="heading-h mb-1 text-black">{{ $post->title }}</h6>
            @if($post->type == '1')
            <h4 class=" text-black mb-3 price">Reward: {{ $post->reward}}</h4>
            @endif
            <div class="car-km row">
              <div class="col-md-5 dtl-hd-s">
                <span><strong>Missing Since :</strong></span>  
              </div>
              <div class="col-md-7 dtl-cn-s">
                <span>{{ $post->found_date }}</span>
              </div>
            </div>
            <div class="car-km row">
              <div class="col-md-5 dtl-hd-s">
                <span><strong>City/State :</strong></span>
              </div>
              <div class="col-md-7 dtl-cn-s">
                <span>{{ isset($content['city']) ? $content['city'] : ''}} {{ isset($content['state']) ? $content['state'] : ''}}
                </span>
              </div>
            </div>
            <div class="car-km row">
              <div class="col-md-5 dtl-hd-s">
                <span><strong>Location :</strong></span>
              </div>
              <div class="col-md-7 dtl-cn-s">
                <span>{{ $post->found_location }}</span>
              </div>
            </div>
            <div class="car-km row">
              <div class="col-md-5 dtl-hd-s">
                <span><strong>Country :</strong></span>
              </div>
              <div class="col-md-7 dtl-cn-s">
                <span>{{ isset($content['country']) ? $content['country'] : ''}} </span>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 side-main-info mb-1">
            <h6 class="heading-h mb-1 text-black">Chat with Reporter</h6>
            <div class="col-lg-12 profile-img-reptr">
              <?php
              $img_urll = social_image_check($image_data = array('image' => $post->image, 'avatar' => $post->social_avatar));
              ?>
              <a class="lnk-pro" href="#"><figure class="rui-D_EoZ _186ru"  style="width: 68px;height: 68px;background-image: url('<?php echo $img_urll ?>');background-repeat: no-repeat;background-size: cover;float: left; border-radius: 50%;"></figure></a>
              <span class="pro-name"> {{ $post->display_name }}</span>
              @if($post->show_number == '1')
              <h4 class=" car-km"><span style="font-weight: 500;text-align: center;margin: 0 auto;display: block;">{{ $post->phonenumber }}</span></h4>
              @endif
            </div>

            @if(Auth::check() && Auth::id() != $post->user_id)
            <form action="{{ url('send-message') }}" autocomplete="off" id="msg-form" method="post">
              {{ csrf_field() }}
              <input type="text" value="{{ Auth::user()->firstname }}" name="name" readonly="readonly" class="form-control mb-1" placeholder="Name">
              <input type="email" value="{{ Auth::user()->email }}" name="email" readonly="readonly" class="form-control mb-1" placeholder="Email">
              <textarea placeholder="Write Message" name="message" id="message" class="form-control mb-1" rows="3" cols="50" style="margin-top: 0px;margin-bottom: 0px;" id="message" required></textarea>

              <button type="submit" id="msg-btn" class="btn txt-white same-bg mxg-xubmt-btn rounded">
                <div id="msg-loader"></div>
                <span id="msg-btn-text">Send
                  <i class="fa fa-paper-plane ml-1"></i>
                </span>
              </button>
            </form>
            @elseif(Auth::id() != $post->user_id)
            <div class="col-12 btn-msg-box">
              <a href="" data-toggle="modal" data-target="#modalLoginForm" class="btn rounded same-bg text-white without-login">
                <span class="same-bg text-white rounded">Chat With User</span>
              </a>
            </div>
            @endif
          </div>

        </div>
        <!-- 4-col end -->
      </div>


      <div class="row">
        <div class="col-lg-8 mb-2">
          <!-- Details -->
          <div class="col-lg-12 col-md-12 col-sm-12 listing-main-detail">
            <div class="col-lg-12 col-md-12 col-sm-12 inner-detail">
              @if($post->status == 'active')
              <div class="social-col social-icnx">
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" class="fa fa-facebook"></a>
                <a target="_blank" href="https://twitter.com/share?url={{ Request::url() }}&text={{ $post->title }}via=shahoodahmed11" class="fa fa-twitter"></a>
                <a target="_blank" href="https://www.linkedin.com/shareArticle?url={{ Request::url() }}&title={{ $post->title }}&summary={!! $post->description !!}&source={{ url('/') }}" class="fa fa-linkedin"></a> 
                <a target="_blank" href="https://{{check_device()}}.whatsapp.com/send?text={{ Request::url() }}" class="fa fa-whatsapp"></a>
                <a target="_blank" href="//www.pinterest.com/pin/create/button/?url={{ Request::url() }}&media={{ $img_url }}&description={{ $post->title }}" data-pin-do="buttonPin" data-pin-config="beside" data-pin-color="red" data-pin-height="28" class="fa fa-pinterest"></a>
              </div>
              @endif
              <h5 class="heading-h mb-1 text-black">Details</h5>
              <div class="col-lg-12 col-md-12 col-sm-12 main-innr-div">
                @foreach($detail_content as $key => $value )
                <?php
                $find = ['cat','sub_cat', '_'];
                $replace = ['Category', 'Sub Category', ' '];
                ?>
                <div class="col-lg-6 col-md-6 col-sm-6 text-detail">
                  <div class="col-lg-12 col-md-12 col-sm-12 innr-text-detail">
                    <span class="text-detail-sp1">{{ ucfirst( str_replace($find,$replace,$key)) }}</span>
                    <span class="text-detail-sp2"> {{ $value }}</span>
                  </div>  
                </div>
                @endforeach
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 dec">
              <h5 class="heading-h mb-1 text-black">Description</h5>
              <p> {!! nl2br($post->description) !!} </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Details End -->
      <!-- if post exists ends -->
      @else
      <?php $rel_class = "col-lg-12"; ?>
      <div class="row">
        <div class="col-md-12 text-center no-search-result">
          <div class="img-search">
            <img src="https://hfrtechnologies.com/dev/lost_found/public/images/cate-search.png">
          </div>
          <div class="expired-mxg">
            <h1>OPPS!</h1>
            <p>This post has been Expired, Removed or In-Active</p>
          </div>
        </div>
      </div>
      @endif 

      <!-- Related Slider -->
      @if($related_ads->isNotEmpty())

      <div class="row">
       <div class="{{ $rel_class }}">
        <div class=" col-lg-12 listing-main-detail related pb-0">
          <!-- Carousel -->
          <div class="row">
            <div class="col-12">
              <h4 class="heading-h mb-1 text-black">Related Posts</h4>
            </div>
            <div class="col-12">
              <div class="owl-carousel nonloop-block-13 my-ol-nav" data-aos="fade-left">
                @foreach($related_ads as $rel_add)
                <?php
                $uploaded_images = json_decode($rel_add->images,true);
                $img_url = image_check(isset($uploaded_images['0']) ? 'th_'.$uploaded_images['0'] : '', $rel_add->sub_cat_id);
                $rel_content = json_decode($rel_add->content, true);
                ?>
                <div class="d-block d-md-flex listing vertical">
                  <div class="ribbon">
                    <?php 
                    $type = ($rel_add->type == '1' ) ? 'danger':'success';
                    $value = ($rel_add->type == '1' ) ? 'Lost':'Found';
                    ?>
                    <span class="ribbon-{{ $type }}">{{$value}}</span>
                  </div>
                  <a href="{{ route('single_post',['id'=>$rel_add->id,'title' => str_replace('+','-',urlencode($rel_add->title))]) }}" class="img d-block">
                    <img src="{{ $img_url }}"/> 
                    @if(isset($rel_add->reward))
                    <div class="body-bottom">
                      <span class="reward">{{ isset($rel_add->reward) ? 'Reward: '.$rel_add->reward : '' }}</span>
                    </div>
                    @endif
                  </a>
                  <?php
                  $liked=(in_array($rel_add->id, $liked_posts)) ? 'fa fa-heart' : 'fa fa-heart-o';
                  ?>
                  <div class="custom-tooltip">
                    @if(Auth::check())
                    <a href="javascript:void(0)" class="bookmark like_unlike">
                      @else
                      <a href="#tab1" data-toggle="modal" data-target="#modalLoginForm" class="bookmark">
                        @endif
                        <span class="{{ $liked }}" data-id="{{$rel_add->id}}">
                          @if($liked === 'fa fa-heart-o')
                          <p class="tooltiptext">Add in remember list</p>
                          @else($liked === 'fa fa-heart')
                          <p class="tooltiptext">Remove from remember list</p>
                          @endif
                        </span>
                      </a>
                    </div>
                    <div class="lh-content">
                     <h3><a href="{{ route('single_post',['id'=>$rel_add->id,'title' => str_replace('+','-',urlencode($rel_add->title))]) }}">{{ $rel_add->title }}</a></h3>
                     <p>{{ $rel_add->description }}</p>
                     <div class="cat-loc">
                       <span><i class="fa fa-th"></i>{{ isset($rel_content['cat'])? $rel_content['cat'] : ''}}</span>
                       <span><i class="fa fa-map-marker"></i>{{ isset($rel_content['city'])? $rel_content['city'] : ''}} {{ isset($rel_content['state'])? $rel_content['state'] : ''}}</span>
                     </div>
                   </div>

                 </div>
                 @endforeach
               </div>
             </div>
           </div> <!-- Carousel -->
         </div>
       </div>
     </div>
     @endif
     <!-- Related Slider end-->

   </div>
 </div>

 @include("lostandfound.footer")

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.4/js/lightgallery-all.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
 <script type="text/javascript">
  $(function() {

    $('#aniimated-thumbnials').lightGallery({
      thumbnail: true,
    });
// Card's slider
var $carousel = $('.slider-for');

$carousel
.slick({
  share: false,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  adaptiveHeight: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  centerMode: true,
  focusOnSelect: true,
  prevArrow: '<span class="fa fa-chevron-circle-left listing-arrow"></span>',
  nextArrow: '<span class="fa fa-chevron-circle-right listing-arrow"></span>',
  variableWidth: true,
  infinite: false
});

$("#lg-share").html('');

$('.left').click(function(){
  $('.slider-for').slick('slickPrev');
})

$('.right').click(function(){
  $('.slider-for').slick('slickNext');
})
});
</script>

@if(!empty($post))
<script type="text/javascript">

  $(document).on('submit', '#msg-form',function(event){
    event.preventDefault();
    $("msg-btn").attr('disabled',true);
    $("#msg-btn-text").html('');
    $("#msg-loader").html("<img src='{{ URL::asset('public/images/login-loader.gif') }}' alt='loading...' />");
    $.ajax({
      url:"{{ url('send-message') }}",
      type:'POST',
      data: {message: $('#message').val(),post_id: "{{ $post->id }}"},
      dataType: 'json'
    }).done(function(r){
      if (r.status == 1) {
        $('.lu_msg_success').html(r.msg);
        $("#lu_msg_s").toast({ delay: 3000 });
        $("#lu_msg_s").toast('show');
        $("#message").val('');
      }
      else{
        $('.lu_msg_failure').html("You cannot send empty message");
        $("#lu_msg_f").toast({ delay: 3000 });
        $("#lu_msg_f").toast('show');
      }
      $('#msg-btn').attr('disabled',false);
      $("#msg-loader").html('');
      $("#msg-btn-text").html('Send<i class="fa fa-sign-in ml-1"></i></span>');
    });
  });

</script>
@endif
</body>
</html>