@extends('layouts.app')

@section('content')

<body style="background-color: #954120">
<div class="container">

    <div class="my_profil">
        <h1>{{trans('translate.my_profile')}}</h1>
        <div class="my_user">
            @foreach($myuser as $user)
                <h3><p><span style="color:#800">My Name :</span> {{$user->name }}</p></h3>
                <h3><p><span style="color:#800">My Mail :</span> {{$user->email }}</p></h3>
                <h3><p><span style="color:#800">My Happy Birthday :</span> {{$user->date }}</p></h3>
            @endforeach
        </div>
        @foreach($myuser as $user)
            <div class="update_element">
                <input type="text" value="{{$user->name }}">
                <input type="email" value="{{$user->email }}">
                <input type="password" placeholder="Update Pass">
                <input type="date" value="{{$user->date }}">
                <input type="button" value="Update User" id="update_user">
            </div>
        @endforeach
    </div>


    <div class="friend">
        <input type="text" class="searchUsers">
        <div class="search" style="display:none">
            <table class = "table table-condensed addusersintable">
            </table>
        </div>
        
    </div>


    <div class="add_product">
        <h1>&nbsp;Add_Product</h1>
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
</body>

<script>
    $('document').ready(function(){
        $('#update_user').click(function(){
            var update_name = $('.update_element').children().eq(0).val();
            var update_mail = $('.update_element').children().eq(1).val();
            var update_pass = $('.update_element').children().eq(2).val();
            var data_user   = $('.update_element').children().eq(3).val();
            $.ajax({
                type:'post',
                url:'/user/update',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{
                    update_name:update_name,
                    update_mail:update_mail,
                    update_pass:update_pass,
                    data_user:data_user
                },
                success:function(dm){
                    if(dm!='[]'){
                        alert(dm)
                    }
                    else
                        location.reload();
                }
            })
        })



        $('.searchUsers').keyup(function () {
            var userName = $(this).val();
            var token = $("input[name=_token]").val();
            $('.addusersintable').empty();
            if (userName == '') {
                $('.search').css('display', 'none');
            }
            $.ajax({
                url: '/searchusers',
                type: 'POST',
                data: {_token: token, user_name: userName},
                success: function (data) {
                    var html = '';
                    console.log(data);
                    if (data) {
                        var jsonData = $.parseJSON(data);
                        var currentuser = jsonData.currentuser;

                        $('.search').css('display', 'block');
                        var userId = '';
                        $.each(jsonData.users, function (key, value) {

                            if ((value.from_user == currentuser && value.status == 0) || (value.to_user == currentuser && value.status == 0)) {

                                button = '<button class = "btn btn-primary"   value = "' + value.id + '" id = "primary_' + value.id + '" disabled ="disabled" >Request is done</button>';
                            } else if ((value.from_user == currentuser && value.status == 1) || (value.to_user == currentuser && value.status == 1)) {
                                (value.from_user == currentuser && value.status == 1) ? userId = value.to_user : userId = value.from_user;
                                button = '<button class = "btn btn-success search-del-friend "   value = "' + userId + '"    id = "user_' + userId  + '"   data="' + value.table_id + '"> Remove From Friend List </button>';
                            } else if (value.from_user == null && value.to_user == null) {

                                var button = '<button class = "btn btn-default add_friend"  value = "' + value.id + '" id = "addFriend_' + value.id + '">Add friend </button>';
                            }

                            html = '<tr style="margin-top: 15px">' +
                                    '<td>' +
                                    '<h5>' +
                                     value.name +
                                    '</h5>' +
                                    '</td>' +
                                    '<td>' +
                                    button +
                                    '</td>' +
                                    '</tr>';
console.log(html);
                            $('.addusersintable').append(html);
                        });
                    }

                }
            });
        });


        $(document).on('click', '.add_friend', function () {
            var userId = $(this).val();
            var token = $("input[name=_token]").val();
            $.ajax({
                url: "/frendrequest",
                data: {_token: token, userId: userId},
                type: "POST",
                success: function (data) {
                    if (data) {
                        $("#addFriend_" + userId).text('Request is done');
                        $("#addFriend_" + userId).attr('disabled', 'disabled');
                        $("#addFriend_" + userId).toggleClass('btn-default btn-primary');
                    }
                }
            });
        });



        $(document).on('click', '.search-del-friend', function () {
            var userId = $(this).attr('data');
            var id = $(this).val();
            console.log(id);
            var token = $("input[name=_token]").val();
            $.ajax({
                url: '/deletefriend',
                type: 'POST',
                data: {_token: token,table_id:userId},
                success: function (data) {
                    if(data == 'success'){
                            $('#user_'+id).removeClass('btn btn-success search-del-friend');
                            $('#user_'+id).removeAttr('data');
                            $('#user_'+id).attr('class','btn btn-default add_friend');
                            $('#user_'+id).text('Add friend');

                    }
                }
            })
        });

    })
</script>


<style>
    .my_profil{
        background-color: red;
        float:left;
        width:45%;
        border-radius: 15px 80px ;
        padding-bottom: 30px;
    }
    .my_user{
        background-color: #afd9ee;
        width:90%;
        margin-left:5%;
        border-radius: 10px 75px;
        padding-bottom: 20px;
        padding-top: 20px;
    }
    .my_user h3{
        margin: 5%;
        padding-bottom: 10px;
    }
    li{
        float:left;
    }
    .add_product{
        width:22%;
        float:right;
        background-color: #da5d4d;
        border-radius: 10px 75px;
    }
    input{
        display:block;
        width:90%;
        margin:5PX auto;
        border-radius:5px  20px  5px 20px;
        outline:none;
        padding: 10px;
    }
    .my_profil h1{
        width:41%;
        margin:10px auto;
        color: saddlebrown;
    }

    .friend h1{
        width:55%;
        margin:10px auto;
        color: saddlebrown;
    }

    /*/////////my friend*/
    .friend{
        width:28%;
        background-color: #2f96b4;
        float:left;
        margin-left: 2%;
        border-radius: 10px 75px;
        padding-top: 25px;
        padding-bottom: 25px;
    }
    .search{
        margin-top: 10px;
        background-color: #e7e7e7;
        height: 300px;
        border-radius: 4px;
        overflow: auto;
        margin-bottom: 45px;
    }

    .one_friend{
        width:90%;
        height:100px; 
        background-color: #ee5d4b;
        margin-bottom: 20%;
        margin-left: 4%;
        border-radius: 5px 35px;
        padding: 4% 5%;
    }
    .h3{
        font-size: 150%;
   }
</style>

@endsection