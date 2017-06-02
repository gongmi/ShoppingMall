<?php

namespace App\Http\Controllers\view;

use App\Entity\CartItem;
use App\Entity\Order;
use App\Entity\OrderItem;
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
        $order = new Order();
        $order->save(); //save后 就会有id
        $cart_items = CartItem::where('member_id', $member->id)->whereIn('product_id', $id_arr)->get();
        foreach ($cart_items as $cart_item) {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->product_id = $cart_item->product_id;
            $order_item->pdt_snapshot = json_encode(Product::find($order_item->product_id));
            $order_item->count = $cart_item->count;
            $order_item->save();
            $order_item->product = json_decode($order_item->pdt_snapshot);
            $total += $order_item->product->price * $order_item->count;
            array_push($order_items, $order_item);
            $cart_item->delete();
        }
        $order->member_id = $member->id;
        $order->order_no = 'E' . time() . $order->id;
        $order->total_price = $total;
        $order->save();
        return view('order')->with('order_items', $order_items)
            ->with('order', $order);
    }

    public function index($order_id = null)
    {
        $member = Session::get('member');
        $orders = Order::where('member_id', $member->id)->get();
        foreach ($orders as $order) {
            if ($order->id == $order_id) {
                $order->status = 2;
                $order->save();
            }
            $order_items = OrderItem::where('order_id', $order->id)->get();
            foreach ($order_items as $order_item)
                $order_item->product = json_decode($order_item->pdt_snapshot);
            $order->order_items = $order_items;
        }
        return view('order_list')->with('orders', $orders);
    }
}
