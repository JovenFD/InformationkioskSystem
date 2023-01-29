<div class="modal fade" id="eventsModal" tabindex="-1" aria-labelledby="eventsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eventsModalLabel">School Events</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
             <div class="card">
                <div class="card-body">

                <div class="container text-black text-1xl">
                    <div id="calendar"></div>
                </div>

                </div>
             </div>
          </div>

          <div class="modal-footer">
            <div class="table-responsive">
              <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <th>Activity</th>
                    <th>Start Date&Time</th>
                    <th>End Date&Time</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td id="title"></td>
                    <td id="start"></td>
                    <td id="end"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
    </div>
</div>

<?php 
    require_once('../class/DynamicComponent.php');
    $obj = new DynamicComponent();
?>  

<script>
    $("#calendar").fullCalendar({
        header:{
            left:"prev",
            center:"title",
            right:"today,next"
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
        
        eventRender: function(event, element) { 
            element.bind('click', function() { // open upate modal

              let str = new Date(moment(event.start).format('YYYY-MM-DD HH:mm:ss')).toLocaleString();
              let nd = new Date(moment(event.event).format('YYYY-MM-DD HH:mm:ss')).toLocaleString();
              
              $('#title').html(event.title).css("color",event.color);;
              $('#start').html(str);
              $('#end').html(nd);

            });
          }
      });
</script>