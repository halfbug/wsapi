<!DOCTYPE html>
<html lang="en">

<head>
   
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


<!-- Navigation -->
@include('frontend.navbar')
@if (\Request::is('/'))
    <!-- Header Carousel -->
    <div class="text-center jumbotron">
        
        <h1>Welcome to a file processing tool</h1>
        <p>You can upload a single or multiple files at once</p>
        
        <button type="button" class="btn btn-info btn-lg" onclick="window.location = '{{ url("file/create") }}'" ><i class="fa fa-upload"></i> Upload Now</button>
        <p>you can even use our <a href="{{url('api-manager/')}}" >Api</a> service.</p>
        
        
    </div>
@endif
<br>







<!-- Page Content -->
<div class="container">

    <!-- Marketing Icons Section -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @yield('heading')
            </h1>
            @if (!(\Request::is('/')))
             <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="active"><i class="fa fa-file"></i></li>
                </ol>
            @endif
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
 <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}"></script>-->

<!-- Script to Activate the Carousel -->
@yield('script')

</body>

</html>
