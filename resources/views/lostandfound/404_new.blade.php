@include('lostandfound.header')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<body class="bg404"> 
  <!-- main --> 
  <div class="container agileits-main mb-5"> 
   <div class="row"> 
    <div class="col-lg-12 col-md-12 col-sm-12 text-center w3layouts-errortext"> 
     <!-- <h1><span>5</span>00</h1> -->
     <figure class="img-gif">
       <img class="img-fluid" src="public/images/5000.gif">
     </figure>
     <h2>Something Went Wrong!</h2> 
     <h6>The page you are looking for might have been removed had its name changed or is temporarily unavailable. </h6> 
     <div class="col-lg-12 col-md-12 col-sm-12 agile-search">
       <button class="btn btn-goto-bck"><span>Goto Back</span></button> 
     </div> 
   </div> 
 </div> 
</div> 

<section class="category-404">
 <div class=" pad-btm">
  <div class="container">
    <!-- Services Items -->
    <div class="d-none d-sm-none d-md-block">
      <div class="row align-items-stretch no-gutters">
        <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
          <a href="{{ url('listings?cat_id=5') }}" class="same-color popular-category h-100">
            <span class="icon"><img class="img-fluid img-w aftr-hovr" src="public/images/ltb.png">
              <img class="img-fluid img-w hovr-img" src="public/images/ltb-w.png">
            </span> <!-- <span class="flaticon-house"></span> -->
            <span class="caption d-block pop-cate">Mobile & Laptop</span>
            <!-- <span class="number">3,921</span> -->
          </a>
        </div>
        <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
          <a href="{{ url('listings?cat_id=3') }}" class="same-color popular-category h-100">
            <span class="icon"><img class="img-fluid img-w aftr-hovr" src="public/images/iconx/file.png">
              <img class="img-fluid img-w hovr-img" src="public/images/file-w.png">
            </span>
            <span class="caption d-block pop-cate">Documents</span>
            <!-- <span class="number">398</span> -->
          </a>
        </div>
        <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
          <a href="{{ url('listings?cat_id=6') }}" class="same-color popular-category h-100">
            <span class="icon"><img class="img-fluid img-w aftr-hovr" src="public/images/iconx/team.png">
              <img class="img-fluid img-w hovr-img" src="public/images/team-w.png">
            </span> <!-- <span class="flaticon-bunk-bed"></span> -->
            <span class="caption d-block pop-cate">Persons</span>
            <!-- <span class="number">1,229</span> -->
          </a>
        </div>
        <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
          <a href="{{ url('listings?cat_id=4') }}" class="same-color popular-category h-100">
            <span class="icon"><img class="img-fluid img-w aftr-hovr" src="public/images/iconx/electronics.png">
              <img class="img-fluid img-w hovr-img" src="public/images/electronics-w.png">
            </span>
            <span class="caption d-block pop-cate">Electronics</span>
            <!-- <span class="number">32,891</span> -->
          </a>
        </div>
        <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
          <a href="{{ url('listings?cat_id=1') }}" class="same-color popular-category h-100">
            <span class="icon"><img class="img-fluid img-w aftr-hovr" src="public/images/car-bike.png">
              <img class="img-fluid img-w hovr-img" src="public/images/car-bike-w2.png">
            </span>
            <span class="caption d-block pop-cate">Vehicles</span>
            <!-- <span class="number">29,221</span> -->
          </a>
        </div>
        <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
          <a href="{{ url('listings?cat_id=8') }}" class="same-color popular-category h-100">
            <span class="icon"><img class="img-fluid img-w aftr-hovr" src="public/images/iconx/service-dog.png">
              <img class="img-fluid img-w hovr-img" src="public/images/service-dog-w.png"></span>
              <span class="caption d-block pop-cate">Pets</span>
              <!-- <span class="number">219</span> -->
            </a>
          </div>
          <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
            <a href="{{ url('listings?cat_id=2') }}" class="same-color popular-category h-100">
              <span class="icon"><img class="img-fluid img-w aftr-hovr" src="public/images/iconx/box1.png">
                <img class="img-fluid img-w hovr-img" src="public/images/box1-w.png">
              </span>
              <span class="caption d-block pop-cate">Jewellery</span>
              <!-- <span class="number">219</span> -->
            </a>
          </div>
          <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
            <a href="{{ url('listings?cat_id=7') }}" class="same-color popular-category h-100">
              <span class="icon"><img class="img-fluid img-w aftr-hovr" src="public/images/iconx/accessory.png">
                <img class="img-fluid img-w hovr-img" src="public/images/accessory-w.png">
              </span>
              <span class="caption d-block pop-cate">Accessories</span>
              <!-- <span class="number">219</span> -->
            </a>
          </div>
          <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-1 my-widht">
            <a href="{{ url('listings?cat_id=9') }}" class="same-color popular-category h-100">
              <span class="icon"><img class="img-fluid img-w aftr-hovr" src="public/images/copyright.png">
                <img class="img-fluid img-w hovr-img" src="public/images/copyright-w.png">
              </span>
              <span class="caption d-block pop-cate">Others</span>
              <!-- <span class="number">219</span> -->
            </a>
          </div>
        </div>
      </div> <!-- Services Items -->
    </div>
  </div>
</section>

<!-- //main --> 
@include('lostandfound.footer')