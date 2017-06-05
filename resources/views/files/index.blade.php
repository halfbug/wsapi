@extends('layouts.frontend')

@section('content')
	<div class="container">
    <div class="row">
    	<div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Files List</div>
                <div class="panel-body">
					<table class="table">
						<tr>
						<th>File ip address</th>
						<th>File path</th>
						<th>Status</th>
						<th>Creation Time</th>
						</tr>
						<?php foreach($files as $file){
						 if($file->status==1){
							$filestatus="Uploaded";
						}elseif($file->status==2){
							$filestatus="In Progress";
						}elseif($file->status==3){
							$filestatus="Downloaded";
						}else{
							$filestatus="Not Defined";
						}?>

						<tr>
						<td><?php echo $file->path; ?></td>
						<td><?php echo $file->ipaddress;?></td>
						<td><?php echo $filestatus;?></td>
						<td><?php echo $file->created_at;?></td>
						</tr>
						<?php } //endforeach ?>
					</table>
			</div>
           </div>
           </div>  
        </div>
        </div>
@endsection