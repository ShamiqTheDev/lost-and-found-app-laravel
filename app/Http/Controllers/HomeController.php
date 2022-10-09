<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use Auth;
use Hash;
use Validator;
use Mail;
use Storage;
use URL;
use App\Admin;
use App\User;
use App\Posts;
use App\Countries;
use App\States;
use App\Cities;
use App\Categories;
use App\Makes;
use App\Models;
use App\Colors;
use App\Brands;
use App\Breeds;
use App\Heights;
use App\Ages;
use App\Complexions;
use App\Materials;
use App\Genders;
use App\Liked_posts;

class HomeController extends Controller
{
  public function __construct()
  {
    // $this->middleware('auth');
  }

  public function index(){

    $lost_adds = Posts::select('id','title', 'sub_cat_id', 'description', 'content', 'images','type','reward')
    ->where('status', 'active')
    ->where('type','1')
    ->groupBy('posts.id')
    ->orderBy('id', 'desc');

    $country_id = Session::get('country_id');
    if (!empty($country_id)) {
      $lost_adds =$lost_adds->where('posts.country_id', $country_id);
    }
    $lost_adds = $lost_adds->take(10)
    ->get();

    $found_adds = Posts::select('id','title', 'sub_cat_id', 'description', 'content', 'images','type','reward')
    ->where('status', 'active')
    ->where('type','2')
    ->groupBy('posts.id')
    ->orderBy('id', 'desc');

    $country_id = Session::get('country_id');
    if (!empty($country_id)) {
      $found_adds =$found_adds->where('posts.country_id', $country_id);
    }
    $found_adds = $found_adds->take(10)
    ->get();
    return view('lostandfound.index', ['lost_adds'=>$lost_adds, 'found_adds'=>$found_adds]);

  }

  public function send_feedback(Request $request)
  {

    $name = $request->firstname.' '.$request->lastname;
    $email = $request->email;
    $body = $request->message;

    $body_text1 = '<h3>welcome '.$name.'!</h3>Thank you for contacting <a href="https://findwala.com">Find Wala</a>. We really value your feedback.<br>Our team will shortly review your message and will send you a respose if needed.<br><br>Thank You.<br>Findwala Team.<br><a href="https://findwala.com">www.findwala.com</a>';
    $data1 = array('body_text' => $body_text1);
    
    Mail::send('emails.contact_mail', $data1, 
      function($message) use ($name, $email) {
        $message->to($email, $name)
        ->subject('Thank you for Contact');
        $message->from('noreply@findwala.com','Find Wala');
      });

    $body_text2 = 'Name: <strong>'.$name.'!</strong><br>Email: <strong>'.$email.'</strong><br>Message:<br><p>'.$body.'</p><br><br>Thank You.';
    $data2 = array('body_text' => $body_text2);
    
    Mail::send('emails.contact_mail', $data2, 
      function($message) use ($name, $email) {
        $message->to('test16aug19@gmail.com', 'FindWala Contact Mail')
        ->subject('A new contact form submission');
        $message->from('noreply@findwala.com','Find Wala');
      });
    return back()
    ->with('msg_success', 'Mail Successfully Sent, We will contact you soon');
  }

