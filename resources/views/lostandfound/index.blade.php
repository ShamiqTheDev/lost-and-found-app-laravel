@include("lostandfound.header")
<style type="text/css">
  .input-fld {
    float: left;
  }
</style>
<?php
$liked_posts = get_liked_posts();
?>
<script type="text/javascript">
  setInterval(function(){ 
    if($('#head-tit').hasClass('is_visible')) {
     $('#head-tit').fadeOut('fast');
     $('#head-tit').removeClass('is_visible');
     $('#head-tit').addClass("opacity1");
     $('.box-img-col').addClass('is_visible');
     $('.box-img-col').fadeIn('slow');
     $('.box-img-col').addClass("opacity1");
   } else if($('.box-img-col').hasClass('is_visible')) {
     $('.box-img-col').fadeOut('fast');
     $('.box-img-col').removeClass('is_visible');
     $('.box-img-col1').addClass('is_visible');
     $('.box-img-col1').fadeIn('slow');
     $('.box-img-col1').addClass("opacity1");
   }
   else{
    $('.box-img-col1').fadeOut('fast');
    $('.box-img-col1').removeClass('is_visible');
    $('#head-tit').addClass('is_visible');
    $('#head-tit').fadeIn('slow');
  }
}, 5000);
</script>

<div class="site-blocks-cover overlay" style="background-image: url(public/images/mbb11.png);background-repeat: no-repeat;
background-position: 0% 70%;">
<div class="container">
  <div class="row align-items-center justify-content-center text-center">
    <div class="col-md-12">
      <div class="row justify-content-center">
        <div class="col-md-12 text-center">
          <div class="col-md-12 abt-col " data-aos="fade-up">
            <div class="bg-shodw">
              <h2 id="head-tit" class="is_visible head-op">

               <?php 
               $ip_if = ip_info();
               $head = "World's Best Lost And Found Website";
               if (isset($ip_if['country_code']) ) {
                if ($ip_if['country_code']== 'PK') {
                 $head = "Pakistan's First Lost And Found Website";
               }elseif($ip_if['continent'] == 'Asia'){
                $head = "Asia's First Lost And Found Website";
              }
            }
            ?>
            {{ $head  }}
          </h2>
          <div class="box-img-col ad-opstn">
            <span><img class="img-fluid" src="{!! asset('public/images/sml.png') !!}"><a href="#"><p>Found Something?</p></a></span>
            <p class="abt-p">Post an Ad to help the owner getting it back. Its Free!</p>       
          </div>
          <div class="box-img-col1 ad-opstn">
            <span><img class="img-fluid" src="{!! asset('public/images/sad.png') !!}"><a href="#"><p>Lost Something?</p></a></span>
            <p class="abt-p">Post an Ad so people can help you getting it back. Its Free!</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- SearchBar -->
  <div class="form-search-wrap mt-2" data-aos="fade-up" data-aos-delay="200">
    <form action="{{ url('listings') }}" method="get">
      <div class="row align-items-center">
        <div class="col-lg-3 col-sm-12 marjin-b1  mb-xl-0 col-xl-4">
          <input type="text" name="search" class="form-control frm-actve rounded" placeholder="What are you looking for?">
        </div>
        <div class="col-lg-3 col-sm-12 marjin-b1  mb-xl-0 col-xl-3">
          <div class="select-wrap">
           <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
           <select class="form-control frm-actve rounded" name="state_id" id="state_id">
            <option></option>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-sm-12 marjin-b1  mb-xl-0 col-xl-3">
        <div class="select-wrap">
          <span class="icon"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
          <select class="form-control frm-actve rounded" name="cat_id" id="cat_id">
            <option></option>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-sm-12 marjin-b1 col-xl-2 ml-auto text-right">
        <input type="submit" class="txt-white btn same-bg btn-block rounded" value="Search">
      </div>
    </div>
  </form>
