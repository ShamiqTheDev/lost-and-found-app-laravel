<?php 

use App\Attributes;
use App\Countries;
use App\States;
use App\Cities;
use App\Categories;
use App\Makes;
use App\Models;
use App\Brands;
use App\Liked_posts;
use App\Messages;
use App\Meta_tags;
use App\Colors;
use App\Complexions;
use App\Materials;
use App\User;
function get_country(){
	if (Session::has('country_id') && Session::has('country_name') && Session::has('country_code') && Session::has('country_phonecode')) {
		$country_id = Session::get('country_id');
		$country_name = Session::get('country_name');
		$country_code = Session::get('country_code');
		$country_phonecode = Session::get('country_phonecode');
	}
	else{
		$country_id = '166';
		$country_name = 'Pakistan';
		$country_code = 'PK';
		$country_phonecode = '92';

		$ip_info = ip_info();
		if (isset($ip_info['country_code']) ) {
			$country_code = $ip_info['country_code'];
			$country = Countries::select('id','sortname','name','phonecode')->where('sortname', $country_code)->first();
			if (!empty($country)) {
				$country_id = $country->id;
				$country_name = $country->name;
				$country_code = $country->sortname;
				$country_phonecode = $country->phonecode;
			}
		}
		
		Session::put('country_id', $country_id);
		Session::put('country_name', $country_name);
		Session::put('country_code', $country_code);
		Session::put('country_phonecode', $country_phonecode);
	}
	return ['country_id' => $country_id, 'country_name' => $country_name, 'country_code' => $country_code, 'country_phonecode' => $country_phonecode];
}
function get_liked_posts()
{
	$liked_posts = [];
	if (Auth::check()) {

		$liked_posts = Liked_posts::where('user_id', Auth::id())->pluck('post_id')->toArray();
	}
	return $liked_posts;
}

function get_attributes($cat_id){

	return Attributes::where('cat_id', $cat_id)->select('attr_name')->get();
}

function get_post_content($cat_id,$sub_cat_id,$state_id,$city_id,$dynamic=[]){

	$return_data = [];

	$cat = Categories::where('id', $cat_id)->select('name')->first();
	$sub_cat = Categories::where('id', $sub_cat_id)->select('name')->first();
	$state = States::where('id', $state_id)->select('name')->first();
	$city = Cities::where('id', $city_id)->select('name')->first();

	$return_data['cat'] = isset($cat->name) ? $cat->name : '';
	$return_data['sub_cat'] = isset($sub_cat->name) ? $sub_cat->name : '';
	$return_data['state'] = isset($state->name) ? $state->name : '';
	$return_data['city'] = isset($city->name) ? $city->name : '';

	if (isset($dynamic['make'])) {
		$make = Makes::where('id', $dynamic['make'])->select('display_name')->first();
		if (isset($make->display_name)) {
			$return_data['make'] = $make->display_name;
		}
	}
	if (isset($dynamic['model'])) {
		$model = Models::where('id', $dynamic['model'])->select('display_name')->first();
		if (isset($model->display_name)) {
			$return_data['model'] = $model->display_name;
		}
	}
	if (isset($dynamic['color'])) {
		$color = Colors::where('id', $dynamic['color'])->select('name')->first();
		if (isset($color->name)) {
			$return_data['color'] = $color->name;
		}
	}
	if (isset($dynamic['material'])) {
		$material = Materials::where('id', $dynamic['material'])->select('name')->first();
		if (isset($material->name)) {
			$return_data['material'] = $material->name;
		}
	}
	if (isset($dynamic['complexion'])) {
		$complexion =Complexions::where('id',$dynamic['complexion'])->select('color')->first();
		if (isset($complexion->color)) {
			$return_data['complexion'] = $complexion->color;
		}
	}
	return $return_data;
}

function image_check($img_url,$sub_cat_id = ''){

	if(!empty($img_url) && file_exists(storage_path('/app/files/'.$img_url))){
		return URL::asset('storage/app/files/'.$img_url);
	}
	else{
		if (empty($sub_cat_id)) {
			$sub_cat_id = 'static';
		}
		return URL::asset('storage/app/thumbnail_static_sub_cat_image/'.$sub_cat_id.'.png');
	}
}

