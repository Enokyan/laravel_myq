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
use Calendar;
class FullcalendarController extends BaseController
{
    public function index(){
        $data = DB::table('users')->select('name','date')->where('date', '!=', 'null')->get();
        return json_encode($data);
    }
}
