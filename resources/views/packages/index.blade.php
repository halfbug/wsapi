@php 
if(\Auth::user()->hasRole('siteuser'))
$view = "dashboard";
else
$view = "backend";
@endphp


@extends('layouts.'.$view)

@section('title')
Packages
@endsection


@section('css')
<!-- css for table in /public/css -->
<link href="{{ asset('css/grid.css') }}" rel="stylesheet">
@endsection

@section('heading')
Packages <small>management</small>
@endsection

@section('content')

<div class="">
    <div class="col-md-12 ">
        <div class="panel panel-default panel-table">
        <!--    <div class="panel-heading">
                <div class="row">
                    <div class="col col-xs-6">
                        <!--<h3 class="panel-title">Panel Heading</h3>-->
                   <!-- </div>
                    <div class="col col-xs-6 text-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-filter" data-target="pagado">Site Users</button>
                            <button type="button" class="btn btn-warning btn-filter" data-target="pendiente">Admin Users</button>
                            <button type="button" class="btn btn-danger btn-filter" data-target="cancelado">Super Admin</button>
                            <!--<button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>-->
                        <!--</div>
                    </div>
                </div>
            </div> -->
            <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                    <tr>
                        <th class="text-center"><em class="fa fa-cog"></em></th>
                        <th>Name</th>
                        <th>description</th>
                        <th>created On</th>
                        <th>End date</th>
                        <th>Price</th>
                        <th>Files count</th>
                        <th>reset count</th>
                        <th>discount in this package</th>
                         <th>Status</th>
                   </tr>
                    @foreach ($packages as $package)
                    <tr>
                        <td align="center">
                            <a class="btn btn-default"><em class="fa fa-pencil"></em></a>
                            <a class="btn btn-danger"><em class="fa fa-trash"></em></a>
                        </td>
                        <td>{{ $package['name'] }}</td>
                        <td>{{ $package['description'] }}</td>
                        <td>{{ date("d-M-Y h:i:s",strtotime($package['start_date'])) }}</td>
                        <td>{{ date("d-M-Y h:i:s",strtotime($package['end_date'])) }}</td>
                        <td> </td>

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
