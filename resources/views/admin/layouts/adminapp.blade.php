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
            window.Laravel = <?php
echo json_encode([
    'csrfToken' => csrf_token(),
]);
?>
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


                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse" style="margin-left: 30%">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            <li class="active border-left"><a href="/events">happy_birthday</a></li>
                            ?>

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                                   <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Hi Admin <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/logout"
                                          logout
                                        </a>

                                        <form id="logout-form" action="{{ url($language.'/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                                                    </ul>
                    </div>
                </div>
            </nav>
            @yield('adminContent')
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
    </body>
</html>