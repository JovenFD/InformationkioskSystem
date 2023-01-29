<style>
    .fc-button {
        font-weight: bold;
        text-transform: capitalize;
    }
</style>

<div class="container rounded-lg border-2 border-gray-200">
    <div class="card">
        <div class="card-header">
            <?php
                $title = 'ADD SCHOOL EVENTS';
                require_once('tableHeader.php'); 
            ?>
            </div>
            <div class="card-body">
                <div class="container text-black text-1xl">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php 
    require('modals/calendar_modal.php');
    require_once('../class/DynamicComponent.php');
    $obj = new DynamicComponent();
?>  

<script>
     let cal = $("#calendar").fullCalendar({
        header:{
            left:"prev, next",
            center:"title",
            right:"month,agendaWeek,agendaDay,listWeek"
        },
        editable: true,
        eventLimit: true, 
        selectable: true,
        selectHelper: true,
        timeFormat:"h:mma",
        defaultView:'month',
        scrollTime: '08:00', 
        eventOverlap:false,
        allDaySlot: false,
        events:<?php echo $obj->getAllEvents();?>,
        
        select: function(start, end) {

            $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
            $('#ModalAdd #startTime').val(moment(start).format('HH:mm:ss'));
            $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
            $('#ModalAdd #endTime').val(moment(end).format('HH:mm:ss')
            );
            $('#ModalAdd').modal('show');
        },

        eventRender: function(event, element) { 
            element.bind('click', function() { // open upate modal
                $('#ModalEdit #evenst_id').val(event.evenst_id);
                $('#ModalEdit #title').val(event.title);
                $('#ModalEdit #color').val(event.color);
                $('#ModalEdit #start').val(moment(event.start).format('YYYY-MM-DD'));
                $('#ModalEdit #startTime').val(moment(event.start).format('HH:mm:ss')
                );
                $('#ModalEdit #end').val(moment(event.end).format('YYYY-MM-DD'));
                $('#ModalEdit #endTime').val(moment(event.end).format('HH:mm:ss')
                );
                $('#ModalEdit').modal('show');
             });
        },
        
        eventDrop: function(event, delta, revertFunc) { // update nito un dropupdate

            new Events().eventDrop(event);
            cal.fullCalendar('refetchEvents');
        },

        eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // update nito end date 

            new Events().eventDrop(event);
            cal.fullCalendar('refetchEvents');
        }
    });
</script>
<script src="../assets/js/eventsForm.js"></script>
        