<?php 

use App\Attributes;

function get_attributes($cat_id){
	return Attributes::where('cat_id', $cat_id)->select('attr_name')->get();
}

?>
