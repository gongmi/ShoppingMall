<?php

namespace App\Http\Controllers\view;

use  App\Tool\Validate\ValidateCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class MemberController extends Controller

{
    public function login()
    {
        $prev = Input::get('return_url');
        return view('Member.login')->with('return_url', urldecode($prev));
    }

    public function register()
    {
        return view('Member.register');
    }
}
