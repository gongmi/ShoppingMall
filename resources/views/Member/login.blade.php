@extends('master')
@section('title','登录')
@section('content')
    <form class="weui_cells weui_cells_form">
        {!! csrf_field() !!}
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">账号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="请输入手机号码或邮箱" name="username"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name="password"/>
            </div>
        </div>
        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="请输入验证码" name="code"/>
            </div>
            <div class="weui_cell_ft">
                <img src="service/validate/code" onclick="this.src='service/validate/code?'+Math.random()"/>
            </div>
        </div>
    </form>
    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" onclick="onLoginClick();">确定</a>
    </div>
    <a href="/register" class="bk_bottom_tips bk_important">没有帐号? 去注册</a>
@endsection

@section('my-js')
    <script type="text/javascript">
        function onLoginClick() {
            var inputs = $("form input").serializeArray();
//            console.log(inputs);
            var verity_res = verifyLogin(inputs);
            if (verity_res != true) {
                showTip(verity_res);
                return;
            }
            $.post('{{url('service/login')}}', inputs, function (data) {
                showTip(data.message);
                if ((data.status) == 0)
                    location.href = '/category';
            }, 'json');
        }
    </script>
@endsection