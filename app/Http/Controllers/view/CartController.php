<?php

namespace App\Http\Controllers\view;

use App\Entity\CartItem;
use App\Entity\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart_items = [];
        //如果用户没有登陆 则还是存在cookie中
        if (!Session::get('member')) {
            $cart_arr = Cookie::get('cart', '');
            if ($cart_arr != '')
                foreach ($cart_arr as $id => $nums) {
                    $cart_item = new CartItem();
                    $cart_item->count = $nums;
                    $cart_item->product = Product::find($id);
                    array_push($cart_items, $cart_item);
                }
        } else {
            $cart_itemss = CartItem::where('member_id', Session::get('member')->id)->get();
            if ($cart_itemss)
                foreach ($cart_itemss as $cart_item) {
                    $cart_item->product = Product::find($cart_item->product_id);
                    array_push($cart_items, $cart_item);
                }
        }
        return view('cart')->with('cart_items', $cart_items);
    }


}
