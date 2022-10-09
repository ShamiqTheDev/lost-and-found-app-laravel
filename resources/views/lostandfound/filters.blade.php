
<div class="col-lg-3 ml-auto">
  <div class="mb-5">
    <h3 class="h5 text-black mb-3">Filters</h3>
    <form action="{{ url('listings') }}" method="get">
      <div class="form-group">
        <div class="select-wrap">
          <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
          <select class="form-control" name="type" id="type" >
            <option value="">Both</option>
            <option value="1">Lost Ad</option>
            <option value="2">Found Ad</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="select-wrap">
          <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
          <select class="form-control" name="search_sub_cat_id" id="search_sub_cat_id">
            <option value="">All Sub-Categories</option>
            <option value=""></option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="select-wrap">
          <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
          <select class="form-control" name="search_city_id" id="search_city_id">
            <option value="">All Cities</option>
            <option value=""></option>
          </select>
        </div>
      </div>


      <div class="marjin-b1 ml-auto text-right">
        <input type="submit" class="txt-white btn same-bg btn-block rounded" value="Search">
      </div>
    </form>
  </div>
  <div class="mb-5">
    <h3 class="h6 mb-3">More Info</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti voluptatem placeat facilis, reprehenderit eius officiis.</p>
  </div>

</div>
