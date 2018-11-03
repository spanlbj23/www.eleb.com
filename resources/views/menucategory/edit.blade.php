@extends('layout.default')

@section('contents')
    <div style="margin:0 auto; width: 60%;">
        <h2 class="bg-primary">------修改菜品分类-------</h2>
        @include('layout._errors')
        <form method="post" action="{{route('menucategory.update',[$menucategory])}}" enctype="multipart/form-data">
            <div class="form-group">
                <label>名称</label>
                <input type="text" name="name" class="form-control" value="{{$menucategory->name}}" >
            </div>
             <div class="form-group">
                <label>菜品编号</label>
                <input type="text" name="type_accumulation" readonly="readonly" class="form-control" value="{{$menucategory->type_accumulation}}">
            </div>
            <div class="from-group">
                <lable>是否是默认分类</lable>
                <label class="radio-inline">
                    <input type="radio" name="is_selected" id="inlineRadio1" value="1" @if($menucategory->is_selected==1) checked="checked"  @endif > 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_selected" id="inlineRadio2" value="0" @if($menucategory->is_selected==0) checked="checked"  @endif  > 否
                </label>
            </div>
            <div class="from-group">
                <lable>描述</lable>
                <br>
                <textarea name="description" class="from-control" cols="90" rows="10">{{$menucategory->description}}</textarea>
            </div>
            {{ csrf_field() }}
            {{method_field('PUT')}}
            <button class="btn btn-primary btn-block">确认修改</button>
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