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
        function delete_child(hideAppChildSender)
        {
            var thisElement = jQuery(hideAppChildSender);

            //save the root element
            var root = thisElement.parents("#main_box");

            //find the ancestor <tr> element and remove it from the DOM
            thisElement.parent().parent().remove();
            //find all remaining "Remove" buttons in this table that are still visible
            var removeButtonsRemaining = root.find(".removeInputButton:visible");
            //if the number of visible "Remove" buttons is (less than or equal to) one, then hide it
            //because that means there's only one input row left, which means that you can't remove it
            if (removeButtonsRemaining.size() <= 1) {
                removeButtonsRemaining.hide();
            }
        }

    </script>
@endsection

@section('heading')
Meta Data <small>settings</small>
@endsection
@section('content')
        <div class="row">
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
                                            <input type="number" class="form-control" id="field2[]" name="field2[]">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="button" value="-&nbsp;" class="btn btn-danger btn-sm " onclick="delete_child(this); return false;">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="button" value="+" class="btn btn-primary btn-sm" onclick="append_child('main_box');">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="field2"  class="col-sm-3 control-label">Field 2</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="field2[]" name="field2[]">
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
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="field3[]" name="field3[]">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="button" value="-&nbsp;" class="btn btn-danger btn-sm " onclick="delete_child(this); return false;">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="button" value="+" class="btn btn-primary btn-sm" onclick="append_child('main_box2');">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="field3"  class="col-sm-3 control-label">Field 11</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="field3[]" name="field3[]">
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
        </div>
@endsection