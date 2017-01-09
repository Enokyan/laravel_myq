@extends('layouts.app')

@section('content')
        <!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


</head>
<body style="background: rgb(180,180,180)">
<div class="container">
    <div class="big_div">
        <div class="row"  style="clear:both">
            <div class="coll-md-6"  style="clear:both">
                <div class="chat-box"  style="clear:both">
                    @foreach($result as $msg)
                        {{--<div class="alert alert-info"><span style="color:#800">{{$msg->user_name}} :</span> {{$msg->msg}}</div>--}}
                        <?php
                        $img = $msg->img;
                        if($img!=0){
                            echo '<div class="alert alert-info"  style="clear:both"><span style="color:#800">'.$msg->user_name.' :</span> '.$msg->msg.' <br> <br>  <img  src=../img/chat/'.$img.'></div>';
                        }
                        else{
                            echo '<div class="alert alert-info"  style="clear:both"><span style="color:#800">'.$msg->user_name.' :</span> '.$msg->msg.'  </div>';
                        }
                        ?>
                    @endforeach
                </div>
                <input type='text' class="form-control send"></input>

                <form class="upload-form">
                    <input type="file" id="photo" name="input_photo" class="input_photo" />
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                </form>
                <button id="send-sms">send</button><br>
            </div>
        </div>
    </div>





</body>

