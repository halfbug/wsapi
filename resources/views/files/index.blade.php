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

@endsection

@section('heading')
Files<small></small>
@endsection

@section('content')

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

    <button class="btn btn-info btn-detail" data-toggle="collapse" data-target="#listing">Show List</button>
   <div >&nbsp;</div>

    <div id="listing" class="collapse  ">

            <div class="row form-group ">
            <div class="col-sm-6">
                <button class="btn btn-info btn-detail">Search&nbsp;&nbsp; <span class="glyphicon glyphicon-search"></span>

                </button>

                <button class="btn btn-warning btn-detail">Reset&nbsp;&nbsp; <span class="glyphicon glyphicon-refresh"></span>

                </button>
            </div>
            <div class="col-sm-6">
            </div>

        </div>
        <div class='row'>
        <div class="">
            <div class="col-md-12 ">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <!--<h3 class="panel-title">Panel Heading</h3>-->
                            </div>
                            <div class="col col-xs-6 text-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-filter" data-target="pagado">Site Users</button>
                                    <button type="button" class="btn btn-warning btn-filter" data-target="pendiente">Admin Users</button>
                                    <button type="button" class="btn btn-danger btn-filter" data-target="cancelado">Super Admin</button>
                                    <!--<button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-list">
                            <tr>
                                <th class="text-center"><em class="fa fa-cog"></em></th>
                                <th>File path</th>
                                <th>Status</th>
                                <th>Upload Time</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            foreach ($files as $file) {
                            //// storing filename from  fullpath
                            $filepath=$file->path;
                            $filepath=basename($filepath);
                            ////user friendly date time format
                            $createddate=date("d-M-Y h:i:s",strtotime($file->created_at));
                            if ($file->status == 1) {
                                $filestatus = "Uploaded";
                            } elseif ($file->status == 2) {
                                $filestatus = "In Progress";
                            } elseif ($file->status == 3) {
                                $filestatus = "Downloaded";
                            } else {
                                $filestatus = "Not Defined";
                            }
                            ?>
                            <tr>
                                <td align="center">
                                    <a class="btn btn-default"><em class="fa fa-pencil"></em></a>
                                    <a class="btn btn-danger"><em class="fa fa-trash"></em></a>
                                </td>
                                <td>{{ $filepath }}</td>
                                <td>{{ $filestatus }}</td>
                                <td>{{ $createddate }}</td>
                                <td><button class="btn btn-secondary btn-detail edit_package" value="{{$file->id}}" title="Download Processed File"><i class="fa fa-download" ></i></button>

                                    <form enctype='multipart/form-data' class="form-inline" style="display:inline" role="form" method="POST"  id="deleteForm_{{$file->id}}" action="{{ url("packages/".$file->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-danger btn-delete delete-package " value="{{$file->id}}" id="delete_package_{{$file->id}}"  title="Delete">
                                            <i class="fa fa-remove" ></i></button>
                                        <input type="hidden" name="package_id" value="{{$file->id}}" />

                                    </form>
                                </td>

                            </tr>
                            <?php } //endforeach  ?>
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
        </div>
    </div>
    <style>

    </style>
@endsection