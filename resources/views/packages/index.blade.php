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
    Packages
    <small>management</small>
@endsection

@section('content')

    <div class="">
        <div class="col-md-12 ">
            <div class="panel panel-default panel-table">
                @can('performAdmin', $packages[0])
                    <div class="panel-heading">

                        <div class="row">
                            <div class="col col-xs-6">
                                <!--<h3 class="panel-title">Panel Heading</h3> -->
                            </div>

                            <div class="col col-xs-6 text-right">

                                <a href="{{url('packages/add')}}" class="btn btn-primary"> <i class="fa fa-plus"></i>
                                    Add New</a>

                            </div>
                        </div>
                    </div>
                @endcan
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-list">
                        <tr>
                            <th class="text-center"><em class="fa fa-cog"></em></th>
                            <th>Name</th>
                            <th>description</th>
                            <th>Type</th>
                            <th>Duration</th>
                            <th>Price</th>
                            <th>Max Files</th>

                            <th>discount</th>
                            @can('performAdmin', $packages[0])
                                <th>Reset count</th>
                                <th>Status</th>
                            @endcan
                        </tr>
                        @foreach ($packages as $package)
                            <tr>
                                <td align="center">
                                    @can('performAdmin', $package)
                                        <a class="btn btn-default" href="{{url('packages/edit/'.$package['id'])}}"><em
                                                    class="fa fa-pencil"></em></a>
                                        <a class="btn btn-danger"><em class="fa fa-trash"></em></a>

                                    @elsecan('performSiteuser',$package)
                                    @php
                                        $subsctioption=(\Auth::user()->subscription()->active()->first() != null )? \Auth::user()->subscription()->active()->first() : new \App\Subscription()  ;
                                    @endphp
                                    <!--/** check if the user is already subscribe then display unsubscripbe button */-->
                                        @if($subsctioption->package_id == $package->id)
                                            <a  class="btn btn-success"><em class="fa fa-angle-double-right"></em>Running</a>
                                        @else
                                            <a href="{{url("paywithpaypal"."/".$package->id)}}" class="btn btn-primary"><em class="fa fa-angle-double-right"></em>Subscribe</a>
                                        @endif
                                    @endcan

                                </td>
                                <td>{{ $package['name'] }}</td>
                                <td>{!! $package['description'] !!}</td>
                                <td>{{ date("d-M-Y h:i:s",strtotime($package['start_date'])) }}</td>
                                <td>{{ date("d-M-Y h:i:s",strtotime($package['end_date'])) }}</td>
                                <td>{{ $package['price'] }}</td>
                                <td>{{ $package['files_count'] }} </td>

                                <td>{{ $package->discount->name }} </td>
                                @can('performAdmin', $package)
                                    <td>{{ $package['reset_count'] }} </td>
                                    <td>{{ $package['status'] }} </td>
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

