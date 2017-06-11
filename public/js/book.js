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
    } else if (index == 2) {
        location.href = '/category';
    } else if (index == 3) {
        location.href = '/cart';
    } else if (index == 4) {
        location.href = '/order_list';
    }
}
function showTip(tip) {
    $('.bk_toptips').show();
    $('.bk_toptips span').html(tip);
    setTimeout(function () {
        $('.bk_toptips').hide();
    }, 2000);
}

function verifyPhone(arr) {
    // 手机号不为空
    if (arr[1].value == '') {
        return '请输入手机号';
    }
    if (arr[1].value.length != 11 || arr[1].value[0] != '1') {
        return '手机格式不正确';
    }
    if (arr[3].value == '' || arr[4].value == '') {
        return '密码不能为空';
    }
    if (arr[3].value.length < 6 || arr[4].value.length < 6) {
        return '密码不能少于6位';
    }
    if (arr[3].value != arr[4].value) {
        return '两次密码不相同!';
    }
    if (arr[2].value == '') {
        return '手机验证码不能为空!';
    }
    if (arr[2].value.length != 6) {
        return '手机验证码为6位!';
    }
    if (arr[5].value == '') {
        return '验证码不能为空!';
    }
    if (arr[5].value.length != 4) {
        return '验证码为4位!';
    }
    return true;
}

function verifyEmail(arr) {
    // 邮箱不为空
    if (arr[1].value == '') {
        return '请输入邮箱';
    }
    if (arr[1].value.indexOf('@') == -1 || arr[1].value.indexOf('.') == -1) {
        return '邮箱格式不正确';
    }
    if (arr[2].value == '' || arr[3].value == '') {
        return '密码不能为空';
    }
    if (arr[2].value.length < 6 || arr[3].value.length < 6) {
        return '密码不能少于6位';
    }
    if (arr[2].value != arr[3].value) {
        return '两次密码不相同!';
    }
    if (arr[4].value == '') {
        return '验证码不能为空!';
    }
    if (arr[4].value.length != 4) {
        return '验证码为4位!';
    }
    return true;
}
function verifyLogin(arr) {

    if (arr[1].value.length == 0) {
        return '帐号不能为空';
    }
    if (arr[1].value.indexOf('@') == -1) { //手机号
        if (arr[1].value.length != 11 || arr[1].value[0] != 1) {
            return '帐号格式不对!';
        }
    } else if (arr[1].value.indexOf('.') == -1) {
        return '帐号格式不对!';
    }
    if (arr[2].value.length == 0) {
        return '密码不能为空!';
    }
    if (arr[2].value.length < 6) {
        return '密码不能少于6位!';
    }
    if (arr[3].value.length == 0) {
        return '验证码不能为空!';
    }
    if (arr[3].value.length < 4) {
        return '验证码不能少于4位!';
    }
    return true;
}
// 将标题栏和标题保持一致
$('.bk_title_content').html(document.title);
