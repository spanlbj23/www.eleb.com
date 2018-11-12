<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TongJiController extends Controller
{
    //最近一周菜品销量统计
    public function order_week()
    {
        //最近一周每日订单量统计
        $shop_id=Auth::user()->shop_id;
        $yy = date('Y');
        $time_start = date('y-m-d,00:00:00', strtotime('-6 day'));
        $time_end = date('y-m-d,23:59:59');
        $sql = "select date(created_at) date,count(*) total from orders where created_at >='{$time_start}' and created_at <='{$time_end} and shop_id={$shop_id}' group by date(created_at)";
        $rows = DB::select($sql);
//        dd($rows);
        //构造一个七天统计格式
        $result = [];
        for ($i = 7; $i >0; $i--) {
            $result[date('m-d', strtotime("-{$i} day"))] = 0;
        }
        foreach ($rows as $row) {
//            dd($row->date);
            $result[substr($row->date, 5, 5)] = $row->total;
        }
//        dd($result);
        return view('shop.order_week', compact('result', 'yy'));
    }


    //统计最近一周菜品销量
    public function menu_week()
    {
        $shop_id=Auth::user()->shop_id;
        $yy=date('Y');
        $time_start=date('y-m-d,00:00:00',strtotime('-6 day'));
        $time_end=date('y-m-d,23:59:59');
        //id唯一 goods_name 不唯一 性能
        $sql="select 
              date(orders.created_at) date,order_details.goods_id,
              sum(order_details.amount) total
              from order_details
              join orders on order_details.order_id = orders.id	
              where orders.created_at>='{$time_start}' and orders.created_at <='{$time_end} and shop_id={$shop_id}'
              group by
              date(orders.created_at),order_details.goods_id";
        $rows=DB::select($sql);
//        dd($rows);
        //构造一个七天统计格式
        $result=[];
        //获取商家的菜品列表
        $menus=Menu::select('id','goods_name')->get();
        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['goods_name']];
        });
//        dd($keyed);
        $keyed2 = $menus->mapWithKeys(function ($item) {
            return [$item['id']];
        });
        $menus=$keyed->all();
//        dd($menus);
//        $week=[];
        for($i=7;$i>0;$i--){
            $week[]=date('Y-m-d',strtotime("-{$i} day"));
        }
//        dd($week);
        foreach($menus as $id=>$goods_name){
            foreach($week as $day){
            $result[$id][$day]=0;
             }
        }
//        dd($rows);
//        dd($result);
        foreach($rows as $row){
            $result[$row->goods_id][$row->date]=$row->total;
        }
//        dd($result);
//        $ths=['菜品名称',];
        $series = [];
        foreach ($result as $id=>$data){
            $serie = [
                'name'=> $menus[$id],
                'type'=>'line',
//                'stack'=> '销量',
                'data'=>array_values($data)
            ];
            $series[] = $serie;
        }
        return view('shop.menu_week',compact('result','yy','menus','week','series'));
    }

    //最近三个月菜订单统计
    public function order_month()
    {
        //最近三个月每日订单量统计
        $shop_id=Auth::user()->id;

        $yy = date('Y');
        $yy = date('Y');
        $time_start = date('Y-m', strtotime('-120 day'));
        $time_end = date('Y-m',strtotime('+30 day'));
        $sql = "select date_format(created_at,'%Y-%m') date,count(*) total from orders where created_at >='{$time_start}' and created_at <='{$time_end}' and shop_id=$shop_id group by date";


        $rows = DB::select($sql);
//        dd($rows);
        //构造一个三个月统计格式
        $result = [];
        for ($i = 2; $i >=0; $i--) {
            $result[date('Y-m', strtotime("-{$i} month"))] = 0;
        }
        foreach ($rows as $row) {
//            dd($row->date);
            $result[substr($row->date, 0, 7)] = $row->total;
        }
//        dd($result);
        return view('shop.order_month', compact('result', 'yy'));
    }

    //统计最近三个月菜品销量
    public function menu_month()
    {
        $shop_id=Auth::user()->id;
        $yy=date('Y');
        $time_start = date('Y-m', strtotime('-120 day'));
        $time_end = date('Y-m',strtotime('+30 day'));
        //id唯一 goods_name 不唯一 性能
        $sql="select
             date_format(orders.created_at,'%Y-%m') date,order_details.goods_id,
              sum(order_details.amount) total
              from order_details
              join orders on order_details.order_id = orders.id
              where orders.created_at>'{$time_start}' and orders.created_at <'{$time_end}' and shop_id=$shop_id
              group by
              date,order_details.goods_id";
        $rows=DB::select($sql);
//        dd($rows);
        //构造一个三个月统计格式
        $result=[];
        //获取商家的菜品列表
        $menus=Menu::select('id','goods_name')->get();
        $keyed = $menus->mapWithKeys(function ($item) {
            return [$item['id'] => $item['goods_name']];
        });
//        dd($keyed);
        $keyed2 = $menus->mapWithKeys(function ($item) {
            return [$item['id']];
        });
        $menus=$keyed->all();
//        dd($menus);
//        $week=[];
        for($i=2;$i>=0;$i--){
            $week[]=date('Y-m',strtotime("-{$i} month"));
        }
//        dd($week);
        foreach($menus as $id=>$goods_name){
            foreach($week as $day){
                $result[$id][$day]=0;
            }
        }
//        dd($rows);
//        dd($result);
        foreach($rows as $row){
            $result[$row->goods_id][$row->date]=$row->total;
        }
//        dd($result);
//        $ths=['菜品名称',];
        $series = [];
        foreach ($result as $id=>$data){
            $serie = [
                'name'=> $menus[$id],
                'type'=>'line',
//                'stack'=> '销量',
                'data'=>array_values($data)
            ];
            $series[] = $serie;
        }
        return view('shop.menu_month',compact('result','yy','menus','week','series'));
    }

}


