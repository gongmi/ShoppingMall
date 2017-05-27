<?php

namespace App\Http\Controllers\Service;

use App\Entity\Member;
use App\Entity\TempEmail;
use App\Entity\TempPhone;
use App\Models\M3Email;
use App\Models\M3Result;
use App\Http\Controllers\Controller;
use App\Tool\UUID;
use App\Tool\Validate\MyValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    public function register(Request $request)
    {
        $m3result = new M3Result();
        $email = $request->input('email', '');
        $phone = $request->input('phone', '');
        $password = $request->input('password', '');
        $confirm = $request->input('confirm', '');
        $phone_code = $request->input('phone_code', '');
        $code = $request->input('code', '');

//        基本校验
        $v = MyValidate::basic($m3result, $email, $phone, $password, $confirm, $code);
        if ($v != null)
            return $v;

//        手机
        if ($email == '') {
            $v = MyValidate:: phone($m3result, $phone_code, $phone);
            if ($v != null)
                return $v;
            $member = new Member();
            $member->phone = $phone;
            $member->email = "";
            $member->password = md5('bk' + $password);
            $member->save();
            $m3result->status = 0;
            $m3result->message = "注册成功";
            return $m3result->toJson();
        } else {

//            邮箱
            $member = Member::where('email', $email)->first();
            if ($member != null) {
                if ($member->active == 1) {
                    $m3result->status = 1;
                    $m3result->message = "此邮箱已注册";
                    return $m3result->toJson();
                } else
                    $member->delete();
            }
            $member = new Member();
            $member->email = $email;
            $member->phone = "";
            $member->password = md5('bk' + $password);
            $member->save();
            $uuid = UUID::create();
            $m3mail = new M3Email();
            $m3mail->to = $email;
            $m3mail->subject = 'ShoppingMall验证电子邮件地址';
            $m3mail->content = 'http://shoppingmall.com/service/validate/email'
                . '?member_id=' . $member->id
                . '&code=' . $uuid;
            Mail::send('email_register', ['m3_email' => $m3mail], function ($m) use ($m3mail) {
                $m->to($m3mail->to, 'test')
                    ->subject($m3mail->subject);
            });
            $tempEmail = new TempEmail();
            $tempEmail->member_id = $member->id;
            $tempEmail->code = $uuid;
            $tempEmail->deadline = date('Y-m-d H-i-s', time() + 24 * 60 * 60);
            $tempEmail->save();

            $m3result->status = 0;
            $m3result->message = "注册成功!请于24小时内前往此邮箱地址激活账号";
            return $m3result->toJson();
        }

    }

    public function login(Request $request)
    {
        $m3result = new M3Result();
        $username = $request->input('username', '');
        $password = $request->input('password', '');
        $code = $request->input('code', '');
        $v = MyValidate:: login($m3result, $username, $password, $code);
        if ($v instanceof Member) {
           Session::put('member', $v);
            $m3result->status = 0;
            $m3result->message = '登录成功';
            return $m3result->toJson();
        } else
            return $v;
    }
}
