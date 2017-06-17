@php 
if(\Auth::user()->hasRole('siteuser'))
$view = "dashboard";
else
$view = "backend";
@endphp


@extends('layouts.'.$view)

@section('title')
Files
@endsection

@section('css')
<link href="{{ asset('css/grid.css') }}" rel="stylesheet">
@endsection

@section('heading')
Files<small></small>
@endsection

@section('content')
<div class="">
    <div class="col-md-12 ">
        <div class="panel">
        <form name="search-file">
            <h2> Search </h2>
            <hr>
        <div class="row form-group">
            <div class="col-sm-3">
                <label for="ddlCompany">Status</label>
                <select id="ddlCompany" class="form-control">
                    <option value="0">Select Status</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="ddlDepartment">User</label>
                <select id="ddlDepartment" class="form-control">
                    <option value="0">Select User</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="ddlBranch">Upload time</label>
                <select id="ddlBranch" class="form-control" >
                    <option value="0">Select period</option>
                    <option value="0">Today</option>
                    <option value="0">Last Week</option>
                    <option value="0">Last Month</option>
                </select>
            </div>

        </div> 
             <button class="btn btn-info btn-detail">Search&nbsp;&nbsp; <span class="glyphicon glyphicon-search"></span></button> 
                                            <button class="btn btn-warning btn-detail" >Reset&nbsp;&nbsp; <span class="glyphicon glyphicon-refresh"></span></button>
                                            
        </form><br>
    </div>
        <div class="panel panel-default panel-table">


            <div class="panel-heading">
                <div class="row">
                                        <div class="col col-xs-2">
                                             <button class="btn btn-default btn-detail" onclick="window.location ='{{ route('fileList') }}'"><span class="glyphicon glyphicon-refresh"></span></button>
             </div>
                    <div class="col col-xs-10 text-right">
                        <div class="btn-group">
                           
                            <button type="button" class="btn btn-info btn-filter" onClick="window.location = '{{url("file/list/uploaded")}}'">Uploaded</button>
                            <button type="button" class="btn btn-success btn-filter" onClick="window.location = '{{url("file/list/in-progress")}}'">In progress</button>
                            <button type="button" class="btn btn-warning btn-filter" onClick="window.location = '{{url("file/list/processed")}}'">Processed</button>
                            <button type="button" class="btn btn-danger btn-filter" onClick="window.location = '{{url("file/list/downloaded")}}'">Downloaded</button>
                            <!--<button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body">


                <table class="table table-striped table-bordered table-list">
                    <tr>
                    <!--<th>File ip address</th>-->
                        <th>File Name</th>
                        <th>Status</th>
                        <th>Upload Time</th>
                        <th>Actions</th>
                        @can('startprocessing', \App\File::class)
                        <th>Start Processing</th>
                        @endcan
                    </tr>

                    @foreach ($files as $file) 
                    @php
                    //// storing filename from fullpath if name field empty
                    $filepath=(empty($file->name))? basename($file->path): $file->name;
                    ////user friendly date time format
                    $createddate=date("d-M-Y h:i:s",strtotime($file->created_at));
                    if ($file->status == 1) {
                    $filestatus = "Uploaded";
                    } elseif ($file->status == 2) {
                    $filestatus = "In Progress";
                    } elseif ($file->status == 3) {
                    $filestatus = "Processed";
                    } elseif ($file->status == 4) {
                    $filestatus = "Downloaded";
                    } else {
                    $filestatus = "Not Defined";
                    }
                    @endphp
                    @if(is_null($status) || strcasecmp(str_replace("-"," ",$status), $filestatus) == 0)
                    <tr>
                    <!--<td><?php echo $file->ipaddress; ?></td>-->
                        <td>{{ $filepath }}</td>
                        <td>{{ $filestatus }}</td>
                        <td>{{ $createddate }}</td>
                        <td> 
                            <button class="btn btn-secondary btn-detail edit_package" value="{{$file->id}}" title="Download Processed File"><i class="fa fa-download" ></i></button>

                            <form enctype='multipart/form-data' class="form-inline" style="display:inline" role="form" method="POST"  id="deleteForm_{{$file->id}}" action="{{ url("packages/".$file->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="button" class="btn btn-danger btn-delete delete-package " value="{{$file->id}}" id="delete_package_{{$file->id}}"  title="Delete">
                                    <i class="fa fa-remove" ></i></button>
                                <input type="hidden" name="package_id" value="{{$file->id}}" />

                            </form>
                        </td>
                        @can('startprocessing', \App\File::class)
                        <td>
                            @if($file->status == 1)
                            <a href="{{ url("/file/startprocessing/".$file->id) }}">
                                <i class="fa fa-check-circle-o fa-2x"></i>
                            </a>
                            @else
                            {{ $filestatus }}
                            @endif
                        </td>
                        @endcan
                    </tr>
                    @endif
                    @endforeach 
                </table>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col col-xs-4">Page 1 of 5
                    </div>
                    <div class="col col-xs-8">
                        <ul class="pagination hidden-xs pull-right">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                        </ul>
                        <ul class="pagination visible-xs pull-right">
                            <li><a href="#">«</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection