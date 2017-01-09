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

class ChatController extends BaseController {

    public $language;
    public $data = array();

    public function __construct() {
        $this->middleware('auth');
        $language = new Language();
        $this->language = $language->language;
        $this->data['language'] = $this->language;
    }

    public function index() {
        $tests = DB::table('chat')->select('*')->get();
        $this->data['result'] = $tests;
        return view('chat')->with($this->data);
    }

    public function store(Request $request) {
        $auth_name = Auth::user()->name;
        $auth_id = Auth::id();
        $msg_all = $request->all();
        $msg = $msg_all['message'];
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(200, 200)->save(public_path('img/chat/') . $filename);
            $img_name = $filename;
        } else
            $img_name = 0;
        DB::table('chat')->insert(['msg' => $msg, 'img' => $img_name, 'chack' => '0', 'user_id' => $auth_id, 'user_name' => $auth_name]);
        $arr = array('image_name' => $img_name, 'auth_name' => $auth_name);
        return json_encode($arr);
    }

    public function ajax() {
        $auth_id = Auth::id();
        $auth_name = Auth::user()->name;
        $test = DB::table('chat')->select('*')->where('chack', '=', '0')->first();
        $count = count($test);
        if ($count < 1)
            return 0;
        else if ($count > 0) {
            if ($test->user_id != $auth_id) {
                $data = DB::table('chat')->select('*')->where('chack', '=', '0')->first();
                DB::table('chat')->where([['chack', '=', '0'], ['user_id', '!=', $auth_id],])->update(['chack' => '1']);
                $arr = array('msg' => $data->msg, 'auth_name' => $data->user_name, 'image_name' => $data->img);
                return json_encode($arr);
            }
        }
    }

    public function ajax3() {
        $auth_id = Auth::id();
        $users = DB::table('twochat')
                        ->leftJoin('users', 'twochat.user_id', '=', 'users.id')->where('twochat.user_id_new', '=', $auth_id)->where('twochat.status', '=', 0)->where('twochat.notification', '=', '0')->get();
        DB::table('twochat')->where('user_id_new', '=', $auth_id)->update(['status' => '1']);

        return json_encode($users);
    }

}
