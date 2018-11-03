@extends('layout.default')
@include('vendor.ueditor.assets')
@section('contents')
    {!!$activity->content!!}
@stop