<script>
    $( document ).ready(function() {
//users_all
        $( ".users_all" ).keyup(function() {
            var search_users=$('.users_all').val();
            $.ajax({
                type:'post',
                url:'{{url("users/select")}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{search_users:search_users},
                success:function(data_all)
                {
                    var users=[];
                    var user_id=[]
                    $( ".user_choose" ).remove();
                    for(var i=0;i<data_all.length;i++){
                        user_id[i]=data_all[i].id;
                        users[i]=data_all[i].name;
                        $('.users').append('<div  style="clear:both" class="name_friend user_choose danger" id='+data_all[i].id+'>'+data_all[i].name+ '</div>')
                    }
                }
            });
        })
//usser send
        $(document).on('click', '#send-sms', function(e){
            var msg = $('.send').val();
            var element = $('.send');
            var empty = '';
            var images=$('.input_photo').val();
            var file = document.getElementById("photo").files[0];
            var formData = new FormData();
            formData.append('message',msg);
            if($('#photo').val()!='')    formData.append('img',file);
            else   formData.append('img',empty);
            $('#photo').val('');
            element.val('');
            if(msg != ''){
                $.ajax({
                    url:'{{url("chat/add")}}',
                    type:'post',
                    cache: false,
                    enctype: 'multipart/form-data',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data:formData,
                    processData: false,
                    contentType: false,
                    success:function(data_all){
                        var arr =JSON.parse(data_all);
                        console.log(arr)
                        if(arr['image_name'] !==0) $('.chat-box').append('<div class="alert alert-info append-sms" style="clear:both"><span style="color:#800">'+arr['auth_name']+' : </span>'+ msg +'<br> <br> <img  src="../img/chat/'+arr['image_name']+'" ><span class="glyphicon glyphicon-trash delete_msg btn" id ="' +arr['id']  + '" ></span> <span type="button"  class="glyphicon glyphicon-wrench update_msg update_msg btn" data-toggle="modal" id ="' +arr['id'] + '" data-target="#myModal"></span></div>')
                        else    $('.chat-box').append('<div  style="clear:both" class="alert alert-info append-sms"><span style="color:#800">'+arr['auth_name']+' : </span>'+ msg +'<span class="glyphicon glyphicon-trash delete_msg btn" id ="' + arr['id'] + '" ></span><span type="button"  class="glyphicon glyphicon-wrench update_msg update_msg btn" data-toggle="modal" id ="' +arr['id'] + '" data-target="#myModal"></span></div>')
                    }
                })
            }
        });
//    ajax formData Send
        function liveChat(){
            $.ajax({
                url:'{{url("ajax")}}',
                data:{_token:'{{csrf_token()}}'},
                success:function(data_all)
                {
                    if(data_all != 0){
                        var arr =JSON.parse(data_all);
                        if(arr['image_name']!=0)  $('.chat-box').append('<div  style="clear:both" class="alert alert-info"><span style="color:#800">'+arr['auth_name']+' : </span>dddddddddddddd'+ arr['msg'] +' <br><br> <img  src="../img/chat/'+arr['image_name']+'" ></div>')
                        else   $('.chat-box').append('<div  style="clear:both" class="alert alert-info"><span style="color:#800">'+arr['auth_name']+' : </span>ffffffffffffff'+ arr['msg'] +'  </div>')
                    }
                }
            });
        }

        setInterval(liveChat,2000);
/


        $(document).on('click', '.user_choose', function(e){
            var friend_name=$(this).text();
            var friend_id=$(this).attr('id');
            $( ".name_friend" ).remove();
            $('.friend_name').append('<div class="name_friend" style="clear:both" id='+friend_id+'><span>'+friend_name+ '</span></div>');
            $.ajax({
                type:'post',
                url:'{{url("select_twochat")}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{friend_id:friend_id},
                success:function(result_twochat)
                {
                    $( ".two_chat_all" ).remove();
                    for(var i=0;i<result_twochat.length;i++){
                        if(friend_id != result_twochat[i].user_id){
                            if(result_twochat[i].img !=0) {
                                $('.friend_msg').append('<div class="alert alert-info two_chat_all" style="float:right">'+result_twochat[i].msg +'<br> <br> <img  src="../img/chattwo/'+result_twochat[i].img+'" ></div>')
                                $('.friend_msg').append('<div class="clear" ></div>')
                            }
                            else {
                                $('.friend_msg').append('<div  style="float:right" class="alert alert-info two_chat_all" id='+result_twochat[i].id+'>'+result_twochat[i].msg+ '</div>')
                                $('.friend_msg').append('<div class="clear" ></div>')
                            }
                        }
                        else{
                            if(result_twochat[i].img !=0) {
                                $('.friend_msg').append('<div class="alert alert-info two_chat_all" style="float:left">'+result_twochat[i].msg +'<br> <br> <img  src="../img/chattwo/'+result_twochat[i].img+'" ></div>')
                                $('.friend_msg').append('<div class="clear" ></div>')
                            }
                            else {
                                $('.friend_msg').append('<div  style="float:left" class="alert alert-info two_chat_all" id='+result_twochat[i].id+'>'+result_twochat[i].msg+ '</div>')
                                $('.friend_msg').append('<div class="clear" ></div>')
                            }
                        }
                    }
                }
            });
            $('.ajax2_div').remove();
        })
//user send 2

        $(document).on('click', '#send_sms2', function(e){
            alert('aaaaaaaaaaaaaaa');
            var msg = $('.send2').val();
            var friend_id=$('.name_friend').attr('id');
            var element = $('.send2');
            var empty = '';
            var images=$('.input_photo2').val();
            var file2 = document.getElementById("photo2").files[0];
            var formData = new FormData();
            formData.append('message',msg);
            formData.append('friend_id',friend_id);
            if($('#photo2').val()!='')    formData.append('img',file2);
            else   formData.append('img',empty);
            $('#photo2').val('');
            element.val('');
            if(msg != ''){
                $.ajax({
                    url:'{{url("chat2/add2")}}',
                    type:'post',
                    cache: false,
                    enctype: 'multipart/form-data',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data:formData,
                    processData: false,
                    contentType: false,
                    success:function(data_all){
                        var arr =JSON.parse(data_all);
                        console.log(arr.insertedId);
                        if(arr['image_name'] !==0) $('.friend_msg').append('<div class="alert alert-info two_chat_all" style="float:right">'+ msg +'<br><br><img  src="../img/chattwo/'+arr['image_name']+'" ><span class="glyphicon glyphicon-trash delete_msg btn" id ="' + arr.insertedId + '" ></span><span type="button"  class="glyphicon glyphicon-wrench update_msg update_msg btn" data-toggle="modal" id ="' +arr.insertedId + '" data-target="#myModal"></span></div>')
                        else    $('.friend_msg').append('<div  style="clear:both;float:right" class="alert alert-info two_chat_all">'+ msg +'<span class="glyphicon glyphicon-trash delete_msg btn" id ="' + arr.insertedId + '" ></span><span type="button"  class="glyphicon glyphicon-wrench update_msg update_msg btn" data-toggle="modal" id ="' +arr.insertedId + '" data-target="#myModal"></span></div>')
                    }
                })
            }
        });

    });
</script>
@stop
<style>
    .big_div{
        width: 33%;
        float: left;
    }
    .users{
        width: 20%;
        float: left;
        margin-left: 4%;
    }
    .twochat{
        width: 40%;
        float:left;
        background-color:#499249;
        margin-left: 3%;
        padding: 2%;
    }
    .name_friend{
        background-color: #0e0e0e ;
        color: #EEEEEE;
        margin-bottom: 1%;
        padding: 2%;border-radius: 10px;
        clear: both;
        /*float:right;*/
    }
    .clear{
        clear:both;
    }
</style>