@php 
if(\Auth::user()->hasRole('siteuser'))
    $view = "dashboard";
else
    $view = "backend";
@endphp

@extends('layouts.'.$view)

@section('title')
Meta data
@endsection

@section('css')
<!-- 
    <style>
        .entry:not(:first-of-type)
        {
            margin-top: 10px;
        }

        .glyphicon
        {
            font-size: 12px;
        }
    </style>
 -->                    <!--put your css here-->
@endsection

@section('script')
<!-- 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     -->
    <script>
        $(function() {
            setTimeout(function() {
                $("#successMessage").fadeOut(2000);
            }, 1000);
        });

    /*    function append_child(main_box)
        {
            var limit = (main_box == 'main_box') ? 11 : 7;
            //save the root element (the <table> element)
            var root = jQuery("#" + main_box);

            var total_children = root.children().length;
            if(total_children >= limit)
            {
                alert('Max limit reached');
                return false;
            }
            //find the template (denoted by the fact that it's hidden unlike the clones) and clone it
            var clonedRow = root.find(".inputRow:hidden").clone(true);
            //insert the cloned row right before the last row (which is the "Add Video" button)
            root.find("#addRow").before(clonedRow);
            //make the cloned row visible
            clonedRow.show();
            if(main_box == 'main_box2')
            {
                total_children = total_children+9;
            }
            clonedRow.find('.counter').html('Field '+total_children);
            //then make all "Remove" buttons visible because there must be at least two input rows now
            root.find(".removeInputButton:hidden").show();
        }

        function  delete_child(hideAppChildSender)
        {
            var thisElement = jQuery(hideAppChildSender);
            thisElement.parent().parent().remove();
        }
        function disable_child(hideAppChildSender,main_box)
        {
            var thisElement = jQuery(hideAppChildSender);
            var elementClass = (main_box == 'main_box2') ? 'numeric_only' : 'alpha_numeric';
            //console.log(thisElement.parent().parent().find('.numeric_only').attr('disabled',true));

            attribute_value = thisElement.parent().parent().find('.'+elementClass).attr('disabled');
            if(attribute_value == undefined)
            {
                thisElement.parent().parent().find('.'+elementClass).attr('disabled',true);
                thisElement.removeClass('btn-danger');
                thisElement.addClass('btn-success');
                thisElement.val('+');
            }
            else
            {
                thisElement.parent().parent().find('.'+elementClass).attr('disabled',false);
                thisElement.removeClass('btn-success');
                thisElement.addClass('btn-danger');
                thisElement.val('- ');
            }

            //thisElement.parent().parent().remove();
        }
        $(function() {
            $('.staticParent').on('keydown', '.numeric_only', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
        })
*/
    </script>
@endsection

