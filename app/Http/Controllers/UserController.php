<?php
namespace App\Http\Controllers;
use Spatie\GoogleCalendar\Event;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Session;
use Auth;
use Hash;
use Validator;
use Storage;
use Mail;
use URL;
use Socialite;
use Exception;
use Image;
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
use App\Brand_Models;
use App\Breeds;
use App\Heights;
use App\Ages;
use App\Complexions;
use App\Materials;
use App\Genders;
use App\Liked_posts;
use Carbon\Carbon;

class UserController extends Controller
{

  public function __construct()
  {
    //$this->middleware('auth');
  }
  
  function user_login( Request $request ) {
    return view("user_login");
  }

  function edit_user_profile( Request $request ){
    $current_user = User::find(Auth::id());
    return view('lostandfound.editprofile', ['current_user'=> $current_user]);
  }

  function user_dashboard( Request $request, $ads_type = '1' ) {
    return view("lostandfound.user_dashboard",['ads_type'=>$ads_type]);
  }

  function post_form( Request $request ) {

    $categories = Categories::where('parent_id', '=', 0)->orderBy('name')->get();
    $sub_categories = Categories::where('parent_id', '!=', 0)->orderBy('name')->get();
    return view("lostandfound.postform",['sub_categories'=>$sub_categories,'categories'=>$categories]);
  }

  function login_submit( Request $request ) {

    if ( $request->has("email") && $request->has("password") ) {

      if ( Auth::attempt(["email" => $request->email, "password" => $request->password]) ) {
        $status = '1';

      } else {
        $status = '0';
      }
    } else {
      $status = '2';
    }
    return $status;
  }

  public function logout() {

    if ( Auth::check()) {
      Auth::logout();
      return back();
    }
  }

