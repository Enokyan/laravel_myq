<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    {{--full calendar--}}

    {{--<link rel="stylesheet" href="/css/bootstrap.css">--}}
    <link rel="stylesheet" href="/css/mycss.css">
    <link rel="stylesheet" href="/css/bootstrap-responsive.css">
    {{--<link rel="stylesheet" href="/css/custom-styles.css">--}}
    <link rel="stylesheet" href="/css/font-awesome.css">
    <link rel="stylesheet" href="/css/font-awesome-ie7.css">


    {{--full calendar--}}
    <link rel='stylesheet' href="/node_modules/fullcalendar/dist/fullcalendar.css">
    <link rel='stylesheet' href="/node_modules/fullcalendar/dist/fullcalendar.print.css" media='print'>
    {{--online jquery--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>



</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="active border-left navbar-brand " href="{{ url('/') }}">
                    My Profile
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse" style="margin-left: 30%">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <?php
                        if(!empty(Auth::user()->id)){?>
                        <li class="active border-left friendscount" data-toggle="modal" data-target="#myModal" id="{{ Auth::user()->id }} "><a href="#">Friends<small class="friendrequests"></small></a></li>
                            <?php
                        }
                    ?>
                    <li class="active border-left"><a href="user">User</a></li>
                    <li class="active border-left"><a href="home">home</a></li>
                    <li class="active border-left"><a href="send_chat">Send Chat Group</a></li>
                    <li class="active border-left"><a href="send_chat_two">Send Chat Two</a></li>
                    <li class="active border-left"><a href="/events">Heppy Birthday</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <div class="modal fade  friendmodal" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Friends Requests</h4>
                </div>
                <div class="modal-body" id="friends">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
{{--script full calendar--}}

<script src="/node_modules/jquery/dist/jquery.min.js"></script>
<script src="/node_modules/moment/min/moment.min.js"></script>
<script src="/node_modules/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="/js/friendrequests.js"></script>

</body>
</html>