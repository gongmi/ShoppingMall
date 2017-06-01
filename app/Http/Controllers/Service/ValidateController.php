<?php

namespace App\Http\Controllers\Service;

use App\Entity\Member;
use App\Entity\TempEmail;
use App\Entity\TempPhone;
use App\Models\M3Result;
use  App\Tool\Validate\ValidateCode;
use  App\Tool\SMS\SendTemplateSMS;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class ValidateController extends Controller
{
    public function code()
    {
        $v = new ValidateCode;
        Session::put('code', $v->getCode());
        return $v->doimg();
    }

    public function sms()
    {
        $input = Input::all();
        $phone = $input['phone'];
        $code = '';
        $charset = '1234567890';
        $_len = strlen($charset) - 1;

        for ($i = 0; $i < 6; ++$i) {
            $code .= $charset[mt_rand(0, $_len)];
        }
        $sms = new SendTemplateSMS();
        $res = $sms->sendTemplateSMS($phone, array($code, 10), 1);
        if ($res->status == 0) {
            $tempPhone = TempPhone::where('phone', $phone)->first(); //这里不能用get 只能用first 不然会得到一个集合
            if ($tempPhone == null) {
                $tempPhone = new TempPhone();
                $tempPhone->phone = $phone;
            }
            $tempPhone->code = $code;
            $tempPhone->deadline = date('Y-m-d H-i-s', time() + 10 * 60);  //second
            $tempPhone->save();
        }
        return $res->toJson();
    }

    public function email()
    {
        $input = Input::all();
        $member_id = $input['member_id'];
        $code = $input['code'];
        $tempEmail = TempEmail::where('member_id', $member_id)->first();
        if ($tempEmail == null)
            return "此链接无效";
        if (time() > strtotime($tempEmail->deadline))
            return "此链接已失效";
        if ($tempEmail->code != $code)
            return "此链接无效";
        Member::where('id', $member_id)->update(['active' => 1]);
        return redirect('/login');
    }
}
