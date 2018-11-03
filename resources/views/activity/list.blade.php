@extends('layout.default')

@section('contents')
    <table class="table table-bordered table-striped">
        <h1>活动列表</h1>
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>活动详情</th>
        </tr>
        @foreach ($activity as $act)
            <tr>
                <td>{{ $act->id }}</td>
                <td>{{ $act->title }}</td>
                <td>{{ $act->start_time }}</td>
                <td>{{ $act->end_time}}</td>
                <td>
                    <a href="{{ route('activity.edit',[$act]) }}" class="btn btn-warning">查看</a>

                </td>
            </tr>
        @endforeach
    </table>
    {{ $activity->links() }}
@endsection