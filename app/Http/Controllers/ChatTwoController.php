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


class ChatTwoController extends BaseController
{
    public function index(){
        $auth_id = Auth::id();



//        $friends = DB::table('users')
//            ->join('userfriendstables', 'users.id', '=', 'userfriendstables.to_user')
//            ->where('userfriendstables.status', '1')
//            ->where('from_user','=',$auth_id)->orWhere('to_user', '=', $auth_id)->get();
//        dump($friends);
        $friends = DB::table('users')
            ->leftJoin('userfriendstables', function($join)
            {
                $auth_id = Auth::id();
                $join->on('users.id', '=', 'userfriendstables.to_user')
                    ->where('from_user','=',$auth_id)
                    ->orOn('users.id', '=', 'userfriendstables.from_user')
                    ->Where('to_user','=',$auth_id);
            })

            ->where('userfriendstables.status', '1')
            ->get();


        return view('twochat' , ['friends' => $friends]);
    }
//////////////// selectid users //////////true
    public function users_select(Request $request){
        $search_user=$request->all();
        $search=$search_user['search_users'];
        $auth_id = Auth::id();
        $tests = DB::table('users')->select('*')->where('name', 'LIKE', '%'.$search.'%')->where('id','!=',$auth_id)->get();

        return $tests;

    }
///////////////select sms dlya two chat
    public function select_twochat(Request $request){
        $result=$request->all();
        $user_id_new=$result['friend_id'];
        $auth_id = Auth::id();
        $result_twochat = DB::table('twochat')->select('*')->where(
            [
                ['user_id', '=', $auth_id],
                ['user_id_new', '=', $user_id_new],
            ])->orwhere(
            [
                ['user_id', '=', $user_id_new],
                ['user_id_new', '=', $auth_id],
            ])
            ->get();
        DB::table('twochat')
            ->where('user_id', $user_id_new)->where('notification','0')
            ->update(['notification' => 1 ]);
        return $result_twochat;
    }

////////////chat twwo
    public function store(Request $request){
        $auth_id = Auth::id();
        $msg_all = $request->all();
        $msg = $msg_all['message'];
        $friend_id = $msg_all['friend_id'];
        if($request->hasFile('img')){
            $file = $request->file('img');
            $filename=time().'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(200,200)->save( public_path('img/chattwo/').$filename);
            $img_name=$filename;
        }
        else   $img_name=0;
        DB::table('twochat')->insert(['msg' => $msg, 'img' =>$img_name, 'chack' => '0', 'user_id' =>$auth_id, 'status'=>'0', 'notification'=>'0', 'user_id_new'=>$friend_id]);
        $arr=array('image_name' => $img_name);
        return json_encode($arr);
    }


/////////////// select new sms
    //chat ajax 2 two chat
    public function select_new(Request $request){
        $auth_id = Auth::id();
        $test = DB::table('twochat')->select('*')->where('chack', '=', '0')->first();
        $friend_all = $request->all();
        $friend_id = $friend_all['friend_id'];
        $count = count($test);
        if($count <1 )  return 0;
        else if($count > 0) {
            if ($test->user_id_new == $auth_id && $test->user_id !=  $friend_all) {
                $data = DB::table('twochat')->select('*')->where( 'chack', '=', '0')->first();
                DB::table('twochat')->where('chack', '=', '0')->update(['chack' => '1']);
                $arr =array('msg' => $data->msg, 'image_name' => $data->img, 'friend_id_new' =>$data->user_id );
                return json_encode($arr);
            }
        }
    }


////////////chat ajax 3 count msg i user_name msg
//    public function select_count_name(){
//
//        $auth_id = Auth::id();
//        $users = DB::table('twochat')
//            ->leftJoin('users', 'twochat.user_id', '=', 'users.id')->where('twochat.user_id_new', '=', $auth_id)->where('twochat.status', '=', 0)->where('twochat.notification','=','0')->get();
//        DB::table('twochat')->where('user_id_new', '=', $auth_id)->update(['status' => '1']);
//
//        return json_encode($users);
//    }

    public function select_count_name(){
        $user_id='';
        $auth_id = Auth::id();
        $users = DB::table('twochat')
            ->leftJoin('users', 'twochat.user_id', '=', 'users.id')->where('twochat.user_id_new', '=', $auth_id)->where('twochat.status', '=', 0)->where('twochat.notification','=','0')->first();
        DB::table('twochat')->where('user_id_new', '=', $auth_id)->update(['twochat.status' => '1']);
        if($users!=null)
        $user_id = $users->user_id;

        $count_all = DB::table('twochat')->select('*')->where('user_id_new', '=', $auth_id)->where('user_id','=',$user_id)->where('notification','=','0')->get();
        $count = count($count_all);

        $arr=array(0 => $count, 1=>json_encode($users), 2 => $user_id);
        return $arr;
    }

    public function online_friend(){
        $friends_online = DB::table('users')->select('*')->get();
//        echo 'true';
        return json_encode($friends_online);
    }

    public function logaut_online(){
        $auth_id = Auth::id();
        $update = DB::table('users')->where('id', '=', $auth_id)->update(['online' => 0]);
    }
}