function get_auth_data(){

	return User::where('user_id',Auth::id())->select('image','social_avatar','firstname')->first();
}

function social_image_check($image_data = []){

	$image = (!empty($image_data))	? $image_data['image'] : Auth::user()->image_data ;
	$avatar = (!empty($image_data)) ?  $image_data['avatar'] : Auth::user()->social_avatar;

	if(!empty($image) && file_exists(storage_path('/app/profiles/'.$image))){
		return URL::asset('storage/app/profiles/'.$image);
	}
	elseif(!empty($avatar)){
		return $avatar;
	}
	else{
		return URL::asset('storage/app/profiles/login-img.png');
	}
}

function string_replace($text, $limit){

	return (strlen($text) > $limit) ? substr_replace($text, "...", 27) : $text;
}

function get_msgs_count(){

	$id = Auth::id();
	return $msg_count = Messages::join('users','users.user_id','=', 'messages.sender_id')->where('receiver_id', $id)->where('messages.status', '0')->count();

}

function new_msgs_count($second_user,$post_id){

	$id = Auth::id();
	return $msg_count = Messages::where('receiver_id', $id)->where('post_id', $post_id)->where('sender_id', $second_user)->where('status', '0')->count();
}


function image_check_l($img_url,$sub_cat_id = ''){

	if(!empty($img_url) && file_exists(storage_path('/app/files/'.$img_url))){
		return URL::asset('storage/app/files/'.$img_url);
	}
	else{
		if (empty($sub_cat_id)) {
			$sub_cat_id = 'static';
		}
		return URL::asset('storage/app/static_sub_cat_image/'.$sub_cat_id.'.png');
	}
}

function image_check_li($img_url,$sub_cat_id = ''){

	if(!empty($img_url) && file_exists(storage_path('/app/files/'.$img_url))){
		return URL::asset('storage/app/files/'.$img_url);
	}
	else{
		if (empty($sub_cat_id)) {
			$sub_cat_id = 'static';
		}
		return URL::asset('storage/app/thumbnail-listing/'.$sub_cat_id.'.png');
	}
}


