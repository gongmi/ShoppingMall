<?php

namespace App\Tool\Validate;

use App\Entity\Member;
use App\Entity\TempPhone;
use Illuminate\Support\Facades\Session;

//我的输入校验类
class MyValidate
{
    public static function basic($m3result, $email, $phone, $password, $confirm, $code)
    {
        if ($email == '' && $phone == '') {
            $m3result->status = 1;
            $m3result->message = '手机号或邮箱不能为空';
            return $m3result->toJson();
        }
        if ($password == '' || strlen($password) < 6) {
            $m3result->status = 2;
            $m3result->message = '密码不少于6位';
            return $m3result->toJson();
        }
        if ($confirm == '' || strlen($confirm) < 6) {
            $m3result->status = 3;
            $m3result->message = '确认密码不少于6位';
            return $m3result->toJson();
        }
        if ($password != $confirm) {
            $m3result->status = 4;
            $m3result->message = '两次密码不相同';
            return $m3result->toJson();
        }

        if (strtolower($code) != Session::get('code')) {
            $m3result->status = 1;
            $m3result->message = "验证码不正确";
            return $m3result->toJson();
        }
        return null;
    }

    public static function phone($m3result, $phone_code, $phone)
    {
        if ($phone_code == '' || strlen($phone_code) != 6) {
            $m3result->status = 5;
            $m3result->message = '手机验证码为6位';
            return $m3result->toJson();
        }
        $tempPhone = TempPhone::where('phone', $phone)->first();
        if (time() > strtotime($tempPhone->deadline)) {
            $m3result->status = 1;
            $m3result->message = "手机验证码已过期";
            return $m3result->toJson();
        }
        if ($phone_code != $tempPhone->code) {
            $m3result->status = 1;
            $m3result->message = "短信验证码错误";
            return $m3result->toJson();
        }
        $member = Member::where('phone', $phone)->first();
        if ($member != null) {
            $m3result->status = 1;
            $m3result->message = "此手机号已注册";
            return $m3result->toJson();
        }
    }

    public static function login($m3result, $username, $password, $code)
    {
        if ($username == '') {
            $m3result->status = 1;
            $m3result->message = '手机号或邮箱不能为空';
            return $m3result->toJson();
        }
        if ($password == '' || strlen($password) < 6) {
            $m3result->status = 2;
            $m3result->message = '密码不少于6位';
            return $m3result->toJson();
        }

        if (strtolower($code) != Session::get('code')) {
            $m3result->status = 1;
            $m3result->message = "验证码不正确";
            return $m3result->toJson();
        }

        $member = null;
        if (strpos($username, '@') == true) {
            $member = Member::where('email', $username)->first();
        } else {
            $member = Member::where('phone', $username)->first();
        }

        if ($member == null) {
            $m3result->status = 2;
            $m3result->message = '该用户不存在';
            return $m3result->toJson();
        } else if (md5('bk' + $password) != $member->password) {
            $m3result->status = 3;
            $m3result->message = '密码不正确';
            return $m3result->toJson();
        } else
            return $member;
    }
}
