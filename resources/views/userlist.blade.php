@php 
if(\Auth::user()->hasRole('siteuser'))
    $view = "dashboard";
else
    $view = "backend";
@endphp


@extends('layouts.'.$view)

@section('title')
Users
@endsection
@section('css')

@endsection

@section('heading')
Users<small></small>
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
            
                <th>Name</th>
                <th>Email Address</th>
                <th>Joined On</th>
                <th>Files Uploaded</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ date("d-M-Y h:i:s",strtotime($user['created_at'])) }}</td>
                    <td>{{ $user['files_count']['count'] }}</td>
                    
                </tr>
            @endforeach
        </table>
    </div>

</div>

@endsection