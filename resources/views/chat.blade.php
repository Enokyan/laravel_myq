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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
</head>
<body style="background: rgb(180,180,180)">
    <div class="container">
        <div class="row">
            <div class="coll-md-6">
                <div class="chat-box">
                @foreach($result as $msg)
                    <div class="alert alert-info"><span style="color:#800">{{$msg->user_name}} :</span> {{$msg->msg}}</div>
                @endforeach
                </div>
                <input type='text' class="form-control send"></input>
            </div>   
        </div>
    </div>
</body>
<script>
    $(document).on('keydown', '.send', function(e){
        var msg = $(this).val();
        var element = $(this);
        if(!msg == '' && e.keyCode == 13 && !e.shiftKey)
        {   liveChat();
            element.val(' ');
            $.ajax({
                url:'{{url("chat/add")}}',
                type:'post',
                data:{_token:'{{csrf_token()}}',msg:msg},

                 success:function(data_all)
                {
                    console.log(data_all)
                        // $('.chat-box').append('<div class="alert alert-info"><span style="color:#800">:</span>'+ data_all +'</div>')
                },
            })
        }
        liveChat(); 
    });
    $(function(){
        liveChat();
    });
    function liveChat()
    {
        $.ajax({
            url:'{{url("ajax")}}',
            data:{_token:'{{csrf_token()}}'},
            success:function(data_all)
            {

                $('.chat-box').append('<div class="alert alert-info"><span style="color:#800">:</span>'+ data_all +'</div>')
                setTimeout(liveChat,100);
            },
            error:function()
            {
                setTimeout(liveChat,500);
            }
        });
    }
</script>
