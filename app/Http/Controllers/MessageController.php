<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\Messages;
use App\User;
use App\Posts;

class MessageController extends Controller
{

	function send_message(Request $request) {
		if ($request->has('message') && !empty($request->post_id) && !empty($request->message)) {
			if($request->has('receiver_id')) {
				$receiver_id = $request->receiver_id;
			} else {
				$post = Posts::where('id', $request->post_id)->first();
				$receiver_id = $post->user_id;
			}
			$msg_data = new Messages;
			$msg_data->sender_id = Auth::id();
			$msg_data->post_id = $request->post_id;
			$msg_data->receiver_id = $receiver_id;
			$msg_data->message = $request->message;
			$msg_data->save();

			$msg = "Message Sent Successfully";
			echo json_encode(['status'=>'1','msg'=>$msg,'msg_data' => $msg_data]);
		}else{
			echo json_encode(['status'=>'0']);
		}
	}

	function message(){

		$user_id = Auth::id();
		
		$users = Messages::leftJoin('posts','posts.id','=','messages.post_id')
		->leftJoin('users as u1','u1.user_id','=','messages.sender_id')
		->leftJoin('users as u2','u2.user_id','=','messages.receiver_id')
		->select(DB::raw('IF(messages.sender_id="'.$user_id.'
			",messages.receiver_id,messages.sender_id) as chat_user_id'),DB::raw('IF(messages.sender_id="'.$user_id.'",u2.firstname,u1.firstname) as chat_user_name'),DB::raw('IF(messages.sender_id="'.$user_id.'",u2.social_avatar,u1.social_avatar) as chat_avatar'),DB::raw('IF(messages.sender_id="'.$user_id.'",u2.image,u1.image) as chat_image'), 'posts.title','posts.images','posts.content','messages.message','messages.created_at','messages.status','messages.post_id', 'messages.id')
		->whereNotNull('u1.user_id')
		->whereNotNull('u2.user_id')

		->whereRaw('u2.user_id != u1.user_id')
		->orderBy('messages.id')
		->where(function($q) use ($user_id) {
			$q->where(function($query) use ($user_id){

				$query->where('messages.sender_id','=',$user_id)
				->orWhere('messages.receiver_id','=',$user_id);
			});
		})

		->groupBy('posts.id','chat_user_id')
		->get();

		// ->DATE_SUB(CURDATE(),INTERVAL 7 DAY);

		return view('lostandfound.messages', ['users'=>$users]);
	}

	function get_user_msgs($user_id,$post_id){
		$current_user_id = Auth::id();

		$user1 = User::where('user_id',$current_user_id)->first()->toArray();
		$user2 = User::where('user_id', $user_id)->first()->toArray();

		$msgs = [];
		$msgs = Messages::where('messages.post_id',$post_id)->where(function($q) use ($user_id,$current_user_id) {
			$q->where(function($query) use ($user_id,$current_user_id){

				$query->where('messages.sender_id','=',$user_id)
				->where('messages.receiver_id','=',$current_user_id);
			})
			->orWhere(function($query) use ($user_id,$current_user_id){

				$query->where('messages.sender_id','=',$current_user_id)
				->where('messages.receiver_id','=',$user_id);
			});
		})

		->get()->toArray();
		$read_msg = (collect($msgs))->pluck('id')->toArray();
		Messages::whereIn('id', $read_msg)->update(['status'=>'1']);

		echo json_encode([ 'status' => '1', 'msgs' => $msgs, 'user1'=>$user1, 'user2'=>$user2 ]);
	}
}
