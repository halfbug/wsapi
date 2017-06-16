@php 
if(\Auth::user()->hasRole('siteuser'))
    $view = "dashboard";
else
    $view = "backend";
@endphp

@extends('layouts.'.$view)

@section('title')
Upload File
@endsection

@section('heading')
Upload Files
@endsection

@section('style')
@endsection

@section('script')
    <script>
        function append_child(main_box)
        {
            //save the root element (the <table> element)
            var root = jQuery("#" + main_box);
            //find the template (denoted by the fact that it's hidden unlike the clones) and clone it
            var clonedRow = root.find(".inputRow:hidden").clone(true);
            //insert the cloned row right before the last row (which is the "Add Video" button)
            root.find("#addRow").before(clonedRow);
            //make the cloned row visible
            clonedRow.show();
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

@section('content')
    <div class="row">
    	<div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Upload File</div>
                <div class="panel-body">
        
            <form  method="post" action="{{url('/file/create')}}" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
         <!--       <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload File</h4>
                    <a href="#_" class="myclass">hello</a>
                </div>
-->
                <div class="modal-body">
                    <div class="form-grop" >
                        <label for="field1 " class="col-sm-3 control-label">Deletion period</label>
                        <div class="col-sm-9">
                            <label for="field1 " class="col-sm-3 control-label">24 hours</label>
                        </div>
                        
                    </div>

                    <div class="form-group ">
                        <label for="field2 " class="col-sm-3 control-label">Field 2</label>
                        <div class="col-sm-6">
                            <select class="form-control " id="field1">
                                <option value="wood">wood</option>
                                <option value="grass">grass</option>
                                <option value="stone">stone</option>
                                <option value="water">water</option>
                                <option value="glass">glass</option>
                                <option value="grass2">grass2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="field3 " class="col-sm-3 control-label">Field 3</label>
                        <div class="col-sm-6">
                            <select class="form-control " id="field1">
                                <option value="circle">circle</option>
                                <option value="rectangle">rectangle</option>
                                <option value="line">line</option>
                                <option value="oval">oval</option>
                                <option value="square">square</option>
                                <option value="cube">cube</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="field4 " class="col-sm-3 control-label">Field 4</label>
                        <div class="col-sm-6">
                            <select class="form-control " id="field1">
                                <option value="handmade">handmade</option>
                                <option value="fine cut">fine cut</option>
                                <option value="machine general">machine general</option>
                             </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="field5 " class="col-sm-3 control-label">Field 5</label>
                        <div class="col-sm-6">
                            <select class="form-control " id="field1">
                                <option value="chair">chair</option>
                                <option value="sofa">sofa</option>
                                <option value="dishwasher">dishwasher</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="field6 " class="col-sm-3 control-label">Field 6</label>
                        <div class="col-sm-6">
                            <select class="form-control " id="field1">
                                <option value="green">green</option>
                                <option value="yellow">yellow</option>
                                <option value="red">red</option>
                                <option value="blue">blue</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="field111 " class="col-sm-3 control-label">Field 11</label>
                        <div class="col-sm-6">
                            <select class="form-control " id="field1">
                                <option value="1">1</option>
                                <option value="3">3</option>
                                <option value="3.15">3.15</option>
                                <option value="34">34</option>
                                <option value="52">52</option>
                                <option value="42">42</option>
                                <option value="21.22">21.22</option>
                             </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="field12 " class="col-sm-3 control-label">Field 12</label>
                        <div class="col-sm-6">
                            <select class="form-control " id="field1">
                                <option value="11">11</option>
                                <option value="0">0</option>
                                <option value="001">001</option>
                                <option value="928">928</option>
                                <option value="002">002</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="field13 " class="col-sm-3 control-label">Field 13</label>
                        <div class="col-sm-6">
                            <select class="form-control " id="field1">
                                <option value="3">3</option>
                                <option value="22">22</option>
                                <option value="1">1</option>
                                <option value="56">56</option>
                                <option value="34">34</option>
                            </select>
                        </div>
                    </div>


                    <div id="main_box">
                        <div class="form-group inputRow" style="display:none;">
                            <label for="file"  class="col-sm-3 control-label">File</label>
                            <div class="col-sm-4">
                                <input type="file" id="photo[]" name="photo[]" class="input-file">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" value="-&nbsp;" class="btn btn-danger btn-sm " onclick="delete_child(this); return false;">
                            </div>
                            <div class="col-sm-1">
                                <input type="button" value="+" class="btn btn-primary btn-sm" onclick="append_child('main_box');">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file"  class="col-sm-3 control-label">File</label>
                            <div class="col-sm-4">
                                <input type="file" id="photo[]" name="photo[]" class="input-file">
                                             </div>
                            <div class="col-sm-2">
                                <input type="button" value="+" class="btn btn-primary btn-sm" onclick="append_child('main_box');">
                            </div>


                        </div>
                        <div id="addRow">

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
        </div>
@endsection

