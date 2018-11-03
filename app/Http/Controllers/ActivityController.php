<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //列表
    public function index(){
//        return 1;
        $activity=Activity::paginate(3);
//        dd($activity);
        return view('activity.list',compact('activity'));
    }
    //添加
    public function create(){
        return view('activity.create');
    }
    public function store(Request $request){
        $this->validate($request,[
           'title'=>'required|max:30|min:1',
            'content'=>'required'
        ],[
            'name.max'=>'活动标题不得大于30个字',
            'name.min'=>'活动标题不得小于1个字',
            ]
        );
        Activity::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        return redirect()->route('activity.index')->with('success','活动添加成功');

    }
    //修改
    public function edit(Activity  $activity){
      return view('activity.edit',compact('activity'));
    }
    public function update(Request $request,Activity  $activity){
        $this->validate($request,[
            'title'=>'required|max:30|min:1',
            'content'=>'required'
        ],[
                'name.max'=>'活动标题不得大于30个字',
                'name.min'=>'活动标题不得小于1个字',
            ]
        );
        $activity->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        return redirect()->route('activity.index')->with('success','活动修改成功');
    }
    public function destroy(Activity $activity){
        $activity->delete();
        return redirect()->route('activity.index')->with('success','活动删除成功');
    }

}