  function register(Request $request) {
    $rules = [
      "firstname" => "required|min:4|max:20",
      "lastname" => "required|min:4|max:20",
      "phonenumber" => "required|numeric|min:10|unique:users,phonenumber",
      "country_code" => "required|numeric",
      "email" =>"required|email|unique:users,email",
      "password" => "required|min:6|max:20",
      "confirmpassword" => 'required|min:6|max:20|same:password',
    ];

    $validation = Validator::make($request->all(),$rules);
    if($validation->fails()) {
     echo json_encode(['status'=> "0", 'msg'=> "The profile could not be created", "errors" => $validation->errors()->toArray()]); 

   } else {

     $verification_token = Str::random(32);
     $user = new User();
     $user->firstname = $request->firstname;
     $user->lastname = $request->lastname;
     $user->phonenumber = $request->phonenumber;
     $user->country_code = $request->country_code;
     $user->status = 'active';
     $user->email = $request->email;
     $user->password = Hash::make($request->password);
     $user->verification_token = $verification_token;

     $user->save();
     Auth::login($user);
     
     $name = $request->firstname.' '.$request->lastname;
     $email = $request->email;

     $data = array('name' => $name, 'email' => $email,'verification_token'=>$verification_token);

     Mail::send('emails.new_user', $data, 
      function($message) use ($name, $email) {
        $message->to($email, $name)
        ->subject('ThankYou for Registration');
        $message->from('noreply@findwala.com','Find Wala');
      });
     return 1;
   }
 }
 function resend_verification($id){
  if (Auth::check()) {

    $user = User::select('firstname','lastname','verification_token', 'email')->where('user_id',$id)->first();
    $verification_token = $user->verification_token;
    $name = $user->firstname.' '.$user->lastname;
    $email = $user->email;

    $data = array('name' => $name, 'email' => $email,'verification_token'=>$verification_token);

    Mail::send('emails.new_user', $data, 
      function($message) use ($name, $email) {
        $message->to($email, $name)
        ->subject('ThankYou for Registration');
        $message->from('noreply@findwala.com','Find Wala');
      });
    echo json_encode(['status'=> "1"]);
  }else{
    echo json_encode(['status'=> "0"]);
  }
}

function get_dashboard_posts($status = 'active'){

  $ads_type = (isset($_GET['ads_type']) && !empty($_GET['ads_type'])) ? $_GET['ads_type'] : '1' ;
  $posts = Posts::select('id', 'sub_cat_id','title', 'type', 'description','images', 'status', 'found_date','updated_at' )
  ->where('user_id', Auth::id())
  ->where('status', $status)
  ->orderBy('id','DESC')
  ->get();

  $count = 0;

  if ($status == 'active') {
    $temp = 'table-success';
  }
  else if($status == 'inactive'){
    $temp = 'table-info';
  }
  else if($status == 'rejected'){
    $temp = 'table-danger';
  }
  else{
    $temp = 'table-warning';
  }
  ?>

  <table class="table table-responsive">
    <thead>
      <tr class="<?php echo $temp ?>">
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Type</th>
        <th scope="col" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($posts->isNotEmpty()) {
        foreach ($posts as $ae) {
          $uploaded_images = json_decode($ae->images,true);
          $img_url = image_check(isset($uploaded_images['0']) ? $uploaded_images['0'] : '', $ae->sub_cat_id);
          ?>
          <tr id="post_<?php echo $ae->status.$ae->id ?>">
            <td class="img-tbl-td">
              <div class="img-tb-box">
                <a href="<?php echo route('single_post',['id' => $ae->id,'title' => str_replace('+','-',urlencode($ae->title))]) ?>"><img class="tbl-img-sz img-fluid" src="<?php echo $img_url ?>"></a>
              </div>
            </td>
            <td><a href="<?php echo route('single_post',['id' => $ae->id,'title' => str_replace('+','-',urlencode($ae->title))]) ?>"><strong><?php echo substr_replace($ae->title, "...", 40) ?></strong></a>
              <p><?php echo substr_replace($ae->description, "...", 40); ?><a href="<?php echo route('single_post',['id' => $ae->id,'title' => str_replace('+','-',urlencode($ae->title))]) ?>">read more</a></p>
            </td>
            <?php
            if ($ae->type == '1') {
              $type = 'Lost';
            }else{
              $type = 'Found';
            }
            ?>
            <td><strong><?php echo $type  ?></strong>
            </td>
            <td class="act-btn-center">
              <div class="dropdown">
                <button class="btn text-white rounded same-bg dropdown-toggle act-btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <a href="<?php echo route('single_post',['id' => $ae->id,'title' => str_replace('+','-',urlencode($ae->title))]) ?>"><i class="fa fa-eye"></i></a>
                    <a href="<?php echo route('edit_post_detail',['id' => $ae->id]) ?>"><i class="fa fa-pencil"></i></a>
                    <?php if ($ae->status == 'active'){ ?>
                      <a title="Change status to In-Active" href="#" onclick="change_status('<?php echo $ae->id ?>','<?php echo $ae->status ?>')"><i class="fa fa-power-off"></i></a>
                    <?php } ?>

                    <?php if ($ae->status == 'inactive'){ ?>
                      <a title="Change status to Active" href="#" onclick="change_status('<?php echo $ae->id ?>','<?php echo $ae->status ?>')"><i class="fa fa-refresh"></i></a>
                    <?php } ?>
                    <a href="#" onclick="delete_confirm('<?php echo $ae->id ?>','<?php echo $ae->status ?>')"><i class="fa fa-trash"></i></a>
                  </ul>
                </div>
              </td>
            </tr>
            <?php
          }
        }else{
          ?>
          <tr class="text-center">
            <td colspan="4" align="center">
              No Post Found
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <?php
  }

  function update_user_detail( Request $request){

    $id = Auth::id();
    $rules = [
      "firstname" => "required|min:4|max:20",
      "lastname" => "required|min:4|max:20",
      "country_code" => "required|numeric",
      "phonenumber" => "required|numeric|min:11|unique:users,phonenumber,".$id.",user_id",
      "imageUpload" => "image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100|dimensions:max_width=1500,max_height=1500"
    ];

    $messages = [
      'imageUpload.image' => 'Profile Image accept only Image.',
      'imageUpload.mimes' => 'Profile Image accept only JPG/JPEG/PNG formats.',
      'imageUpload.max' => 'Profile Image is larger than 2MB.',
      'imageUpload.dimensions' => 'Profile Image accept Min dimension of 50X50 and Max dimension of 1500X1500.',
    ];

    $validator = Validator::make($request->all(),$rules,$messages);
    if ($validator->fails()) {
      echo json_encode(['status'=> "0", 'msg'=> "The profile could not be updated", 'errors'=> $validator->errors()->toArray()]);
    }
    else{
      $data =  ['firstname'=>$request->firstname,'lastname'=>$request->lastname,'phonenumber'=>$request->phonenumber];

      if ($request->hasFile('imageUpload')) {
        $image = $request->file('imageUpload');
        $name = uniqid().'.'.$image->getClientOriginalExtension();
        Storage::disk('local')->putFileAs(
          'profiles/',
          $image,
          $name
        );

        $data['image'] = $name;
      // $data['social_avatar'] = URL::asset('storage/app/profiles/'.$name);
      }else{
        if ($request->remove_profile_img == '1') {
         $data['image'] = '';
         $data['social_avatar'] = '';
       }


     }
     User::where('user_id',$id)->update($data);

     $msg = "Account updated successfully.";
     echo json_encode(['status' => '1', 'msg' => $msg]);
   }
 }

 function update_user_password(Request $request) {

  if (!empty($request->old_password) && !empty($request->new_password) && !empty($request->new_password_confirmation)  ) {
    $rules = [
      "old_password" => 'required',
      "new_password" => 'required|min:6|max:30|confirmed|different:old_password',
      "new_password_confirmation" => 'required|min:6|max:30',
    ];

    $messages = [
      "old_password.required" => "Old password is required",
      "new_password.required" => "New password is required",
      "new_password.min" => "Minimum 6 characters required for new password",
      "new_password.max" => "Maximum 30 characters allowed for new password",
      "new_password_confirmation.required" => "Confirm password is required",
      "new_password_confirmation.min" => "Minimum 6 characters required for confirm password",
      "new_password_confirmation.max" => "Maximum 30 characters allowed for confirm password",
    ];

    $validation = Validator::make($request->all(),$rules,$messages);
    if($validation->fails()) {
     echo json_encode(['status'=> "0", 'msg'=> "The password could not be updated", 'errors'=> $validation->errors()->toArray()]);
   } else {
    $user = Auth::user();
    $old_password = $request->old_password;
    $real_password = $user->password;
    if (Hash::check($old_password, $real_password))
    {
      $user->password = Hash::make($request->new_password);
      $user->save();
      $msg = "The password was updated successfully";
      echo json_encode(['status'=> "1", 'msg' => $msg]); 

    }else {
      $msg = "The old password is incorrect";
      echo json_encode(['status'=> "0", 'msg' => $msg, 'errors'=> $validation->errors()->add('old_password', 'Old password is not valid')]);
    }
  }
}else{
  $msg = "All fields Required";
  echo json_encode(['status'=> "0", 'msg' => $msg]);
}

}

function update_notification( Request $request){

  $id = Auth::id();
  if( $request->notification_email == true) {
    $notification_value = '1';
  } else {
    $notification_value = '0';
  }
  User::where('user_id',$id)->update(['notification_email' => $notification_value]);
  $msg = "Notification settings was updated successfully";
  echo json_encode(['status'=> "1", 'msg' => $msg]);
}


function login( Request $request ) {

  if ( $request->email && $request->password ) {
    $user = User::where('email', $request->email)->first();
    if ($user) {
      $validCredentials = Hash::check($request->password, $user->password);
      if ($user && $validCredentials) {
        return redirect()->route("user_dashboard"); 
      }else{
        Session::flash("msg_error","Invalid Credentials");
      }
    }
  } else {
    Session::flash("msg_error","Email or password field missing");
  }
  return back();
}

function edit_post_detail( $id ){

  $post = Posts::where('id',$id)->where('user_id', Auth::id())->first();
  if (!empty($post)) {
    
  
  $categories = Categories::where('parent_id', '=', 0)->orderBy('name')->get();
  $sub_categories = Categories::where('parent_id', '!=', 0)->orderBy('name')->get();
  return view('lostandfound.edit_postform',[ 'post' => $post,'sub_categories' => $sub_categories, 'categories' => $categories ]);
}else{
  return redirect()->route('user_dashboard');
}

}

function delete_post_detail($id,$status)
{
  $status = Posts::where('id',$id)->where('status',$status)->where('user_id', Auth::id())->delete();
  echo json_encode(['status'=>$status]);
}

function change_post_status($id,$status)
{
  if ($status == 'active') {
    $status=Posts::where('id',$id)->where('user_id',Auth::id())->update(['status'=>'inactive']);
  }elseif($status == 'inactive'){
    $status=Posts::where('id',$id)->where('user_id', Auth::id())->update(['status'=>'active']);
  }
  echo json_encode(['status'=>$status]);
}

function delete_image( Request $request){

 $post = Posts::find($request->post_id);
 $uploaded_images = json_decode($post->images,true);
 $updated_images = array_diff($uploaded_images, array($request->name) ); // removes 11
 $post->images = json_encode($updated_images);

 $post->save();

 $msg = 'Image was deleted succesfully';
 echo json_encode(['status' => '1', 'msg' => $msg]);
}

function get_fields($cat_id, $sub_cat_id) {

  $return_data = [];
  $dynamic_filters = isset($_GET['dynamic_filters']) ? json_decode($_GET['dynamic_filters'], true) : '';
  $return_data['current_model'] = isset($dynamic_filters['model']) ? $dynamic_filters['model'] : '';
  $return_data['current_color'] = isset($dynamic_filters['color']) ? $dynamic_filters['color'] : '';
  $return_data['current_materials'] = isset($dynamic_filters['materials']) ? $dynamic_filters['materials'] : '';
  $return_data['current_complexion'] = isset($dynamic_filters['complexion']) ? $dynamic_filters['complexion'] : '';

  $return_data['current_registration'] = isset($dynamic_filters['registration']) ? $dynamic_filters['registration'] : '';
  $return_data['current_chasis'] = isset($dynamic_filters['chasis']) ? $dynamic_filters['chasis'] : '';
  $return_data['current_engine'] = isset($dynamic_filters['engine']) ? $dynamic_filters['engine'] : '';
  $return_data['current_year'] = isset($dynamic_filters['year']) ? $dynamic_filters['year'] : '';


  $return_data['current_brand'] = isset($dynamic_filters['brand']) ? $dynamic_filters['brand'] : '';
  $return_data['current_name'] = isset($dynamic_filters['name']) ? $dynamic_filters['name'] : '';
  $return_data['current_gender'] = isset($dynamic_filters['gender']) ? $dynamic_filters['gender'] : '';
  $return_data['current_age'] = isset($dynamic_filters['age']) ? $dynamic_filters['age'] : '';
  $return_data['current_height'] = isset($dynamic_filters['height']) ? $dynamic_filters['height'] : '';

  $return_data['current_material'] = isset($dynamic_filters['material']) ? $dynamic_filters['material'] : '';
  $return_data['current_weight'] = isset($dynamic_filters['weight']) ? $dynamic_filters['weight'] : '';

  switch ($cat_id) {
    case '1':
    if ($sub_cat_id != '10') {
      $return_data['makes'] = Makes::select('id', 'display_name')
      ->where('status', 'active')
      ->where('sub_cat_id', $sub_cat_id)
      ->get();
    }
    if(isset($dynamic_filters['make']) && !empty($dynamic_filters['make'])){
      $cmake = $dynamic_filters['make'];
    }else{
      $cmakes = collect($return_data['makes'])
      ->first();
      if (isset($cmakes->display_name)) {
        $cmake = $cmakes->display_name;
      }else{
        $cmake = '';
      }
    }

    $current_make = Makes::select('display_name','id')
    ->where('status', 'active')
    ->where('display_name', $cmake)
    ->first();


    if (isset($current_make->id)) {
      $return_data['current_make'] = $current_make->id;
      $return_data['models'] = Models::select('id', 'make_id', 'display_name')
      ->where('make_id',$current_make->id)
      ->where('status', 'active')
      ->get();
    }else{
      $return_data['current_make'] = '';
    }

    $return_data['colors'] = Colors::select('id', 'name')
    ->where('status', 'active')
    ->get();
    break;

    case '2':
    $return_data['materials'] = Materials::select('id', 'name')
    ->where('status', 'active')
    ->get();
    $return_data['colors'] = Colors::select('id', 'name')
    ->where('status', 'active')
    ->get();
    break;

    case '6':
    $return_data['complexions'] = Complexions::select('id','color')->where('status', 'active')->get();
    break;

    case '5':
    $return_data['colors'] = Colors::select('id', 'name')
    ->where('status', 'active')
    ->get();
    $return_data['makes'] = Makes::select('id', 'display_name')
    ->where('status', 'active')
    ->where('sub_cat_id', $sub_cat_id)
    ->get();
    
        if(isset($dynamic_filters['make']) && !empty($dynamic_filters['make'])){
      $cmake = $dynamic_filters['make'];
    }else{
      $cmakes = collect($return_data['makes'])
      ->first();
      if (isset($cmakes->display_name)) {
        $cmake = $cmakes->display_name;
      }else{
        $cmake = '';
      }
    }

    $current_make = Makes::select('display_name','id')
    ->where('status', 'active')
    ->where('display_name', $cmake)
    ->first();


    if (isset($current_make->id)) {
      $return_data['current_make'] = $current_make->id;
    }
    
    break;

    case '3':
    case '4':
    case '7':
    case '8':
    case '9':
    $return_data['colors'] = Colors::select('id', 'name')
    ->where('status', 'active')
    ->get();
    break;

    default:
    break;
  }
  $return_data['cat_id'] = $cat_id;
  $return_data['sub_cat_id'] = $sub_cat_id;

  return view('lostandfound.forms.dynamic_form', $return_data);
}

function get_brand_models(Request $request) {

  $makes = Brand_Models::select('id', 'name')
  ->where('brand_id', $request->id)
  ->where('status','active')
  ->get();
  ?>
  <option value="">Select Models</option>
  <?php
  foreach ($makes as $mk) {
    ?>
    <option value="<?php echo $mk->id ?>">
      <?php echo $mk->name ?>
    </option>
    <?php
  }
}

function submit_post(Request $request) {

  $country_id = Session::get('country_id');
  $country_name = Session::get('country_name');

  $post = new Posts;
  $validation = $post->validator($request->all());
  if($validation->fails()) {
    echo json_encode(['status'=> "0", 'msg'=> "The post could not be created", 'errors'=> $validation->errors()->toArray()]);
  }else{
   $attr = get_attributes($request->cat_id);
   $post_attr = [];

   foreach ($attr as $at) {
    if ($request->has($at->attr_name)) {
      $b = $at->attr_name;
      $post_attr[$at->attr_name] = $request->$b;
    }
  }
  
  $user_id = Auth::id();

  $post = new Posts();
  $files = \Request::file('image');

  $up_images = [];
  if (isset($_FILES['image']['tmp_name'])) {

    foreach ($_FILES['image']['tmp_name'] as $key => $val ) {

      if (isset($files[$key])) {

       $file1=$_FILES['image']['name'][$key];
       $name1=uniqid().'.'.pathinfo($file1, PATHINFO_EXTENSION);
       $uploadedFile = $files[$key];
       Storage::disk('local')->putFileAs(
        'files/',
        $uploadedFile,
        $name1
      );
       $up_images[] = $name1;
       $th_name = 'th_'.$name1;
       $img_path = storage_path('app/files/'.$name1);
       $thumb_path = storage_path('app/files/'.$th_name);
       $thumb = Image::make($img_path)->resize(300,null, function ($constraint) {$constraint->aspectRatio();});
        //  Image::make($img_path)->save($img_path, 70);
        // save file as jpg with medium quality
       $thumb->save( $thumb_path, 80);
     }
   }
 }

 $up_images = array_filter($up_images);

 $post->user_id = $user_id;

 $post->cat_id = $request->cat_id;
 $post->sub_cat_id = $request->sub_cat_id;

 $post->images = json_encode($up_images);

 $post->country_id = $country_id;
 $post->state_id = $request->state_id;
 $post->city_id = $request->city_id;
 $post->found_location = trim($request->location);
 $title = str_replace('/', '', $request->title);
 $post->title = trim(stripslashes($title));
 $post->found_date = $request->date;
 $post->description = trim($request->description);
 $post->display_name = trim($request->display_name);
 $post->phonenumber = trim($request->phonenumber);
 $post->country_code = $request->country_code;
 $post->show_number = trim($request->show_number);
 $post->reward = trim($request->reward);
 $post->status = 'pending';
 $post->type = $request->post_type;

 $content_data = get_post_content($request->cat_id,$request->sub_cat_id,$request->state_id,$request->city_id, ['make'=>$request->make,'model'=>$request->model,'complexion'=>$request->complexion,'material'=>$request->material,'color'=>$request->color]);

 $content_data['country']= $country_name;

 $post_attr = array_merge($post_attr,$content_data);

 if (!empty($post_attr)) {
  $post->content = json_encode($post_attr);
}

$post->save();

$post_link = route('single_post',['id'=>$post->id,'title' => str_replace('+','-',urlencode($request->title)) ]);
$name = Auth::user()->firstname.' '.Auth::user()->lastname;
$body_text = 'A new post submited by '.$name.'. Please review it soon.';
$data = array('name' => 'Admin', 'post_link' => $post_link,'body_text' => $body_text);

Mail::send('emails.post_approve', $data, 
  function($message){
    $message->to('info@findwala.com', 'Admin')
    ->subject('New Post Request Received');
    $message->from('noreply@findwala.com','Find Wala');
  });

$notif = User::select('notification_email')->where('user_id', $user_id)->first();
if ($notif->notification_email == '1') {

  $body_text = 'We have received your new post request. Our team will review it shortly and will publish it soon. Currently the post is not visible to other users';
  $data = array('name' => $name, 'post_link' => $post_link,'body_text' => $body_text);
  $email = Auth::user()->email;
  Mail::send('emails.post_approve', $data, 
    function($message) use ($name, $email) {
      $message->to($email, $name)
      ->subject('New Post Request Received');
      $message->from('noreply@findwala.com','Find Wala');
    });
}
Session::flash("msg_success","The post status is 'Pending'. Our team will review shortly.");
echo json_encode(['status'=> "1", 'msg'=> "The post successfully submited"]);
}
}

function update_submit_post(Request $request) {

  $post = new Posts;
  $validation = $post->validator($request->all());
  if($validation->fails()) {
    echo json_encode(['status'=> "0", 'msg'=> "The post could not be updated", 'errors'=> $validation->errors()->toArray()]);
  }
  else{
    $attr = get_attributes($request->cat_id);
    $post_attr = [];

    foreach ($attr as $at) {
      if ($request->has($at->attr_name)) {
        $b = $at->attr_name;
        $post_attr[$at->attr_name] = $request->$b;
      }
    }

    $user_id = Auth::id();

    $post = Posts::find($request->id);
    $files = \Request::file('image');

    $up_images = [];
    if (!empty($post->images)) {
     $up_images = json_decode($post->images,true);
   }

   $remove_images = $request->remove_images;
   if (!empty($remove_images)) {
    $remove_images = explode(',', $remove_images);
    $up_images = array_diff( $up_images, $remove_images);
  }

  if (isset($_FILES['image']['tmp_name'])) {

    foreach ($_FILES['image']['tmp_name'] as $key => $val ) {

      if (isset($files[$key])) {

       $file1=$_FILES['image']['name'][$key];
       $name1= uniqid().'.'.pathinfo($file1, PATHINFO_EXTENSION);
       $uploadedFile = $files[$key];
       Storage::disk('local')->putFileAs(
        'files/',
        $uploadedFile,
        $name1
      );
       $up_images[$key] = $name1;

       $th_name = 'th_'.$name1;
       $img_path = storage_path('app/files/'.$name1);
       $thumb_path = storage_path('app/files/'.$th_name);
       $thumb = Image::make($img_path)->resize(300,null, function ($constraint) {$constraint->aspectRatio();});
        //  Image::make($img_path)->save($img_path, 70);
        // save file as jpg with medium quality
       $thumb->save( $thumb_path, 80);
     }
   }
 }

 $up_images = array_values($up_images);
 
 $post->user_id = $user_id;

 $post->cat_id = $request->cat_id;
 $post->sub_cat_id = $request->sub_cat_id;
 $post->state_id = $request->state_id;
 $post->city_id = $request->city_id;
 $post->images = json_encode($up_images);
 $post->found_location = trim($request->location);
 $title = str_replace('/', '', $request->title);
 $post->title = trim(stripslashes($title));
 $post->found_date = trim($request->date);
 $post->description = trim($request->description);
 $post->display_name = trim($request->display_name);
 $post->phonenumber = trim($request->phonenumber);
 $post->country_code = trim($request->country_code);
 $post->show_number = $request->show_number;
 $post->status = 'pending';
 $post->type = $request->post_type;
 $post->reward = trim($request->reward);

 $content_data = get_post_content($request->cat_id,$request->sub_cat_id,$request->state_id,$request->city_id, ['make'=>$request->make,'model'=>$request->model,'complexion'=>$request->complexion,'material'=>$request->material,'color'=>$request->color]);

 $post_country = Countries::where('id', $post->country_id)->first();
 if (isset($post_country->name)) {
  $content_data['country']= $post_country->name;
}

$post_attr = array_merge($post_attr,$content_data);

if (!empty($post_attr)) {
  $post->content = json_encode($post_attr);
}

$post->save();

$post_link = route('single_post',['id'=>$post->id,'title' => str_replace('+','-',urlencode($request->title)) ]);
$name = Auth::user()->firstname.' '.Auth::user()->lastname;
$body_text = 'A new post submited by '.$name.'. Please review it soon.';
$data = array('name' => 'Admin', 'post_link' => $post_link,'body_text' => $body_text);

Mail::send('emails.post_approve', $data, 
  function($message) {
    $message->to('info@findwala.com', 'Admin')
    ->subject('Post updated successfully');
    $message->from('noreply@findwala.com','Find Wala');
  });

$notif = User::select('notification_email')->where('user_id', $user_id)->first();
if ($notif->notification_email == '1') {

  $body_text = 'We have received your post request. Our team will review it shortly and will publish it soon. Currently the post is not visible to other users';
  $data = array('name' => $name, 'post_link' => $post_link, 'body_text' => $body_text);
  $email = Auth::user()->email;
  Mail::send('emails.post_approve', $data, 
    function($message) use ($name, $email) {
      $message->to($email, $name)
      ->subject('Post updated successfully');
      $message->from('noreply@findwala.com','Find Wala');
    });
}
Session::flash("msg_success","The post status is 'Pending'. Our team will review shortly.");
echo json_encode(['status'=> "1", 'msg'=> "The post was successfully updated"]);
}

}

public function verify_email($verification_token){

  $user_data = User::where('verification_token',$verification_token)->first();
  if (!empty($user_data)) {
    User::where('verification_token',$verification_token)->update(['verifiy_email'=>'1','verification_token'=>'']);
    Auth()->loginUsingId($user_data->user_id);
    Session::flash("msg_success","Account is activated. Now you can use all services");
    return redirect()->route("user_dashboard");
  }else{
   Session::flash("msg_faliure","The link is expired or does not exist.");
   return redirect()->route("index");
 }
}

public function reset_password(Request $request){

 $rules = [
  "email" =>"required|email",
];

$validation = Validator::make($request->all(),$rules);
if($validation->fails()) {
  $msg = "Please insert Email";
  $status = "msg_faliure";
}else{

  $user= User::where('email',$request->email)->first();
  if (!empty($user)) {

    $reset_password_token = Str::random(32);
    User::where('email',$request->email)->update(['verification_forget_password'=>$reset_password_token]);

    $data = array('email' => $request->email, 'name' => $user->firstname,'reset_password_token'=>$reset_password_token);
    $email = $request->email;

    Mail::send('emails.forget_password', $data, 
      function($message) use ($email) {
        $message->to($email)
        ->subject('Request for Reset Password');
        $message->from('noreply@findwala.com','Find Wala');
      });
  }
  $msg = "If you entered correct Email address, you will receive an Email.";
  $status = "msg_success";
}

Session::flash($status,$msg);
return back();  
}


public function verify_forget_email($verification_forget_password){

  $vfp = User::where('verification_forget_password',$verification_forget_password)->first();
  if (!empty($vfp)) {
    $token = $vfp->verification_forget_password;
    return view('lostandfound.submit_resetpassword', ['token'=>$token]);
  }
  else{
   Session::flash("msg_faliure","Token expired please reset password again");
   return redirect()->route("index");
 }
}

public function change_password(Request $request){


  $rules = [
    "password" => "required|min:6|max:20",
    "confirmpassword" => 'required|min:6|max:20|same:password',
  ];

  $messages = [
    "confirmpassword.required" => "Confirm Password field is required.",
    "confirmpassword.min" => "Minimum 6 charachters allowed for confirm password",
    "confirmpassword.max" => "Maximum 20 charachters allowed for confirm password",
    "confirmpassword.same" => "Password and Confirm Password fields must match.",

    "password.required" => "Password field is required.",
    "password.min" => "Minimum 6 charachters allowed for password",
    "password.max" => "Maximum 20 charachters allowed for password",
    
  ];

  $validation = Validator::make($request->all(),$rules,$messages);
  if($validation->fails()) {
    Session::flash("msg_faliure","Password could not be reset.");
    return back()->withErrors($validation)->withInput();
  } else {
    $user_data = User::where('verification_forget_password',$request->token)->first();
    if (!empty($user_data)) {
      $password = Hash::make($request->password);

      $user=User::where('verification_forget_password',$request->token)->update(['password'=>$password,'verification_forget_password'=>'']);


      Auth()->loginUsingId($user_data->user_id);

      return redirect()->route("user_dashboard");
    }
    else{
     Session::flash("msg_faliure","Then link is expired or does not exist.");
     return redirect()->route("index");

   }
 }

}

function like_unlike_posts($post_id,$type){

  $user_id = Auth::id();
  if ($type == '1') {
   $check = Liked_posts::where('post_id', $post_id)->where('user_id', $user_id)->first();
   if (empty($check)) {
    Liked_posts::insert(['post_id'=>$post_id, 'user_id'=>$user_id]);
  }
  $msg = 'Post was added to your "Remember List"';
}
else{
  Liked_posts::where('post_id', $post_id)->where('user_id', $user_id)->delete();
  $msg = 'Post was removed from your "Remember List"';
}
echo json_encode(['type'=>$type,'msg'=> $msg]);
}

function remember_list(){

  $remember_list = Liked_posts::join('posts','liked_posts.post_id','=','posts.id')
  ->where('liked_posts.user_id', Auth::id())
  ->select("posts.title","description","content",'reward',"images","type","liked_posts.post_id")
  ->groupBy('posts.id')
  ->paginate(10);

  return view( 'lostandfound.remember_list' , ['remember_list'=>$remember_list]);
}


//Facebook Social
public function redirectfb($provider="facebook")
{
  return Socialite::driver($provider)->redirect();
}

public function callbackfb($provider="facebook")
{
  $getInfo = Socialite::driver($provider)->user();
  $finduser = User::where('facebook_id', $getInfo->id)->orWhere('email', $getInfo->email)->first();
  if (!empty($finduser)) {
    $user = User::find($finduser->user_id);
  }else{
    $user = new User();
    $new_password = substr(uniqid(rand(), true), 8, 8);
    $counter = 1;
  }

  $user->firstname = $getInfo->name;
  $user->email = $getInfo->email;
  $user->provider = $provider;
  $user->facebook_id = $getInfo->user['id'];
  $user->is_social = '1';
  $user->verifiy_email = '1';
  $user->social_avatar = $getInfo->avatar_original;
  $user->country_code = "+".Session::get('country_phonecode');
  if (isset($counter) && $counter == 1) {
    $this->social_mail($getInfo->name, $getInfo->email, $new_password);
    $user->password = Hash::make($new_password);
  }
  $user->save();
  Auth()->login($user);
  return redirect()->to('user_dashboard');

}

//Google Social
public function redirectToGoogle()
{
  return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
  try {
    $google_user = Socialite::driver('google')->user();
    $finduser = User::where('google_id', $google_user->id)->orWhere('email', $google_user->email)->first();
    if(!empty($finduser)){
      $user = User::find($finduser->user_id);
    }else{
     $user = new User();
     $new_password = substr(uniqid(rand(), true), 8, 8);
     $counter = 1;
   }
   $user->firstname = $google_user->user['given_name'];
   $user->lastname = $google_user->name;
   $user->email = $google_user->email;
   $user->google_id = $google_user->id;
   $user->is_social = '1';
   $user->verifiy_email = '1';
   $user->social_avatar = $google_user->avatar;
   $user->country_code = "+".Session::get('country_phonecode');

   if (isset($counter) && $counter == 1) {
     $this->social_mail($google_user->name, $google_user->email, $new_password);
     $user->password = Hash::make($new_password);
   }

   $user->save();
   Auth::login($user);
   return redirect()->to('user_dashboard');

 } catch (Exception $e) {
  print_r($e->getMessage());

  //return redirect('auth/google');
}
} 

//Twitter Social
public function redirecttw($provider='twitter')
{
  return Socialite::driver($provider)->redirect();
}

public function callbacktw($provider='twitter')
{

  $getInfo = Socialite::driver($provider)->user();

  $finduser = User::where('twitter_id', $getInfo->id)->orWhere('email', $getInfo->email)->first();

  if (!empty($finduser)) {
    $user = User::find($finduser->user_id);
  }else{
    $user = new User();
    $new_password = substr(uniqid(rand(), true), 8, 8);
    $counter = 1;
  }
  $user->firstname = $getInfo->name;
  $user->lastname = $getInfo->nickname;
  $user->email = $getInfo->email;
  $user->provider = $provider;
  $user->twitter_id = $getInfo->id;
  $user->is_social = '1';
  $user->verifiy_email = '1';
  $user->social_avatar = $getInfo->avatar;
  $user->country_code = "+".Session::get('country_phonecode');
  
  if (isset($counter) && $counter == 1) {
    $this->social_mail($getInfo->name, $getInfo->email, $new_password);
    $user->password = Hash::make($new_password);
  }

  $user->save();
  Auth()->login($user);
  return redirect()->to('user_dashboard');
}

public function social_mail($name, $email, $new_password = ''){

  $data = array('name' => $name, 'email' => $email,'new_password'=>$new_password);

  Mail::send('emails.new_social_user', $data, 
    function($message) use ($name, $email) {
      $message->to($email, $name)
      ->subject('ThankYou for Registration');
      $message->from('noreply@findwala.com','Find Wala');
    });

  $counter = 0;
}

}
