@extends('layout.default')

@section('contents')
    <table class="table table-bordered table-striped">
        <h1>菜品分类列表</h1>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>菜品编号</th>
            <th>描述</th>
            <th>是否默认分类</th>
            <th>操作</th>
        </tr>
        @foreach ($menucategory as $menuc)
            <tr>
                <td>{{ $menuc->id }}</td>
                <td>{{ $menuc->name }}</td>
                <td>{{ $menuc->type_accumulation }}</td>
                <td>{{ $menuc->description}}</td>
                <td>@if($menuc->is_selected==1) 是  @endif  </td>
                <td><a href="{{route('menucategory.create')}}" class="btn btn-info">添加</a>
                    <a href="{{ route('menucategory.edit',[$menuc]) }}" class="btn btn-warning">修改</a>
                    <form method="post" action="{{ route('menucategory.destroy',[$menuc]) }}" style="float: left;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">删除</button>
                    </form>
                {{--</td>--}}
            </tr>
        @endforeach
    </table>
    {{ $menucategory->links() }}
@endsection