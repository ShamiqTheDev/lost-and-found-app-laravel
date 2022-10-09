@include("lostandfound.header")
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
<?php
$filters = ["search", "state_id", "cat_id", "type","sub_cat_id","city_id"];

foreach ($filters as $filter) {
  if (isset($_GET[$filter])&& !empty($_GET[$filter])) {
    $$filter = $_GET[$filter];
    $filter_values[$filter] =  $_GET[$filter];
}
else{
    $$filter = '';
    $filter_values[$filter] =  '';
}
}
$liked_posts = get_liked_posts();
?>
<div id="loader-image-page" class="main-looader main-page-loader">
</div>

<div class="site-section no-pad-sectn">
  <div class="container">
    <div class="row">
      <nav class="navbar navbar-expand-lg navbar-dark primary-color mb-5 cate-nav">
        <!-- Navbar brand -->
        <a class="font-weight-bold white-text mr-4">Categories</a>
        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="true" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <!-- Collapsible content -->
        <div class="navbar-collapse collapse show" id="navbarSupportedContent1" style="">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle  no-caret waves-effect waves-light" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">All</a>
                    <div class="dropdown-menu mega-menu v-2 row z-depth-1 white" aria-labelledby="navbarDropdownMenuLink1">
                        <div class="row mx-md-4 mx-1">
                            <div class="col-md-6 col-xl-3 sub-menu">
                                <a class="sub-menu-title-a" href="{{ url('listings/?cat_id=7') }}"><h6 class="sub-title text-uppercase font-weight-bold blue-text">Accessories</h6></a>
                                <ul class="caret-style pl-0">
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=39') }}">Glasses/Sunglasses/Cases</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=40') }}">Keys</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=42') }}">Watches</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=41') }}">Toys</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=43') }}">Wallet Hangbags and Purses</a></li>

                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=48') }}">Security Equipments</a></li>

                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=49') }}">Sports Equipments</a></li>

                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=52') }}">Musical Equipments</a></li>
                                    
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=53') }}">Drugs/Medicine</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=44') }}">Other</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-xl-3 sub-menu">
                                <a class="sub-menu-title-a" href="{{ url('listings/?cat_id=5') }}"><h6 class="sub-title text-uppercase font-weight-bold blue-text">Mobiles & Laptops</h6></a>
                                <ul class="caret-style pl-0">
                                    <li class=""><a class="menu-item mb-0 waves-effect waves-light" href="{{ url('listings/?sub_cat_id=31') }}">Mobile</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=32') }}">Laptops/Notebooks</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=33') }}">Tablets</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=34') }}">Computers</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=30') }}">Accessories</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=35') }}">Hard disk/Pen-Drive</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=29') }}">Others</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-xl-3 sub-menu">
                                <a class="sub-menu-title-a" href="{{ url('listings/?cat_id=3') }}"><h6 class="sub-title text-uppercase font-weight-bold blue-text">Documents</h6></a>
                                <ul class="caret-style pl-0">
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=24') }}">Marksheet/Certificates<br>Degrees/Diploma</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=20') }}">Books</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=21') }}">Credit Card/Debit Card</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=22')}}">Driving License/ ID Card</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=23') }}">Other</a></li>
                                </ul>
                            </div>

                            <div class="col-md-6 col-xl-3 sub-menu">
                                <a class="sub-menu-title-a" href="{{ url('listings/?cat_id=4') }}"><h6 class="sub-title text-uppercase font-weight-bold blue-text">Electronics</h6></a>
                                <ul class="caret-style pl-0">
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=25') }}">Camera</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=27') }}">Music/Video players</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=26') }}">Gaming consoles</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=28') }}">Other</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mx-md-4 mx-1">
                            <div class="col-md-6 col-xl-3 sub-menu">
                                <a class="sub-menu-title-a" href="{{ url('listings/?cat_id=2') }}"><h6 class="sub-title text-uppercase font-weight-bold blue-text">Jewellery</h6></a>
                                <ul class="caret-style pl-0">
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=14') }}">Bangles</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=15') }}">Bracelets</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=16') }}">Chains/Necklaces</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=17') }}">Earrings</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=19') }}">Rings</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=18') }}">Other</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-xl-3 sub-menu">
                                <a class="sub-menu-title-a" href="{{ url('listings/?cat_id=1') }}"><h6 class="sub-title text-uppercase font-weight-bold blue-text">Vehicle</h6></a>
                                <ul class="caret-style pl-0">
                                    <li class=""><a class="menu-item mb-0 waves-effect waves-light" href="{{ url('listings/?sub_cat_id=12') }}">Car</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=11') }}">Bike</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=Auto') }}">Auto</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=10') }}">Bicycle</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=13') }}">Other</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-xl-3 sub-menu">
                                <a class="sub-menu-title-a" href="{{ url('listings/?cat_id=8') }}"><h6 class="sub-title text-uppercase font-weight-bold blue-text">Pets</h6></a>
                                <ul class="caret-style pl-0">
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=45') }}">Cates</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=46') }}">Dogs</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=47') }}">Other</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-xl-3 sub-menu">
                                <a class="sub-menu-title-a" href="{{ url('listings/?cat_id=6') }}"><h6 class="sub-title text-uppercase font-weight-bold blue-text">Persons</h6></a>
                                <ul class="caret-style pl-0">
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=36') }}">Aged</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=37') }}">Adults</a></li>
                                    <li class=""><a class="menu-item waves-effect waves-light" href="{{ url('listings/?sub_cat_id=38') }}">Kids</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle no-caret waves-effect waves-light" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Popular</a>
                    <div class="dropdown-menu mega-menu v-2 row z-depth-1 white" aria-labelledby="navbarDropdownMenuLink1">
                        <div class="row mx-md-4 mx-1">
                            <div class="col-md-6 col-xl-3 sub-menu my-xl-1 mt-5 mb-1">
                                <h6 class="sub-title text-uppercase font-weight-bold blue-text">Mobiles & Laptops</h6>
                                <div class="view overlay mb-3 z-depth-1">
                                    <a class="img-ancher" href="{{ url('listings/?cat_id=5') }}">
                                        <img src="{{ asset('public/images/mob-lap.jpg') }}" class="img-fluid" alt="First sample image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 sub-menu my-xl-1 mt-5 mb-1">
                                <h6 class="sub-title text-uppercase font-weight-bold blue-text">Electronics</h6>
                                <!--Featured image-->
                                <div class="view overlay mb-3 z-depth-1">
                                    <a class="img-ancher" href="{{ url('listings/?cat_id=4') }}">
                                        <img src="{{ asset('public/images/camera.jpg') }}" class="img-fluid" alt="First sample image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 sub-menu my-xl-1 mt-5 mb-1">
                                <h6 class="sub-title text-uppercase font-weight-bold blue-text">Accessories</h6>
                                <!--Featured image-->
                                <div class="view overlay mb-3 z-depth-1">
                                    <a class="img-ancher" href="{{ url('listings/?cat_id=7') }}">
                                        <img src="{{ asset('public/images/accessories.jpg') }}" class="img-fluid" alt="First sample image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 sub-menu my-xl-1 mt-5 mb-1">
                                <h6 class="sub-title text-uppercase font-weight-bold blue-text">Vehicle</h6>
                                <div class="view overlay mb-3 z-depth-1">
                                    <a class="img-ancher" href="{{ url('listings/?cat_id=1') }}">
                                        <img src="{{ asset('public/images/vehicle.jpg') }}" class="img-fluid" alt="First sample image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ url('listings/?cat_id=9') }}" class="nav-link no-caret waves-effect waves-light">Others</a>
                </li>
            </ul>
            <!-- Links -->
        </div>
        <!-- Collapsible content -->

    </nav>
