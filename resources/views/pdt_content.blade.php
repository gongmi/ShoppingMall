@extends('master')
@section('title',$product->name)
@section('content')
    <link rel="stylesheet" href="/css/swipe.css">

    <div class="addWrap">
        <div class="swipe" id="mySwipe">
            <div class="swipe-wrap">
                @foreach($pdt_images as $pdt_image)
                    <div>
                        <a href="javascript:;"><img class="img-responsive" src="{{$pdt_image->image_path}}"/></a>
                    </div>
                @endforeach
            </div>
        </div>
        <ul id="position">
            @foreach($pdt_images as $index => $pdt_image)
                <li class={{$index == 0 ? 'cur' : ''}}></li>
            @endforeach
        </ul>
    </div>

    <div class="weui_cells_title">
        <span class="bk_title">{{$product->name}}</span>
        <span class="bk_price" style="float: right;">￥ {{$product->price}}</span>
    </div>

    <div class="weui_cell">
        <p class="bk_summary">{{$product->summary}}</p>
    </div>


    <div class="weui_cells_title">detail</div>
    <div class="weui_cells">
        <div class="weui_cell">
            {!! $pdt_content->content !!}
        </div>
    </div>

@endsection

@section('my-js')
    <script src="/js/swipe.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        var bullets = document.getElementById('position').getElementsByTagName('li');
        Swipe(document.getElementById('mySwipe'), {
            auto: 2000,
            continuous: true,
            disableScroll: false,
            callback: function (pos) {
                var i = bullets.length;
                while (i--) {
                    bullets[i].className = '';
                }
                bullets[pos].className = 'cur';
            }
        });
    </script>

@endsection