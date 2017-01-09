<?php

namespace App;

use Illuminate\Http\Request;
use App;

class Language {

    public $language = '';

    public function __construct() {
        $language = request()->segment(1);
        $this->language = $language;
        App::setLocale($language);
        return $this->language;
    }

    static function currenturl() {
        $geturl=Request::segment(1);
        return (substr($geturl, 2));
    }

}
