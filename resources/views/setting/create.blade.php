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
    Settings&nbsp;<small><a href="{{url('setting')}}" >Back</a></small>
@endsection
@section('content')
    <div class="col-md-12">
        <form method="post" action="{{url('setting')}}">
            <div class="form-group row">
                {{csrf_field()}}
                <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-lg" id="smFormGroupInput" placeholder="Name" name="name" maxlength="50" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Value</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-lg" id="smFormGroupInput" placeholder="Value" name="value" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Option</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-lg" id="smFormGroupInput" placeholder="Option" name="option" >
                </div>
            </div>
            <div class="form-group row">
                <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Section</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-lg" id="smFormGroupInput" placeholder="Section" name="section" required autofocus>
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
                <div class="col-md-2"></div>
                <input type="submit" class="btn btn-primary" value="Add Setting">
            </div>
        </form>
        </div>
@endsection