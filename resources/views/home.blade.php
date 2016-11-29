@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Add_Product</h1></div>
                 <a href="user"><button>User</button></a>  
                 <a href="email"><button>email</button></a> 
                 <a href="send/chat"><button>Send_Chat</button></a>  
                <div class="panel-body">
                    <form action='product' method="post" enctype="multipart/form-data" files='true'>
                        <h2>Name</h2><br><input type="text" name="name">
                        @if(count($errors) > 0)
                            <div class="error">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h2>Price</h2><br><input type="text" name="price">
                        
                        <h2>Upload File</h2>
                        <br><input type="file" name="upload_file"><br><br>

                        <input type="submit" name="Add" value='Add'>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    </form> 
                           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
