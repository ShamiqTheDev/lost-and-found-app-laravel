<div class="fields_dynamic" id="fields_1">
  <div class="form-group">
    <div class="row">
      <div class="col-md-6">
        <label class="control-label">Select Make<span>*</span></label>
        <div class="select_wrapper">
         <i class="fa fa-caret-down"></i>
         <select class="mdb-select md-form" name="make" id="make">
          <option>Corola</option>
          <option>Daihatsu</option>
          <option>Toyota</option>
          <option>Suzuki</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <label class="control-label">Select Model<span>*</span></label>
      <div class="select_wrapper">
       <i class="fa fa-caret-down"></i>
       <select class="mdb-select md-form" name="model" id="model">
        <option>2000</option>
        <option>2001</option>
        <option>2002</option>
        <option>2003</option>
        <option>2004</option>
        <option>2005</option>
      </select>
    </div>
  </div>
</div>
<div class="row"> 
  <div class="col-md-6">
    <label class="control-label">Chasis<span>*</span></label>
    <div class="inputGroupContainer">
      <div class="input-group"><input id="chasis" name="chasis" placeholder="Enter Title" class="form-control" value="{{ old('chasis') }}" type="text"></div>
   </div>
 </div>
 <div class="col-md-6">
   <label class="control-label">Engine<span>*</span></label>
   <div class="inputGroupContainer">
     <div class="input-group"><input id="engine" name="engine" placeholder="Enter Engine" class="form-control" value="{{ old('engine') }}" type="text"></div>
   </div>
 </div>
</div>

</div>
</div>