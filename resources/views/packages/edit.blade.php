@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Package
            </div>
            <form action="{{url('packages/edit/'.$package->id)}}" method="post" id="frmEditPackages" name="frmEditPackages" class="form-horizontal" novalidate="">
                {{ csrf_field() }}
               
			   <div class="panel-body">

                    <div class="form-group error">
                        <label for="inputName" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-4">
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
                        <label for="inputDetail" class="col-sm-3 control-label">Start Date</label>
                        <div class="col-sm-4">
						    <input type="datetime" name="createdate" value="{{ date("Y-m-d h:i:s", strtotime($package->start_date)) }}" class="form-control">
						 </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">End Date</label>
                        <div class="col-sm-4">
						    <input type="datetime" name="enddate" value="{{ date("Y-m-d h:i:s", strtotime($package->end_date)) }}" class="form-control">
						 </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Files Count</label>
                        <div class="col-sm-4">
						    <input type="text" name="filecount" value="{{$package->files_count}}" class="form-control">
						 </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Reset Count</label>
                        <div class="col-sm-4">
						    <input type="text" name="resetcount" value="{{$package->reset_count}}" class="form-control">
						 </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Price</label>
                        <div class="col-sm-4">
						    <input type="text" name="price" value="{{$package->price}}" class="form-control">
						 </div>
                    </div>

                    <div class="form-group">
						<label for="discount" class="col-sm-3 control-label">discount</label>
						<div class="col-sm-4">
						<select id="discount" name="discount" class="form-control">
							<option value="0">Select discount for this package</option>
							@php $selected="";@endphp
							@foreach ($discounts as $disc)
							@php if($disc->id==$discount->id) {$selected="selected";}@endphp
							<option value="{{ $disc->id }}" {{$selected}}>{{ $disc->name }}</option>
							@php $selected="";@endphp
							@endforeach 
							
						</select>
						</div>
                        <!-- <a href="#dissc" data-toggle="collapse" class="btn btn-info">Edit disconunt for this package</a>-->
                    </div>
                  <!-- <div id="dissc" class="collapse">
                       <table border="1" width="75%"><tr><td>
					   <div class="form-group">
                       <label for="discname" class="col-sm-3 control-label">Name</label>
                       <div class="col-sm-4">
                           <input type="text" name="discname" value="{{$discount->name}}" class="form-control">
                       </div>
                       </div>
                       <div class="form-group">
                       <label for="discountdesc" class="col-sm-3 control-label">Description</label>
                       <div class="col-sm-4">
                           <textarea class="form-control" rows="5" id="discountdesc" name="discountdesc">{{$discount->description}}</textarea>
                       </div>
                       </div>
                       <div class="form-group">
                       <label for="duration" class="col-sm-3 control-label">duration</label>
                       <div class="col-sm-4">
                           <input type="text" name="duration" value="{{$discount->duration}}" class="form-control">
                       </div>
                       </div>
                       <div class="form-group">
                       <label for="amount" class="col-sm-3 control-label">Amount</label>
                       <div class="col-sm-4">
                           <input type="text" name="amount" value="{{$discount->amount}}" class="form-control">
                       </div>
                       </div>
                        <div class="form-group">
                       <label for="newstartdate" class="col-sm-3 control-label">start date</label>
                       <div class="col-sm-4">
                           <input type="datetime" value="{{ date("Y-m-d h:i:s", strtotime($discount->start_date)) }}" name="newstartdate" class="form-control">
                       </div>
                       </div>
                        <div class="form-group">
                       <label for="newenddate" class="col-sm-3 control-label">End Date</label>
                       <div class="col-sm-4">
                           <input type="datetime" value="{{ date("Y-m-d h:i:s", strtotime($discount->end_date)) }}" name="newenddate" class="form-control">
                       </div>
                       </div>
                        <div class="form-group">
                       <label for="newtype" class="col-sm-3 control-label">Type</label>
                       <div class="col-sm-4">
                           <input type="text" name="newtype" value="{{$discount->type}}" class="form-control">
                       </div>
                       </div>
                        <div class="form-group">
                       <label for="discountstatus" class="col-sm-3 control-label">Discount Status</label>
                       <div class="col-sm-4">
						<select id="discountstatus" name="discountstatus" class="form-control">
							<option value="0"{{ ($discount->status == 0 ? 'selected="selected"' : '') }}>Disabled</option>
							<option value="1" {{ ($discount->status == 0 ? 'selected="selected"' : '') }}>Enabled</option>
						</select>
                       </div>
                       </div>
                </td></tr></table>
				</div>-->

                    <div class="form-group">
						<label for="status" class="col-sm-3 control-label"> Package Status</label>
						<div class="col-sm-4">
						<select id="status" name="status" class="form-control">
							<option value="0"{{ ($package->status == 0 ? 'selected="selected"' : '') }}>Disabled</option>
							<option value="1" {{ ($package->status == 1 ? 'selected="selected"' : '') }}>Enabled</option>
						</select>
						</div>
                    </div>


                    <div class="frmPackage-footer"></div>
                </div>
                <div class="panel-footer ">

                    <span class="pull-right">
                        <button type="submit" class="btn btn-primary " id="btn-save" value="Save">Save changes</button>
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