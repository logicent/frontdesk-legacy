<div id='calendar'></div>

<script>
    // var Events = JSON.parse('<?php echo $events; ?>');
    var Events = '<?php echo $events; ?>';

    $(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            themeSystem: 'bootstrap3',
            header: {
                left: 'prev,next today',
                center: 'title',
                // right: 'month,agendaWeek,agendaDay listDay,listWeek'
                right: 'month listWeek'
            },
            views: {
                month: { buttonText: 'Month'},
                agendaWeek: { buttonText: 'Week'},
                agendaDay: { buttonText: 'Day'},
                listDay: { buttonText: 'List Day'},
                listWeek: { buttonText: 'List Week'}
            },
            buttonText: {
                today: 'Today'
            },
            defaultView: 'month',
            // editable: true,
            // eventLimit: true,

            events: function(start, end, timezone, callback) 
            {
                $.ajax({
                    url: '/calendar/show-reservations',
                    dataType: 'json',
                    data: {
                        // start: start.unix(),
                        // end: end.unix()
                    },
                    success: function(bookings) 
                    {
                        var events = [];
                        $.each(bookings, function(index,booking)
                        {
                            events.push({
                                title: booking['title'],
                                start: booking['start'],
                                end: booking['end'],
                                color: '#358753',
                                textColor: '#fff',
                            });              
                        });
                        callback(events);
                    }
                });
            }
        })
    });
</script>