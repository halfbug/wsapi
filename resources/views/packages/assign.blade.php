@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 ">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Assign Package To User
            </div>
            <form action="{{url('packages/assign')}}" method="post" id="frmPackagesAssign" name="frmPackagesAssign" class="form-horizontal" novalidate="">
                {{ csrf_field() }}
               
			   <div class="panel-body">


                    <div class="form-group">
						<label for="discount" class="col-sm-3 control-label">Packages</label>
						<div class="col-sm-9">
						<select id="pkg" name="pkg" class="form-control">
							<option value="0">select pkge 1</option>
							<option value="1">select pkge 2</option>
						</select>
						</div>
                    </div>

                    <div class="form-group">
						<label for="status" class="col-sm-3 control-label">User</label>
						<div class="col-sm-9">
						<select id="status" name="status" class="form-control">
							<option value="0">user1 </option>
							<option value="1" selected>user2 </option>
						</select>
						</div>
                    </div>


                    <div class="frmPackage-footer"></div>
                </div>
                <div class="panel-footer ">

                    <span class="pull-right">
                        <button type="submit" class="btn btn-primary " id="btn-save" value="Submit">Save changes</button>
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