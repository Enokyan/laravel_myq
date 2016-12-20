$(document).ready(function(){
    function friendinterval() {
        var id = $('.friendscount').attr('id');
        var token = $("input[name=_token]").val();
        if(id){
            $.ajax({
                url:'getfriendrequests',
                 type:'POST',
                data:{_token:token},
                success:function (data) {
                    var jsondata = $.parseJSON(data);
                   if(jsondata.count !== 0){
                       $('.friendrequests').css({'font-size': '17px','background-color': 'red','color': 'white','padding': '4px','border-radius': '9px','margin-left': '3px'});
                       $('.friendrequests').text(jsondata.count);

                   }
                   else{
                       $('.friendrequests').removeAttr( 'style' );
                       $('.friendrequests').text('');
                   }
                }
            });
        }

    }

    setInterval(friendinterval, 3000);


    $('.friendscount').click(function(){
        var id = $('.friendscount').attr('id');
        var token = $("input[name=_token]").val();
        var html = '';
        $('#friends').html('');
        if(id) {
            $.ajax({
                url: 'selectfriendrequests',
                type: 'POST',
                data: {_token: token},
                success: function (data) {
                    var jsondata = $.parseJSON(data);
                    if (jsondata.count !== 0) {
                        var table = '<table class="table"></table>';
                        $('#friends').append(table);
                        $.each(jsondata.friends, function(key,value){
                            html = '<tr  class=" friendtable_'+value.table_id+'">' +
                                '<td>' +
                                '<h5>' +
                                value.name +
                                '</h5>' +
                                '</td>' +
                                '<td>' +
                                '<button type="button" class="btn btn-default addfriend" value="'+value.table_id+'">Add</button>'+
                                '</td>'+
                                '<td>'+
                                '<button type="button" class="btn btn-default deletefriend" value="'+value.table_id+'">Delete</button>'+
                                '</td>' +
                                '</tr>';

                            $('.table').append(html);
                        });


                    }
                    else{
                        $('#friends').append('You havent Friends Requests');
                    }
                }
            });
        }

        })

    $(document).on('click','.addfriend',function(){
        var id = $(this).val();
        var token = $("input[name=_token]").val();
        $.ajax({
                url: 'addfriend',
                type: 'POST',
                data: {_token: token,table_id:id},
                success: function (data) {
                        if(data == 'success'){
                            $('.friendtable_'+id).remove();
                        }
                }
        })
});

    $(document).on('click','.deletefriend',function(){
        var id = $(this).val();
        var token = $("input[name=_token]").val();
        $.ajax({
            url: 'deletefriend',
            type: 'POST',
            data: {_token: token,table_id:id},
            success: function (data) {
                if(data == 'success'){
                    $('.friendtable_'+id).remove();
                }
            }
        })
    });

    // .logaut_online
    $(document).on('click','.logaut_online',function(){
        $.ajax({
            url: 'logaut_online',
            type: 'get',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (data) {
            }
        })
    })
});

