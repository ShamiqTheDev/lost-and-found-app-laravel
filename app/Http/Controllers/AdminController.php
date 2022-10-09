<?php
namespace App\Http\Controllers;

use Spatie\GoogleCalendar\Event;
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

class AdminController extends Controller
{

  function login( Request $request ) {

    return view("dashboard.admin_login");
  }

  function login_submit( Request $request ) {

    if ( $request->has("email") && $request->has("password") ) {

      if ( Auth::guard('admin')->attempt(["email" => $request->email, "password" => $request->password ]) ) {
        return redirect()->route("dashboard");
      } else {
        Session::flash("err_msg","Invalid Credentials");
      }
    } else {
      Session::flash("err_msg","Email or password field missing");
    }
    return back();
  }

  function get_users( Request $request ) {

    $users = User::get();
    return view('dashboard.user.getusers',[ 'users' => $users ]);
  }

  function create_user( Request $request ){
    return view('dashboard.user.create_user');
  }

  function create_user_submit(Request $request) {
    $rules = [
      "firstname" => "required|min:4|max:20",
      "lastname" => "required|min:4|max:20",
      "phonenumber" => "required|numeric|min:11|unique:users,phonenumber",
      "email" =>"required|email|unique:users,email",
      "password" => "required|min:6|max:20",
      "confirmpassword" => 'required|min:6|max:20|same:password',
    ];

    $validation = Validator::make($request->all(),$rules);
    if($validation->fails()) {
      return back()->withErrors($validation)->withInput();

    } else {
      $user = new User();
      $user->firstname = $request->firstname;
      $user->lastname = $request->lastname;
      $user->phonenumber = $request->phonenumber;
      $user->status = 'active';
      $user->email = $request->email;
      $user->password = Hash::make($request->password);

      $user->save();

      Session::flash("msg_success","Account created successfully.");
      return back();

    }
  }

  function view_user_detail( $id ){
    $user = User::where('user_id',$id)->first();
    return view('dashboard.user.view_user_detail',[ 'user' => $user ]);

  }

  function edit_user_detail( $id ){
    $user = User::where('user_id',$id)->first();
    return view('dashboard.user.edit_user_detail',[ 'user' => $user ]);

  }

  function update_user_detail( Request $request, $id){

    $validator = Validator::make($request->all(), [
      "firstname" => "required|min:4|max:20",
      "lastname" => "required|min:4|max:20",
      "phonenumber" => "required|numeric|min:11|unique:users,phonenumber,".$id.",user_id",
      "email" =>"required|email|unique:users,email,".$id.",user_id",
    ]);

    if ($validator->fails()) {

      return redirect()->back()
      ->withErrors($validator)
      ->withInput();
    }
    else{
      User::where('user_id',$id)->update(['firstname'=>$request->firstname,'lastname'=>$request->lastname,'phonenumber'=>$request->phonenumber, 'email'=> $request->email]);

      Session::flash("msg_success","Account updated successfully.");
      return back();
    }
  }

  function delete_user_detail($id)
  {
    User::where('user_id',$id)->delete();
    $users = User::all();
    return back()->with(['users'=>$users]);
  }

