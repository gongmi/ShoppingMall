@extends('master')
@section('title','订单')
@section('content')

    <div class="page bk_content" style="top: 0;">
        <div class="weui-cells">
            <div class="weui_cells_title">产品列表</div>
            @foreach($order_items as $order_item)
                <div class="weui-cell">
                    <div class="weui-cell__hd"><img
                                src="{{$order_item->product->preview}}"
                                alt="" style="width:20px;margin-right:5px;display:block"></div>
                    <div class="weui-cell__bd">
                        <p>{{$order_item->product->name}}</p>
                    </div>
                    <div class="bk_price">￥ {{$order_item->product->price}}</div>
                    <div class="bk_time">X</div>
                    <div class="bk_important">{{$order_item->count}}</div>
                </div>
            @endforeach
        </div>
        </br>
        </br>
        <div class="weui_cells_title">请选择付款方式</div>
        <div class="weui_cells weui_cells_radio">
            <label class="weui_cell weui_check_label" for="x11">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>支付宝</p>
                </div>
                <div class="weui_cell_ft">
                    <input type="radio" class="weui_check" name="pay_type" id="x11" checked="checked">
                    <span class="weui_icon_checked"></span>
                </div>
            </label>

            <label class="weui_cell weui_check_label" for="x12">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>微信</p>
                </div>
                <div class="weui_cell_ft">
                    <input type="radio" class="weui_check" name="pay_type" id="x12">
                    <span class="weui_icon_checked"></span>
                </div>
            </label>
        </div>
        </br>
        </br>

        <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>总金额</p>
            </div>
            <div class="bk_price">￥ {{$total}}</div>
        </div>
    </div>
    <div class="bk_fix_bottom">
        <button class="weui_btn weui_btn_primary" onclick="_order()">付款</button>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
        $('#x12').next().hide();
        $('input:radio[name=pay_type]').click(function () {
            $('input:radio[name=pay_type]').attr('checked', false);
            $(this).attr('checked', true);
            if ($(this).attr('id') == 'x11') {
                $('#x11').next().show();
                $('#x12').next().hide();
                $('.weui_cells_form').eq(0).show();
                $('.weui_cells_form').eq(1).hide();
            } else if ($(this).attr('id') == 'x12') {
                $('#x12').next().show();
                $('#x11').next().hide();
                $('.weui_cells_form').eq(1).show();
                $('.weui_cells_form').eq(0).hide();
            }
        });
    </script>
@endsection