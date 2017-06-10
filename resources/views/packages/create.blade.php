@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 ">
        @php
            if ($state == 'add')
              {
              $package = new \App\package();
              $discount= new \App\discount();
			  $disabled = "disabled";
              }
              else{
              $disabled ="";
              }
        @endphp
        <div class="panel panel-primary">
            <div class="panel-heading">
                Add New Package
            </div>
            <form action="{{url('packages/add')}}" method="post" id="frmPackages" name="frmPackages" class="form-horizontal" novalidate="">
                {{ csrf_field() }}
               
			   <div class="panel-body">

                    <div class="form-group error">
                        <label for="inputName" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control has-error" id="name" name="name" placeholder="Package name" value="{{$package->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="description" name="description" placeholder="description" value="{{$package->description}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Create Date</label>
                        <div class="col-sm-9">
						    <input type="datetime" name="createdate" value="<?php echo date("Y-m-d h:i:s",time()); ?>">
						 </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">End Date</label>
                        <div class="col-sm-9">
						    <input type="datetime" name="enddate" value="<?php echo date("Y-m-d h:i:s",time()); ?>">
						 </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">File Count</label>
                        <div class="col-sm-9">
						    <input type="text" name="filecount">
						 </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Reset Count</label>
                        <div class="col-sm-9">
						    <input type="text" name="resetcount">
						 </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Price</label>
                        <div class="col-sm-9">
						    <input type="text" name="price">
						 </div>
                    </div>

                    <div class="form-group">
						<label for="discount" class="col-sm-3 control-label">discount</label>
						<div class="col-sm-9">
						<select id="discount" name="discount" class="form-control">
						 @foreach($discount as $disc)
							<option value="{{ $disc->id }}">{{$disc->duration }}</option>
							@endforeach
						</select>
						</div>
                    </div>

                    <div class="form-group">
						<label for="status" class="col-sm-3 control-label">Status</label>
						<div class="col-sm-9">
						<select id="status" name="status" class="form-control">
							<option value="0">Disabled</option>
							<option value="1">Enabled</option>
						</select>
						</div>
                    </div>


                    <div class="frmPackage-footer"></div>
                </div>
                <div class="panel-footer ">

                    <span class="pull-right">
                        <button type="submit" class="btn btn-primary " id="btn-save" value="{{$state}}">Save changes</button>
                        <input type="hidden" id="package_id" name="package_id" value="{{$package->id}}">
                    </span>
                    <div class="clearfix"></div>
                </div>
            </form>

        </div>


    </div>
</div>


@endsection

@section('heading')
Packages <small>New</small>
@endsection

@section('title')
Packages
@endsection

@section('script')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/package.js')}}"></script>
<script src="{{asset('js/discount.js')}}"></script>
<script src="{{asset('js/document.js')}}"></script>
<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: '#content',
    height: 300,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'undo redo | insert | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
    content_css: '//www.tinymce.com/css/codepen.min.css'
});

tinymce.init({
    selector: '#discount',
    height: 100,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'undo redo | insert | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
    content_css: '//www.tinymce.com/css/codepen.min.css'
});

</script>
@endsection
