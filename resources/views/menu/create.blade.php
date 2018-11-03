@extends('layout.default')

@section('contents')
    <div style="margin:0 auto; width: 60%;">
        <h2 class="bg-primary">------新增菜品-------</h2>
        @include('layout._errors')
        <form method="post" action="{{route('menu.store')}}" enctype="multipart/form-data">
            <div class="form-group">
                <label>名称</label>
                <input type="text" name="goods_name" class="form-control" value="{{old('goods_name')}}" >
            </div>

            <div class="from-group">
                <lable>状态</lable>
                <label class="radio-inline">
                    <input type="radio" name="status" id="inlineRadio1" value="1" checked="checked"> 上架
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" id="inlineRadio2" value="0" > 下架
                </label>
            </div>
            <div class="form-group">
                <label>评分</label>
                <input type="text" name="rating" class="form-control" readonly="readonly" value="{{rand(40,50)*0.1}}" >
            </div>
            <div class="form-group">
                <label>菜品分类 </label>
                <select name="category_id" class="form-control">
                    @foreach($menucc as $menu)
                        <option value="{{ $menu->id }}"
                                @if(old('shop_id')==$menu->id)
                                selected="selected"
                                @endif
                        >{{ $menu->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>价格(￥)</label>
                <input type="text" name="goods_price" class="form-control" value="{{old('goods_price')}}" >
            </div>
            <div class="from-group">
                <lable style="font-size: 20px;">描述</lable>
                <br>
                <textarea name="description" class="from-control" cols="80" rows="5">{{old('description')}}</textarea>
            </div>

            <div class="form-group">
                <label>月销量</label>
                <input type="text" name="months_sales" class="form-control" readonly="readonly" value="{{rand(0,9999)}}" >
            </div>
            <div class="form-group">
                <label>评分数量</label>
                <input type="text" name="rating_count" readonly="readonly" class="form-control" value="{{rand(0,999)}}" >
            </div>
            <div class="form-group">
                <label>提示信息</label>
                <input type="text" name="tips" class="form-control" value="{{old('tips')}}" >
            <div class="form-group">
                <label>满意度数量</label>
                <input type="text" name="satisfy_count"  readonly="readonly" class="form-control" value="{{rand(700,999)*0.1.'%'}}" >
            </div>
            <div class="form-group">
                <label>满意度评分</label>
                <input type="text" name="satisfy_rate" class="form-control" readonly="readonly" value="9.3" >
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" style="color: #419641;font-size:20px;padding-top: 20px;">添加商品图片：</label>
                <div class="col-sm-1 " style="width: 300px;!important"  onclick="test          ()">
                    <input type="file" id="file" name="goods_img"  style="display: none"                                  onchange="preview(this)"><br/>
                    <img id="face" src="/img/dp.jpg" class="img-thumbnail" alt="点击添加商品图片" style="width: 300px;height: 190px;margin-top: -19px;"/>
                </div>
            </div>
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