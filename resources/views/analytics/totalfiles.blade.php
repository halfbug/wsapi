@if(\Auth::user()->hasRole("admin") || \Auth::user()->hasRole("sadmin"))
@extends('layouts.backend')
@endif

@section('content')


<div class="row">
    <div class="col-md-12">

        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Total amount of files uploaded by and sent to users
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Actions
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="lastweek">Last Week</a>
                            </li>
                            <li><a href="onemonth">Last 31 days</a>
                            </li>
                            <li><a href="lastsixmonths">Last 6 months</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="totalfiles">Refresh</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Uploaded</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($totalfiles as $file)
								 @php $sno=3326;
								 $totalnumoffiles="to be calculated";
								 @endphp
								    <tr>
                                        <td>{{ $sno }}</td>
                                        <td>{{ $file->created_at }}</td>
                                        <td>{{$filemodel->countfilesforgivendate($file->created_at)}}</td>
                                    </tr>
                                 @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                        <!-- /.table-responsive -->
                    <div class="col-lg-8">
                        <div id="morris-bar-chart"></div>
                    </div>
                    <!-- /.col-lg-8 (nested) -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.panel-body -->
        </div>
         </div>
        </div>
       @endsection
