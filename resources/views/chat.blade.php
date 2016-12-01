@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
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

        <div class="row"  style="clear:both">
            <div class="coll-md-6"  style="clear:both">
                <div class="chat-box"  style="clear:both">
                @foreach($result as $msg)
                    {{--<div class="alert alert-info"><span style="color:#800">{{$msg->user_name}} :</span> {{$msg->msg}}</div>--}}
                    <?php
                        $img = $msg->img;
                        if($img!=0){
                            echo '<div class="alert alert-info"  style="clear:both"><span style="color:#800">'.$msg->user_name.' :</span> '.$msg->msg.'<img  src=../img/chat/'.$img.'></div>';
                        }
                        else{
                            echo '<div class="alert alert-info"  style="clear:both"><span style="color:#800">'.$msg->user_name.' :</span> '.$msg->msg.'</div>';
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


    $(document).on('click', '#send-sms', function(e){
        var msg = $('.send').val();
        var element = $('.send');
        var empty = '';
        var images=$('.input_photo').val();
        var file = document.getElementById("photo").files[0];
        var formData = new FormData();
        formData.append('message',msg);
        if($('#photo').val()!=''){
            formData.append('img',file);
        }else{
            formData.append('img',empty);
        }
        $('#photo').val('');
        element.val('');
        if(msg != '')
        {

            $.ajax({
                url:'{{url("chat/add")}}',
                type:'post',
                cache: false,
                enctype: 'multipart/form-data',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:formData,
                processData: false,
                contentType: false,
                success:function(data_all)
                {
                    var arr =JSON.parse(data_all);
                    if(arr['image_name'] !==0){

                        $('.chat-box').append('<div class="alert alert-info append-sms" style="clear:both"><span style="color:#800">'+arr['auth_name']+' : </span>'+ msg +'<img  src="../img/chat/'+arr['image_name']+'" ></div>')
                    }
                    else
                    {
                        $('.chat-box').append('<div  style="clear:both" class="alert alert-info append-sms"><span style="color:#800">'+arr['auth_name']+' : </span>'+ msg +'</div>')

                    }


                }

            })

        }
    });

    function liveChat()
    {
        $.ajax({
            url:'{{url("ajax")}}',
            data:{_token:'{{csrf_token()}}'},
            success:function(data_all)
            {
                if(data_all != 0){
                    var arr =JSON.parse(data_all);
                    if(arr['image_name']!=0){

                        $('.chat-box').append('<div  style="clear:both" class="alert alert-info"><span style="color:#800">'+arr['auth_name']+' : </span>'+ arr['msg'] +'<img  src="../img/chat/'+arr['image_name']+'" ></div>')
                    }
                    else
                    {
                        $('.chat-box').append('<div  style="clear:both" class="alert alert-info"><span style="color:#800">'+arr['auth_name']+' : </span>'+ arr['msg'] +'</div>')

                    }

//                        $('.chat-box').append('<div class="alert alert-info"><span style="color:#800">'+arr['user_name']+' : </span>'+ arr['msg'] +'</div>')
                }
            }
        });
    }
    setInterval(liveChat,1000);
    });
</script>
@stop