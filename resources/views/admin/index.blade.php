@extends('admin.master')

@section('content')
    <header class="Hui-header cl">
        <a class="Hui-logo l" title="MichelleShoppingMall" href="/admin/index">MichelleShoppingMall</a>
        <span class="Hui-subtitle l">后台</span>
        <ul class="Hui-userbar">
            <li>{{$admin->username}}</li>
            <li><a href="/admin/exit">退出</a></li>
            {{--<li id="Hui-msg">--}}
                {{--<a href="#" title="消息">--}}
                    {{--<span class="badge badge-danger">1</span>--}}
                    {{--<i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
        <a class="Hui-nav-toggle Hui-iconfont" aria-hidden="false">&#xe667;</a>
    </header>
    <aside class="Hui-aside">
        <input runat="server" id="divScrollValue" type="hidden" value=""/>
        <div class="menu_dropdown bk_2">
            <dl id="menu-product">
                <dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a _href="/admin/category" data-title="分类管理">分类管理</a></li>
                        <li><a _href="/admin/product" data-title="产品管理">产品管理</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-order">
                <dt><i class="Hui-iconfont">&#xe687;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a _href="/admin/order" data-title="订单列表">订单列表</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-member">
                <dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a _href="/admin/member" data-title="会员列表">会员列表</a></li>
                    </ul>
                </dd>
            </dl>
        </div>
    </aside>
    <div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box">
        <div id="Hui-tabNav" class="Hui-tabNav">
            <div class="Hui-tabNav-wp">
                <ul id="min_title_list" class="acrossTab cl">
                    <li class="active"><span title="我的桌面" data-href="/admin/member">我的桌面</span><em></em></li>
                </ul>
            </div>
            <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S"><i
                            class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next"
                                                                    class="btn radius btn-default size-S"><i
                            class="Hui-iconfont">&#xe6d7;</i></a></div>
        </div>
        <div id="iframe_box" class="Hui-article">
            <div class="show_iframe">
                <div style="display:none" class="loading"></div>
                <iframe scrolling="yes" frameborder="0" src="/"></iframe>
            </div>
        </div>
    </section>
@endsection
