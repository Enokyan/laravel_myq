@extends('layouts.app')
@section('content')
<script>
$(document).ready(function () {
    var newData = [];
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        defaultDate: new Date(),
        navLinks: true,
        editable: true,
        eventLimit: true,
        events: {
            url: 'calendar_result',
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                newData.push({
                            title: data[i].name,
                            start: data[i].date
                        }
                    );
                }
                return newData;
            }
        }
    });
});
</script>
 <style>
    #calendar {
         max-width: 500px;
         margin: 0 auto;
     }
</style>
<div class="container">
    <div id='calendar'></div>
</div>
@stop
