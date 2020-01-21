<?php

namespace KevinSoft\MultiLanguage\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
//use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use KevinSoft\MultiLanguage\MultiLanguage;

class MultiLanguageController extends Controller
{

    public function locale(Request $request) {
        $locale = $request->input('locale');
        $languages = MultiLanguage::config('languages');
        if(array_key_exists($locale, $languages)) {

            return response('ok')->cookie('adm_locale', $locale);
        }
    }

    public function getLogin() {
        $languages = MultiLanguage::config("languages");

        $current = MultiLanguage::config('default');
        if(Cookie::has('adm_locale')) {
            $current = Cookie::get('adm_locale');
        }
        return view("multi-language::login", compact('languages', 'current'));
    }
}
