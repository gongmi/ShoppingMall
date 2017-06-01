<?php

namespace App\Http\Controllers\Service;

use App\Entity\CartItem;
use App\Models\M3Result;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add($product_id)
    {
        if (!Session::get('member')) {
            $cart_arr = Cookie::get('cart');
            if ($cart_arr == null)
                $cart_arr[$product_id] = 1;
            else {
                $exist = false;
                foreach ($cart_arr as $k => $v)
                    if ($k == $product_id) {
                        $cart_arr[$k]++;
                        $exist = true;
                        break;
                    }
                if (!$exist)
                    $cart_arr[$product_id] = 1;
            }
            $m3result = new M3Result();
            $m3result->status = 0;
            $m3result->message = "添加成功";
            return Response()->json($m3result)->withCookie('cart', $cart_arr);
        } else {
            $member = Session::get('member');
            $cart_items = CartItem::where('member_id', $member->id)->get();
            $exist = false;
            if ($cart_items)
                foreach ($cart_items as $cart_item) {
                    if ($cart_item->product_id == $product_id) {
                        $cart_item->count = $cart_item->count + 1;
                        $exist = true;
                        break;
                    }
                }
            if (!$exist) {
                $cart_item = new CartItem();
                $cart_item->member_id = $member->id;
                $cart_item->product_id = $product_id;
                $cart_item->count = 1;
            }
            $cart_item->save();
            $m3result = new M3Result();
            $m3result->status = 0;
            $m3result->message = "添加成功";
            return Response()->json($m3result);
        }
    }

    public function delete($ids)
    {
        $id_arr = explode(',', $ids);
        if (!Session::get('member')) {
            $cart_arr = Cookie::get('cart');
            foreach ($id_arr as $id)
                unset($cart_arr[$id]);
            $m3result = new M3Result();
            $m3result->status = 0;
            $m3result->message = "删除成功";
            return Response()->json($m3result)->withCookie('cart', $cart_arr);
        } else {
            $member = Session::get('member');
            foreach ($id_arr as $id)
                CartItem::where(['member_id' => $member->id, 'product_id' => $id])->delete();
        }
        $m3result = new M3Result();
        $m3result->status = 0;
        $m3result->message = "删除成功";
        return Response()->json($m3result);

    }


    public static function count()
    {
        $count = 0;
        if (!Session::get('member')) {
            $cart_arr = Cookie::get('cart');
            if ($cart_arr != null)
                foreach ($cart_arr as $k => $v)
                    $count += $v;
        } else {
            $member = Session::get('member');
            $cart_items = CartItem::where('member_id', $member->id)->get();
            if ($cart_items)
                foreach ($cart_items as $cart_item) {
                    $count += $cart_item->count;
                }
        }
        return $count;
    }

    public static function sync()
    {
        $member = Session::get('member');
        $cart_arr = Cookie::get('cart');
        if ($cart_arr)
            foreach ($cart_arr as $id => $nums) {
                $cart_item = CartItem::where('product_id', $id)->first();
                if (!$cart_item) {
                    $cart_item = new CartItem();
                    $cart_item->member_id = $member->id;
                    $cart_item->product_id = $id;
                    $cart_item->count = $nums;
                    $cart_item->save();
                } else {
                    $cart_item->count = $cart_item->count + $nums;
                    $cart_item->save();
                }
            }


    }
}
