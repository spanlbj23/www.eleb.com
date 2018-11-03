@extends('layout.default')

@section('contents')
    <div style="margin:0 auto; width: 60%;">
        <h2 >------修改密码-------</h2>
        @include('layout._errors')
        <form method="post" action="{{ route('update') }}" enctype="multipart/form-data">
            <div class="form-group">
                <label>用户名</label>
                <input type="text" name="name" class="form-control" value="{{}}" >
            </div>
            <div class="form-group">
                <label>密码</label>
                <input type="password" name="password" class="form-control" value="{{old('password')}}">
            </div>


            {{--<input id="captcha" class="form-control" name="captcha" >--}}
            {{--<img class="thumbnail captcha" src="{{ captcha_src('inverse') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">--}}


            {{ csrf_field() }}
            <button class="btn btn-primary btn-block">提交</button>
        </form>
    </div>
    @stop
<script>
    function test(){
        var $file = document.getElementById('file');
        $file.click();
    }

    function preview(obj) {
        // 获取input上传的图片数据;
        var file = obj.files[0];
        // 得到bolb对象路径，可当成普通的文件路径一样使用，赋值给src;
        url = window.URL.createObjectURL(file);
        //预览
        var face = document.getElementById('face');
        face.src = url;
    }
</script>