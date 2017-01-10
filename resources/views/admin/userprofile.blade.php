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


        <link rel="stylesheet" href="/css/mycss.css">
        <link rel="stylesheet" href="/css/bootstrap-responsive.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/font-awesome.css">
        <link rel="stylesheet" href="/css/font-awesome-ie7.css">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/dataTables.bootstrap.css">

        {{--full calendar--}}
        <link rel='stylesheet' href="/node_modules/fullcalendar/dist/fullcalendar.css">
        <link rel='stylesheet' href="/node_modules/fullcalendar/dist/fullcalendar.print.css" media='print'>
        {{--online jquery--}}




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
                            <li class="active border-left"><a href="/admin_home">General page</a></li>
                            <li class="active border-left"><a href="/users">users</a></li>
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
                                        <a href="/admin_logout">logout</a>
                                        
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <h2 class="username"><?php echo $userdata->name;?></h2>
                </div>
            </div>
          
            <script src="/js/app.js"></script>
            <script src="/js/bootstrap.js"></script>
            <script src="/js/jquery.dataTables.min.js"></script>
            <script src="/js/dataTables.bootstrap.js"></script>
</div>
    </body>
</html>