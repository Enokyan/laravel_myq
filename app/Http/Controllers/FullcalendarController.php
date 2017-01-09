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
use App\Language;

class FullcalendarController extends BaseController {

    public $language;
    public $data = array();

    public function __construct() {
        $this->middleware('auth');
        $language = new Language();
        $this->language = $language->language;
        $this->data['language'] = $this->language;
    }

    public function showcalendar() {
         return view('calendar/calendar')->with($this->data);
    }
    
    public function index() {
        $data = DB::table('users')->select('name', 'date')->where('date', '!=', 'null')->get();
        return json_encode($data);
    }

}
