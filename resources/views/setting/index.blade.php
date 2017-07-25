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
    Settings &nbsp;<small><a href="{{url("/setting/index_listing")}}" class="btn btn-success">Advance Setting</a></small>
@endsection
@section('content')
    <div class="col-md-12">
        @if(count($settings)>0)
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
            <div class="row top-buffer">
                <div class="col-xs-2 col-md-2">Name</div>
                <div class="col-xs-2 col-md-2"><a href="#" data-toggle="tooltip" data-placement="left" title="Name!"><span class="glyphicon glyphicon-question-sign"></span></a>{{$setting['name']}}</div>
            </div>
            <form method="post" action="{{action('SettingController@update', $setting['id'])}}">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="PATCH">
             <div class="row top-buffer">
                <div for="smFormGroupInput" class="col-xs-2 col-md-2 col-form-label">Value</div>
                <div class="col-xs-2 col-md-2">
                    <input type="text" class="form-control form-control-lg" id="lgFormGroupInput"  name="value" value="{{$setting->value}}">
                </div>
            </div>
                @if(count($setting['option'])>0)
            <div class="row top-buffer">
                <div for="smFormGroupInput" class="col-xs-2 col-md-2 col-form-label">Option</div>
                <div class="col-xs-2 col-md-2">
                    <div class="dropdown">
                        <select class="form-control btn btn-default dropdown-toggle"  data-toggle="dropdown" name="status" id="smFormGroupInput">
                            @foreach(explode(',',$setting['option']) as $op)
                            <option value="1">{{$op}}</option>
                                @endforeach
                        </select>
                    </div>

                    </div>
            </div>
                @endif
            <div class="row top-buffer">
                <div class="col-xs-2 col-md-2 "><a href="{{action('SettingController@edit', $setting['id'])}}" class="btn btn-warning">Save Setting</a></div>
            </div>

            </form>

        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>
                        <div class="col-sm-8 alert alert-warning text-center">Sorry No Record Found Please Add Setting</div>
                    </td>
                </tr>
                </thead>
            </table>
        @endif
    </div>

@endsection