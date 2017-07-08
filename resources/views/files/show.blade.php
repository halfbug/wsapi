@php 
if(\Auth::user()->hasRole('siteuser'))
    $view = "dashboard";
else
    $view = "backend";
@endphp

@extends('layouts.'.$view)

@section('heading')
File
@endsection

@section('title')
File
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title " style="display: inline">File detail</h3>
                @can('startprocessing', \App\File::class)
                <span class="pull-right">
                    @if($file->getStatus() ==  "Uploaded")
                        <button class="btn btn-primary " onClick="{{ url("/file/startprocessing/".$file->id) }}">Start Processing</button>
                    @elseif($file->getStatus() == "In Progress")
                        <button class="btn btn-primary " data-toggle="modal" data-target="#myModal">Upload Processed File</button>
                    @endif
                </span>
                @endcan
                <div class="clearfix"></div>
            </div>
               
            <div class="panel-body">

                <div class=" col-md-9 col-lg-9 "> 
                    <table class="table">
                      <tbody>
                        <tr>
                            <td>File Name:</td>
                            <td>{{$file->name}}</td>
                        </tr>
                        @if($file->user)
                        <tr>
                            <td>Uploaded by:</td>
                            <td>{{$file->user->name}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Uploaded on:</td>
                            <td>{{$file->created_at}}</td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td>{{$file->getStatus()}}</td>
                        </tr>
                        <tr>
                            <td>File Format:</td>
                            <td>{{ "No File format yet" }}</td>
                        </tr>
                        <tr>
                            <td>Meta:</td>
                            <td>{{ "No meta-data yet" }}</td>
                        </tr>
                      </tbody>
                    </table>
                </div>

            </div>
            
            <div class="panel-footer ">

                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form  method="post" action="{{ url('/file/'.$file->id) }}" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Processed File</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="file"  class="col-sm-3 control-label">File</label>
                        <div class="col-sm-9">
                            <input  id="file" name="file" type="file" >
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="fileid" value="{{ $file->id }}">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                </div> 
            </form>
        </div>

    </div>
</div>


@endsection