</div>
<div class="row flex-column-reverse flex-md-row">
  <div class="col-lg-8">
    <div class="row">
        @if(!$posts->isEmpty())
        <div class="col-12">
            <h2 class="h5 mb-4 text-black">Searched Posts
            </h2>
        </div>
        @foreach($posts as $post)
        <div class="col-lg-6 col-md-6 col-sm-12">
            <?php
            $uploaded_images = json_decode($post->images,true);
            $img_url = image_check_li(isset($uploaded_images['0']) ? $uploaded_images['0'] : '', $post->sub_cat_id);
            $content = json_decode($post->content, true);
            ?>

            <div class="d-block d-md-flex listing vertical">
              <div class="ribbon">
                <?php 
                $type = ($post->type == '1' ) ? 'danger':'success';
                $value = ($post->type == '1' ) ? 'Lost':'Found';
                ?>
                <span class="ribbon-{{ $type }}">{{$value}}</span>
            </div>

            <a href="{{ route('single_post',['id'=>$post->id,'title' => str_replace('+','-',urlencode($post->title)) ]) }}" class="img d-block">
                <img src="{{ $img_url }}"/> 
                @if(isset($post->reward))
                <div class="body-bottom">
                  <span class="reward">{{ isset($post->reward) ? 'Reward: '.$post->reward : '' }}</span>
              </div>
              @endif
          </a>
          <?php
          $liked=(in_array($post->id, $liked_posts)) ? 'fa fa-heart' : 'fa fa-heart-o';
          ?>
          <div class="custom-tooltip">
            @if(Auth::check())
            <a href="javascript:void(0)" class="bookmark like_unlike">
                @else
                <a href="#tab1" data-toggle="modal" data-target="#modalLoginForm" class="bookmark">
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
          <div class="lh-content">
            <h3>
                <a href="{{ route('single_post',['id'=>$post->id,'title' => str_replace('+','-',urlencode($post->title))]) }}">{{ $post->title }}
                </a>
            </h3>
            <p>{{ $post->description }}
            </p>

            <div class="cat-loc">
               <span>
                <i class="fa fa-th"></i>{{ isset($content['cat'])? $content['cat'] : ''}}
            </span>
            <span>
                <i class="fa fa-map-marker"></i>{{ isset($content['city'])? $content['city'] : ''}} {{ isset($content['state'])? $content['state'] : ''}}
            </span>
        </div>
    </div>
