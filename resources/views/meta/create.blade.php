@extends('layouts.dashboard')

@section('title')
Meta data
@endsection

@section('css')

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
                    <!--put your css here-->
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function append_child(main_box)
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

        /*function  delete_child(hideAppChildSender)
        {
            var thisElement = jQuery(hideAppChildSender);
            thisElement.parent().parent().remove();
        }*/
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
                                            <input  type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
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
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
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
                    <div class="panel-heading">Meta Data Form</div>
                    <div class="panel-body">
                        <form  method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group ">
                                    <label for="field1 " class="col-sm-3 control-label"></label>
                                    <div class="col-sm-2 text-center">
                                        <strong><u>NAME</u></strong>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <strong><u>VALUES</u></strong>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="field1 " class="col-sm-3 control-label">Field 1</label>
                                    <div class="col-sm-2">
                                        Deletion Period
                                    </div>
                                    <div class="col-sm-4">
                                        24 Hours
                                    </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-6 control-label"><u>Text Fields</u></label>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 2</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 3</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 4</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 5</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 6</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 7</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 8</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 9</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 10</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                
                                <div class="form-group">
                                   <label class="col-sm-6 control-label"><u>Numeric Fields</u></label>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 11</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 12</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 13</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 14</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 15</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="field2[]" name="field2[]">
                                        </div>
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