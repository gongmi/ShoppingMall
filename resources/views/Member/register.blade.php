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
                <span class="weui_icon_checked"></span>
            </div>
        </label>
    </div>

    <div class="weui_cells weui_cells_form">
        {!! csrf_field() !!}
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="tel" placeholder="请输入手机号码" name="phone"/>
            </div>
            <p class=" bk_important bk_phone_code_send">发送验证码</p>
            <div class="weui_cell_ft">
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">短信验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="tel" placeholder="6位短信验证码" name="phone_code"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_phone'/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">确认密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_phone_cfm'/>
            </div>
        </div>

        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="请输入验证码" name="p_code"/>
            </div>
            <div class="weui_cell_ft">
                <img src="service/validate/code" onclick="this.src='service/validate/code?'+Math.random()"/>
            </div>
        </div>
    </div>

    <div class="weui_cells weui_cells_form" style="display:none;">
        {!! csrf_field() !!}
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">邮箱</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="请输入邮箱地址" name="email"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_email'/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">确认密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_email_cfm'/>
            </div>
        </div>
        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="请输入验证码" name="e_code"/>
            </div>
            <div class="weui_cell_ft">
                <img src="service/validate/code" onclick="this.src='service/validate/code?'+Math.random()"/>
            </div>
        </div>
    </div>
    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" onclick="onRegisterClick();">注册</a>
    </div>
    <a href="/login" class="bk_bottom_tips bk_important">已有帐号? 去登录</a>
@endsection

@section('my-js')
    <script type="text/javascript">
        $('#x12').next().hide();
        $('input:radio[name=register_type]').click(function () {
            $('input:radio[name=register_type]').attr('checked', false);
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
        var enable = true;
        $('.bk_phone_code_send').click(function () {
            if (enable == false)
                return;
            enable = false;
            var num = 10;
            var interval = window.setInterval(function () {
                if (num == 0) {
                    enable = true;
                    window.clearInterval(interval);
                    $('.bk_phone_code_send').html('重新发送验证码');
                    $('.bk_phone_code_send').removeClass('bk_summary');
                    $('.bk_phone_code_send').addClass('bk_important');
                }
                else {
                    if (num == 10) {
                        $('.bk_phone_code_send').removeClass('bk_important');
                        $('.bk_phone_code_send').addClass('bk_summary');
                    }
                    $('.bk_phone_code_send').html(--num + 's 重新发送')

                }
            }, 1000);
            var phone = $('input[name=phone]').val();
            $.post('{{url('/service/validate/sms')}}', {
                '_token': '{{csrf_token()}}',
                'phone': phone,
            }, function (data) {
                var datas = $.parseJSON(data);
                if ((datas.status) == 0) {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('发送成功');
                    setTimeout(function () {
                        $('.bk_toptips').hide();
                    }, 2000);
                }
                else {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html(datas.message[0]);
                    setTimeout(function () {
                        $('.bk_toptips').hide();
                    }, 2000);
                }
            });
        });
    </script>

    <script type="text/javascript">
        function onRegisterClick() {
            $('input:radio[name=register_type]').each(function (index, el) {
                if ($(this).attr('checked') == 'checked') {
                    var email = '';
                    var phone = '';
                    var password = '';
                    var confirm = '';
                    var phone_code = '';
                    var code = '';

                    var id = $(this).attr('id');
                    if (id == 'x11') {
                        phone = $('input[name=phone]').val();
                        password = $('input[name=passwd_phone]').val();
                        confirm = $('input[name=passwd_phone_cfm]').val();
                        phone_code = $('input[name=phone_code]').val();
                        code = $('input[name=p_code]').val();
                        if (verifyPhone(phone, password, confirm, phone_code, code) == false) {
                            return;
                        }
                    } else if (id == 'x12') {
                        email = $('input[name=email]').val();
                        password = $('input[name=passwd_email]').val();
                        confirm = $('input[name=passwd_email_cfm]').val();
                        code = $('input[name=e_code]').val();
                        if (verifyEmail(email, password, confirm, code) == false) {
                            return;
                        }
                    }
                    $.post('{{url('service/register')}}', {
                        '_token': '{{csrf_token()}}',
                        'phone': phone,
                        'email': email,
                        'password': password,
                        'confirm': confirm,
                        'phone_code': phone_code,
                        'code': code,
                    }, function (data) {
                        var datas = $.parseJSON(data);
                        $('.bk_toptips').show();
                        $('.bk_toptips span').html(datas.message);
                        setTimeout(function () {
                            $('.bk_toptips').hide();
                        }, 2000);
                        if ((data.status) == 0)
                            location.href = '/category';
                    });
                }
            });
        }
    </script>
@endsection