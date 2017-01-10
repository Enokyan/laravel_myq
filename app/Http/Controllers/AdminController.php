<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {

    private $data = array();

    public function loginForm() {
        if (session()->has('admindata')) {
            return redirect('admin_home');
        }
        return view('admin.login');
    }

    public function checkdata(Request $request) {
        $check = DB::table('admin')
                ->where('email', $request->email)
                ->where('password', $request->password)
                ->first();

        if ($check->logged !== 1) {
            $dd = DB::table('admin')
                    ->where('id', $check->id)
                    ->update(['logged' => 1]);

            session()->put('admindata', $check->id);
            return redirect('admin_home');
        } else {
            return redirect('admin');
        }
    }

    public function adminlogout() {
        if (!(session()->has('admindata'))) {
            return redirect('admin');
        }
        $logout = DB::table('admin')
                ->where('id', session()->get('admindata'))
                ->update(['logged' => 0]);
        if ($logout) {
            session()->forget('admindata');
            return redirect('admin');
        }
    }

    public function home() {
        if (!(session()->has('admindata'))) {
            return redirect('admin');
        }
        return view('admin.home');
    }

    public function users() {
        if (!(session()->has('admindata'))) {
            return redirect('admin');
        }
        $users = DB::table('users')
                ->select('*')
                ->get();
        $this->data['users'] = $users;
        return view('admin.users')->with($this->data);
    }

    public function deleteuser($id) {
        $deleteuser = DB::table('users')
                ->where('id', $id)
                ->delete();
        if ($deleteuser) {
            return redirect('users');
        }
    }

    public function updateuserdata(Request $request) {
        $updateuser = DB::table('users')
                ->where('id', $request->userId)
                ->update(['name' => $request->username]);
        if ($updateuser) {
            return json_encode(array('data' => 1));
        }
    }

    public function viewprofile($id) {
        if (!(session()->has('admindata'))) {
            return redirect('admin');
        }
        $getuser = DB::table('users')
                ->where('id', $id)
                ->first();
        
        $this->data['userdata']=$getuser;
        return view('admin.userprofile')->with($this->data);
    }

}
