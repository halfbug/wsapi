@extends('layouts.dashboard')
@section('title')
Files
@endsection
@section('css')

@endsection

@section('heading')
Files<small></small>
@endsection

@section('content')

<div class="">
    <div class="col-md-12 ">

        <table class="table">
            <tr>
            <!--<th>File ip address</th>-->
                <th>File path</th>
                <!--<th>Status</th>-->
                <th>Upload Time</th>
                <th>Actions</th>
            </tr>
            <?php
            foreach ($files as $file) {
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
                    <td><?php echo $file->path; ?></td>
                    <!--<td><?php echo $filestatus; ?></td>-->
                    <td><?php echo $file->created_at; ?></td>
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