</div>
</div>
@endforeach

@else
<div class="col-12 no-search-result">
    <div class="img-search">
        <img src="{{ asset('public/images/cate-search.png') }}">
    </div>
    <div class="text-search-reslt">
        <h1>We couldn't found it!</h1>
        <p>We are sorry, Your search didn't have any result</p>
    </div>
</div>
@endif

</div> 
<div class="col-12 my-paginatin">
    <nav aria-label="...">
      {{ $posts->appends($filter_values)->links() }}
  </nav>
</div>

</div>
<?php
$search = isset($_GET['search']) ? $_GET['search'] : ''; 
// $state_id= isset($_GET['state_id']) ? $_GET['state_id'] : ''; 
// $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
?>
<div class="col-lg-4 ml-auto">
  <div class="mb-5">
    <div class="form-group" style="display: flex;">
        <p class="h5 text-black mb-3">Filters</p>
        <div class="marjin-b1 ml-auto text-right mb-3">
            <input type="button" onclick="delete_confirm()" class="txt-white btn same-bg btn-block rounded" value="Clear All Filters">
        </div>    
    </div>
    
    <form action="{{ url('listings') }}" method="get" id="form">

      <div class="form-group">
        <div class="select-wrap">
          <input type="text" name="search" id="f" class="form-control rounded" value="{{ $search }}" placeholder="What are you looking for?">
      </div>
  </div>

  <div class="form-group">
    <div class="select-wrap">
      <span class="icon-keyboard_arrow_down"></span>
      <select class="form-control rounded" name="type" id="type">
        <option value="">Both</option>
        <option value="1" @if(Request()->type=='1') selected @endif>Lost Ads</option>
        <option value="2"  @if(Request()->type=='2') selected @endif>Found Ads</option>
    </select>
</div>
</div>

<div class="form-group">
    <div class="select-wrap">
      <span class="icon icon-room"></span>
      <select class="form-control rounded" name="state_id" id="state_id">
        <option value=""></option>
    </select>
</div>
</div>

<div class="form-group" id="city_hid" style="display: none;">
    <div class="select-wrap">
      <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
      <select class="form-control rounded" name="city_id" id="city_id">
        <option value="">All Cities</option>
        <option value=""></option>
    </select>
</div>
</div>

<div class="form-group">
    <div class="select-wrap">
      <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
      <select class="form-control rounded" name="cat_id" id="cat_id">
        <option value="">All Categories</option>
        <option value=""></option>
    </select>
</div>
</div>

