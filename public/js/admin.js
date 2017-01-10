$(document).ready(function () {
    $('.edituserdata').click(function () {
        var id = $(this).attr('id');
        var name = $('.user_' + id).attr('user_name');
        $('.setusername').val(name)
        $('.setusername').attr('userId', id)
    })

    $('.changeuser').click(function () {
        var username = $('.setusername').val();
        var userId = $('.setusername').attr('userId')
       
        $.ajax({
            type: 'post',
            url: '/updateuserdata',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {username: username,userId:userId},
            success: function (data) {
              var jsondata = $.parseJSON(data);
              if(jsondata.data){
                   $('.user_' + userId).text(username);
              }
            }
        })
    })
});