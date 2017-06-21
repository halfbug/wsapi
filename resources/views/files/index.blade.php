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
        @can('searchfile', \App\File::class)
        <div class="panel">
            <form name="search-file" enctype='multipart/form-data' method="POST"  id="search-file" action="{{url("file/search")}}">
                {{ csrf_field() }}
                <h2> Search </h2>
                <hr>
            <div class="row form-group">
                <div class="col-sm-3">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="0">Select Status</option>
                        <option value="1">Uploaded</option>
                        <option value="2">In Progress</option>
                        <option value="3">Processed</option>
                        <option value="4">Downloaded</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="user">User</label>
                    <select id="user" name="user" class="form-control">
                        <option value="0">Select User</option>
                        <option value="3">Site User</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="uploadtime">Upload time</label>
                    <select id="uploadtime" name="uploadtime" class="form-control" >
                        <option value="0">Select period</option>
                        <option value="1">Today</option>
                        <option value="2">Last Week</option>
                        <option value="3">Last Month</option>
                    </select>
                </div>

            </div> 
                 <button class="btn btn-info btn-detail" onClick="$(#search-file).submit();">Search&nbsp;&nbsp; <span class="glyphicon glyphicon-search"></span></button> 
                 <button class="btn btn-warning btn-detail" >Reset&nbsp;&nbsp; <span class="glyphicon glyphicon-refresh"></span></button>
                                                
            </form><br>
        </div>
        @endcan
        <div class="panel panel-default panel-table">


            <div class="panel-heading">
                <div class="row">
                                        <div class="col col-xs-2">
                                             <button class="btn btn-default btn-detail" onclick="window.location ='{{ route('fileList') }}'"><span class="glyphicon glyphicon-refresh"></span></button>
             </div>
                    <div class="col col-xs-10 text-right">
                        <div class="btn-group">
                           
                            <button type="button" class="btn btn-info btn-filter" onClick="window.location = '{{url("file/list/Uploaded")}}'">Uploaded</button>
                            <button type="button" class="btn btn-success btn-filter" onClick="window.location = '{{url("file/list/In-Progress")}}'">In progress</button>
                            <button type="button" class="btn btn-warning btn-filter" onClick="window.location = '{{url("file/list/Processed")}}'">Processed</button>
                            <button type="button" class="btn btn-danger btn-filter" onClick="window.location = '{{url("file/list/Downloaded")}}'">Downloaded</button>
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
                    @php
                    if(session()->has('files'))
                        $files = \Session::get('files');
                    @endphp
                    @foreach ($files as $file) 
                   
                   
                    <tr>
                    <!--<td><?php echo $file->ipaddress; ?></td>-->
                        <td>{{ $file->name }}</td>
                        <td>{{ $file->getStatus() }}</td>
                        <td>{{ $file->created_at }}</td>
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
                            @if($file->getStatus() == "Uploaded")
                            <a href="{{ url("/file/startprocessing/".$file->id) }}">
                                <i class="fa fa-check-circle-o fa-2x"></i>
                            </a>
                            @else
                            {{ $file->getStatus() }}
                            @endif
                        </td>
                        @endcan
                    </tr>
                   
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