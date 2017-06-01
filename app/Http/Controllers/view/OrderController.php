<?php

namespace App\Http\Controllers\view;

use App\Entity\CartItem;
use App\Entity\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function commit($ids)
    {
        $order_items = [];
        $id_arr = explode(',', $ids);
        $member = Session::get('member');
        $total = 0;
        $order_itemss = CartItem::where('member_id', $member->id)->whereIn('product_id', $id_arr)->get();
        foreach ($order_itemss as $order_item) {
            $order_item->product = Product::find($order_item->product_id);
            $total += $order_item->product->price * $order_item->count;
            array_push($order_items, $order_item);
        }
        return view('order')->with('order_items', $order_items)
            ->with('total', $total);
    }
}
