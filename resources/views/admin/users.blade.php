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
         <link rel="stylesheet" href="/css/bootstrap-datepicker.css">

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
                            <li class="active border-left"><a href="/events">users</a></li>
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
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add user</button><br/><br/>
       <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>View Profile</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>View Profile</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                if (!empty($users)) {
                                    foreach ($users as $key => $value) {
                                        ?>
                                        <tr>
                                            <td class="{{$value->id}} user_{{$value->id}}" user_name="{{$value->name}}">{{$value->name}}</td>
                                            <td class="{{$value->id}}">{{$value->email}}</td>
                                            <td><button type="button" class="btn btn-default btn-sm edituserdata" id="{{$value->id}}" data-toggle="modal" data-target="#edituser"> <span class="glyphicon glyphicon-pencil"></span>Edit user data</button></td>
                                            <td><a  href="deleteuser/{{$value->id}}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-trash"></span>Delete user</a></td>
                                            <td><a  href="viewprofile/{{$value->id}}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-eye-open"></span>View profile</a></td>
                                        </tr>
                                                       <?php
                                                   }
                                               }
                                               ?>


                                       </tbody>
                                               </table>
                                               </div>
 <!-- add user modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add user</h4>
        </div>
        <div class="modal-body">
            <form role="form" method="POST" action="{{ url('/createnewuser') }}">
              {{ csrf_field() }}
         <div class="form-group">
           <label for="exampleInputEmail1">User name</label>
           <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User name" required>
          </div>
            <div class="form-group">
           <label for="exampleInputEmail1">User email</label>
           <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User email" required>
          </div>
             <div class="form-group">
           <label for="exampleInputEmail1">User password</label>
           <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User password" required>
          </div>
            <div class="form-group">
           <label for="exampleInputEmail1">User date</label>
          <input id="text" type="text" class="form-control datepickerrrr" name="birthday">
          </div>
            </form>
        </div>
        <div class="modal-footer">
              <button type="submit" class="btn btn-primary adduser" data-dismiss="modal">Add</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 
  <!-- edit user modal -->
  <div class="modal fade" id="edituser" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit user</h4>
        </div>
        <div class="modal-body">
           <div class="form-group">
           <label for="exampleInputEmail1">User name</label>
           <input type="email" class="form-control setusername" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User name">
          </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-primary changeuser" data-dismiss="modal">Change</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
                                               </div>
        
                                               <!-- Scripts -->
                                               <script src="/js/app.js"></script>
                                               <script src="{{URL::asset('js/datapicker.js')}}"></script>
                                               <script src="/js/bootstrap.js"></script>
                                               <script src="/js/jquery.dataTables.min.js"></script>
                                               <script src="/js/dataTables.bootstrap.js"></script>
                                                <script src="/js/admin.js"></script>]
                                                
<script>
            $(document).ready(function () {
                $('#example').DataTable();
                $('.datepickerrrr').datepicker({format: 'mm/dd/yyyy', });
    
            });
</script>
</body>
</html>