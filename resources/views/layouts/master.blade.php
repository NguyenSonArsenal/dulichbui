<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
    

    

    @yield('libs_css')

    @yield('style_css')


  </head>


@if(Auth::user()) 
    @php
        $user = Auth::user();
        $avatar = $user->avatar;
    @endphp
@endif


<body class="nav-md">

    
    <div class="container body">
    
        <div class="main_container">

            <div class="col-md-3 left_col">
              <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{route('index')}}" class="site_title"><i class="fa fa-paw"></i> <span>DULICHBUI</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    
                    <div class="profile clearfix">
                        @if(Auth::user()) 
                            <div class="profile_pic">
                                <img src="{{asset($avatar)}}" alt="name_img" class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2>{{$user->name}}</h2>
                            </div>
                        @endif
                    </div>  
                   
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="{{route('index')}}"><i class="fa fa-home"></i> Home</a></li>
                                <li><a href="{{route('trips.create')}}"><i class="fa fa-home"></i> Create trip</a></li>
                               
                                    <li> @if(Auth::user())
                                        <a href="{{route('users.edit',$user->id)}}" title="setting profile user"><i class="fa fa-edit"></i> Profile</a>
                                    
                                @endif</li>
                                <li><a><i class="fa fa-desktop"></i>Requests</a></li>
                                <li><a><i class="fa fa-table"></i> Tests <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="form.html">General Form</a></li>
                                        <li><a href="form_advanced.html">Advanced Components</a></li>
                                        <li><a href="form_validation.html">Form Validation</a></li>
                                        <li><a href="form_wizards.html">Form Wizard</a></li>
                                        <li><a href="form_upload.html">Form Upload</a></li>
                                        <li><a href="form_buttons.html">Form Buttons</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
              </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">

                            @if(!Auth::user())
                                <li><a href="{{route('login')}}">Login</a></li>
                                <li><a href="{{route('register')}}">Register</a></li>
                            @else
                                <li>
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="{{asset($avatar)}}" alt="{{$user->name}}">{{$user->name}}
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="{{route('users.edit',$user->id)}}"> Profile</a></li>
                                        <li><a href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>

                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope-o"></i><span class="badge bg-green">6</span></a>
                                    
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="{{asset('images/user.png')}}" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                  Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                         <li>
                                            <a>
                                                <span class="image">
                                                    <img src="{{asset('images/user.png')}}" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                  Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                         <li>
                                            <a>
                                                <span class="image">
                                                    <img src="{{asset('images/user.png')}}" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                  Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                   
                                        <li>
                                            <div class="text-center">
                                                <a>
                                                  <strong>See All Alerts</strong>
                                                  <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                
                                </li>
                            @endif
                      </ul>
                    </nav>
              </div> <!-- end nav_menu -->
            </div> 
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content') 
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
              <div class="pull-right">
                Copyright by  <a href="">me</a>
              </div>
              <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->

      </div>

    </div>

    <!-- jQuery -->
    <script type="text/javascript" src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script type="text/javascript" src="{{asset('build/js/custom.js')}}"></script>

    

    @yield('libs_js') 

    @yield('script_js')

    

	
  </body>
</html>

<script type="text/javascript">
    
    // sidebar full height body
    $(document).ready(function(){
        $(".left_col").height( $(".body").height() );
    });

</script>


@yield('script') 