function meta_tags($post){

	$route_name = '';
	if (!empty(Request::route())) {
		$route_name = Request::route()->getName();
	}
	if (in_array($route_name, ['index','howitworks','contact-us','about-us','privacy-policy','terms-and-conditions','faqs','forget-password','listings','single_post'])) {

		switch ($route_name) {
			case 'single_post':
			if (!empty($post)) {
				
				$uploaded_images = json_decode($post->images,true);
				$img_url = image_check(isset($uploaded_images['0']) ? $uploaded_images['0'] : '');
				$content = json_decode($post->content, true);
				?>
				<meta property="og:url" content="<?php echo Request::url(); ?>">
				<meta property="og:title" content="<?php echo $post->title; ?>">
				<meta property="og:description" content="<?php echo $post->description; ?>">
				<meta property="og:image" content="<?php echo $img_url; ?>">
				<meta property="og:image:width" content="514" /> 
				<meta property="og:image:height" content="269" />
				<meta name="og:site_name" content="FindWala"/>
				<?php if (isset($content['country'])){ ?>
					<meta name="og:country-name" content="<?php echo $content['country']; ?>"/>
				<?php } ?>
				<meta property="twitter:title" content="<?php echo $post->title; ?>">
				<meta property="twitter:description" content="<?php echo $post->description; ?>">
				<meta property="twitter:image" content="<?php echo $img_url; ?>">
				<meta property="twitter:url" content="<?php echo Request::url(); ?>">
				<meta name="twitter:site" content="FindWala"/>
				<meta name="keywords" content="<?php echo str_replace(' ', ',', $post->title); ?>"/>
				<meta name="description" content="<?php echo $post->description; ?>"/>
				<meta name="subject" content="Lost and Found">
				<meta name="copyright"content="FindWala">
				<meta name="summary" content="<?php echo $post->description; ?>">
				<meta name="author" content="FindWala, info@findwala.com">
				<meta name="url" content="<?php echo Request::url(); ?>">
				<meta name="identifier-URL" content="https://findwala.com">
				<title><?php echo $post->title; ?></title>
				<?php
			}
			break;

// 			case 'forget-password':
// 			if (!empty($post)) {

// 			
// 				<meta name="og:site_name" content="FindWala"/>
// 				<meta name="twitter:site" content="FindWala"/>
// 				<meta name="subject" content="Lost and Found">
// 				<meta name="copyright"content="FindWala">
// 				<meta name="author" content="FindWala, info@findwala.com">
// 				<meta name="url" content="https://findwala.com">
// 				<meta name="identifier-URL" content="https://findwala.com">
// 			
// 			}
// 			break;


			case 'listings':
			
			$meta_values = ['search','state_id','cat_id','type','city_id','sub_cat_id'];
			foreach ($meta_values as $mv) {
				if(isset($_GET[$mv])) {
					$$mv = $_GET[$mv];
				}else{
					$$mv = '';
				}
			}
			$title = '';
			if(!empty($search)){
				$title .= $search." - ";
				if (!empty($type)) {
					switch ($type) {
						case '1':
						$title .= 'Lost ';
						break;
						
						case '2':
						$title .= 'Found ';
						break;
						default:
						$title .= 'Lost and Found ';
						break;
					}
				}else{
					$title .= 'Lost and Found ';
				}
			}
			else{
				$title .= 'Lost and Found ';
			}

			if(!empty($sub_cat_id)){
				$sub_cat_mata = Categories::select('name')->where('id', $sub_cat_id)->first();
				$title .= isset($sub_cat_mata->name) ? $sub_cat_mata->name." "  : '';
			}
			if(!empty($cat_id)){
				$cat_mata = Categories::select('name')->where('id', $cat_id)->first();
				$title .= (isset($cat_mata->name) && !isset($sub_cat_mata->name)) ?  $cat_mata->name." " : '';
			}
			if(!empty($city_id)){
				$city_mata = Cities::select('name')->where('id', $city_id)->first();
				$title .= isset($city_mata->name) ? "in ".$city_mata->name." "  : '';
			}
			if(!empty($state_id)){
				$state_mata = States::select('name')->where('id', $state_id)->first();
				$title .= isset($state_mata->name) ? (!isset($city_mata->name) ? "in ": '').$state_mata->name." "  : '';
			}
			$title .= Session::get('country_name');
			?>
			
			<meta property="og:title" content="<?php echo $title; ?>">
			<meta property="og:description" content="<?php echo $title.' Findwala is a site to help people find their lost things from all over the world. The lost and found things can be of any category for example mobile and laptops,documents, persons, electronics, vehicles,pets, jewellery, accessories, and any other category'; ?>">
			<meta property="og:image" content="<?php echo asset('public/images/findwala-logo.png'); ?>">
			<meta property="og:url" content="<?php echo Request::url(); ?>">
			<meta name="og:site_name" content="FindWala"/>
			<meta name="og:country-name" content="<?php echo Session::get('country_name'); ?>"/>
			<meta property="twitter:title" content="<?php echo $title; ?>">
			<meta property="twitter:description" content="<?php echo $title.' Findwala is a site to help people find their lost things from all over the world. The lost and found things can be of any category for example mobile and laptops,documents, persons, electronics, vehicles,pets, jewellery, accessories, and any other category'; ?>">
			<meta property="twitter:image" content="<?php echo asset('public/images/findwala-logo.png'); ?>">
			<meta property="twitter:url" content="<?php echo Request::url(); ?>">
			<meta name="twitter:site" content="FindWala"/>
			<meta name="keywords" content="<?php echo str_replace(' ', ',', $title); ?>"/>
			<meta name="description" content="<?php echo $title.' Findwala is a site to help people find their lost things from all over the world. The lost and found things can be of any category for example mobile and laptops,documents, persons, electronics, vehicles,pets, jewellery, accessories, and any other category'; ?>"/>
			<meta name="subject" content="Lost and Found">
			<meta name="summary" content="<?php echo $title.' Findwala is a site to help people find their lost things from all over the world. The lost and found things can be of any category for example mobile and laptops,documents, persons, electronics, vehicles,pets, jewellery, accessories, and any other category'; ?>">
			<meta name="author" content="FindWala, info@findwala.com">
			<meta name="url" content="<?php echo Request::url(); ?>">
			<meta name="identifier-URL" content="https://findwala.com">

			<title><?php echo $title; ?></title>
			<?php

			break;

			default:
		
			$meta_tags = Meta_tags::where('route_name', $route_name)->first();
			if(!empty($meta_tags)) {

			?>
			<meta property="og:title" content="<?php echo $meta_tags->title; ?>">
			<meta property="og:description" content="<?php echo $meta_tags->description; ?>">
			<meta property="og:image" content="<?php echo $meta_tags->image; ?>">
			<meta property="og:url" content="<?php echo Request::url(); ?>">
			<meta name="og:site_name" content="FindWala"/>
			<meta property="twitter:title" content="<?php echo $meta_tags->title; ?>">
			<meta property="twitter:description" content="<?php echo $meta_tags->description; ?>">
			<meta property="twitter:image" content="<?php echo $meta_tags->image; ?>">
			<meta property="twitter:url" content="<?php echo Request::url(); ?>">
			<meta name="twitter:site" content="FindWala"/>
			<meta name="keywords" content="<?php echo str_replace(' ', ',', $meta_tags->title); ?>"/>
			<meta name="description" content="<?php echo $meta_tags->description; ?>"/>
			<meta name="subject" content="Lost and Found">
			<meta name="copyright"content="FindWala">
			<meta name="summary" content="<?php echo $meta_tags->description; ?>">
			<meta name="author" content="FindWala, info@findwala.com">
			<meta name="url" content="https://findwala.com">
			<meta name="identifier-URL" content="https://findwala.com">
			<title><?php echo $meta_tags->title; ?></title>
			<?php
			}
			break;
		}

	}

}

