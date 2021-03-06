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

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset('vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('dist/css/sb-admin-2.css') }}" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="{{ asset('vendor/morrisjs/morris.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js")}} IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js")}} doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js")}}"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js")}}/1.4.2/respond.min.js")}}"></script>
        <![endif]-->
@yield('css')
    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}"> {{ config('app.name', 'File Processor') }}</a>
                </div>
                <!-- /.navbar-header -->

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

                    <li class="dropdown" onclick="$.get('/markAsRead')">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i> 
                        @if(count(Auth::user()->unreadNotifications))
                            <span class="badge">{{ count(Auth::user()->unreadNotifications) }}</span>
                        @endif
                            <i class="fa fa-caret-down"></i>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-alerts">
                            @forelse(Auth::user()->notifications as $notification)
                                <li>
                                    <a href="{{ url("/file/startdownloading/".$notification->data['file']['id']) }}">
                                        <div>
                                            <i class="fa fa-file fa-fw"></i> File {{$notification->data['file']['name']}} has been processed
                                            <!-- <span class="pull-right text-muted small">4 minutes ago</span> -->
                                        </div>
                                    </a>
                                </li>
                            <li class="divider"></li>
                            @empty
                                <li title="No new notification">
                                    <a>No new notification</a>
                                </li>
                            @endforelse
                        </ul>
                        
                    </li>

                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="{{url('profile/'.Auth::user()->id)}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="{{url('profile/edit/'.Auth::user()->id)}}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li> <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out fa-fw"></i>Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
<!--                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                 /input-group 
                            </li>-->
                            <li>
                                <a href="{{url("/home")}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="{{url("file/list")}}"><i class="fa fa-files-o fa-fw"></i> Files</a>
                            </li>
                            <!-- <li>
                                <a href=""><i class="fa fa-plus-square fa-fw"></i> Add Meta data</a>
                            </li> -->
                            <li>
                                <a href="{{url("analysis/")}}"><i class="fa fa-diamond fa-fw"></i> Analysis</a>
                            </li>
                            
                            
                            <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url("/users")}}"><i class="fa fa-list fa-fw"></i> View all </a>
                                </li>
                                <li>
                                    <a href="{{url("/users/create/admin")}}"><i class="fa fa-plus fa-fw"></i> Add Admin </a>
                                </li>
                                <li>
                                    <a href="{{url("/users/create/siteuser")}}"><i class="fa fa-plus-circle fa-fw"></i> Add Site User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-database fa-fw"></i> Packages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url("/packages")}}"><i class="fa fa-list fa-fw"></i> Packages List </a>
                                </li>
                                <li>
                                    <a href="{{url("/packages/add")}}"><i class="fa fa-plus fa-fw"></i> Add New </a>
                                </li>
                                <li>
                                    <a href="{{url("/packages/assign")}}"><i class="fa fa-star fa-fw"></i> Assign User to Package</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                            <li>
                                <a href="{{url("api-manager/clients")}}"><i class="fa fa-magic fa-fw"></i> API</a>
                            </li>
                          <li>
                                <a href="#"><i class="fa fa-cog fa-fw"></i> Settings<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ url('file/meta/create') }}"><i class="fa fa-plus-square fa-fw"></i>Set Meta Data</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('setting/') }}"><i class="fa fa-feed fa-fw"></i>General Settings</a>
                                    </li>
                                </ul>
                                 {{--/.nav-second-level --}}
                            </li>

                            <!--                              <li>
                                                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                                                        </li>
                                                        <li>
                                                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                                                            <ul class="nav nav-second-level">
                                                                <li>
                                                                    <a href="panels-wells.html">Panels and Wells</a>
                                                                </li>
                                                                <li>
                                                                    <a href="buttons.html">Buttons</a>
                                                                </li>
                                                                <li>
                                                                    <a href="notifications.html">Notifications</a>
                                                                </li>
                                                                <li>
                                                                    <a href="typography.html">Typography</a>
                                                                </li>
                                                                <li>
                                                                    <a href="icons.html"> Icons</a>
                                                                </li>
                                                                <li>
                                                                    <a href="grid.html">Grid</a>
                                                                </li>
                                                            </ul>
                                                             /.nav-second-level
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                                                            <ul class="nav nav-second-level">
                                                                <li>
                                                                    <a href="#">Second Level Item</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">Second Level Item</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                                                    <ul class="nav nav-third-level">
                                                                        <li>
                                                                            <a href="#">Third Level Item</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">Third Level Item</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">Third Level Item</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">Third Level Item</a>
                                                                        </li>
                                                                    </ul>
                                                                     /.nav-third-level
                                                                </li>
                                                            </ul>
                                                             /.nav-second-level
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                                                            <ul class="nav nav-second-level">
                                                                <li>
                                                                    <a href="blank.html">Blank Page</a>
                                                                </li>
                                                                <li>
                                                                    <a href="login.html">Login Page</a>
                                                                </li>
                                                            </ul>
                                                             /.nav-second-level
                                                        </li>-->
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">@yield('heading')</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                @yield('content')
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<!-- jQuery -->
    <script src="{{ asset("vendor/jquery/jquery.min.js")}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset("vendor/bootstrap/js/bootstrap.min.js")}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset("vendor/metisMenu/metisMenu.min.js")}}"></script>



    <!-- Custom Theme JavaScript -->
    <script src="{{ asset("dist/js/sb-admin-2.js")}}"></script>
@yield('script')
</body>

</html>

