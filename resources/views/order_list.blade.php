@extends('master')
@section('title','我的订单')
@section('content')
    <div class="page bk_content" style="top: 0;">
        <br class="weui-cells">
        @foreach($orders as $order)
            <div class="weui_cells_title">
                <span>订单编号：{{$order->order_no}} </span>
                @if($order->status == 1)
                    <span style="float: right;" class="bk_price"> 未支付 </span>
                @else
                    <span style="float: right;" class="bk_important"> 已付款 </span>
                @endif
            </div>

            @foreach($order->order_items as $order_item)
                <div class="weui-cell">
                    <div class="weui-cell__hd"><img
                                src="{{$order_item->product->preview}}"
                                alt="" style="width:20px;margin-right:5px;display:block"></div>
                    <div class="weui-cell__bd">
                        <p class="bk_summary">{{$order_item->product->name}}</p>
                    </div>
                    <div class="bk_summary">￥ {{$order_item->product->price}} X {{$order_item->count}}</div>
                </div>
            @endforeach
            <div class="weui_cells_tips" style="text-align: right;">合计:
                <span class="bk_price">{{$order->total_price}}</span>
            </div>
            </br>
        @endforeach
    </div>
    </div>
@endsection

@section('my-js')
@endsection