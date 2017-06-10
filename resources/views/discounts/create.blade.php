@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 ">
        @php
            if ($state == 'add')
              {
              $discount = new \App\discount();
              $disabled = "disabled";
              }
              else{
              $disabled ="";
              }
        @endphp
        <div class="panel panel-primary">
            <div class="panel-heading">
                Add New Discount
            </div>
              <form action="{{ url('discounts/') }}" class="form-horizontal" novalidate="" method="POST" id="frmDiscount" name="frmDiscount">
                <div class="panel-body">

                            {{ csrf_field() }}
                            <div class="row">

                    <div class="form-group error">
                        <label for="inputName" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control has-error" id="dname" name="dname" placeholder="Discount name" value="{{$discount->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="discountdescription" name="discountdescription" placeholder="discount description" value="{{$discount->description}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Create Date</label>
                        <div class="col-sm-9">
						    <input type="time" name="dcreatedate">
						 </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">End Date</label>
                        <div class="col-sm-9">
						    <input type="time" name="denddate">
						 </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Duration</label>
                        <div class="col-sm-9">
						    <input type="text" name="duration">
						 </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Amount</label>
                        <div class="col-sm-9">
						    <input type="text" name="amount">
						 </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Type</label>
                        <div class="col-sm-9">
						    <input type="text" name="type">
						 </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDetail" class="col-sm-3 control-label">Dsicount Status</label>
                        <div class="col-sm-9">
						    <input type="text" name="discountstatus">
						 </div>
                    </div>


                    <div class="frmPackage-footer"></div>
                </div>
                <div class="panel-footer ">

                    <span class="pull-right">
                        <button type="submit" class="btn btn-primary " id="btn-save" value="{{$state}}">Save changes</button>
                        <button type="button" class="btn btn-warning {{$disabled}}" id="btn-save-discount" value="add">Save changes</button>
                   </span>
                    <div class="clearfix"></div>
                </div>
            </form>

        </div>



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
