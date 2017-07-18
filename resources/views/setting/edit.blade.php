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
@endsection

@section('script')
@endsection

@section('heading')
    <small>Settings</small>
@endsection
@section('content')
    <div class="container">
        <form method="post" action="{{action('SettingController@update', $id)}}">
            <div class="form-group row">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="PATCH">
                <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-lg" id="smFormGroupInput" placeholder="Name" name="name" value="{{$setting->name}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Value</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Value" name="value" value="{{$setting->value}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Status</label>
                <div class="col-sm-4">
                    <div class="dropdown">
                          <select class="form-control btn btn-default dropdown-toggle"  data-toggle="dropdown" name="status" id="smFormGroupInput">
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2"></div>

            </div>
            <div class="form-group row">
                <div class="col-md-4"></div>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection