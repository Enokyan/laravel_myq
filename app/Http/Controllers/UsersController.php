<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use App\Userfriendstable;

class UsersController extends BaseController{
    public function index(){
        return view('email');
    }
    public function select(){
    	$auth_id = Auth::id();
	    $product = DB::table('product')->where('id_user', '=', $auth_id)->paginate(3);	   
        return view('user', ['product' => $product]);

    }
    public function delete(Request $request){
    	$element = $request->all();
    	$product_id = $element['product_id'];
    	DB::table('product')->where('id', '=', $product_id)->delete();
    }
	public function update(Request $request){

    	$element = $request->all();
    	$product_id = $element['product_id'];
    	$name = $element['name_product'];
    	$price_product = $element['price_product'];
    	DB::table('product')
            ->where('id', $product_id)
            ->update(['name_product' => $name, 'price' => $price_product ]);
    }
    public  function select_all()
    {

        $product = DB::table('product')->paginate(3);
        return view('product', ['product' => $product]);
    }
    public  function send_chat()
    {
    		
        return view('chat');
    }

//    send friend request
    public function frendrequest(Request $request)
    {        $from_user = Auth::id();
        $to_user=$request->userId;
        $success =Userfriendstable::create([
           'from_user'        => $from_user,
           'to_user'          => $to_user,
            'status'  => 0
        ]);

        if($success){
            return json_encode(array('data'=>1));
        }
    }


    public function getfriendrequests(){
        $userId = Auth::id();
        $friendRequest = DB::table('userfriendstables')
            ->select('userfriendstables.table_id', 'userfriendstables.from_user', 'users.name')
            ->where('to_user', $userId)
            ->where('status', 0)
            ->leftJoin('users', 'users.id', '=', 'userfriendstables.from_user')
            ->get();

        return json_encode(array('count'=>count($friendRequest)));

    }

    public function selectfriendrequests(Request $request){
        $userId = Auth::id();
        $friendRequest = DB::table('userfriendstables')
            ->select('userfriendstables.table_id', 'userfriendstables.from_user', 'users.name')
            ->where('to_user', $userId)
            ->where('status', 0)
            ->leftJoin('users', 'users.id', '=', 'userfriendstables.from_user')
            ->get();

        return json_encode(array('count'=>count($friendRequest),'friends'=>$friendRequest));
    }

    public function addfriend(Request $request){
          $tableid= $request->table_id;

        $addfriend = DB::table('userfriendstables')
            ->where('table_id', $tableid)
            ->update(['status' => 1]);

        if($addfriend){
            return  'success';
        }
    }

    public function deletefriend(Request $request){
        $tableid= $request->table_id;
        $deletefriend = DB::table('userfriendstables')
            ->where('table_id', $tableid)
            ->delete();

        if($deletefriend){
            return  'success';
       }
    }

}
