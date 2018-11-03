<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //订单列表
    public function index(){
        $orders=Order::where([['status',0],['shop_id',Auth::user()->id]])->paginate(3);
//        dd($orders);
        return view('order/list',compact('orders'));
    }
    //日订单列表
    public function indexd(){
        $pp=date('y-m-d',time()+8*3600);
        //日订单数
//        $orderss=select count(*) from orders where shop_id=Auth::user()->id and DATE('created_at')==$pp;
//        日订单数据
//         $orders=select * from orders where shop_id=Auth::user()->id and DATE('created_at')==$pp;
        $orders=Order::where([['shop_id',Auth::user()->id],[date('y-m-d',time('created_at')+3600*8),$pp]])->paginate(3);
        return view('order/list',compact('orders'));
    }
    //月订单列表
    public function indexm(){
//        dd(date('m',time()));
        $pp=date('m',time());
        //月订单数据
        $orders= $orders=Order::where([['shop_id',Auth::user()->id],[date('m',time('created_at')+3600*8),$pp]])->paginate(3);
        return view('order/list',compact('orders'));
    }
    //产看订单
    public function  show(Order $order)
    {
        return view('order.show',compact('order'));
    }
    public function store(){
        $orders=Order::paginate(8);
//        dd($orders);
        return view('order/list',compact('orders'));
    }
    //取消订单
    public function destroy(Order $order){
        $order->update([
            'status'=>-1
        ]);
        return back()->with('danger','订单已取消');
    }
    //发货
    public function  edit(Order $order){
        $order->update([
            'status'=>2
        ]);
        return back()->with('success','订单已经发货');
    }


}
