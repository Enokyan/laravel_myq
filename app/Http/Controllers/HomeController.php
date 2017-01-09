<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ValidatesRequests;
use Validator;
use Illuminate\Support\Facades\DB;
use App;
use Auth;
use Files;
use App\Language;

class HomeController extends Controller {

    public $language;
    public $data;

    public function __construct() {
        $this->middleware('auth');
        $language = new Language();
        $this->language = $language->language;
        $thid->data['language'] = $this->language;
        //echo Language::currenturl();
    }

    public function index() {
        $auth_id = Auth::id();
        $user = DB::table('users')->select('*')->where('id', '=', $auth_id)->get();
        $update = DB::table('users')->where('id', '=', $auth_id)->where('online', '!=', 1)->update(['online' => 1]);
        $user_friend = DB::table('users')->select('*')->where('id', '!=', $auth_id)->get();
        $thid->data['myuser'] = $user;
        $thid->data['user_friend'] = $user_friend;
        $thid->data['language'] = $this->language;
        return view('home')->with($thid->data);
    }

    public function error() {
        return redirect('login');
    }

    public function searchUsers(Request $request) {
        $userId = Auth::user()->id;
        $name = $request->user_name;
        if (!empty($name)) {
            $users = DB::select(
                            'SELECT `users`.`id`,`users`.`name`,`userfriendstables`.`from_user`,`userfriendstables`.`to_user`,`userfriendstables`.`status`,`userfriendstables`.`table_id`
                                FROM `users`
                                LEFT JOIN `userfriendstables` ON (`users`.`id`=`userfriendstables`.`from_user` AND (`userfriendstables`.`to_user` = "' . $userId . '" OR `userfriendstables`.`to_user` ="NULL")) OR (`users`.`id`=`userfriendstables`.`to_user` AND (`userfriendstables`.`from_user` = "' . $userId . '" OR `userfriendstables`.`from_user` = "NULL"))
                                WHERE `users`.`ID` <> "' . $userId . '"
                                AND  `users`.`name` LIKE "' . $name . '%" ESCAPE "!"'
            );

            return json_encode(array('users' => $users, 'currentuser' => $userId));
        }
    }

    public function update_user(Request $request) {
        $auth_id = Auth::id();
        $update = $request->all();
        $v = Validator::make($request->all(), [
                    'update_name' => 'required|min:3',
                    'update_mail' => 'email',
        ]);
        if ($v) {
            echo $v->errors();
        }
        $update_pass = Auth::user()->password;
        $update = $request->all();
        $update_name = $update['update_name'];
        $update_mail = $update['update_mail'];
        if ($update['update_pass']) {
            $update_pass = bcrypt($update['update_pass']);
        }
        $data_user = $update['data_user'];


        DB::table('users')
                ->where('id', '=', $auth_id)
                ->update(['name' => $update_name, 'password' => $update_pass, 'date' => $data_user, 'email' => $update_mail]);
    }

}