</div> 
<!-- SearchBar -->
</div>
</div>
</div>
</div>
<div class="pad-btm site-section bg-lightt">
  <div class="container">
   <!-- Services Items -->
   <div class="d-none d-sm-none d-md-block overlap-category mb-5" data-aos="fade-up">
    <div class="row align-items-stretch no-gutters">
      <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
        <a href="{{ url('listings?cat_id=5') }}" class="same-color popular-category h-100">
          <span class="icon"><img class="img-fluid img-w aftr-hovr" src="{!! asset('public/images/ltb.png') !!}">
            <img class="img-fluid ltm-w hovr-img" src="{!! asset('public/images/ltb-w.png') !!}">
          </span>
          <span class="caption d-block pop-cate"><p>Mobile\Laptop</p></span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
        <a href="{{ url('listings?cat_id=3') }}" class="same-color popular-category h-100">
          <span class="icon"><img class="img-fluid img-w aftr-hovr" src="{!! asset('public/images/iconx/file.png') !!}">
            <img class="img-fluid img-w hovr-img" src="{!! asset('public/images/file-w.png') !!}">
          </span>
          <span class="caption d-block pop-cate">Documents</span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
        <a href="{{ url('listings?cat_id=6') }}" class="same-color popular-category h-100">
          <span class="icon"><img class="img-fluid img-w aftr-hovr" src="{!! asset('public/images/iconx/team.png') !!}">
            <img class="img-fluid img-w hovr-img" src="{!! asset('public/images/team-w.png') !!}">
          </span>
          <span class="caption d-block pop-cate">Persons</span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
        <a href="{{ url('listings?cat_id=4') }}" class="same-color popular-category h-100">
          <span class="icon"><img class="img-fluid img-w aftr-hovr" src="{!! asset('public/images/iconx/electronics.png') !!}">
            <img class="img-fluid img-w hovr-img" src="{!! asset('public/images/electronics-w.png') !!}">
          </span>
          <span class="caption d-block pop-cate">Electronics</span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
        <a href="{{ url('listings?cat_id=1') }}" class="same-color popular-category h-100">
          <span class="icon"><img class="img-fluid img-w aftr-hovr" src="{!! asset('public/images/car-bike.png') !!}">
            <img class="img-fluid img-w hovr-img" src="{!! asset('public/images/car-bike-w2.png') !!}">
          </span>
          <span class="caption d-block pop-cate">Vehicles</span>
        </a>
      </div>
      <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
        <a href="{{ url('listings?cat_id=8') }}" class="same-color popular-category h-100">
          <span class="icon"><img class="img-fluid img-w aftr-hovr" src="{!! asset('public/images/iconx/service-dog.png') !!}">
            <img class="img-fluid img-w hovr-img" src="{!! asset('public/images/service-dog-w.png') !!}"></span>
            <span class="caption d-block pop-cate">Pets</span>
          </a>
        </div>
        <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
          <a href="{{ url('listings?cat_id=2') }}" class="same-color popular-category h-100">
            <span class="icon"><img class="img-fluid img-w aftr-hovr" src="{!! asset('public/images/iconx/box1.png') !!}">
              <img class="img-fluid img-w hovr-img" src="{!! asset('public/images/box1-w.png') !!}">
            </span>
            <span class="caption d-block pop-cate">Jewellery</span>
          </a>
        </div>
        <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
          <a href="{{ url('listings?cat_id=7') }}" class="same-color popular-category h-100">
            <span class="icon"><img class="img-fluid img-w aftr-hovr" src="{!! asset('public/images/iconx/accessory.png') !!}">
              <img class="img-fluid img-w hovr-img" src="{!! asset('public/images/accessory-w.png') !!}">
            </span>
            <span class="caption d-block pop-cate">Accessories</span>
          </a>
        </div>
        <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
          <a href="{{ url('listings?cat_id=9') }}" class="same-color popular-category h-100">
            <span class="icon"><img class="img-fluid img-w aftr-hovr" src="{!! asset('public/images/copyright.png') !!}">
              <img class="img-fluid img-w hovr-img" src="{!! asset('public/images/copyright-w.png') !!}">
            </span>
            <span class="caption d-block pop-cate">Others</span>
          </a>
        </div>
      </div>
    </div>
    <!-- Services Items -->
    <div class="row" data-aos="fade-left">
      <div class="col-7 heading-sldr-hme-innr">
        <h2 class="h5 mb-4 text-black">Recent Lost Posts</h2>
      </div>
      <div class="col-5 btn-sldr-hme-innr">
        <a href="{{ url('listings?type=1') }}">
          <button class="btn btn-view-more"><span>View All</span></button>
        </a>
      </div>
      <div class="col-12">
        <div class="owl-carousel nonloop-block-12 my-ol-nav" data-aos="fade-up">
          @foreach($lost_adds as $lost_add)
          <?php
          $uploaded_images = json_decode($lost_add->images,true);
          $img_url = image_check(isset($uploaded_images['0']) ? 'th_'.$uploaded_images['0'] : '', $lost_add->sub_cat_id);
          $content = json_decode($lost_add->content, true);
          ?>
          <div class="d-block d-md-flex listing vertical">
            <div class="ribbon">
              <?php 
              $type = ($lost_add->type == '1' ) ? 'danger':'success';
              $value = ($lost_add->type == '1' ) ? 'Lost':'Found';
              ?>
              <span class="ribbon-{{ $type }}">{{$value}}</span>
            </div>
            <a href="{{ route('single_post',['id'=>$lost_add->id, 'title' => str_replace('+','-',rawurlencode($lost_add->title)) ]) }}" class="img d-block">
             <img src="{{ $img_url }}"/> 

             @if(isset($lost_add->reward))
             <div class="body-bottom">
              <span class="reward">{{ isset($lost_add->reward) ? 'Reward: '.$lost_add->reward : '' }}</span>
            </div>
            @endif
          </a>
          <?php
          $liked=(in_array($lost_add->id, $liked_posts)) ? 'fa fa-heart' : 'fa fa-heart-o';
          ?>
          <div class="custom-tooltip">
            @if(Auth::check())
            <a href="javascript:void(0)" class="bookmark like_unlike">
              @else
              <a href="#tab1" data-toggle="modal" data-target="#modalLoginForm" class="bookmark">
                @endif
                <span class="{{ $liked }}" data-id="{{$lost_add->id}}">
                  @if($liked === 'fa fa-heart-o')
                  <p class="tooltiptext">Add in remember list</p>
                  @else($liked === 'fa fa-heart')
                  <p class="tooltiptext">Remove from remember list</p>
                  @endif
                </span>
              </a>
            </div>
            <div class="lh-content">
              <h3><a href="{{ route('single_post',['id'=>$lost_add->id,'title' => str_replace('+','-',rawurlencode($lost_add->title))]) }}">{{ $lost_add->title }}</a></h3>
              <p>{{ $lost_add->description }}</p>
              <div class="cat-loc">
               <span><i class="fa fa-th"></i>{{ isset($content['cat'])? $content['cat'] : ''}}</span>
               <span><i class="fa fa-map-marker"></i>{{ isset($content['city'])? $content['city'] : ''}} {{ isset($content['state'])? $content['state'] : ''}}</span>
             </div>
           </div>
         </div>
         @endforeach
       </div>
     </div>
   </div>
   <div class="row" data-aos="fade-right">
    <div class="col-7 heading-sldr-hme-innr">
      <h2 class="h5 mb-4 text-black">Recent Found Posts</h2>
    </div>
    <div class="col-5 btn-sldr-hme-innr">
      <a href="{{ url('listings?type=2') }}">
        <button class="btn btn-view-more"><span>View All</span></button>
      </a>
    </div>
    <div class="col-12">
      <div class="owl-carousel nonloop-block-12 my-ol-nav" data-aos="fade-up">
        @foreach($found_adds as $found_add)
        <?php
        $uploaded_images = json_decode($found_add->images,true);
        $img_url = image_check(isset($uploaded_images['0']) ? 'th_'.$uploaded_images['0'] : '', $found_add->sub_cat_id);
        $content = json_decode($found_add->content, true);
        ?>
        <div class="d-block d-md-flex listing vertical">
          <div class="ribbon">
            <?php 
            $type = ($found_add->type == '1' ) ? 'danger':'success';
            $value = ($found_add->type == '1' ) ? 'Lost':'Found';
            ?>
            <span class="ribbon-{{ $type }}">{{$value}}</span>
          </div>
          <a href="{{ route('single_post',['id'=>$found_add->id,'title' => str_replace('+','-',rawurlencode($found_add->title))]) }}" class="img d-block">
            <img src="{{ $img_url }}"/> 
            @if(isset($found_add->reward))
            <div class="body-bottom">
              <span class="reward">{{ isset($found_add->reward) ? 'Reward: '.$found_add->reward : '' }}</span>
            </div>
            @endif
          </a>
          <?php
          $liked=(in_array($found_add->id, $liked_posts)) ? 'fa fa-heart' : 'fa fa-heart-o';
          ?>
          <div class="custom-tooltip">
            @if(Auth::check())
            <a href="javascript:void(0)" class="bookmark like_unlike">
              @else
              <a href="#tab1" data-toggle="modal" data-target="#modalLoginForm" class="bookmark">
                @endif
                <span class="{{ $liked }}" data-id="{{$found_add->id}}">
                  @if($liked === 'fa fa-heart-o')
                  <p class="tooltiptext">Add in remember list</p>
                  @else($liked === 'fa fa-heart')
                  <p class="tooltiptext">Remove from remember list</p>
                  @endif
                </span>
              </a>
            </div>
            <div class="lh-content">
             <h3><a href="{{ route('single_post',['id'=>$found_add->id,'title' => str_replace('+','-',rawurlencode($found_add->title))]) }}">{{ $found_add->title }}</a></h3>
             <p>{{ $found_add->description }}</p>
             <div class="cat-loc">
               <span><i class="fa fa-th"></i>{{ isset($content['cat'])? $content['cat'] : ''}}</span>
               <span><i class="fa fa-map-marker"></i>{{ isset($content['city'])? $content['city'] : ''}} {{ isset($content['state'])? $content['state'] : ''}}</span>
             </div>
           </div>
         </div>
         @endforeach
       </div>
     </div>
   </div>
 </div>
