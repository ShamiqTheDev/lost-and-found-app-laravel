
@if(isset($dynamic_filters['cat_id']) && !empty($dynamic_filters['cat_id']) && isset($dynamic_filters['sub_cat_id']) && !empty($dynamic_filters['sub_cat_id']))


<?php
$cat_id = $dynamic_filters['cat_id'];
$sub_cat_id = $dynamic_filters['sub_cat_id'];
?>
@if($cat_id == '1')

@if($sub_cat_id == '11' || $sub_cat_id == '12' || $sub_cat_id == '58')

<!-- vehicle -->
<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="make" id="make">
      <option value="">All Makes</option>
      @foreach($makes as $mk)
      <option value="{{$mk->id}}"  @if(isset($dynamic_filters['make']) && $dynamic_filters['make'] == $mk->id) selected @endif>{{ $mk->display_name }}</option>
      @endforeach
    </select>
  </div>
</div>
@if($sub_cat_id == '12')
<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="model" id="model">
      <option value="">Models</option>
      @foreach($models as $md)
      <option value="{{$md->id}}"  @if(isset($dynamic_filters['model']) && $dynamic_filters['model'] == $md->id) selected @endif>{{ $md->display_name }}</option>
      @endforeach

    </select>
  </div>
</div>
@endif
<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="color" id="color">
      <option value="">All Colors</option>
      @foreach($colors as $color)
      <option value="{{$color->id}}" @if(isset($dynamic_filters['color']) && $dynamic_filters['color'] == $color->id) selected @endif>{{ $color->name }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group">
  <div class="select-wrap">
    <input id="year" name="year" placeholder="Year" class="form-control" value="{{ isset( $dynamic_filters['year']) ? $dynamic_filters['year'] : '' }}" type="number" onKeyPress="if(this.value.length==4) return false;">
  </div>
</div>

<div class="form-group">
  <div class="select-wrap">
    <input id="registration" name="registration" placeholder="Registration No." class="form-control" value="{{ isset( $dynamic_filters['registration']) ? $dynamic_filters['registration'] : '' }}" type="text">
  </div>
</div>

<div class="form-group">
  <div class="select-wrap">
    <input id="engine" name="engine" placeholder="Engine No." class="form-control" value="{{ isset( $dynamic_filters['engine']) ? $dynamic_filters['engine'] : '' }}"  type="text">
  </div>
</div>

<div class="form-group">
  <div class="select-wrap">
    <input id="chasis" name="chasis" placeholder="Chasis No." class="form-control" value="{{ isset( $dynamic_filters['chasis']) ? $dynamic_filters['chasis'] : '' }}"  type="text">
  </div>
</div>


@elseif($sub_cat_id == '10' || $sub_cat_id == '13')
<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="color_id" id="color_id">
      @foreach($colors as $color)
      <option value="{{$color->id}}">{{ $color->name }}</option>
      @endforeach
    </select>
  </div>
</div>
@endif
@elseif($cat_id == '5')
@if($sub_cat_id == '31')
<!-- mobile and laptop -->
<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="brand_id" id="brand_id">
      @foreach($makes as $bd)
      <option value="{{$bd->id}}">{{ $bd->display_name }}</option>
      @endforeach
    </select>
  </div>
</div>
@endif
<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="color_id" id="color_id">
      @foreach($colors as $color)
      <option value="{{$color->id}}">{{ $color->name }}</option>
      @endforeach
    </select>
  </div>
</div>

@elseif($cat_id == '8')

<!-- pets -->

<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="color_id" id="color_id">
      @foreach($colors as $color)
      <option value="{{$color->id}}">{{ $color->name }}</option>
      @endforeach
    </select>
  </div>
</div>


<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="gender_id" id="gender_id">
      @foreach($genders as $gender)
      <option value="{{$gender->id}}">{{ $gender->name }}</option>
      @endforeach
    </select>
  </div>
</div>

@elseif($cat_id == '6')

<!-- persons -->
<div class="form-group">
  <div class="select-wrap">
    <input id="name" name="name" placeholder="Enter name" class="form-control" value="{{ old('name') }}" type="text">
  </div>
</div>

<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="complexion_id" id="complexion_id">
      @foreach($complexions as $comp)
      <option value="{{$comp->id}}">{{ $comp->color }}</option>
      @endforeach
    </select>
  </div>
</div>


@elseif($cat_id == '2')

<!-- jewellery -->
<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="material_id" id="material_id">
      @foreach($materials as $mt)
      <option value="{{$mt->id}}">{{ $mt->name }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="color_id" id="color_id">
      @foreach($colors as $color)
      <option value="{{$color->id}}">{{ $color->name }}</option>
      @endforeach
    </select>
  </div>
</div>


@elseif($cat_id == '3' || $cat_id == '4' || $cat_id == '7' || $cat_id == '9')

<!-- accessories -->
<!-- documents -->
<!-- electronics -->
<!-- others -->
<div class="form-group">
  <div class="select-wrap">
    <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
    <select class="form-control" name="color_id" id="color_id">
      @foreach($colors as $color)
      <option value="{{$color->id}}">{{ $color->name }}</option>
      @endforeach
    </select>
  </div>
</div>

@endif
@endif
