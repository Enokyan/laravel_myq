<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Mail\Usermail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;





class UsermailController extends BaseController{
	public function index()
	{
		return view('Email');
	}   
	public function sendmail(Request $request){
		Mail::to($request->email)->send(new Usermail($request->content, $request->title));

	}
}

