<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;

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
}
