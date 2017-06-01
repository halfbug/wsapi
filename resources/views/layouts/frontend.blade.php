<!DOCTYPE html>
<html lang="en">

<head>

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
                <li class="dropdown pull-right top-right">
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


            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
@if (\Request::is('/'))
    <!-- Header Carousel -->

@endif
<br>


<div class="text-center jumbotron">
    <h1>Upload File from here</h1>
    <p></p>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Upload File</button>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form  method="post" action="" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload File</h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="field1 " class="col-sm-3 control-label">Please select</label>
                        <div class="col-sm-9">
                            <select class="form-control " id="field1">
                                <option value="1">Field 1</option>
                                <option value="2">Field 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file"  class="col-sm-3 control-label">File</label>
                        <div class="col-sm-9">
                            <input  id="file" type="file" >
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
