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
      locale:'zh-cn',
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: true,
      events:// [
        // {
        //   title: '高三全市第一次统考',
        //   start: '2019-11-17 12:00',
        //   end: '2019-11-19 12:00',
        //  // allDay: true,
        //   color:'#d9534f'
        // },
        // {
        //   title: '高三语数外学考',
        //   start: '2019-11-29',
        //   end: '2019-11-31',
        //   allDay: true,
        //   color: '#d9534f'
        // },
        // {
        //   title: '高一第二次月考',
        //   start: '2019-12-02',
        //   end: '2019-12-05',
        //   allDay: true,
        //   color:'#f0ad4e'
        // },
        // {
        //   title: '高二第二次月考',
        //   start: '2019-12-04',
        //   end: '2019-12-06',
        //   allDay: true,
        //   color:'#337ab7'
        // },
        // {
        //   title: '高三第六次检测',
        //   start: '2019-12-06',
        //   end: '2019-12-08',
        //   allDay: true,
        //   color: '#d9534f'
        // },
        // {
        //   title: '高三第六次检测（二统模拟）',
        //   start: '2019-12-20',
        //   end: '2019-12-22',
        //   allDay: true,
        //   color: '#d9534f'
        // },
        // // areas where "Meeting" must be dropped
        // {
        //   title: '高二期末模拟考试',
        //   start: '2019-12-25',
        //   end: '2019-12-27',
        //   allDay: true,
        //   color:'#337ab7'
        //   //rendering: 'background'
        // },
        // {
        //   title: '高一期末模拟考试',
        //   start: '2019-12-25',
        //   end: '2019-12-28',
        //   allDay: true,
        //   color:'#f0ad4e'
        //  // rendering: 'background'
        // },
        // {
        //   title: '高三全市第二次统考',
        //   start: '2020-01-05',
        //   end: '2020-01-07',
        //   allDay: true,
        //   color: '#d9534f'
        // },

        // {
        //   title: '高二理化生史地学考',
        //   start: '2020-01-07',
        //   end: '2020-01-09',
        //   allDay: true,
        //   color:'#337ab7'
        //  // rendering: 'background'
        // },
        // {
        //   title: '本学期结束',
        //   start: '2020-01-17',
        //   color: 'red',
        //   rendering: 'background'
        // }
      //]
      <?=json_encode($cal)?>
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

  