<div class="form-group" id="sub_cat_hid">
    <div class="select-wrap">
      <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
      <select class="form-control rounded" name="sub_cat_id" id="sub_cat_id">
       <option value="" id="sel_all">All Sub-Categories</option>
       @if(empty($cat_id) )
       <option val="" id="sel_main" disabled>Select a Main category first</option>
       @endif
       @foreach($sub_categories as $sub_cat)
       <option value="{{$sub_cat->id}}" data-id="{{ $sub_cat->parent_id}}" disabled>{{$sub_cat->name}}</option>
       @endforeach

   </select>
</div>
</div>

<div id="dynamic_filters_fields">
</div>

<div class="marjin-b1 ml-auto text-right">
    <input type="submit" class="txt-white btn same-bg btn-block rounded"  id="search-btn" value="Search">
</div>
</form>
</div>
<div class="mb-5">
</div>
</div>
</div>
</div>
</div>

@include("lostandfound.footer")
<script type="text/javascript" src="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js"></script>
<script type="text/javascript">

    cat_id = "<?php echo $cat_id; ?>";

    if(cat_id != "") {
        $("#dynamic_filters_fields").load("{{url('get-filters-fields').'/'.$cat_id.'/'.$sub_cat_id.'?dynamic_filters='.urlencode(json_encode($dynamic_filters)) }}");
    }

    $(document).on('click', '#btn',function(){
        $('#f').val($('#search').val());
        $('#state_id_f').val($('#state_id').val());
        $('#cat_id_f').val($('#cat_id').val());
        $('#form').submit();
    });

    $(document).on('change', '#sub_cat_id',function(){

     $("#dynamic_filters_fields").load("{{url('get-filters-fields').'/'}}"+$('#cat_id').val()+'/'+$('#sub_cat_id').val()+'?dynamic_filters='+"{{urlencode(json_encode([])) }}");
 });


    state_id = "<?php echo $state_id; ?>";
    sub_cat_id = "<?php echo $sub_cat_id; ?>";
    city_id = "<?php echo $city_id; ?>";

    if(cat_id != ""){
      get_subcategories(cat_id);
      $('#sub_cat_id').val(sub_cat_id);
  }
  if(state_id != ""){
      get_cities(state_id);
  }
  <?php
  $country = get_country();
  $country_id = $country['country_id'];
  ?>

  $(document).on('change', '#cat_id',function(){
    get_subcategories($('#cat_id').val());
    
});

  $(document).on('change', '#state_id',function(){
      get_cities($('#state_id').val());

  });

  $(document).on('change', '#make',function(){
      $.ajax({url:"{{ route('get-brands')}}/?id="+$(this).val(),
        type:'GET'
    }).done(function(r){
        $('#model').html(r);
    });
});

  function get_subcategories(cat_id){
    $('#sub_cat_id').val('');
    $('#sub_cat_id option:not(#sel_all,#sel_main)').hide();
    $('#sub_cat_id option:not(#sel_all)').attr('disabled','disabled');
    $('#sub_cat_id option[data-id="'+cat_id+'"]').show();
    $('#sub_cat_id option[data-id="'+cat_id+'"]').removeAttr('disabled');
}

function get_cities(state_id){
 $.ajax({url:"{{ route('get-cities')}}/?id="+state_id,
  type:'GET'
}).done(function(r){
 $('#city_id').html(r);
 $('#city_id').val(city_id);
 $('#city_hid').show();
});
}
</script>


<script type="text/javascript">

  function delete_confirm(){
    swal({
      title: "Are you sure?",
      text: "Your selected filters will be lost!",
      type: "warning",
      showCancelButton:  true,
      confirmButtonColor: '#e33030',
      confirmButtonText: 'Yes, clear filters!',
      cancelButtonText: "Cancel",
      closeOnConfirm: true,
      closeOnCancel: true
  },
  function(isConfirm){
      if (isConfirm){

         window.location.href = "{{route('listings')}}";
     }
 });
};

$(document).on('click', '#search-btn',function(e){
    $(this).attr('disabled',true);
    $(".main-looader").addClass("loader-after");
    $("#loader-image-page").html("<img src='{{url('public/images/findwala-loader.gif')}}' alt='loader...' />");
    $('#form').submit();
});
</script>

</body>
</html>