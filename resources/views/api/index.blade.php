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

                                <!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createForm"><em class="fa fa-plus"></em> New Client</button>

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
                            @can('performAdmin')
                            <th>User</th>
                            @endcan



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


    <!-- Modal -->
    <div id="createForm" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Client</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" id="addClient" action="{{ url('/oauth/clients') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">User</label>

                            <div class="col-md-6">
                                <select class="form-control" id="user_id" name="user_id" required>
								@foreach($users as $user)
								<option value="{{ $user->id}}">{{ $user->name}}</option>
								@endforeach
								</select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required>


                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Redirect Url</label>

                            <div class="col-md-6">
                                <input id="redirect" type="url" class="form-control" name="redirect" required>


                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="btn_save">
                                    Save
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
                <!--<div class="modal-footer">
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--</div>--}} -->
            </div>

        </div>
    </div>

@endsection

@section('script')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/defiant.min.js')}}"></script>
    <script>
        clients = "";
    axios.get('{{url('/oauth/clients')}}')
    .then(function (response)  {
    clients = response.data;
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
            +"<button class=\"btn btn-default\" id=\"editClient\" value="+rowData.id+">"
            +"<em class=\"fa fa-pencil\"></em></button> "
            +"<a class=\"btn btn-danger\"><em class=\"fa fa-trash\"></em>"
            +"</a>"
            +"</td>"));
        row.append($("<td>" + rowData.name + "</td>"));
        row.append($("<td>" + rowData.secret + "</td>"));
        row.append($("<td>" + rowData.redirect + "</td>"));
        row.append($("<td>" + rowData.created_at + "</td>"));
        @can('performAdmin')
        row.append($("<td>" + rowData.user_id + "</td>"));
        @endcan
    }

    $( document ).ready(function() {
        $("#addClient").submit(function (e) {
//            alert("me here");
            //prevent Default functionality
            e.preventDefault();

            //get the action-url of the form
            var actionurl = e.currentTarget.action;

            axios.post(actionurl,  $("#addClient").serialize())
                .then(function (response) {
                    $("#addClient").hide().before($("<p> Client has been added succefully . </p>"));
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
        $(document).on('click', '#editClient', function (e) {

            $('#createForm').modal('show');
            $(".modal-title").html("Edit Client");
            clientId=$(this).val();
			
            console.log(clients);
            client = JSON.search(clients, '//*[id="'+clientId+'"]');
            console.log(client);

//            axios.post(actionurl,  $("#addClient").serialize())
//                .then(function (response) {
//                    $("#addClient").hide().before($("<p> Client has been added succefully . </p>"));
//                    console.log(response);
//                })
//                .catch(function (error) {
//                    console.log(error);
//                });

        });
    });

    </script>
@endsection
