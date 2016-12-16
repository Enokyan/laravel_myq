<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Image;
use App\Http\Controllers\Controller;


class ChatController extends BaseController{
    public function index(){
	    $tests = DB::table('chat')->select('*')->get();
	    return view('chat',['result' => $tests]);
    }
    public function store(Request $request){
    	$auth_name = Auth::user()->name;
    	$auth_id = Auth::id();
    	$msg_all = $request->all();
    	$msg = $msg_all['message'];
        if($request->hasFile('img')){
            $file = $request->file('img');
            $filename=time().'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(200,200)->save( public_path('img/chat/').$filename);
            $img_name=$filename;
        }
        else   $img_name=0;
    	DB::table('chat')->insert(['msg' => $msg, 'img' =>$img_name, 'chack' => '0', 'user_id' =>$auth_id, 'user_name'=>$auth_name]);
        $arr=array('image_name' => $img_name, 'auth_name' => $auth_name);
    	return json_encode($arr);
    }
////chat twwo
//    public function store2(Request $request){
//        $auth_id = Auth::id();
//        $msg_all = $request->all();
//        $msg = $msg_all['message'];
//        $friend_id = $msg_all['friend_id'];
//        if($request->hasFile('img')){
//            $file = $request->file('img');
//            $filename=time().'.'.$file->getClientOriginalExtension();
//            Image::make($file)->resize(200,200)->save( public_path('img/chattwo/').$filename);
//            $img_name=$filename;
//        }
//        else   $img_name=0;
//        DB::table('twochat')->insert(['msg' => $msg, 'img' =>$img_name, 'chack' => '0', 'user_id' =>$auth_id, 'status'=>'0', 'notification'=>'0', 'user_id_new'=>$friend_id]);
//        $arr=array('image_name' => $img_name);
//        return json_encode($arr);
//    }
// chat ajax obshi chat
    public function ajax(){
        $auth_id = Auth::id();
        $auth_name = Auth::user()->name;
    	$test = DB::table('chat')->select('*')->where('chack', '=', '0')->first();
    	$count = count($test);
    	if($count <1 )  return 0;
    	else if($count > 0) {
            if ($test->user_id != $auth_id) {
                $data = DB::table('chat')->select('*')->where('chack', '=', '0')->first();
                DB::table('chat')->where([['chack', '=', '0'], ['user_id', '!=', $auth_id],])->update(['chack' => '1']);
                $arr =array('msg' => $data->msg, 'auth_name' => $data->user_name, 'image_name' => $data->img);
                return json_encode($arr);
            }
        }
    }
//chat ajax 2 two chat
//    public function ajax2(Request $request){
//        $auth_id = Auth::id();
//        $test = DB::table('twochat')->select('*')->where('chack', '=', '0')->first();
//        $friend_all = $request->all();
//        $friend_id = $friend_all['friend_id'];
//        $count = count($test);
//        if($count <1 )  return 0;
//        else if($count > 0) {
//            if ($test->user_id_new == $auth_id && $test->user_id !=  $friend_all) {
//                $data = DB::table('twochat')->select('*')->where( 'chack', '=', '0')->first();
//                DB::table('twochat')->where('chack', '=', '0')->update(['chack' => '1']);
//                $arr =array('msg' => $data->msg, 'image_name' => $data->img, 'friend_id_new' =>$data->user_id );
//                return json_encode($arr);
//            }
//        }
//    }


//chat ajax 3 count msg i user_name msg
    public function ajax3(){

        $auth_id = Auth::id();
            $users = DB::table('twochat')
                ->leftJoin('users', 'twochat.user_id', '=', 'users.id')->where('twochat.user_id_new', '=', $auth_id)->where('twochat.status', '=', 0)->where('twochat.notification','=','0')->get();
                DB::table('twochat')->where('user_id_new', '=', $auth_id)->update(['status' => '1']);

            return json_encode($users);
    }




// store
}