function check_device(){
	$useragent=$_SERVER['HTTP_USER_AGENT'];

	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptopiemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
	{
		return 'api';
	}else{
		return 'web';
	}
}


function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
	$output = NULL;
	if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
		$ip = $_SERVER["REMOTE_ADDR"];
		if ($deep_detect) {
			if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
				$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	}
	$purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
	$support    = array("country", "countrycode", "state", "region", "city", "location", "address");
	$continents = array(
		"AF" => "Africa",
		"AN" => "Antarctica",
		"AS" => "Asia",
		"EU" => "Europe",
		"OC" => "Australia (Oceania)",
		"NA" => "North America",
		"SA" => "South America"
	);
	if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
		if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
			switch ($purpose) {
				case "location":
				$output = array(
					"city"           => @$ipdat->geoplugin_city,
					"state"          => @$ipdat->geoplugin_regionName,
					"country"        => @$ipdat->geoplugin_countryName,
					"country_code"   => @$ipdat->geoplugin_countryCode,
					"continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
					"continent_code" => @$ipdat->geoplugin_continentCode
				);
				break;
				case "address":
				$address = array($ipdat->geoplugin_countryName);
				if (@strlen($ipdat->geoplugin_regionName) >= 1)
					$address[] = $ipdat->geoplugin_regionName;
				if (@strlen($ipdat->geoplugin_city) >= 1)
					$address[] = $ipdat->geoplugin_city;
				$output = implode(", ", array_reverse($address));
				break;
				case "city":
				$output = @$ipdat->geoplugin_city;
				break;
				case "state":
				$output = @$ipdat->geoplugin_regionName;
				break;
				case "region":
				$output = @$ipdat->geoplugin_regionName;
				break;
				case "country":
				$output = @$ipdat->geoplugin_countryName;
				break;
				case "countrycode":
				$output = @$ipdat->geoplugin_countryCode;
				break;
			}
		}
	}
	return $output;
}


?>
