@include("lostandfound.header")
@include("lostandfound.search_bar")

<?php
$liked_posts = get_liked_posts();
?>
<div class="site-section">
  <div class="container">
    @if(!$remember_list->isEmpty())
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          @foreach($remember_list as $rl)
          <?php
          $uploaded_images = json_decode($rl->images,true);
          $img_url = image_check(isset($uploaded_images['0']) ? $uploaded_images['0'] : '');
          $content = json_decode($rl->content, true);
          ?>
          <div class="col-lg-4" id="like_post_{{ $rl->post_id }}">
            <div class="d-block d-md-flex listing vertical m-sld-h">
              <div class="slide-one-item home-slider my-listing-carousel owl-carousel">
                <div class="remember-post">
                  <a href="{{ route('single_post',['id'=>$rl->post_id,'title' => str_replace('+','-',urlencode($rl->title))]) }}">
                    <img src="{{ $img_url }}" alt="Image" class="img-fluid">
                    @if(isset($rl->reward))
                    <div class="body-bottom">
                      <span class="reward">{{ isset($rl->reward) ? 'Reward: '.$rl->reward : '' }}</span>
                    </div>
                    @endif
                  </a>
                </div>
              </div>
              <div class="custom-tooltip">
                <a href="javascript:void(0)" class="bookmark like_unlike">
                  <span class="fa fa-heart" data-id="{{$rl->post_id}}">
                    <p class="tooltiptext">Remove from remember list</p>
                  </span>
                </a>
              </div>
              <div class="lh-content">
               <h3><a href="{{ route('single_post',['id'=>$rl->post_id,'title' => str_replace('+','-',urlencode($rl->title))]) }}">{{ string_replace($rl->title,27) }}</a></h3>
               <p>{{ string_replace($rl->description, 32) }}</p>

               <div class="cat-loc">
                 <span><i class="fa fa-th"></i>{{ isset($content['cat'])? $content['cat'] : ''}}</span>
                 <span><i class="fa fa-map-marker"></i>{{ isset($content['city'])? $content['city'] : ''}} {{ isset($content['state'])? $content['state'] : ''}}</span>
               </div>
             </div>
           </div>
         </div>
         @endforeach
       </div>
       <div class="col-12 my-paginatin">
        <nav aria-label="...">
         {{ $remember_list->links() }}
       </nav>
     </div>
   </div>
 </div>
 @else
 <div class="row">
 	<div class="col-md-12 text-center rembrlst-head">
 		<h1>Remember list</h1>
 	</div>
 	<div class="col-md-12 text-center rembrlst-heart">
 		<i class="fa fa-heart-o" aria-hidden="true"></i>
 	</div>
 	<div class="col-md-12 text-center rembrlst-pra">
 		<p>No post were added to the remember list</p>
 	</div>
 </div>
 @endif
</div>
</div>
@include("lostandfound.footer")
</body>
</html>