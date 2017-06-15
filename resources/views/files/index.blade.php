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
        <div class="panel panel-default panel-table">
            <!-- <div class="row form-group">
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

    </div> -->
        @php
        $role = (session()->has('role'))? \Session::get('role'): 'all';
        if(session()->has('searchfile'))
            $files = \Session::get('searchfile');
        @endphp
        <div class="panel-heading">
                <div class="row">
                    <div class="col col-xs-6">
                        <form id="search_form" enctype="multipart/form-data" method="POST" action="{{url("/file/search/".$role)}}" style="display:inline">
                            {{ csrf_field() }}
                            <input type="text" style="display:none;" id="search" name="search" autofocus
                                onKeyDown="function(event) {if ((event.keyCode || event.which) == 13) $('#search_form').submit();}">
                        </form>
                        <button class="btn btn-info btn-detail" onClick="$('#search').show(); $(this).hide();">
                            Search&nbsp;&nbsp; <span class="glyphicon glyphicon-search"></span>
                        </button>
                        
                        <button class="btn btn-warning btn-detail">Reset&nbsp;&nbsp; <span class="glyphicon glyphicon-refresh"></span>

                        </button>
                    </div>
                    <div class="col col-xs-6 text-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-filter" onClick="window.location = '{{url("file/filter/all")}}'">All Users</button>
                            <button type="button" class="btn btn-success btn-filter" onClick="window.location = '{{url("file/filter/siteuser")}}'">Site Users</button>
                            <button type="button" class="btn btn-warning btn-filter" onClick="window.location = '{{url("file/filter/admin")}}'">Admin Users</button>
                            <button type="button" class="btn btn-danger btn-filter" onClick="window.location = '{{url("file/filter/sadmin")}}'">Super Admin</button>
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
                    $show = 1;
                    if($role != 'all')                   
                       $show = ($file->user->hasRole($role))? 1 : 0;
                        
                    //// storing filename from  fullpath
                    $filepath=(empty($file->name))? basename($file->path): $file->name;
                    //$filepath=basename($filepath);
                    ////user friendly date time format
                    $createddate=date("d-M-Y h:i:s",strtotime($file->created_at));
                    $startprocess = false;
                    if ($file->status == 1) {
                        $filestatus = "Uploaded";
                        $startprocess = true;
                    } elseif ($file->status == 2) {
                        $filestatus = "In Progress";
                    } elseif ($file->status == 3) {
                        $filestatus = "Downloaded";
                    } else {
                        $filestatus = "Not Defined";
                    }
                    @endphp
                    @if($show)
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
                            @if($startprocess)
                                <a href="{{ url("/file/startprocessing/".$file->id) }}">
                                    <i class="fa fa-check-circle-o fa-2x"></i>
                                </a>
                            @else
                                Already Processed
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