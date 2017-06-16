@extends('master')
@section('title','注册')
@section('content')
    <div class="weui_cells weui_cells_radio">
        <label class="weui_cell weui_check_label" for="x11">
            <div class="weui_cell_bd weui_cell_primary">
                <p>手机号注册</p>
            </div>
            <div class="weui_cell_ft">
                <input type="radio" class="weui_check" name="register_type" id="x11" checked="checked">
                <span class="weui_icon_checked"></span>
            </div>
        </label>

        <label class="weui_cell weui_check_label" for="x12">
            <div class="weui_cell_bd weui_cell_primary">
                <p>邮箱注册</p>
            </div>
            <div class="weui_cell_ft">
                <input type="radio" class="weui_check" name="register_type" id="x12">
                <span class="weui_icon_checked" style="display:none;"></span>
            </div>
        </label>
    </div>

    <form id="form1" class="weui_cells weui_cells_form">
        {!! csrf_field() !!}
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="tel" placeholder="请输入手机号码" name="phone"/>
            </div>
            <p class="bk_important" id="send_code">发送验证码</p>
            <div class="weui_cell_ft">
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">短信验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" placeholder="6位短信验证码" name="phone_code"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='password'/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">确认密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='confirm'/>
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

    <form id="form2" class="weui_cells weui_cells_form" style="display:none;">
        {!! csrf_field() !!}
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">邮箱</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="email" placeholder="请输入邮箱地址" name="email"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='password'/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">确认密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='confirm'/>
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
        <a class="weui_btn weui_btn_primary" href="javascript:" onclick="onRegisterClick();">注册</a>
    </div>
    <a href="/login" class="bk_bottom_tips bk_important">已有帐号? 去登录</a>
@endsection

@section('my-js')
    <script type="text/javascript">
        $('#x11').click(function () {
            $('#x11').attr('checked', true).next().show();
            $('#x12').attr('checked', false).next().hide();
            $('#form1').slideDown();
            $('#form2').hide(100);
        });

        $('#x12').click(function () {
            $('#x12').attr('checked', true).next().show();
            $('#x11').attr('checked', false).next().hide();
            $('#form2').slideDown();
            $('#form1').hide(100);
        });
        var enable = true;
        $('#send_code').click(function () {
            if (!enable)
                return;
            enable = false;
            var num = 10;
            var interval = window.setInterval(function () {
                if (num == 1) {
                    enable = true;
                    window.clearInterval(interval);
                    $('#send_code').html('重新发送验证码').attr('class', 'bk_important');
                }
                else {
                    if (num == 10) {
                        $('#send_code').attr('class', 'bk_summary');
                    }
                    $('#send_code').html(--num + 's 后可重新发送')
                }
            }, 1000);
            var phone = $('input[name=phone]').val();
            $.post('{{url('/service/validate/sms')}}', {
                '_token': '{{csrf_token()}}',
                'phone': phone,
            }, function (data) {
                showTip(data.message);
            }, 'Json');

        });
    </script>

    <script type="text/javascript">
        function onRegisterClick() {
            var inputs;
            var verity_res;
            if ($('#x11').attr('checked') == 'checked') {
                inputs = $("#form1 input").serializeArray();
                verity_res = verifyPhone(inputs);
            } else {
                inputs = $("#form2 input").serializeArray();
                verity_res = verifyEmail(inputs);
            }
            if (verity_res != true) {
                showTip(verity_res);
                return;
            }
            $.post('{{url('service/register')}}', inputs, function (data) {
                showTip(data.message);
//                if ((data.status) == 0)
//                    location.href = '/login';
            }, 'Json');
        }
    </script>
@endsection