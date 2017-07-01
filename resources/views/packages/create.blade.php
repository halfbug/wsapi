@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add New Package
            </div>
            <form action="{{url('packages/add')}}" method="post" id="frmPackages" name="frmPackages" class="form-horizontal" novalidate="">
                {{ csrf_field() }}
               
			   <div class="panel-body">

                    <div class="form-group error">
                        <label for="inputName" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control has-error" id="name" name="name" placeholder="Package name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="description" name="description" placeholder="description">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Start Date</label>
                        <div class="col-sm-4">
						    <input type="datetime" name="createdate" id="createdate" value="" class="form-control">
						 </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">End Date</label>
                        <div class="col-sm-4">
						    <input type="datetime" name="enddate" id="enddate" value="" class="form-control">
						 </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">File Count</label>
                        <div class="col-sm-4">
						    <input type="text" name="filecount" class="form-control">
						 </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Reset Count</label>
                        <div class="col-sm-4">
						    <input type="text" name="resetcount" class="form-control">
						 </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Price</label>
                        <div class="col-sm-4">
						    <input type="text" name="price" class="form-control">
						 </div>
                    </div>

                    <div class="form-group">
						<label for="discount" class="col-sm-3 control-label">discount</label>
						<div class="col-sm-4">
						<select id="discount" name="discount" class="form-control">
							<option value="0">Select discount for this package</option>
							@foreach ($discounts as $discount) 
							<option value="{{ $discount->id }}">{{ $discount->name }}</option>
							@endforeach 
						</select>
						</div>
                        <a href="#dissc" data-toggle="collapse" class="btn btn-info">New Discount</a>
                    </div>
                   <div id="dissc" class="collapse">

					   <div class="form-group">
                       <label for="discname" class="col-sm-3 control-label">Name</label>
                       <div class="col-sm-4">
                           <input type="text" name="discname" class="form-control">
                       </div>
                       </div>
                       <div class="form-group">
                       <label for="discountdesc" class="col-sm-3 control-label">Description</label>
                       <div class="col-sm-4">
                           <textarea class="form-control" rows="5" id="discountdesc" name="discountdesc"></textarea>
                       </div>
                       </div>
                       <div class="form-group">
                       <label for="duration" class="col-sm-3 control-label">duration</label>
                       <div class="col-sm-4">
                           <input type="text" name="duration" class="form-control">
                       </div>
                       </div>
                       <div class="form-group">
                       <label for="amount" class="col-sm-3 control-label">Amount</label>
                       <div class="col-sm-4">
                           <input type="text" name="amount" class="form-control">
                       </div>
                       </div>
                        <div class="form-group">
                       <label for="newstartdate" class="col-sm-3 control-label">start date</label>
                       <div class="col-sm-4">
                           <input type="datetime" value="" name="newstartdate" id="newstartdate" class="form-control">
                       </div>
                       </div>
                        <div class="form-group">
                       <label for="newenddate" class="col-sm-3 control-label">End Date</label>
                       <div class="col-sm-4">
                           <input type="datetime" value="" name="newenddate" id="newenddate" class="form-control">
                       </div>
                       </div>
                        <div class="form-group">
                       <label for="newtype" class="col-sm-3 control-label">Type</label>
                       <div class="col-sm-4">
							<select name="newtype" class="form-control">
							<option value="1">1</option>
							<option value="3">3</option>
							</select>
						   </div>
                       </div>
                        <div class="form-group">
                       <label for="discountstatus" class="col-sm-3 control-label">Discount Status</label>
                       <div class="col-sm-4">
						<select id="discountstatus" name="discountstatus" class="form-control">
							<option value="0">Disabled</option>
							<option value="1" selected>Enabled</option>
						</select>
                       </div>
                       </div>

				</div>

                    <div class="form-group">
						<label for="status" class="col-sm-3 control-label"> Package Status</label>
						<div class="col-sm-4">
						<select id="status" name="status" class="form-control">
							<option value="0">Disabled</option>
							<option value="1" selected>Enabled</option>
						</select>
						</div>
                    </div>


                    <div class="frmPackage-footer"></div>
                </div>
                <div class="panel-footer ">

                    <span class="pull-right">
                        <button type="submit" class="btn btn-primary " id="btn-save">Save changes</button>
                        <input type="hidden" id="package_id" name="package_id" value="">
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

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
    $( "#createdate" ).datepicker();
  } );
$( function() {
    $( "#enddate" ).datepicker();
  } );
$( function() {
    $( "#newstartdate" ).datepicker();
  } );
$( function() {
    $( "#newenddate" ).datepicker();
  } );
tinymce.init({
    selector: '#description',
    height: 300,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'undo redo | insert | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
//    content_css: '//www.tinymce.com/css/codepen.min.css'
});

</script>
@endsection