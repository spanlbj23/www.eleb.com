<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    //列表
    public function index(MenuCategory $menuategory){

//            public function __construct()
//        {
//            $this->middleware('auth', [
//                'except' => ['index'],
//            ]);
//        }

            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
            }
            if(isset($_GET['goods_name'])){
                $goods_name = $_GET['goods_name'];
            }
            if(isset($_GET['price1'])){
                $price1 = $_GET['price1'];
            }
            if(isset($_GET['price2'])){
                $price2 = $_GET['price2'];
            }
            if(@$goods_name!=''&&@$price1!=''&&@$price2!=''){
                $menu = Menu::where('goods_name','like','%'.$goods_name.'%')->where('goods_price','>=',$price1)->where('goods_price','<=',$price2)->paginate(2);}
            elseif(@$price1!=''&&@$price2!=''){
                $menu = Menu::where('goods_price','>=',$price1)->where('goods_price','<=',$price2)->get();
            }elseif(@$goods_name!=''){
                $menu = Menu::where('goods_name','like','%'.$goods_name.'%')->paginate(2);
            }elseif(@$category_id!=''){
                $menu = Menu::where('category_id','=',$category_id)->paginate(2);
            }else{
                $menu = Menu::paginate(2);
            }
//            $Categorys = MenuCategory::all();
//            return view('menu.index', compact('menus', 'Categorys'));




        //-----------------------------------
        $Categorys=MenuCategory::all();
//        $menu=Menu::paginate(3);
        return view('menu.list',compact('menu','Categorys'));
    }
    //添加
    public function create(){
        $menucc=MenuCategory::all();
        return view('menu.create',compact('menucc'));
    }
    public function store(Request $request){
        $this->validate($request,[
           'goods_name'=>'required',
//            'goods_img'=>'required|file'
        ]);
//        dd($_POST);
        $path=$request->file('goods_img')->store('public/shopcate');

        Menu::create([
            'goods_name'=>$request->goods_name,
            'rating'=>$request->rating,
            'shop_id'=>Auth::user()->shop_id,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'months_sales'=>$request->months_sales,
            'rating_count'=>$request->rating_count,
            'tips'=>$request->tips,
            'satisfy_count'=>$request->satisfy_count,
            'satisfy_rate'=>$request->satisfy_rate,
            'goods_img'=>$path,
            'status'=>$request->status,

        ]);
        return redirect()->route('menu.index')->with('success','菜品添加成功');

    }
    //修改
    public  function edit(){

    }
    public function update(){

    }

   // 删除
    public  function destroy(Menu $menu){
        $menu->delete();
        session()->flash('success','该菜品已被删除');

        return view('menu.list')->with('success','6414111');

    }


}
