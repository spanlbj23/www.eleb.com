<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //
    //登录
    public function create()
    {
        //登录表单

        return view('session.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required'
        ]);
        //验证 账号密码是否正确
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember'))){
            return redirect()->route('user.index')->with('success','登录成功');
        }else{
            //登录失败
            return back()->with('danger','用户名或密码错误，请重新登录')->withInput();
        }

    }
    //退出登录
    public function destroy(){
        Auth::logout();
        return redirect()->route('login')->with('success','您已成功退出登录');
    }

    //修改密码
//    public function edit(User $users){
//
//        return view('Session.edit',compact('users'));
//    }
//    public function updatepass(){
//
//    }
}
