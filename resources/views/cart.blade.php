@extends('master')
@section('title','购物车')
@section('content')
    <div class="page bk_content" style="top: 0;">

        <div class="weui-cells weui-cells_checkbox">
            @foreach($cart_items as $cart_item)
                <label class="weui-cell weui-check__label" for="{{$cart_item->product->id}}">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" name="cart_item" id="{{$cart_item->product->id}}"
                               checked="checked"/>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd">
                        <img class="bk_preview" src="{{$cart_item->product->preview}}" class="m3_preview">
                        <div style="position: absolute; left: 200px; right: 0; top:10px;">
                            <p>{{$cart_item->product->name}}</p>
                            <p class="bk_time" style="margin-top: 15px;">数量:
                                <span class="bk_summary">{{$cart_item->count}}</span></p>
                            <p class="bk_time">总计:
                                <span class="bk_price">￥{{$cart_item->product->price * $cart_item->count}}</span>
                            </p>
                        </div>
                    </div>
                </label>
            @endforeach
        </div>

    </div>
    <div class="bk_fix_bottom">

        <div class="bk_half_area">
            <button class="weui_btn weui_btn_warn" onclick="_delete()">删除</button>
        </div>
        <div class="bk_half_area">
            <button class="weui_btn weui_btn_primary" onclick="_order()">结算</button>
        </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
        $('input:checkbox[name=cart_item]').click(function () {
            var check = $(this).attr('checked');
            if (check == 'checked') {
                $(this).attr('checked', false);
                $(this).next().removeClass('weui-icon-checked');
                $(this).next().addClass('weui-icon-unchecked');
            }
            else {
                $(this).attr('checked', 'checked');
                $(this).next().removeClass('weui-icon-unchecked');
                $(this).next().addClass('weui-icon-checked');
            }

        })
        function _delete() {
            delete_arr = [];
            $('input:checkbox[name=cart_item]').each(function () {
                if ($(this).attr('checked') == 'checked')
                    delete_arr.push($(this).attr('id'));
            });
            if (delete_arr.length == 0) {
                $('.bk_toptips').show();
                $('.bk_toptips span').html("请选择删除项");
                setTimeout(function () {
                    $('.bk_toptips').hide();
                }, 2000);
                return;
            }
            console.log(delete_arr);
            $.get('/service/cart/delete/' + delete_arr, function (data) {
                $('.bk_toptips').show();
                $('.bk_toptips span').html(data.message);
                setTimeout(function () {
                    $('.bk_toptips').hide();
                }, 2000);
                if ((data.status) == 0)
                    location.reload();
            }, 'json');

        }

        function _order() {
            order_arr = [];
            $('input:checkbox[name=cart_item]').each(function () {
                if ($(this).attr('checked') == 'checked')
                    order_arr.push($(this).attr('id'));
            });
            if (order_arr.length == 0) {
                $('.bk_toptips').show();
                $('.bk_toptips span').html("请选择结算项");
                setTimeout(function () {
                    $('.bk_toptips').hide();
                }, 2000);
                return;
            }
            location.href = '/order/' + order_arr;
        }

    </script>
@endsection