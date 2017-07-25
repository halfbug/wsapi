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
                
                @if (Auth::guest())
                    @if(isset($notify) && count($notify))
                        <li class="dropdown">
                             <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell fa-fw"></i>
                                <span class="badge">{{count($notify)}}</span>
                                <i class="fa fa-caret-down"></i>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-alerts">
                               @forelse($notify as $notification)
                                <li>
                                    <a href="{{ url("/file/startdownloading/".$notification->id) }}">
                                        <div>
                                            <i class="fa fa-file fa-fw"></i> File {{$notification->name}} has been processed
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
                    @endif
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                @else

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

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   <i class="fa fa-user"></i>  {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    
                                     <li><a href="profile/{{Auth::user()->id}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="{{url("/home")}}"><i class="fa fa-gear fa-fw"></i> Dashboard</a>
                            </li>
                            <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                           <i class="fa fa-sign-out fa-fw"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                    <!--                            just put notification dropdown here-->
                            
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

