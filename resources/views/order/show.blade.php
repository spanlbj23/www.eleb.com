@extends('layout.default')

@section('contents')
    <div style="margin:0 auto; width: 60%;">
        <h2 class="bg-primary">------订单详情-------</h2>
        @include('layout._errors')
        <form method="post" action="{{route('order.index',[$order])}}" enctype="multipart/form-data">
            <div class="form-group">
                <label>收货人</label>
                <input type="text" name="name" readonly="readonly" class="form-control" value="{{$order->name}}" >
            </div>
            <div class="form-group">
                <label>联系电话</label>
                <input type="text" name="tel" class="form-control" readonly="readonly" value="{{$order->tel}}" >
            </div>
            <div class="form-group">
                <label>收货地址</label>
                <input type="text" name="address" readonly="readonly" class="form-control" value="{{$order->address}}">
            </div>
            <div class="form-group">
                <label>总价</label>
                <input type="text" name="total" readonly="readonly" class="form-control" value="{{$order->total}}">
            </div>
             <div class="form-group">
                <label>订单编号</label>
                <input type="text" name="sn" readonly="readonly" class="form-control" value="{{$order->sn}}">
            </div>
            <div class="form-group">
                <label>下单时间</label>
                <input type="text" name="created_at" readonly="readonly" class="form-control" value="{{$order->created_at}}">
            </div>
            <div class="form-group">
                <label>状态</label>
                @if($order->status==1) 待发货 @elseif($order->status==2) 待确认 @elseif($order->status==3) 完成 @elseif($order->status==-1)已取消 @elseif($order->status==0) 待支付 @endif
            </div>
            {{ csrf_field() }}
            {{--{{method_field('PUT')}}--}}
            <button class="btn btn-primary btn-block">返回</button>
        </form>
    </div>
    @stop
