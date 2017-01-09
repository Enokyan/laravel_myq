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
use App\Language;
class ChatTwoController extends BaseController {

    public $language;
    public $data = array();

    public function __construct() {
        $this->middleware('auth');
        $language = new Language();
        $this->language = $language->language;
        $this->data['language'] = $this->language;
    }

    public function index() {
        $auth_id = Auth::id();
        $friends = DB::table('users')
                ->leftJoin('userfriendstables', function($join) {
                    $auth_id = Auth::id();
                    $join->on('users.id', '=', 'userfriendstables.to_user')
                    ->where('from_user', '=', $auth_id)
                    ->orOn('users.id', '=', 'userfriendstables.from_user')
                    ->Where('to_user', '=', $auth_id);
                })
                ->where('userfriendstables.status', '1')
                ->get();
        return view('twochat', ['friends' => $friends])->with($this->data);
    }

//////////////// selectid users //////////true
    public function users_select(Request $request) {
        $search_user = $request->all();
        $search = $search_user['search_users'];
        $auth_id = Auth::id();
        $tests = DB::table('users')->select('*')->where('name', 'LIKE', '%' . $search . '%')->where('id', '!=', $auth_id)->get();

        return $tests;
    }

///////////////select sms dlya two chat
    public function select_twochat(Request $request) {
        $result = $request->all();
        $user_id_new = $result['friend_id'];
        $auth_id = Auth::id();
        $result_twochat = DB::table('twochat')->select('*')
                ->where(
                        [
                            ['user_id', '=', $auth_id],
                            ['user_id_new', '=', $user_id_new],
                            ['delete_msg', '<>', $auth_id ],
                ])->orwhere(
                        [
                            ['user_id', '=', $user_id_new],
                            ['user_id_new', '=', $auth_id],
                            ['delete_msg', '<>', $auth_id ],
                ])
                ->get();
        DB::table('twochat')
                ->where('user_id', $user_id_new)->where('notification', '0')
                ->update(['notification' => 1]);
        return $result_twochat;
    }

////////////chat twwo
    public function store(Request $request) {
        $auth_id = Auth::id();
        $msg_all = $request->all();
        $msg = $msg_all['message'];
        $friend_id = $msg_all['friend_id'];
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(200, 200)->save(public_path('img/chattwo/') . $filename);
            $img_name = $filename;
        } else
            $img_name = 0;
       $insert =  DB::table('twochat')
           ->insertGetId(['msg' => $msg, 'img' => $img_name, 'chack' => '0', 'user_id' => $auth_id, 'status' => '0', 'notification' => '0', 'user_id_new' => $friend_id , 'delete_msg' => 0,'update_msg'=>0]);

        return json_encode(array('image_name' => $img_name,'insertedId'=>$insert));
    }

/////////////// select new sms
    //chat ajax 2 two chat
    public function select_new(Request $request) {
        $auth_id = Auth::id();
        $test = DB::table('twochat')->select('*')->where('chack', '=', '0')->first();
        $friend_all = $request->all();
        $friend_id = $friend_all['friend_id'];
        $count = count($test);
        if ($count < 1)
            return 0;
        else if ($count > 0) {
            if ($test->user_id_new == $auth_id && $test->user_id != $friend_all) {
                $data = DB::table('twochat')->select('*')->where('chack', '=', '0')->first();
                DB::table('twochat')->where('chack', '=', '0')->update(['chack' => '1']);
                $arr = array('msg' => $data->msg, 'image_name' => $data->img, 'friend_id_new' => $data->user_id, 'messageid'=>$data->id);
                return json_encode($arr);
            }
        }
    }


    public function select_count_name() {
        $user_id = '';
        $auth_id = Auth::id();
        $users = DB::table('twochat')
                        ->leftJoin('users', 'twochat.user_id', '=', 'users.id')->where('twochat.user_id_new', '=', $auth_id)->where('twochat.status', '=', 0)->where('twochat.notification', '=', '0')->first();
        DB::table('twochat')->where('user_id_new', '=', $auth_id)->update(['twochat.status' => '1']);
        if ($users != null)
            $user_id = $users->user_id;

        $count_all = DB::table('twochat')->select('*')->where('user_id_new', '=', $auth_id)->where('user_id', '=', $user_id)->where('notification', '=', '0')->get();
        $count = count($count_all);

        $arr = array(0 => $count, 1 => json_encode($users), 2 => $user_id);
        return $arr;
    }

    public function online_friend() {
        $friends_online = DB::table('users')->select('*')->get();
        return json_encode($friends_online);
    }

    public function logaut_online() {
        $auth_id = Auth::id();
        $update = DB::table('users')->where('id', '=', $auth_id)->update(['online' => 0]);
    }
    
    
    public function delete_msg(Request $request){
        $auth_id = Auth::id();
        $request_all = $request->all();
        $chat_id = $request_all['msg_id'];
        $delete_msg = DB::table('twochat')->select('delete_msg')->where('id',$chat_id)->first();
        $delete = $delete_msg->delete_msg;
        if($delete_msg->delete_msg == 0){

            DB::table('twochat')
                ->where('id', $chat_id)
                ->update(['delete_msg' => $auth_id]);
        }
        else{
            DB::table('twochat')->where('id', '=', $chat_id)->delete();
        }
        return 1;
    }


        public function updatemessage(Request $request)
        {
             $messageid = $request->messageid;
             $messagecontent = $request->messagecontent;
           $update =  DB::table('twochat')
                ->where('id', $messageid)
                ->update(['msg' => $messagecontent,'update_msg'=>1]);
           if($update){
               return json_encode(array('data'=>1));
           }
        }


        public function getupdatedmessages(Request $request)
        {
            $auth_id = Auth::id();
            $updatemsg = DB::table('twochat')
                ->select('*')
                ->where('update_msg',1)
                ->get();
            DB::table('twochat')
                ->where('update_msg', 1)
                ->where('user_id','<>',$auth_id)
                ->update(array('update_msg' => 0));
            return json_encode(array('updatemsg'=>$updatemsg));
        }

}
