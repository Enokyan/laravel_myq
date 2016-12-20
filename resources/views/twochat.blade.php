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


    {{--two chat--}}
    <div class="users">
        <input type="text" class="users_all tt-query" autocomplete="off" spellcheck="false">
        <br><br>

    </div>
    {{--///two chat--}}
    <div class="twochat">

        <div class="sms"></div>
        <div class="friend_name"></div>
        <div class="name_friend" id="0"></div>
        <div class="friend_msg"></div>
        {{--//send chattwo--}}
        <input type='text' class="form-control send2">

        <form class="upload-form2">
            <input type="file" id="photo2" name="input_photo2" class="input_photo2" />
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        </form>
        <button id="send_sms2">send2</button> &nbsp;&nbsp;&nbsp;&nbsp; <span id="pdf_sms">Send sms to email</span> <br>

    </div>

    <div class="my_friends ">

        @foreach($friends as $friend)

            <div class="bg-info my_friend" id="my_friend_{{$friend->id}}">{{$friend->name}}






            </div>

        @endforeach
    </div>
</div>


</body>
<script>
    $( document ).ready(function() {
//users_all search true
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
                        $('.users').append('<div  style="clear:both" class="name_friend user_choose" id='+data_all[i].id+'>'+data_all[i].name+ '</div>')
                    }
                }
            });
        })

{{--//////////@ntrel userin chat two--}} //true
        $(document).on('click', '.user_choose', function(e){

            var friend_name=$(this).text();
            var friend_id=$(this).attr('id');
            $( ".name_friend" ).remove();
            $( this ).remove();
            $('.friend_name').append('<div class="name_friend" style="clear:both" id='+friend_id+'><span>'+friend_name+ '</span></div>');
            $.ajax({
                type:'post',
                url:'{{url("select_twochat")}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{friend_id:friend_id},
                success:function(result_twochat){
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

        $(document).on('click', '#pdf_sms', function(){
            var friend_id=$('.name_friend').attr('id');
            $.ajax({
                type:'get',
                url:'send_sms_pdf',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{friend_id:friend_id},
                success:function(msg){
                    console.log(msg);
                }
            });

        });

//user send 2
        $(document).on('click', '#send_sms2', function(e){
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
                        if(arr['image_name'] !==0) $('.friend_msg').append('<div class="alert alert-info two_chat_all" style="float:right">'+ msg +'<br> <br> <img  src="../img/chattwo/'+arr['image_name']+'" ></div>')
                        else    $('.friend_msg').append('<div  style="clear:both;float:right" class="alert alert-info two_chat_all">'+ msg +'  </div>')
                    }
                })
            }

        });

        function liveChat2(){

            if($('.name_friend'))
                var friend_id=$('.name_friend').attr('id');
            else friend_id=0;
//            console.log(friend_id)
            $.ajax({
                url: '{{url("ajax2")}}',
                data: {_token: '{{csrf_token()}}', friend_id: friend_id},
                success: function (data_all) {
                    if (data_all != 0) {
                        var arr = JSON.parse(data_all);
//                        console.log(arr['friend_id_new'])
                        if(friend_id==arr['friend_id_new'])
                            if (arr['image_name'] != 0) $('.friend_msg').append('<div  style="float:left;clear:both" class="alert alert-info ajax2_div">' + arr['msg'] + ' <br><br> <img  src="../img/chattwo/' + arr['image_name'] + '" ></div>')
                            else   $('.friend_msg').append('<div  style="float:left;clear:both" class="alert alert-info ajax2_div">' + arr['msg'] + '  </div>')
                    }
                }
            });

        }
        setInterval(liveChat2,1000);



        function liveChat3(){
            $.ajax({
                url: '{{url("ajax3")}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (data_all_count) {
                    var arr_all = JSON.parse(data_all_count[1]);
                    if(arr_all != null) {
                        console.log(arr_all.id)
                        arr_name = [];
                            $('.'+arr_all.id+'').remove();
                            $('.sms').append('<div class="name_friend2  '+arr_all.id+'" style="float:right" ><div class="name_friend2 user_choose " id='+arr_all.id+'>' +  arr_all.name + '  </div><span style="color:red;float:right">:'+ data_all_count[0]+'</span></div>')
                    }
                }
            });

        }
        setInterval(liveChat3,1000);

//        online friendd
        function online_friend(){
            $.ajax({
                type: 'get',
                url: '{{url("online_friend")}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (data_all_count) {
                    var online_friend = $.parseJSON(data_all_count);
                    $('.online').remove();
                    $('.noonline').remove();
                    $.each(online_friend,function(key,value){
                        if(value.online == 1) {
                            $('#my_friend_' + value.id).append('<div class="online"></div>');

                        }
                        else{
                            $('#my_friend_' + value.id).append('<div class="noonline"></div>');
                        }
                    });
                }
            });

        }
        setInterval(online_friend,1000);
    });
</script>
@stop
<style>
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
    .name_friend, .name_friend2{
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


    /*my friend*/

    .my_friends  {
        width:30%;
        float:right;
        background-color: #151515;
    }

    .my_friend{
        width:90%;
        font-size: 30px;
        margin: 2% auto;
    }

    .online{
        border-radius: 50%;
        background-color: #00dd00;
        width: 20px;
        height: 20px;
        float:right;
        margin-top: 5%;
        margin-right: 5%;
    }
    .noonline{
        border-radius: 50%;
        background-color: #761c19;
        width: 20px;
        height: 20px;
        float:right;
        margin-top: 5%;
        margin-right: 5%;
    }
</style>