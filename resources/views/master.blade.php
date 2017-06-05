<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, user-scalable=0, minimal-ui">
    <title> @yield('title')</title>
    <link rel="stylesheet" href="/css/weui.css">
    <link rel="stylesheet" href="/css/weui2.css">
    <link rel="stylesheet" href="/css/book.css">
</head>
<body>

<div class="bk_title_bar">
    <img class="bk_back" src="/images/back.png" onclick="history.go(-1);">
    <p class="bk_title_content"></p>
    <img class="bk_menu" src="/images/menu.png" onclick="onMenuClick();">
</div>

<div class="page">
    @yield('content')
</div>


<!-- tooltips -->
<div class="bk_toptips"><span></span></div>

<!--BEGIN actionSheet-->
<div id="actionSheet_wrap">
    <div class="weui_mask_transition" id="mask"></div>
    <div class="weui_actionsheet" id="weui_actionsheet">
        <div class="weui_actionsheet_menu">
            <div class="weui_actionsheet_cell" onclick="onMenuItemClick(2)">商品类别</div>
            <div class="weui_actionsheet_cell" onclick="onMenuItemClick(3)">购物车</div>
            <div class="weui_actionsheet_cell" onclick="onMenuItemClick(4)">我的订单</div>
        </div>
        <div class="weui_actionsheet_action">
            <div class="weui_actionsheet_cell" id="actionsheet_cancel">取消</div>
        </div>
    </div>
</div>
</body>
<script src="/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="/js/book.js" type="text/javascript"></script>

@yield('my-js')
</html>