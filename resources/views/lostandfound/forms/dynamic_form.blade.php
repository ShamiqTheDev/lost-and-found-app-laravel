<div class="fields_dynamic">

  @if($cat_id == '1')

  @if($sub_cat_id == '11' || $sub_cat_id == '12' || $sub_cat_id == '58')
  <div class="row">
    <div class="col-md-6">
      <label class="control-label">All Makers</label>
      <div class="select_wrapper">
       <i class="fa fa-caret-down"></i>
       <select class="mdb-select md-form frm-actve" name="make" id="make">
        @foreach($makes as $mk)
        <option value="{{$mk->id}}"  @if(isset($current_make) && $current_make == $mk->id) selected @endif>{{ $mk->display_name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  @if($sub_cat_id == '12')
  <div class="col-md-6">
    <label class="control-label">Select Model</label>
    <div class="select_wrapper">
     <i class="fa fa-caret-down"></i>
     <select class="mdb-select md-form frm-actve" name="model" id="model">
      @if(isset($models))
      @foreach($models as $md)
      <option value="{{$md->id}}"  @if(isset($current_model) && $current_model == $md->id) selected @endif>{{ $md->display_name }}</option>
      @endforeach
      @endif
    </select>
  </div>
</div>
@endif
</div>
<div class="row"> 
  <div class="col-md-6">
    <label class="control-label">Select Color</label>
    <div class="select_wrapper">
     <i class="fa fa-caret-down"></i>
     <select class="mdb-select md-form frm-actve" name="color" id="color">
      <option value="">All Colors</option>
      @foreach($colors as $color)
      <option value="{{$color->id}}" @if(isset($current_color) && $current_color == $color->name) selected @endif>{{ $color->name }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="col-md-6">
 <label class="control-label">Registration No.</label>
 <div class="inputGroupContainer">
  <div class="input-group"><input id="registration" name="registration" placeholder="Enter Registration No." class="form-control frm-actve" value="{{ (isset($current_registration)) ?  $current_registration : '' }}" type="text"></div>
</div>
</div>
</div>
<div class="row"> 
  <div class="col-md-6">
   <label class="control-label">Engine No.</label>
   <div class="inputGroupContainer">
     <div class="input-group">
      <input id="engine" name="engine" placeholder="Enter Engine No." class="form-control frm-actve" value="{{ (isset($current_engine)) ?  $current_engine : '' }}" type="text">
    </div>
  </div>
</div>
<div class="col-md-6">
  <label class="control-label">Chasis No.</label>
  <div class="inputGroupContainer">
    <div class="input-group"><input id="chasis" name="chasis" placeholder="Enter Chasis No." class="form-control frm-actve" value="{{ (isset($current_chasis)) ?  $current_chasis : '' }}" type="text"></div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-md-6">
    <label class="control-label">Year</label>
    <div class="inputGroupContainer">
      <div class="input-group">
        <input id="year" name="year" placeholder="Year" class="form-control frm-actve" value="{{ isset( $current_year) ? $current_year : '' }}" type="number" onKeyPress="if(this.value.length==4) return false;">
      </div>
    </div>
  </div>
</div>
@elseif($sub_cat_id == '10' || $sub_cat_id == '13')
<div class="row">
  <div class="col-md-6">
    <label class="control-label">Select Color</label>
    <div class="select_wrapper">
      <i class="fa fa-caret-down"></i>
      <select class="mdb-select md-form frm-actve" name="color" id="color">
        <option value="">All Colors</option>
        @foreach($colors as $color)
        <option value="{{$color->id}}" @if(isset($current_color) && $current_color == $color->name) selected @endif>{{ $color->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>
@endif
@elseif($cat_id == '5')

<!-- mobile and laptop -->
@if($sub_cat_id == '31')
<div class="row">
  <div class="col-md-6">
    <label class="control-label">Brand</label>
    <div class="select_wrapper">
      
      <select class="mdb-select md-form frm-actve" name="make" id="make">
        @foreach($makes as $mk)
        <option value="{{$mk->id}}"  @if(isset($current_make) && $current_make == $mk->id) selected @endif>{{ $mk->display_name }}</option>
        @endforeach
      </select>
    </div>
  </div>
@endif
  <div class="col-md-6">
    <label class="control-label">Select Color</label>
    <div class="select_wrapper">
     <i class="fa fa-caret-down"></i>
     <select class="mdb-select md-form frm-actve" name="color" id="color">
      <option value="">All Colors</option>
      @foreach($colors as $color)
      <option value="{{$color->id}}" @if(isset($current_color) && $current_color == $color->name) selected @endif>{{ $color->name }}</option>
      @endforeach
    </select>
  </div>
</div>
</div>

@elseif($cat_id == '8')
<!-- pets -->

<div class="row">
  <div class="col-md-6">
    <label class="control-label">Select Gender</label>
    <div class="select_wrapper">
     <i class="fa fa-caret-down"></i>
     <select class="mdb-select md-form frm-actve" name="gender" id="gender">
      <option>Both</option>
      <option>Male</option>
      <option>Female</option>
    </select>
  </div>
</div>
<div class="col-md-6">
  <label class="control-label">Select Color</label>
  <div class="select_wrapper">
    <i class="fa fa-caret-down"></i>
    <select class="mdb-select md-form frm-actve" name="color" id="color">
      <option value="">All Colors</option>
      @foreach($colors as $color)
      <option value="{{$color->id}}" @if(isset($current_color) && $current_color == $color->name) selected @endif>{{ $color->name }}</option>
      @endforeach
    </select>
  </div>
</div>
</div>

@elseif($cat_id == '6')
<!-- persons -->
<div class="row">
  <div class="col-md-6">
    <label class="control-label">Missing Person Name</label>
    <div class="inputGroupContainer">
     <div class="input-group">
      <input id="name" name="name" placeholder="Enter Missing Person Name" class="form-control frm-actve" value="{{ (isset($current_name)) ?  $current_name : '' }}" type="text">
    </div>
  </div>
</div>
<div class="col-md-6">
  <label class="control-label">Complexion</label>
  <div class="select_wrapper">
   <i class="fa fa-caret-down"></i>
   <select class="mdb-select md-form frm-actve" name="complexion" id="complexion">
    @foreach($complexions as $comp)
    <option value="{{$comp->id}}" @if(isset($current_complexion) && $current_complexion == $comp->color) selected @endif>{{ $comp->color }}</option>
    @endforeach
  </select>
</div>
</div>
</div>

<div class="row"> 
  <div class="col-md-6">
    <label class="control-label">Age</label>
    <div class="select_wrapper">
     <input id="age" name="age" placeholder="Enter Age" class="form-control frm-actve" value="{{ (isset($current_age)) ?  $current_age : '' }}" type="text">
   </div>
 </div>
 <div class="col-md-6">
   <label class="control-label">Height</label>
   <div class="select_wrapper">
     <input id="height" name="height" placeholder="Enter Height" class="form-control frm-actve" value="{{ (isset($current_height)) ?  $current_height : '' }}" type="text">
   </div>
 </div>
</div>


@elseif($cat_id == '2')
<!-- jewellery -->

<div class="row">
  <div class="col-md-6">
    <label class="control-label">Material</label>
    <div class="select_wrapper">
      <i class="fa fa-caret-down"></i>
      <select class="mdb-select md-form frm-actve" name="material" id="material">
        @foreach($materials as $material)
        <option value="{{$material->id}}" @if(isset($current_material) && $current_material == $material->name) selected @endif>{{ $material->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-md-6">
    <label class="control-label">Select Color</label>
    <div class="select_wrapper">
      <i class="fa fa-caret-down"></i>
      <select class="mdb-select md-form frm-actve" name="color" id="color">
        <option value="">All Colors</option>
        @foreach($colors as $color)
        <option value="{{$color->id}}" @if(isset($current_color) && $current_color == $color->name) selected @endif>{{ $color->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <label class="control-label">Weight</label>
    <div class="inputGroupContainer">
      <div class="input-group"><input id="weight" name="weight" placeholder="Enter Weight" class="form-control frm-actve" value="{{ (isset($current_weight)) ?  $current_weight : '' }}" type="text"></div>
    </div>
  </div>
</div>



<!-- others -->
<!-- electronics -->
<!-- documents -->
<!--   accessories -->
@elseif($cat_id == '3' || $cat_id == '4' || $cat_id == '7' || $cat_id == '9')
<div class="row">
  <div class="col-md-6">
    <label class="control-label">Select Color</label>
    <div class="select_wrapper">
      <i class="fa fa-caret-down"></i>
      <select class="mdb-select md-form frm-actve" name="color" id="color">
        <option value="">All Colors</option>
        @foreach($colors as $color)
        <option value="{{$color->id}}" @if(isset($current_color) && $current_color == $color->name) selected @endif>{{ $color->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>
@endif
</div>