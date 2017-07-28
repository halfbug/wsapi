@extends('layouts.backend')

@section('content')
    <div class="container">
    <div class="row top-buffer">
        <div class="col-xs-6"><i class="fa fa-area-chart" style="font-size:24px;">&nbsp;<a href="analysis/totalfiles"> Total amount of files upload</a></i></div>
    </div>
    <div class="row top-buffer">
        <div class="col-xs-6"><i class="fa fa-bar-chart" style="font-size:24px;">&nbsp;<a href="analysis/averagetime"> Average time between available for download and when was uploaded</a></i></div>
    </div>
    <div class="row top-buffer">
        <div class="col-xs-6"><i class="fa fa-line-chart" style="font-size:24px;">&nbsp;<a href="analysis/last31upload"> Count files uploaded and downloaded by guest/free and registered users in the last 31 days</a> </i></div>
    </div>
    <div class="row top-buffer">
        <div class="col-xs-6"><i class="fa fa-pie-chart" style="font-size:24px;">&nbsp;<a href="analysis/uploadfile"> Upload and download file counts per Website and the API in the last 31 days</a> </i></div>
    </div>

    </div>
@endsection

@section('css')
    <style>
    .top-buffer { margin-top:20px; }
    </style>
@endsection

@section('heading')
    Analysis <small></small>
@endsection

@section('title')
    Analytics
@endsection

@section('script')
    @parent
@endsection