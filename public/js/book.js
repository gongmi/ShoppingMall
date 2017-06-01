function hideActionSheet(weuiActionsheet, mask) {
    weuiActionsheet.removeClass('weui_actionsheet_toggle');
    mask.removeClass('weui_fade_toggle');
    weuiActionsheet.on('transitionend', function () {
        mask.hide();
    }).on('webkitTransitionEnd', function () {
        mask.hide();
    })
}

function onMenuClick() {
    var mask = $('#mask');
    var weuiActionsheet = $('#weui_actionsheet');
    weuiActionsheet.addClass('weui_actionsheet_toggle');
    mask.show().addClass('weui_fade_toggle').click(function () {
        hideActionSheet(weuiActionsheet, mask);
    });
    $('#actionsheet_cancel').click(function () {
        hideActionSheet(weuiActionsheet, mask);
    });
    weuiActionsheet.unbind('transitionend').unbind('webkitTransitionEnd');
}

function onMenuItemClick(index) {
    var mask = $('#mask');
    var weuiActionsheet = $('#weui_actionsheet');
    hideActionSheet(weuiActionsheet, mask);
    if (index == 1) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html("敬请期待!");
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
    } else if (index == 2) {
        location.href = '/category';
    } else if (index == 3) {
        location.href = '/cart';
    } else if (index == 4) {
        location.href = '/order_list';
    }
}


function verifyPhone(phone, password, confirm, phone_code, code) {
    // 手机号不为空
    if (phone == '') {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('请输入手机号');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    // 手机号格式
    if (phone.length != 11 || phone[0] != '1') {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('手机格式不正确');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    if (password == '' || confirm == '') {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('密码不能为空');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    if (password.length < 6 || confirm.length < 6) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('密码不能少于6位');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    if (password != confirm) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('两次密码不相同!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    if (phone_code == '') {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('手机验证码不能为空!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    if (phone_code.length != 6) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('手机验证码为6位!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }

    if (code == '') {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('验证码不能为空!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    if (code.length != 4) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('验证码为4位!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }

    return true;
}

function verifyEmail(email, password, confirm, code) {
    // 邮箱不为空
    if (email == '') {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('请输入邮箱');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    // 邮箱格式
    if (email.indexOf('@') == -1 || email.indexOf('.') == -1) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('邮箱格式不正确');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    if (password == '' || confirm == '') {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('密码不能为空');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    if (password.length < 6 || confirm.length < 6) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('密码不能少于6位');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    if (password != confirm) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('两次密码不相同!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    if (code == '') {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('验证码不能为空!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    if (code.length != 4) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('验证码为4位!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return false;
    }
    return true;
}
function verifyLogin(username, password, code) {

    if (username.length == 0) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('帐号不能为空');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return;
    }
    if (username.indexOf('@') == -1) { //手机号
        if (username.length != 11 || username[0] != 1) {
            $('.bk_toptips').show();
            $('.bk_toptips span').html('帐号格式不对!');
            setTimeout(function () {
                $('.bk_toptips').hide();
            }, 2000);
            return;
        }
    } else {
        if (username.indexOf('.') == -1) {
            $('.bk_toptips').show();
            $('.bk_toptips span').html('帐号格式不对!');
            setTimeout(function () {
                $('.bk_toptips').hide();
            }, 2000);
            return;
        }
    }
// 密码
    if (password.length == 0) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('密码不能为空!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return;
    }
    if (password.length < 6) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('密码不能少于6位!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return;
    }
// 验证码
    if (code.length == 0) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('验证码不能为空!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return;
    }
    if (code.length < 4) {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('验证码不能少于4位!');
        setTimeout(function () {
            $('.bk_toptips').hide();
        }, 2000);
        return;
    }
}
// 将标题栏和标题保持一致
$('.bk_title_content').html(document.title);
