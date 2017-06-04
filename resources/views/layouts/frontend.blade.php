<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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



    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>File Processor - @yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/modern-business.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')
</head>

<body>

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
<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}"> {{ config('app.name', 'File Processor') }}</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{url('/about')}}">About</a>
                </li>
                <li>
                    <a href="{{url('/services')}}">Services</a>
                </li>
                <li>
                    <a href="{{url('/pricing')}}">Pricing Table</a>
                </li>
                <li>
                    <a href="{{url('/contact')}}">Contact</a>
                </li>
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        @if (Route::has('login'))

                            @if (Auth::check())
                                <li> <a href="{{ url('/home') }}">Dashboard</a></li>
                            @else
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/register') }}">Register</a></li>
                            @endif

                        @endif

                    </ul>
                </li>

                <li><button type="button" class="btn btn-info navbar-top-links" style="margin-top: 10px" title="file upload"data-toggle="modal" data-target="#myModal"><i class="fa fa-upload"></i></button></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
@if (\Request::is('/'))
    <!-- Header Carousel -->
    <div class="text-center jumbotron">
        
        <h1>Welcome to a file processing tool</h1>
        <p>You can upload a single or multiple files at once</p>
        
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload"></i> Upload Now</button>
        <p>you can even use our <a href="{{url('api_doc')}}" >Api</a> service.</p>
        
        
    </div>
@endif
<br>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form  method="post" action="" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload File</h4>
                    <a href="#_" class="myclass">hello</a>
                </div>

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
                            <div class="col-sm-6">
                                <input type="file" id="photo[]" name="photo[]" class="input-file"> <input type="button" value="Remove" class="btn btn-danger btn-mini" onclick="delete_child(this); return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file"  class="col-sm-3 control-label">File</label>
                            <div class="col-sm-6">
                                <input type="file" id="photo[]" name="photo[]" class="input-file"> <input type="button" value="Add More" class="btn btn-primary btn-mini" onclick="append_child('main_box');">
                            </div>
                        </div>
                        <div id="addRow">

                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>

                </div>  </form>
        </div>

    </div>
</div>



<!-- Page Content -->
<div class="container">

    <!-- Marketing Icons Section -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @yield('heading')
            </h1>
        </div>
    </div>
    @yield('content')

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; File Processor 2017</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="{{ asset('js/jquery.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Script to Activate the Carousel -->
@yield('script')

</body>

</html>
