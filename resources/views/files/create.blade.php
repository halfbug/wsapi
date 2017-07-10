@php 
//if(\Auth::user()->hasRole('siteuser'))
$view = "dashboard";
//else
//  $view = "backend";
@endphp

@extends('layouts.frontend')

@section('title')
Upload File
@endsection

@section('heading')
Upload Files
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset("css/jquery.fileupload.css")}}">
<link rel="stylesheet" href="{{ asset("css/jquery.fileupload-ui.css")}}">
<style>

    .wizard {
        margin: 20px auto;
        background: #fff;
    }

    .wizard .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

    .connecting-line {
        height: 2px;
        background: #e0e0e0;
        position: absolute;
        width: 80%;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: 50%;
        z-index: 1;
    }

    .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
        color: #555555;
        cursor: default;
        border: 0;
        border-bottom-color: transparent;
    }

    span.round-tab {
        width: 70px;
        height: 70px;
        line-height: 70px;
        display: inline-block;
        border-radius: 100px;
        background: #fff;
        border: 2px solid #e0e0e0;
        z-index: 2;
        position: absolute;
        left: 0;
        text-align: center;
        font-size: 25px !important;
    }
    span.round-tab i{
        color:#555555;
        font-size: 25px;
    }
    .wizard li.active span.round-tab {
        background: #fff;
        border: 2px solid #5bc0de;

    }
    .wizard li.active span.round-tab i{
        color: #5bc0de;
    }

    span.round-tab:hover {
        color: #333;
        border: 2px solid #333;
    }

    .wizard .nav-tabs > li {
        width: 25%;
    }

    .wizard li:after {
        content: " ";
        position: absolute;
        left: 46%;
        opacity: 0;
        margin: 0 auto;
        bottom: 0px;
        border: 5px solid transparent;
        border-bottom-color: #5bc0de;
        transition: 0.1s ease-in-out;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 46%;
        opacity: 1;
        margin: 0 auto;
        bottom: 0px;
        border: 10px solid transparent;
        border-bottom-color: #5bc0de;
    }

    .wizard .nav-tabs > li a {
        width: 70px;
        height: 70px;
        margin: 20px auto;
        border-radius: 100%;
        padding: 0;
    }

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

    .wizard .tab-pane {
        position: relative;
        padding-top: 50px;
    }

    .wizard h3 {
        margin-top: 0;
    }

    @media( max-width : 585px ) {

        .wizard {
            width: 90%;
            height: auto !important;
        }

        span.round-tab {
            font-size: 16px;
            width: 50px;
            height: 50px;
            line-height: 50px;
        }

        .wizard .nav-tabs > li a {
            width: 50px;
            height: 50px;
            line-height: 50px;
        }

        .wizard li.active:after {
            content: " ";
            position: absolute;
            left: 35%;
        }
    }
</style>
@endsection

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
//        function append_child(main_box)
//        {
//            //save the root element (the <table> element)
//            var root = jQuery("#" + main_box);
//            //find the template (denoted by the fact that it's hidden unlike the clones) and clone it
//            var clonedRow = root.find(".inputRow:hidden").clone(true);
//            //insert the cloned row right before the last row (which is the "Add Video" button)
//            root.find("#addRow").before(clonedRow);
//            //make the cloned row visible
//            clonedRow.show();
//            //then make all "Remove" buttons visible because there must be at least two input rows now
//            root.find(".removeInputButton:hidden").show();
//        }
//        function delete_child(hideAppChildSender)
//        {
//            var thisElement = jQuery(hideAppChildSender);
//
//            //save the root element
//            var root = thisElement.parents("#main_box");
//
//            //find the ancestor <tr> element and remove it from the DOM
//            thisElement.parent().parent().remove();
//            //find all remaining "Remove" buttons in this table that are still visible
//            var removeButtonsRemaining = root.find(".removeInputButton:visible");
//            //if the number of visible "Remove" buttons is (less than or equal to) one, then hide it
//            //because that means there's only one input row left, which means that you can't remove it
//            if (removeButtonsRemaining.size() <= 1) {
//                removeButtonsRemaining.hide();
//            }
//        }
    $(document).ready(function () {
        //Initialize tooltips
        $('.nav-tabs > li a[title]').tooltip();

        //Wizard
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

            var $target = $(e.target);

            if ($target.parent().hasClass('disabled')) {
                return false;
            }
        });

        $(".next-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);

        });
        $(".prev-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            prevTab($active);

        });
    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }
    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }
</script>

<script src="{{ asset("js/jquery.ui.widget.js") }}"></script>
<script src="{{ asset("js/tmpl.min.js")}}"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>

<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{ asset("js/jquery.iframe-transport.js") }}"></script>
<!-- The basic File Upload plugin -->
<script src="{{ asset("js/jquery.fileupload.js") }}"></script>
<!-- The File Upload processing plugin -->
<script src="{{ asset("js/jquery.fileupload-process.js") }}"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{{ asset("js/jquery.fileupload-image.js") }}"></script>
<!-- The File Upload audio preview plugin -->
<script src="{{ asset("js/jquery.fileupload-audio.js") }}"></script>
<!-- The File Upload video preview plugin -->
<script src="{{ asset("js/jquery.fileupload-video.js") }}"></script>
<!-- The File Upload validation plugin -->
<script src="{{ asset("js/jquery.fileupload-validate.js") }}"></script>
<script src="{{ asset("js/jquery.fileupload-ui.js")}}"></script>
<script src="{{ asset("js/main.js")}}"></script>



@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 ">
        <!--            <div class="panel panel-default">
                        <div class="panel-heading">Upload File</div>
                        <div class="panel-body">
                
                    
        
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                           
                        </div>  
                      </form>
                   </div>
                   </div>-->

        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        @if (Auth::guest())
                            <li role="presentation" class="active">
                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Register with us">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                                </a>
                            </li>
                        @else
                            <li role="presentation" class="active">
                                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Upgrade Membership">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-user"></i>
                                </span>
                                </a>
                            </li>
                        @endif

                        <li role="presentation" class=" disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Upload Files">

                                <span class="round-tab">

                                    <i class="glyphicon glyphicon-open-file"></i>
                                </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Set Meta Data">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                </span>
                            </a>
                        </li>


                        <li role="presentation" class="disabled">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                <span class="round-tab">
                                    <i class="glyphicon glyphicon-ok"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!--<form role="form">-->
                <div class="tab-content">
                    <div class="tab-pane " role="tabpanel" id="step2">
                        <h3>Step 2 : Select and Upload files</h3>

                       <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="photos[]" data-url="/upload" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>

                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <!--<li><button type="button" class="btn btn-warning next-step">Upload</button></li>-->
                            <li><button type="button" id="step1btn"  disabled="true" class="btn btn-primary next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <h3>Step 3 : Set Meta Data</h3>
                        <form  method="post" action="{{url('/file/create')}}" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}


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
                                            <input type="button" value="-&nbsp;" class="btn btn-danger btn-sm " onclick="delete_child(this);
                                                    return false;">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="button" value="+" class="btn btn-primary btn-sm" onclick="append_child('main_box');">
                                        </div>
                                    </div>
<!--                                    <div class="form-group">
                                        <label for="file"  class="col-sm-3 control-label">File</label>
                                        <div class="col-sm-4">
                                            <input type="file" id="photo[]" name="photo[]" class="input-file">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="button" value="+" class="btn btn-primary btn-sm" onclick="append_child('main_box');">
                                        </div>


                                    </div>
                                    <div id="addRow">

                                    </div>-->
                        
                                </div>
                        
                            </div>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                            </ul>
                            </form>
                    
                    </div>
                    @if (Auth::guest())
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <h3>Step 1 : Stay Connected!!</h3>
                        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <input type="hidden" name="role" value="{{\App\Role::siteuser()}}">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                        <ul class="list-inline pull-right">
                            {{--<li><button type="button" class="btn btn-default prev-step">Previous</button></li>--}}
                            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    @else
                     <div class="tab-pane active" role="tabpanel" id="step1">
                        <h3>Step 1 : Upgrade Membership!!</h3>
                        <p> You can upgrade membership by select our package. <br>
                            <a href="{{url("pricing")}}">Click here</a> to see latest offered packages. </p>
                        <ul class="list-inline pull-right">

                            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    @endif
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <h3>Complete</h3>
                        <p>You have successfully completed all steps.</p>
                        <p> Wait for about 24hours.</p>
                        <p>you will see yours processed file in notification area.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                </form>
            </div>
        </section>
    </div>
</div>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

@endsection