  function get_categories( Request $request) {

    $categories = Categories::select('id','name')
    ->where('status','active')
    ->where('parent_id', 0)
    ->orderByRaw("CASE WHEN name = 'Others'
                       THEN 1 -- last
                       ELSE 0 -- first
                   END ASC
                , name ASC")
    ->get();
    ?>
    <option value="" selected="selected">Select Category</option>
    <?php
    foreach ($categories as $ct) {
      ?>
      <option value="<?php echo $ct->id ?>">
        <?php echo $ct->name ?>
      </option>
      <?php
    }
  }

  function get_subcategories(Request $request) {

    $subcategories = Categories::select('id','name')
    ->where('parent_id', $request->id)
    ->where('status','active')
     ->orderByRaw("CASE WHEN name = 'Others'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , name ASC")
    ->get();
    ?>
    <option value="" id="del-sub-cat">Select Sub-Category</option>
    <?php
    foreach ($subcategories as $sct) {
      ?>
      <option value="<?php echo $sct->id ?>">
        <?php echo $sct->name ?>
      </option>
      <?php
    }
  }

  function set_country_code( Request $request ) {

    $country = Countries::select('id', 'name', 'sortname', 'phonecode')->where('sortname', $request->cc)->first();
    Session::put('country_id', $country->id);
    Session::put('country_code', $country->sortname);
    Session::put('country_name', $country->name);
    Session::put('country_phonecode', $country->phonecode);
  }

  function get_states(Request $request) {

    $country = get_country();

    $country_id = $country['country_id'];
    $states = States::select('id', 'name')
    ->where('country_id', $country_id)
    ->orderByRaw("CASE WHEN name = 'Other'
                   THEN 1 -- last
                   ELSE 0 -- first
               END ASC
            , name ASC")
    ->get();
    ?>
    <option value="" selected="selected">Select Province</option>
    <?php
    foreach ($states as $st) {
      ?>
      <option value="<?php echo $st->id ?>">
        <?php echo $st->name ?>
      </option>
      <?php
    }
  }

  function get_cities(Request $request) {

    $cities = Cities::select('id', 'name')
    ->where('state_id', $request->id)
   ->orderByRaw("CASE WHEN name = 'Other'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , name ASC")
    ->get();
    ?>

    <option value="" selected="selected">Select City</option>
    <?php
    foreach ($cities as $cs) {
      ?>
      <option value="<?php echo $cs->id ?>">
        <?php echo $cs->name ?>
      </option>
      <?php
    }
  }

  public function get_posts( Request $request){

    $posts = Posts::select('id', 'title', 'type', 'sub_cat_id', 'content', 'images','reward', 'description')
    ->where('status', 'active');

    $input = $request->all();
    $return_data = [];
    $filters = [ "state_id", "cat_id", "type", "sub_cat_id", "city_id"];
    $dynamic_filters = [];

    $categories = Categories::where('parent_id', '=', 0)->orderByRaw("CASE WHEN name = 'Others'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , name ASC")->get();
    $sub_categories = Categories::where('parent_id', '!=', 0)->orderByRaw("CASE WHEN name = 'Others'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , name ASC")->get();

    foreach ($filters as $filter) {

      if (isset($_GET[$filter])&& !empty($_GET[$filter])) {

        $$filter = $_GET[$filter];
        $filter_values[$filter] =  $_GET[$filter];
        $posts = $posts->where($filter, $_GET[$filter]);
        if ($filter == 'cat_id') {
          $attribute = get_attributes($request->cat_id);
          $filter_values = [];
          foreach ($attribute as $att) {

           if (isset($input[$att->attr_name]) && !empty($input[$att->attr_name])) {
             $dynamic_filters[$att->attr_name] = $input[$att->attr_name];
             $posts = $posts->where('content','like', "%".$input[$att->attr_name]."%");
             $return_data[$att->attr_name] = $input[$att->attr_name];
             $filter_values[$att->attr_name] = $input[$att->attr_name];
           }
           else{
            $dynamic_filters[$att->attr_name] = '';
          }
        }
      }
      $dynamic_filters[$filter] = $_GET[$filter];
    }
    else{
      $return_data[$filter] = '';
      $filter_values[$filter] = '';
    }
  }

  $return_data['dynamic_filters'] = $dynamic_filters;

  if ($request->has('search') && !empty($request->search)) {
    $search = '';
    $filter_values['search'] = $request->search;

    $search = $request->search;
    $return_data['search'] = $request->search;
    $filter_values['search'] = $request->search;
    $posts = $posts->where(function($q) use ($search) {
      $q->where(function($query) use ($search){
        $search = explode(' ', $search);

        foreach ($search as $ser => $value) {
         $query->where(function($query) use ($value){
          $query->where('title','like', "%".$value."%")
          ->orWhere('description','like', "%".$value."%")
          ->orWhere('content','like', "%".$value."%");
        });
       }
     });
    });

  }else{
    $return_data['search'] = '';
    $filter_values['search'] = '';
  }

  $country_id = Session::get('country_id');
  if (!empty($country_id)) {
   $posts = $posts->where('posts.country_id', $country_id);
 }

 $posts = $posts->paginate(10);
 $return_data['posts'] = $posts;
 $return_data['filter_values'] = $filter_values;
 $return_data['categories'] = $categories;
 $return_data['sub_categories'] = $sub_categories;
 return view('lostandfound.listings', $return_data);
}

function get_single_post( Request $request, $id){

  $post = Posts::join("users","posts.user_id", "=", "users.user_id")->select("posts.user_id","posts.id","posts.title","posts.sub_cat_id","posts.description","posts.content","posts.found_location","posts.reward","posts.images","posts.phonenumber","posts.created_at","posts.display_name","posts.show_number","posts.views","posts.likes","posts.found_date","posts.type",'posts.cat_id', 'posts.status', 'users.social_avatar', 'users.image');

  if (Auth::check()) {
    $auth_id = Auth::id();
    $post = $post->where(function($q) use ($auth_id) {
      $q->where('posts.status', 'active')
      ->orWhere('posts.user_id', $auth_id);
    });
  }
  else{
    if ( !Auth::guard('admin')->check()) {
      $post = $post->where('posts.status', 'active');
    }
  }
  $post = $post->where('id', $id)->first();

  $date = '';
  if (!empty($post)) {
    if ($post->created_at->diffInHours() <= 24) {
      $date =  "Today";
    }
    else if($post->created_at->diffInHours() <= 48){
      $date =  "Yesterday";
    }
    else{
      $date = $post->created_at;
    }
    $con = $post->cat_id;
  }

  $related_ads = Posts::select('id','title', 'sub_cat_id', 'description', 'content', 'images','type','reward')
  ->where('status', 'active')
  ->where('posts.id','!=',  $id);

  if (!empty($post)) {
    $related_ads = $related_ads->where('cat_id',$con);
  }
  $related_ads = $related_ads->groupBy('posts.id')
  ->orderBy('id', 'desc');

  $country_id = Session::get('country_id');
  if (!empty($country_id)) {
    $related_ads =$related_ads->where('posts.country_id', $country_id);
  }
  $related_ads = $related_ads->take(10)
  ->get();
  return view('lostandfound.listings-single', ['post'=> $post,'date'=> $date,'related_ads'=>$related_ads]);
}

function get_filters_fields($cat_id,$sub_cat_id=0) {

  $return_data = [];
  $return_data['dynamic_filters'] = json_decode(urldecode($_GET['dynamic_filters']),true);
  if (empty($return_data['dynamic_filters'])) {
    $return_data['dynamic_filters'] = ['cat_id' => $cat_id, 'sub_cat_id' => $sub_cat_id ];
  }

  $return_data['models'] =[];
  switch ($cat_id) {
    case '1':
    if ($sub_cat_id != '10') {
     $return_data['makes'] = Makes::select('id', 'display_name')
     ->where('status', 'active')
     ->where('sub_cat_id', $sub_cat_id)
     ->orderByRaw("CASE WHEN display_name = 'Other'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , display_name ASC")
     ->get();
   }
   if(isset($return_data['dynamic_filters']['make']) && !empty($return_data['dynamic_filters']['make'])){
    $return_data['models'] = Models::select('id', 'make_id', 'display_name')
    ->where('make_id', $return_data['dynamic_filters']['make'])
    ->where('status', 'active')
     ->orderByRaw("CASE WHEN display_name = 'Other'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , display_name ASC")
    ->get();
  }

  $return_data['colors'] = Colors::select('id', 'name')
  ->where('status', 'active')
   ->orderByRaw("CASE WHEN name = 'Other'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , name ASC")
  ->get();
  break;

  case '2':
  $return_data['materials'] = Materials::select('id', 'name')
  ->where('status', 'active')
   ->orderByRaw("CASE WHEN name = 'Other'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , name ASC")
  ->get();
  $return_data['colors'] = Colors::select('id', 'name')
  ->where('status', 'active')
   ->orderByRaw("CASE WHEN name = 'Other'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , name ASC")
  ->get();
  break;

  case '3':
  case '4':
  case '7':
  case '9':
  $return_data['colors'] = Colors::select('id', 'name')
  ->where('status', 'active')
   ->orderByRaw("CASE WHEN name = 'Other'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , name ASC")
  ->get();
  break;

  case '5':
  $return_data['colors'] = Colors::select('id', 'name')
  ->where('status', 'active')
   ->orderByRaw("CASE WHEN name = 'Other'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , name ASC")
  ->get();

  if ($sub_cat_id == '31') {
    $return_data['makes'] = Makes::select('id', 'display_name')
    ->where('status', 'active')
    ->where('sub_cat_id', $sub_cat_id)
     ->orderByRaw("CASE WHEN display_name = 'Other'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , display_name ASC")
    ->get();
  }
  break;

  case '6':
  $return_data['complexions'] = Complexions::select('id','color')
  ->where('status', 'active')
  ->orderBy('color')
  ->get();  
  break;

  case '8':
  $return_data['colors'] = Colors::select('id', 'name')
  ->where('status', 'active')
   ->orderByRaw("CASE WHEN name = 'Other'
             THEN 1 -- last
             ELSE 0 -- first
         END ASC
      , name ASC")
  ->get();
  break;

  default:
  break;
}

return view('lostandfound.filters.dynamic_filters_form', $return_data);
}

function get_brands(Request $request) {

  $makes = Models::select('id','display_name')->where('status', 'active')->where('make_id', $request->id)->get();
  ?>
  <option value="">Select Models</option>
  <?php
  foreach ($makes as $mk) {
    ?>
    <option value="<?php echo $mk->id ?>">
      <?php echo $mk->display_name ?>
    </option>
    <?php
  }
}

}