  function logout() {

   if ( Auth::guard('admin')->check()) {
     Auth::guard('admin')->logout();
     return redirect()->route("admin");
   }
 }
 function dashboard( Request $request ) {

  $today_date  = Date("Y-m-d");

  return view("dashboard.dashboard", [ "today_date" => $today_date]);

}

function get_posts( $id ) {

  if ($id=='active') {
    $posts = Posts::leftJoin('users', 'users.user_id', '=', 'posts.user_id')
    ->where('posts.status', '=', 'active')
    ->get();
  }
  if ($id=='inactive') {
    $posts = Posts::leftJoin('users', 'users.user_id', '=', 'posts.user_id')
    ->where('posts.status', '=', 'inactive')
    ->get();
  }
  if ($id=='pending') {
    $posts = Posts::leftJoin('users', 'users.user_id', '=', 'posts.user_id')
    ->where('posts.status', '=', 'pending')
    ->get();
  }
  if ($id=='rejected') {
    $posts = Posts::leftJoin('users', 'users.user_id', '=', 'posts.user_id')
    ->where('posts.status', '=', 'rejected')
    ->get();
  }
  return view('dashboard.post.get_posts',[ 'posts' => $posts ]); 
}

function view_post_detail( $id ){

  if (Auth::guard('admin')) {

    $post = Posts::where('id', $id)
    ->select("title","description","content",'reward',"images","phonenumber","created_at","display_name","show_number","views","likes","found_date","type",'user_id','status')
    ->first();

    $user = User::where('user_id', $post->user_id)->first();
    if ($post->created_at->diffInHours() <= 24) {
      $date =  "Today";
    }
    else if($post->created_at->diffInHours() <= 48){
      $date =  "Yesterday";
    }
    else{
      $date = $post->created_at;
    }

    return view('dashboard.post.view_post_detail', ['post'=> $post,'user'=>$user,'date'=> $date]);
  }
  else{
    return redirect()->route('index');
  }

}
function get_states($country_id){

  $states = States::select('id', 'name')
  ->where('country_id', $country_id)
  ->orderBy('name')
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

function edit_post_detail( $id ){

 $post = Posts::where('id',$id)->first();
 $user = User::where('user_id', $post->user_id)->first();
 return view('dashboard.post.edit_post_detail',[ 'post' => $post, 'user'=>$user ]);
}

function delete_post_detail($id)
{
  Posts::where('id',$id)->delete();
  $posts = Posts::all();
  return back()->with(['posts'=>$posts]);
}

function update_post_status($id){

  Posts::where('id',$id)->update(['status'=>'active']);
  $post = Posts::join('users', 'users.user_id', '=', 'posts.user_id')
  ->where('posts.id', $id)
  ->first();

  $name = $post->firstname.' '.$post->lastname;
  $email = $post->email;
  $status = $post->status;
  $title = $post->title;

  $body_text = "The status of your post <strong>".$title."</strong> has been changed to <strong>Active</strong>. The post is now visible to other users.";
  $post_link = route('single_post',['id'=>$post->id,'title' => str_replace('+','-',urlencode($post->title)) ]);
  $data = array('name' => $name, 'email' => $email, 'status' => $status, 'title' => $title, 'post_link' => $post_link,'body_text' => $body_text);

  Mail::send('emails.post_approve', $data, 
    function($message) use ($name, $email) {
      $message->to($email, $name)
      ->subject('Post Approved');
      $message->from('noreply@findwala.com','Find Wala');
    });

  Session::flash("msg_success","Post activated successfully.");
  return back();
}

function reject_post_status($id){

  Posts::where('id',$id)->update(['status'=>'rejected']);
  $post = Posts::join('users', 'users.user_id', '=', 'posts.user_id')
  ->where('posts.id', $id)
  ->first();

  $name = $post->firstname.' '.$post->lastname;
  $email = $post->email;
  $status = $post->status;
  $title = $post->title;

  $body_text = "The status of your post <strong>".$title."</strong> has been changed to <strong>Rejected</strong>. The post is not visible to other users.";

  $post_link = route('single_post',['id'=>$post->id,'title' => str_replace('+','-',urlencode($post->title)) ]);
  $data = array('name' => $name, 'email' => $email, 'status' => $status, 'title' => $title, 'post_link' => $post_link,'body_text' => $body_text);

  Mail::send('emails.post_approve', $data, 
    function($message) use ($name, $email) {
      $message->to($email, $name)
      ->subject('Post Rejected');
      $message->from('noreply@findwala.com','Find Wala');
    });

  Session::flash("msg_success","Post Rejected.");
  return back();
}

function update_submit_post(Request $request) {

  $country_id = Session::get('country_id');
  $country_name = Session::get('country_name');

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
       $name1=uniqid().'.'.pathinfo($file1, PATHINFO_EXTENSION);
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
 // $up_images = array_filter($up_images);

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
// $post->status = 'pending';
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

echo json_encode(['status'=> "1", 'msg'=> "The post was successfully updated"]);
}

}


function user_profile( Request $request ) {

  $user = Auth::guard('admin')->user();
  return view("dashboard.user_profile", [ "user" => $user ]);

}

function user_profile_submit(Request $request) {

  $rules = ["email" =>"required|email"];
  $password_update = 0;

  if ( !empty($request->old_password) || !empty($request->new_password) || !empty($request->new_password_confirmation)  ) {
    $password_update = 1;
    $rules = [
      "email" =>"required|email",
      "old_password" => 'required|min:6|max:30',
      "new_password" => 'required|min:6|max:30|confirmed',
      "new_password_confirmation" => 'required|min:6|max:30',
    ];
  }

  $messages = [
    "email.required" => "Email is required",
    "email.email" => "Email must be valid",
    "old_password.required" => "Old password is required",
    "old_password.min" => "Minimum 6 characters required for old password",
    "old_password.max" => "Maximum 30 characters allowed for old password",
    "new_password.required" => "New password is required",
    "new_password.min" => "Minimum 6 characters required for new password",
    "new_password.max" => "Maximum 30 characters allowed for new password",
    "new_password_confirmation.required" => "Confirm password is required",
    "new_password_confirmation.min" => "Minimum 6 characters required for confirm password",
    "new_password_confirmation.max" => "Maximum 30 characters allowed for confirm password",

  ];

  $validation = Validator::make($request->all(),$rules,$messages);
  if($validation->passes()) {
    $login_user = Auth::guard('admin')->user();
    $user = Admin::find($login_user->id);
    $user->email = $request->email;
    $old_password = $request->old_password;
    $real_password = $login_user->password;
    if ( $password_update == '1' ) {
      if (Hash::check($old_password, $real_password))
      {
        $user->password = Hash::make($request->new_password);  

      } else {
        Session::flash("msg_error","The old password is incorrect");
        return back();
      }
    }

    $user->save();
    
    Session::flash("msg_success","The profile setting was updated successfully");
    return back();
  } else {    
    Session::flash("msg_error","The profile setting could not be updated");
    return back()->withErrors($validation);
  }

}

}
