<?php

namespace App\Http\Controllers\view;

use  App\Tool\Validate\ValidateCode;
use App\Http\Controllers\Controller;

class MemberController extends Controller

{
    public function login()
    {
        return view('Member.login');
    }

    public function register()
    {
        return view('Member.register');
    }
}
