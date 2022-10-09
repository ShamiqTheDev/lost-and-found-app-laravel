
<div id="demo" class="site-blocks-cover inner-page-cover overlay my-cover collapse" style="background-image: url({!! asset('public/images/b1.png') !!})" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center my-search-bar">

      <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">

        <!-- SearchBar -->
        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : ''; 
        $state_id= isset($_GET['state_id']) ? $_GET['state_id'] : ''; 
        $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
        ?>
        
        <div class="hidden" data-aos="fade-up" data-aos-delay="200">
          <form action="{{ url('listings') }}" method="get">
            <div class="row align-items-center">
              <div class="col-lg-3 col-sm-12 marjin-b1 mb-xl-0 col-xl-4">
                <input type="text" id="search" name="search" class="form-control rounded" placeholder="What are you looking for?" value="{{ $search }}">
              </div>
              <div class="col-lg-3 col-sm-12 marjin-b1 mb-xl-0 col-xl-3">
                <div class="wrap-icon">
                  <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>

                  <select class="form-control rounded" name="state_id" id="state_id">
                    <option value=""></option>
                  </select>

                </div>
              </div>
              <div class="col-lg-3 col-sm-12 marjin-b1 mb-xl-0 col-xl-3">
                <div class="select-wrap">
                  <span class="icon"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                  <select class="form-control rounded" name="cat_id" id="cat_id">
                    <option value=""></option>
                  </select>

                </div>
              </div>
              <div class="col-lg-3 col-sm-12 col-xl-2 marjin-b1 ml-auto text-right">
                <input @if(Request::route()->getName() == 'listings') type="button" id="btn" @else type="submit" @endif  class="txt-white btn same-bg btn-block rounded" value="Search" style="padding:8px">
              </div>
            </div>
          </form>
        </div> <!-- SearchBar -->

      </div>
    </div>
  </div>
</div>  
