@if(\Auth::user()->hasRole("admin") || \Auth::user()->hasRole("sadmin"))
@extends('layouts.backend')
@endif

@section('heading')
    Average time between available for download and when was uploaded
        @endsection

@section('content')


<div class="row">
    <div class="col-md-12">

        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>This Week
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Actions
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li class="active"><a href="{{action('AnalyticController@averagetime', 1)}}">This Week</a>
                            </li>
                            <li><a href="{{action('AnalyticController@averagetime', 1)}}">Last Week</a>
                            </li>
                            <li><a href="{{action('AnalyticController@averagetime', 1)}}">This month</a>
                            </li>
                            <li><a href="{{action('AnalyticController@averagetime', 1)}}">Last month</a>
                            </li>
                            <li><a href="{{action('AnalyticController@averagetime', 1)}}">Last 6 months</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="{{url("/analysis/averagetime")}}">Refresh</a>
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
                                        <th>Average</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $sno=0; @endphp

								 @foreach($data as $rec)

								    <tr>
                                        <td>{{ ++$sno }}</td>
                                        <td>{{ $rec['y'] }}</td>
                                        <td>{{$rec['a']}}</td>
                                    </tr>

								 @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                        <!-- /.table-responsive -->
                    <div class="col-lg-8">
                        <div id="bar-chart"></div>
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
@section('script')
    @parent
    <!-- Morris Charts JavaScript -->
    <script src="{{ asset("vendor/raphael/raphael.min.js")}}"></script>
    <script src="{{ asset("vendor/morrisjs/morris.min.js")}}"></script>
   <!--  <script src="{{ asset("data/morris-data.js")}}"></script> -->
<script>


$(function() {
    var data = {!! json_encode($data) !!},
        config = {
            data: data,
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Average'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors:['gray','red']
        };
    config.element = 'bar-chart';
    Morris.Bar(config);

    
});

</script>
@endsection