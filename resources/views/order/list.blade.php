@extends('layout.default')

@section('contents')

    {{--<form class="navbar-form navbar-left" action="{{route('menu.index')}}" method="get">--}}
        {{--<div class="form-group">--}}
            {{--<label>d：</label>--}}
            {{--<select name="category_id"  class="form-control">--}}
                {{--<option value="">菜品分类</option>--}}
                {{--@foreach ($Categorys as $Category)--}}
                    {{--<option value="{{$Category->id}}"   @if(old('category_id')==$Category->id)selected="selected"@endif>{{$Category->name}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<input type="text" name='goods_name' class="form-control" placeholder="菜品名称">--}}
            {{--<input type="text" name="price1" class="form-control" placeholder="价格区间"> ---}}
            {{--<input type="text" name="price2" class="form-control" placeholder="价格区间">--}}
        {{--</div>--}}
        {{--<button type="submit" class="btn btn-success">搜索菜品</button>--}}
    {{--</form>--}}
    <table class="table table-bordered table-striped">
        <h1 style="color: #449d44;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  -------订单列表-------</h1>
        <tr>
            <th>ID</th>
            <th>收货人</th>
            <th>订单编号</th>
            <th>状态</th>
            <th>下单时间</th>
            <th>操作</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->sn }}</td>
                <td>@if($order->status==1) 待发货 @elseif($order->status==2) 待收货 @elseif($order->status==3) 完成 @elseif($order->status==-1)已取消 @elseif($order->status==0) 待支付 @endif  </td>
                <td>{{ $order->created_at }}</td>

                <td><a href="{{route('order.show',[$order])}}" class="btn btn-info">订单详情</a>
                    <form method="post" action="{{ route('order.destroy',[$order]) }}" style="float: left;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">取消订单</button>
                    </form>
                    <a href="{{ route('order.edit',[$order]) }}" class="btn btn-warning">发货</a>
                {{--</td>--}}
            </tr>
        @endforeach
    </table>
    {{ $orders->links() }}
@endsection