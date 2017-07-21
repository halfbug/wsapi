@php
    if(\Auth::user()->hasRole('siteuser'))
        $view = "dashboard";
    else
        $view = "backend";
@endphp

@extends('layouts.'.$view)

@section('title')
@endsection

@section('css')
    <style>
        .top-buffer { margin-top:20px; }
    </style>
@endsection

@section('script')
@endsection

@section('heading')
    Settings<small></small> <a href="/setting/create" class="btn btn-primary">Add New</a>&nbsp;<a href="/setting/index_listing" class="btn btn-success">View All</a>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12" >
                @foreach($settings as $post)
                <a href="{{action('SettingController@show', $post['id'])}}">{{$post['section']}} </a>
                    @if (!$loop->last)
                        &nbsp;|&nbsp;
                    @endif
                @endforeach
            </div>
        </div>
        @if($setting['id']!=0)
        <div class="row top-buffer">
                <div class="col-xs-2 col-md-2">Name</div>
            <div class="col-xs-2 col-md-2"><a href="#" data-toggle="tooltip" data-placement="left" title="Name!"><span class="glyphicon glyphicon-question-sign"></span></span></a>{{$setting['name']}}</div>
        </div>
        <div class="row top-buffer">
            <div class="col-xs-2 col-md-2">Value</div>
            <div class="col-xs-2 col-md-2"><a href="#" data-toggle="tooltip" data-placement="left" title="Value!"><span class="glyphicon glyphicon-question-sign"></span></span></a>
                {{$setting['value']}}</div>
        </div>
        <div class="row top-buffer">
            <div class="col-xs-2 col-md-2">Option</div>
            <div class="col-xs-2 col-md-2">{{$setting['option']}}</div>
        </div>
        <div class="row top-buffer">
            <div class="col-xs-2 col-md-2">Section</div>
            <div class="col-xs-2 col-md-2">{{$setting['section']}}</div>
        </div>
        <div class="row top-buffer">
            <div class="col-xs-2 col-md-2">Status</div>
            <div class="col-xs-2 col-md-2">@if($setting['status']==1)Yes @else No @endif</div>
        </div>
        <div class="row top-buffer">
            <div class="col-xs-2 col-md-2 "><a href="{{action('SettingController@edit', $setting['id'])}}" class="btn btn-warning">Edit</a></div>
        </div>
        @endif
    </div>

@endsection