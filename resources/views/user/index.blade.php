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
<!-- css for table in /public/css -->
<link href="{{ asset('css/grid.css') }}" rel="stylesheet">
@endsection

@section('script')

@endsection

@section('heading')
Users <small>management</small>
@endsection

@section('content')

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
                            <button type="button" class="btn btn-success btn-filter" onClick="window.location = '{{url("users/filter/siteuser")}}'">Site Users</button>
                            <button type="button" class="btn btn-warning btn-filter" onClick="window.location = '{{url("users/filter/admin")}}'">Admin Users</button>
                            <button type="button" class="btn btn-danger btn-filter" onClick="window.location = '{{url("users/filter/sadmin")}}'">Super Admin</button>
                            <!--<button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>-->
                        </div>
                    </div>
                </div>
            </div>
            {{ csrf_field() }}
            <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                    <tr>
                        <th class="text-center"><em class="fa fa-cog"></em></th>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Joined On</th>
                        <th>Files Uploaded</th>
                    </tr>
                    @foreach ($users as $user)
                    @php 
                        $id = $user['id'];
                        $show = 1;
                        $role = (session()->has('role'))? \Session::get('role'): 'all';
                        if($role != 'all')                   
                            $show = ($role == $user['roles'][0]['name'])? 1 : 0;
                        
                    @endphp
                    @if($show)
                    <tr>
                        <td align="center">
                            <a class="btn btn-default" onclick="window.location = '{{url("users/edit/".$id)}}'"><em class="fa fa-pencil"></em></a>
                            <a class="btn btn-danger" onclick="window.location = '{{url("users/delete/".$id."/".$role)}}'"><em class="fa fa-trash"></em></a>
                        </td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ date("d-M-Y h:i:s",strtotime($user['created_at'])) }}</td>
                        <td>{{ is_null($user['files_count']['count'])?0:$user['files_count']['count'] }}</td>

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

