<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Http\Controllers\Controller;


class ChatController extends BaseController{
    public function index(){
	   $tests = DB::table('chat')->select('msg','user_name')->get();
	    return view('chat',['result' => $tests]);
    }
    public function store(Request $request)
    {
    	$auth_name = Auth::user()->name;
    	$auth_id = Auth::id();
    	$msg_all = $request->all();
    	$msg = $msg_all['msg'];
    	DB::table('chat')->insert(
				['msg' => $msg, 'chack' => '0', 'user_id' => '1', 'user_name'=>$auth_name]
		);
    	$arr = array('msg' => $msg, 'name' => $auth_name );
    	print_r($arr);
    }
    public function ajax()
    {	
    	ini_set('max_execution_time',7200);
    	$test = DB::table('chat')->select('chack')->where('chack', '=', '0')->get();
    	$count = count($test);


    	while($count <1)
    	{
    		usleep(100);
    	}
    	if($count > 0)
    	{
    	$data = DB::table('chat')->select('*')->where('chack', '=', '0')->first();

        $id = $data->id;
        $data = DB::table('chat')->find($id);

		DB::table('chat')->where('chack', '=', '0' )->update(['chack' => '1']); 
        $data_all=array('msg' => $data->msg,'name' => $data->user_name );
        print_r($data_all);
        }
        
    }
}
