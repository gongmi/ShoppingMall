@extends('master')
@section('title','Michelle 商城')
@section('content')
    <div class="weui_cells_title">选择商品类别</div>
    <div class="weui_cells weui_cells_split">
        <div class="weui_cell weui_cell_select">
            <div class="weui_cell_bd weui_cell_primary">
                <select class="weui_select" name="category" onchange="getCategory()">
                    @foreach($categories as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="weui_cells weui_cells_access">
    </div>
@endsection

@section('my-js')
    <script>
        getCategory();
        function getCategory() {
            var category_id = $(':selected').val();
            console.log("category_id:" + category_id);
            $.get('/service/category/parent_id/' + category_id, function (data) {
                console.log("获取此类别的子类别");
                console.log(data);
                $('.weui_cells_access').html("");
                for (var i = 0; i < data.length; i++) {
                    var node =
                        '<a class="weui_cell" href="' + '/category/show/' + data[i].id + '">' +
                        '<div class="weui_cell_hd"><img class="bk_preview" src=' + data[i].preview + '></div>' +
                        '<div class="weui_cell_bd weui_cell_primary">' +
                        '<p>' + data[i].name + '</p></div>' +
                        '<div class="weui_cell_ft"></div></a>';
                    $('.weui_cells_access').append(node);
                }
            });
        }

    </script>
@endsection