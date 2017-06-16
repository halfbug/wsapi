@extends('layouts.dashboard')

@section('title')
    File Format
@endsection


@section('css')
          <style>
              .checkbox {
                  padding-left: 20px; }
              .checkbox label {
                  display: inline-block;
                  position: relative;
                  padding-left: 5px; }
              .checkbox label::before {
                  content: "";
                  display: inline-block;
                  position: absolute;
                  width: 17px;
                  height: 17px;
                  left: 0;
                  margin-left: -20px;
                  border: 1px solid #cccccc;
                  border-radius: 3px;
                  background-color: #fff;
                  -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
                  -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
                  transition: border 0.15s ease-in-out, color 0.15s ease-in-out; }
              .checkbox label::after {
                  display: inline-block;
                  position: absolute;
                  width: 16px;
                  height: 16px;
                  left: 0;
                  top: 0;
                  margin-left: -20px;
                  padding-left: 3px;
                  padding-top: 1px;
                  font-size: 11px;
                  color: #555555; }
              .checkbox input[type="checkbox"] {
                  opacity: 0; }
              .checkbox input[type="checkbox"]:focus + label::before {
                  outline: thin dotted;
                  outline: 5px auto -webkit-focus-ring-color;
                  outline-offset: -2px; }
              .checkbox input[type="checkbox"]:checked + label::after {
                  font-family: 'FontAwesome';
                  content: "\f00c"; }
              .checkbox input[type="checkbox"]:disabled + label {
                  opacity: 0.65; }
              .checkbox input[type="checkbox"]:disabled + label::before {
                  background-color: #eeeeee;
                  cursor: not-allowed; }
              .checkbox.checkbox-circle label::before {
                  border-radius: 50%; }
              .checkbox.checkbox-inline {
                  margin-top: 0; }

              .checkbox-primary input[type="checkbox"]:checked + label::before {
                  background-color: #428bca;
                  border-color: #428bca; }
              .checkbox-primary input[type="checkbox"]:checked + label::after {
                  color: #fff; }

              .checkbox-danger input[type="checkbox"]:checked + label::before {
                  background-color: #d9534f;
                  border-color: #d9534f; }
              .checkbox-danger input[type="checkbox"]:checked + label::after {
                  color: #fff; }

              .checkbox-info input[type="checkbox"]:checked + label::before {
                  background-color: #5bc0de;
                  border-color: #5bc0de; }
              .checkbox-info input[type="checkbox"]:checked + label::after {
                  color: #fff; }

              .checkbox-warning input[type="checkbox"]:checked + label::before {
                  background-color: #f0ad4e;
                  border-color: #f0ad4e; }
              .checkbox-warning input[type="checkbox"]:checked + label::after {
                  color: #fff; }

              .checkbox-success input[type="checkbox"]:checked + label::before {
                  background-color: #5cb85c;
                  border-color: #5cb85c; }
              .checkbox-success input[type="checkbox"]:checked + label::after {
                  color: #fff; }

          </style>          <!--put your css here-->
@endsection

@section('script')
                    <!--put your script here-->
@endsection

@section('heading')
Upload File
@endsection


@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Please upload a file</div>
                <div class="panel-body">

                    <form  method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                           <div class="modal-body">
                            <div class="col-md-4">
                                <fieldset>

                                    <p>
                                        Allow a specific file
                                    </p>
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox1" type="checkbox">
                                        <label for="checkbox1">
                                            Document
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox2" type="checkbox" >
                                        <label for="checkbox2">
                                            Spreadsheet
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox3" type="checkbox" checked="">
                                        <label for="checkbox3">
                                            PDF
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox4" type="checkbox">
                                        <label for="checkbox4">
                                            Video
                                        </label>
                                    </div>
                          </fieldset>
                            </div>
                               <div class="col-md-4">
                                   <fieldset>

                                       <p>
                                           Accordian button
                                       </p>
                                       <div class="checkbox checkbox-primary">
                                           <input id="checkbox5" type="checkbox">
                                           <label for="checkbox5">
                                               Presentation
                                           </label>
                                       </div>
                                       <div class="checkbox checkbox-primary">
                                           <input id="checkbox6" type="checkbox" >
                                           <label for="checkbox6">
                                               Drawing
                                           </label>
                                       </div>
                                       <div class="checkbox checkbox-primary">
                                           <input id="checkbox7" type="checkbox" checked="">
                                           <label for="checkbox7">
                                               Image
                                           </label>
                                       </div>
                                       <div class="checkbox checkbox-primary">
                                           <input id="checkbox8" type="checkbox">
                                           <label for="checkbox8">
                                               Audio
                                           </label>
                                       </div>
                                   </fieldset>
                               </div>
</div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection