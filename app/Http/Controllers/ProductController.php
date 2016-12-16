<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use Image;
use Validator;


class ProductController extends BaseController{
	public function create(Request $request){
		$auth_id = Auth::id();
		$product = $request->all();
		//upload file

		//validation
		$v = Validator::make($request->all(), [
		    'name' => 'required|min:3',
		    'price' => 'required|int',
		]);
		$name_product = $product['name'];
		$price = $product['price'];

		if($request->hasFile('upload_file')){
			$file = $request->file('upload_file');
			$filename=time().'.'.$file->getClientOriginalExtension();
			Image::make($file)->resize(300,300)->save( public_path('img/').$filename);
		}
		else{
			$filename = 'defaolt.jpg';
		}
		if ($v->fails())
		{
		    return redirect()->back()->withErrors($v->errors());
		}
		if($name_product!='' && $price!='' && $filename)
			DB::table('product')->insert(
				['name_product' => $name_product, 'price' => $price, 
				'id_user' => $auth_id, 'image_name'=>$filename]
			);
        return redirect('home');
	}
}
