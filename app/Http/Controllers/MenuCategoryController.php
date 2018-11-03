<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    //菜品分类表
    public function index(MenuCategory $menucategory){

        $menucategory=MenuCategory::paginate(3);
        return view('menucategory.list',compact('menucategory'));
    }
    //添加菜品分类
    public  function create(){
        return view('menucategory.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|max:15|min:1|unique:menu_categories',
        ],[
            'name.required'=>'名称不能为空',
            'name.max'=>'名称字符过长',
            'name.min'=>'名称字符不得小于一个字符',
            'name.unique'=>'该名称已存在',
        ]);
        if($request->is_selected==1){
            DB::table('menu_categoried')
                ->where('is_selected','=',1)
                ->where('shop_id','=',Auth::user()->shop_id)
                ->update(['is_selected' => 0 ]);
        }
        MenuCategory::create([
            'name'=>$request->name,
            'type_accumulation'=>$request->type_accumulation,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected,
            'shop_id'=>Auth::user()->shop_id,
        ]);

        return redirect()->route('menucategory.index')->with('success','菜品分类添加成功');

    }
    //更新菜品分类
    public function edit(MenuCategory $menucategory){
//        dd($menuCategory);
        return view('menucategory.edit',compact('menucategory'));
    }
    public  function update(Request $request,MenuCategory $menucategory){
        $this->validate($request,[
            'name'=>'required|max:15|min:1',
        ],[
            'name.required'=>'名称不能为空',
            'name.max'=>'名称字符过长',
            'name.min'=>'名称字符不得小于一个字符',

        ]);
        if($request->is_selected==1){
            DB::table('menu_categories')
                ->where('is_selected','=',1)
                ->where('shop_id','=',Auth::user()->shop_id)
                ->update(['is_selected' => 0 ]);
        }
        $menucategory->update([
            'name'=>$request->name,
            'type_accumulation'=>$request->type_accumulation,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected,
            'shop_id'=>Auth::user()->shop_id,
        ]);

        return redirect()->route('menucategory.index')->with('success','菜品分类修改成功');
    }
    //删除菜品分类
    public function destroy(MenuCategory $menucategory){
        $menu=Menu::all();
        foreach($menu as $men){
          if ($men->category_id!=$menucategory->id){
              $menucategory->delete();  return redirect()->route('menucategory.index')->with('success','删除成功');
          }
        else{
            return back()->with('danger','该菜品不能删除');
        }
        }
//

    }
    //显示一条数据
    public function show(){

    }
}
