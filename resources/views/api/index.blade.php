@php
    if(\Auth::user()->hasRole('siteuser'))
    $view = "dashboard";
    else
    $view = "backend";
@endphp

@extends('layouts.'.$view)

@section('title')
    Clients
@endsection


@section('css')
    <!-- css for table in /public/css -->
    <link href="{{ asset('css/grid.css') }}" rel="stylesheet">
@endsection

@section('heading')
    API Clients
    <small>management</small>
@endsection

@section('content')

    <div class="">
        <div class="col-md-12 ">
            <div class="panel panel-default panel-table">
                {{--@can('performAdmin', $packages[0])--}}
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
                {{--@endcan--}}
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-list" id="clientlist">
                        <tr>
                            <th class="text-center"><em class="fa fa-cog"></em></th>
                            <th>Name</th>
                            <th>Secret</th>
                            <th>Redirect url</th>
                            <th>Created</th>
                            <th>User</th>



                        </tr>

                    <!--        <tr>
                                <td align="center">

                                        <a class="btn btn-default" href="{{url('packages/edit/')}}"><em
                                                    class="fa fa-pencil"></em></a>
                                        <a class="btn btn-danger"><em class="fa fa-trash"></em></a>


                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td> </td>

                            </tr> -->

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

@section('script')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script>
    axios.get('{{url('/oauth/clients')}}')
    .then(response => {
    console.log(response.data);
    drawTable(response.data);
    });

    function drawTable(data) {
        for (var i = 0; i < data.length; i++) {
            drawRow(data[i]);
        }
    }

    function drawRow(rowData) {
        var row = $("<tr />")
        $("#clientlist").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
        row.append($("<td align=\"center\">"
            +"<a class=\"btn btn-default\" href=\"{{url('packages/edit/')}}\">"
            +"<em class=\"fa fa-pencil\"></em></a> "
            +"<a class=\"btn btn-danger\"><em class=\"fa fa-trash\"></em>"
            +"</a>"
            +"</td>"));
        row.append($("<td>" + rowData.name + "</td>"));
        row.append($("<td>" + rowData.secret + "</td>"));
        row.append($("<td>" + rowData.redirect + "</td>"));
        row.append($("<td>" + rowData.created_at + "</td>"));
        row.append($("<td>" + rowData.user_id + "</td>"));
    }

    </script>
@endsection
