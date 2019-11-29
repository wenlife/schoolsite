<?php
/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '学校校历';
//$this->params['breadcrumbs'][] = $this->title;
$cal = (new \yii\db\Query())->select(['title','start','end','color'])->from('teach_cal')->orderby('start')->all();
//echo json_encode($cal);
?>

<link href='js/packages/core/main.css' rel='stylesheet' />
<link href='js/packages/daygrid/main.css' rel='stylesheet' />
<link href='js/packages/timegrid/main.css' rel='stylesheet' />
<link href='js/packages/list/main.css' rel='stylesheet' />
<script src='js/packages/core/main.js'></script>

      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<script src='js/jquery.min.js'></script>
<script src='js/packages/interaction/main.js'></script>
<script src='js/packages/daygrid/main.js'></script>
<script src='js/packages/timegrid/main.js'></script>
<script src='js/packages/list/main.js'></script>
<script src="js/packages/core/locales/zh-cn.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      //defaultDate: '2019-08-12',
      height:600,
      locale:'zh-cn',
      displayEventTime:false,
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: true,
      events: <?=json_encode($cal)?>
    });

    calendar.render();
  });

$(function(){ 
    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

})

</script>


  