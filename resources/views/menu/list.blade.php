@extends('layout.default')

@section('contents')

    <form class="navbar-form navbar-left" action="{{route('menu.index')}}" method="get">
        <div class="form-group">
            <label>按菜品分类显示列表：</label>
            <select name="category_id"  class="form-control">
                <option value="">菜品分类</option>
                @foreach ($Categorys as $Category)
                    <option value="{{$Category->id}}"   @if(old('category_id')==$Category->id)selected="selected"@endif>{{$Category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="text" name='goods_name' class="form-control" placeholder="菜品名称">
            <input type="text" name="price1" class="form-control" placeholder="价格区间"> -
            <input type="text" name="price2" class="form-control" placeholder="价格区间">
        </div>
        <button type="submit" class="btn btn-success">搜索菜品</button>
    </form>
    <table class="table table-bordered table-striped">
        <h1 style="color: #449d44;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  -------菜品列表-------</h1>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>评分</th>
            <th>所属分类</th>
            <th>价格</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>商品图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach ($menu as $men)
            <tr>
                <td>{{ $men->id }}</td>
                <td>{{ $men->goods_name }}</td>
                <td>{{ $men->rating }}</td>
                <td>{{ $men->menucategory->name}}</td>
                <td>{{ $men->goods_price }}</td>
                <td>{{ $men->month_sales }}</td>
                <td>{{ $men->rating_count }}</td>
                <td>@if($men->goods_img)<img src="{{\Illuminate\Support\Facades\Storage::url($men->goods_img)}}" style="width: 50px;">@endif</td>
                <td>@if($men->status==1) 上架 @else 下架 @endif  </td>
                <td><a href="{{route('menu.create')}}" class="btn btn-info">添加</a>
                    <a href="{{ route('menu.edit',[$men]) }}" class="btn btn-warning">修改</a>
                    <form method="post" action="{{ route('menu.destroy',[$men]) }}" style="float: left;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">删除</button>
                    </form>
                {{--</td>--}}
            </tr>
        @endforeach
    </table>
    {{ $menu->links() }}
@endsection