</div>
<section class="how-it-wrk" data-aos="fade-up">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 text-center how-head">
        <h1 class="aos-init aos-animate" data-aos="fade-up">How It Works</h1>
        <p>Find wala is a site to help people find their lost things from all over the world specially Pakistan. Users can report about their lost things and also found things on the site to help return it to the owner. The lost and found things can be of any category for example mobiles, laptops, documents, persons, electronics, vehicles, pets, jewellery, accessories and any other category.</p>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 how-main">
        <div class="col-lg-4 col-md-4 col-sm-12 text-center innr-main-col">
          <div class="col-8 img-bg-box lf-bck">
          	<img class="img-fluid" src="{!! asset('public/images/lst-fnd.png') !!}">
          </div>
          <div class="dec-main" id="summary">
            <h4>Lost or Found?</h4>
            <p  class="collapse" id="collapseSummary">If you want to get your lost thing back or report it, so other people can know about it. 
            Or if you find anything, anywhere in the world, and you want to return it the owner. Or you see anything somewhere which seems to be lost by the owner and you want to help the owner to get it back. Then Findwala is the right platform for you.</p>
            <a class="collapsed same-color" data-toggle="collapse" href="#collapseSummary" aria-expanded="false" aria-controls="collapseSummary"></a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 text-center innr-main-col">
          <div class="col-8 img-bg-box reprt-bck">
            <img class="img-fluid" src="{!! asset('public/images/1-r.png') !!}">
          </div>
          <div class="dec-main" id="summary2">
            <h4>Post an Ad</h4>
            <p class="collapse" id="collapseSummary2">Findwala.com is the place to report such lost and found things.
              Create an account at findwala.com. Post an ad about your lost/found thing. 
              Put proper details about the lost/found thing/person etc while filling the post form, so that its easier for other people to find it at findwala.com
            The post is by default pending. Findwala team reviews the post and approves it. The post becomes live for visitors.</p>
            <a class="collapsed same-color" data-toggle="collapse" href="#collapseSummary2" aria-expanded="false" aria-controls="collapseSummary2"></a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 text-center innr-main-col">
          <div class="col-8 img-bg-box contn-bck">
            <img class="img-fluid" src="{!! asset('public/images/1-con.png') !!}">
          </div>
          <div class="dec-main" id="summary3">
            <h4>Connect with people</h4>
            <p  class="collapse" id="collapseSummary3">Site Visotors can view the post and contact you if needed. Findwala also has social share options. The post can be shared on facebook, twitter, instagram, whatsapp and pinterest. 
              Sharing on social media makes the post to reach more number of people, which increases the chances to reach the post to related person. 
              The post reaches the related person and he/she can contact the post owner.
              The report person and the related person can make sure the lost/found thing reaches the real owner. 
              Kindly note its the duty of the report person to verify the belonging of the lost/found thing. 
              Findwala.com is not responsible for verifying the belongings. Findwala just gives you a platform.
            </p>
            <a class="collapsed same-color" data-toggle="collapse" href="#collapseSummary3" aria-expanded="false" aria-controls="collapseSummary3"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="contact-us" data-aos="fade-up">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-12 col-md-12 col-sm-12 text-center contct-head">
        <h1>Contact Us</h1>
        <h4 style="text-align:center">For suggestions and advertisements</h4>
      </div>
    </div>
    @if(Session::has("msg_success"))
    <div class="col-md-6 m-auto alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success!</strong>
      {{ Session::get("msg_success") }}
    </div>
    @endif
    <div class="row input-container contact-form">
      <form action="{{ route('send-feedback') }}" method="post" style="width: 100%">
       {{ csrf_field() }}
       <div class="col-md-6 col-sm-6 float-left">
        <div class="form-group">
          <input class="inpt-txt frm-actve form-control" placeholder="First Name" name="firstname" type="text" required />
        </div>
      </div>
      <div class="col-md-6 col-sm-6 float-left">
        <div class="form-group">
          <input class="inpt-txt frm-actve form-control" placeholder="Last Name" name="lastname" type="text" required />
        </div>
      </div>
      <div class="col-md-12 col-sm-12 float-left">
        <div class="form-group">
          <input class="inpt-txt frm-actve form-control" placeholder="Email" type="email" name="email" required />
        </div>
      </div>
      <div class="col-md-12 col-sm-12 float-left">
        <div class="form-group">
          <textarea class="inpt-txt frm-actve contact-textarea form-control" rows="7" placeholder="Message" name="message" required></textarea>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 text-center input-btn">
        <div class="btn same-bg txt-white rounded con-snd-mxg"><button class="btn same-bg text-white rounded" type="submit">Send Message</button></div>
      </div>
    </form>
  </div>
</div>
</section>
@include("lostandfound.footer")
</body>
</html>