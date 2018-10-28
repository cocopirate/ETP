@extends('layouts.user')
@section('title', '首页')

@section('content')
    <h1>这里是首页</h1>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        退出登录
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <div>{{ Auth::getRecallerName() }}</div>
    <div>{{ Cookie::get(Auth::getRecallerName()) }}</div>
@stop