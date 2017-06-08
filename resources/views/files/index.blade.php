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
    <div class="row form-group">
        <div class="col-sm-6">
            <button class="btn btn-info btn-detail">Search&nbsp;&nbsp; <span class="glyphicon glyphicon-search"></span>

            </button>
            
            <button class="btn btn-warning btn-detail">Reset&nbsp;&nbsp; <span class="glyphicon glyphicon-refresh"></span>

            </button>
        </div>
        <div class="col-sm-6">
            
        </div>
    </div>

<div class="">
    <div class="col-md-12 ">

        <table class="table">
            <tr>
            <!--<th>File ip address</th>-->
                <th>File path</th>
                <th>Status</th>
                <th>Upload Time</th>
                <th>Actions</th>
            </tr>
            <?php
            foreach ($files as $file) {
				$filepath=$file->path;
                $filepath=basename($filepath);
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
                <!--<td><?php echo $file->ipaddress; ?></td>-->
                    <td>{{ $filepath }}</td>
                    <td>{{ $filestatus }}</td>
                    <td>{{$file->created_at }}</td>
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
                </tr>
<?php } //endforeach  ?>
        </table>
    </div>

</div>

@endsection