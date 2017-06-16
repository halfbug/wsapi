    <!-- Navigation -->
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="{{ asset('vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{ asset('dist/css/sb-admin-2.css') }}" rel="stylesheet">
        <!-- Morris Charts CSS -->
        <link href="{{ asset('vendor/morrisjs/morris.css') }}" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js")}}"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js")}}/1.4.2/respond.min.js")}}"></script>
        @yield('css')
    <div id="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span  class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}"> {{ config('app.name', 'File Processor') }}</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-top-links navbar-right">

            <!--                    <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-messages">
                                        <li>
                                            <a href="#">
                                                <div>
                                                    <strong>John Smith</strong>
                                                    <span class="pull-right text-muted">
                                                        <em>Yesterday</em>
                                                    </span>
                                                </div>
                                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#">
                                                <div>
                                                    <strong>John Smith</strong>
                                                    <span class="pull-right text-muted">
                                                        <em>Yesterday</em>
                                                    </span>
                                                </div>
                                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#">
                                                <div>
                                                    <strong>John Smith</strong>
                                                    <span class="pull-right text-muted">
                                                        <em>Yesterday</em>
                                                    </span>
                                                </div>
                                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a class="text-center" href="#">
                                                <strong>Read All Messages</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                     /.dropdown-messages
                                </li>
                                 /.dropdown
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-tasks">
                                        <li>
                                            <a href="#">
                                                <div>
                                                    <p>
                                                        <strong>Task 1</strong>
                                                        <span class="pull-right text-muted">40% Complete</span>
                                                    </p>
                                                    <div class="progress progress-striped active">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                            <span class="sr-only">40% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#">
                                                <div>
                                                    <p>
                                                        <strong>Task 2</strong>
                                                        <span class="pull-right text-muted">20% Complete</span>
                                                    </p>
                                                    <div class="progress progress-striped active">
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                            <span class="sr-only">20% Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#">
                                                <div>
                                                    <p>
                                                        <strong>Task 3</strong>
                                                        <span class="pull-right text-muted">60% Complete</span>
                                                    </p>
                                                    <div class="progress progress-striped active">
                                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                            <span class="sr-only">60% Complete (warning)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#">
                                                <div>
                                                    <p>
                                                        <strong>Task 4</strong>
                                                        <span class="pull-right text-muted">80% Complete</span>
                                                    </p>
                                                    <div class="progress progress-striped active">
                                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                            <span class="sr-only">80% Complete (danger)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a class="text-center" href="#">
                                                <strong>See All Tasks</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                     /.dropdown-tasks
                                </li>
                                 /.dropdown -->
            <li><button type="button" class="btn btn-info navbar-top-links" style="margin-top: 10px" title="file upload" onclick="window.location = '{{url("file/create")}}'"><i class="fa fa-upload"></i></button></li>
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
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href=""><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href=""><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li> <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i>Logout
                        </a>

                        <form id="logout-form" action="" method="POST" style="display: none;">

                        </form>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </nav>
    </div>

<script src="{{ asset("vendor/jquery/jquery.min.js")}}"></script>
<script src="{{ asset("vendor/bootstrap/js/bootstrap.min.js")}}"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="{{ asset("vendor/metisMenu/metisMenu.min.js")}}"></script>
<!-- Morris Charts JavaScript -->
<script src="{{ asset("vendor/raphael/raphael.min.js")}}"></script>
<script src="{{ asset("vendor/morrisjs/morris.min.js")}}"></script>
<script src="{{ asset("data/morris-data.js")}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset("dist/js/sb-admin-2.js")}}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Script to Activate the Carousel -->
    @yield('script')