@section('heading')
Meta Data <small>settings</small>
@endsection
@section('content')
  <!--       <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Meta Data Form</div>
                    <div class="panel-body">
                        <form  method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group ">
                                    <label for="field1 " class="col-sm-3 control-label">Field 1</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="field1">
                                    </div>
                                </div>
                                <div id="main_box">
                                    <div class="form-group inputRow" style="display:none;">
                                        <label for="field2"  class="col-sm-3 control-label counter">Field 0</label>
                                        <div class="col-sm-4">
                                            <input  type="text" class="form-control alpha_numeric" id="name[]" name="name[]" placeholder="">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="button" value="-&nbsp;" class="btn btn-danger btn-sm " onclick="disable_child(this,'main_box'); return false;">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="button" value="+" class="btn btn-primary btn-sm" onclick="append_child('main_box');">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 2</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" placeholder="">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="button" value="+" class="btn btn-primary btn-sm" onclick="append_child('main_box');">
                                        </div>
                                    </div>
                                    <div id="addRow">
                                    </div>
                                </div>
                                <div id="main_box2">
                                    <div class="form-group inputRow" style="display:none;">
                                        <label for="field3"  class="col-sm-3 control-label counter">Field 0</label>
                                        <div class="col-sm-4 staticParent" >
                                            <input type="number" class="form-control numeric_only" id="field3[]" name="field3[]">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="button" value="-&nbsp;" class="btn btn-danger btn-sm " onclick="disable_child(this,'main_box2'); return false;">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="button" value="+" class="btn btn-primary btn-sm" onclick="append_child('main_box2');">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="field3"  class="col-sm-3 control-label">Field 11</label>
                                        <div class="col-sm-4 staticParent" >
                                            <input type="number" class="form-control numeric_only" id="field3[]" name="field3[]">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="button" value="+" class="btn btn-primary btn-sm" onclick="append_child('main_box2');">
                                        </div>
                                    </div>
                                    <div id="addRow">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div> -->
       
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Meta Data</div>
                    <div class="panel-body">
                        <form  method="POST" action="{{ url('/file/meta/create') }}" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                @if ($errors->has('success'))
                                <div class="form-group " id="successMessage">
                                    <span class="help-block text-center alert-success">
                                        <strong>{{ $errors->first('success') }}</strong>
                                    </span>
                                </div>
                                @endif
                                @if ($errors->has('failure'))
                                <div class="form-group " id="successMessage">
                                    <span class="help-block text-center alert-danger">
                                        <strong>{{ $errors->first('failure') }}</strong>
                                    </span>
                                </div>
                                @endif
                                <div class="form-group ">
                                    <label for="field1 " class="col-sm-3 control-label"></label>
                                    <div class="col-sm-2 text-center">
                                        <strong><u>NAME</u></strong>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <strong><u>VALUES</u></strong>
                                    </div>
                                @if($view == 'backend')
                                    <div class="col-sm-4 text-center">
                                        <strong><u>FIXED</u></strong>
                                    </div>
                                @endif
                                </div>
                                <div class="form-group ">
                                    <label for="field1 " class="col-sm-3 control-label">Field 1</label>
                                    <div class="col-sm-2">
                                        Deletion Period
                                    </div>
                                    <div class="col-sm-4">
                                        24 Hours
                                    </div>
                                @if($view == 'backend')
                                    <div class="col-sm-3">
                                        <input type="checkbox" checked disabled>
                                    </div>
                                @endif
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-6 control-label"><u>Text Fields</u></label>
                                </div>
                                <div class="form-group{{ $errors->has('field2') ? ' has-error' : '' }}">
                                        <label for="field2"  class="col-sm-3 control-label">Field 2</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.0')}}" value="{{old('name.0')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.0')}}" placeholder="Comma separated values">
                                            @if ($errors->has('field2'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field2') }}</strong>
                                                </span>
                                            @endif
                                        </div>                                        
                                    @if($view == 'backend')
                                        <div class="col-sm-3">
                                            <input id="fixed[2]" name="fixed[2]" type="checkbox" >
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('field3') ? ' has-error' : '' }}">
                                        <label for="field3"  class="col-sm-3 control-label">Field 3</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.1')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.1')}}" placeholder="Comma separated values">
                                            @if ($errors->has('field3'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field3') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[3]" name="fixed[3]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('field4') ? ' has-error' : '' }}">
                                        <label for="field4"  class="col-sm-3 control-label">Field 4</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.2')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.2')}}" placeholder="Comma separated values">
                                            @if ($errors->has('field4'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field4') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[4]" name="fixed[4]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('field5') ? ' has-error' : '' }}">
                                        <label for="field5"  class="col-sm-3 control-label">Field 5</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.3')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.3')}}" placeholder="Comma separated values">
                                            @if ($errors->has('field5'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field5') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[5]" name="fixed[5]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('field6') ? ' has-error' : '' }}">
                                        <label for="field6"  class="col-sm-3 control-label">Field 6</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.4')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.4')}}" placeholder="Comma separated values">
                                            @if ($errors->has('field6'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field6') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[6]" name="fixed[6]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('field7') ? ' has-error' : '' }}">
                                        <label for="field7"  class="col-sm-3 control-label">Field 7</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.5')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.5')}}" placeholder="Comma separated values">
                                            @if ($errors->has('field7'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field7') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[7]" name="fixed[7]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('field8') ? ' has-error' : '' }}">
                                        <label for="field8"  class="col-sm-3 control-label">Field 8</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.6')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.6')}}" placeholder="Comma separated values">
                                            @if ($errors->has('field8'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field8') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[8]" name="fixed[8]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('field9') ? ' has-error' : '' }}">
                                        <label for="field9"  class="col-sm-3 control-label">Field 9</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.7')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.7')}}" placeholder="Comma separated values">
                                            @if ($errors->has('field9'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field9') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[9]" name="fixed[9]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('field10') ? ' has-error' : '' }}">
                                        <label for="field10"  class="col-sm-3 control-label">Field 10</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.8')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.8')}}" placeholder="Comma separated values">
                                            @if ($errors->has('field10'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field10') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[10]" name="fixed[10]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                
                                <div class="form-group">
                                   <label class="col-sm-6 control-label"><u>Numeric Fields</u></label>
                                </div>
                                <div class="form-group{{ $errors->has('field11') ? ' has-error' : '' }}">
                                        <label for="field11"  class="col-sm-3 control-label">Field 11</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.9')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.9')}}" placeholder="Comma separated numeric values">
                                            @if ($errors->has('field11'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field11') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[11]" name="fixed[11]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('field12') ? ' has-error' : '' }}">
                                        <label for="field12"  class="col-sm-3 control-label">Field 12</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.10')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.10')}}" placeholder="Comma separated numeric values">
                                            @if ($errors->has('field12'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field12') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[12]" name="fixed[12]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('field13') ? ' has-error' : '' }}">
                                        <label for="field13"  class="col-sm-3 control-label">Field 13</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.11')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.11')}}" placeholder="Comma separated numeric values">
                                            @if ($errors->has('field13'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field13') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[13]" name="fixed[13]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('field14') ? ' has-error' : '' }}">
                                        <label for="field14"  class="col-sm-3 control-label">Field 14</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.12')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.12')}}" placeholder="Comma separated numeric values">
                                            @if ($errors->has('field14'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field14') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[14]" name="fixed[14]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('field15') ? ' has-error' : '' }}">
                                        <label for="field15"  class="col-sm-3 control-label">Field 15</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[]" name="name[]" value="{{old('name.13')}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[]" name="values[]" value="{{old('values.13')}}" placeholder="Comma separated numeric values">
                                            @if ($errors->has('field15'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field15') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                            <div class="col-sm-3">
                                                <input id="fixed[15]" name="fixed[15]" type="checkbox" >
                                            </div>
                                        @endif
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
@endsection