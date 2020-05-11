<?php
use yii\web\View;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
$this->title = '班级课程安排';
$this->params['breadcrumbs'][] = $this->title;
$week = CommonFunction::getWeekday();
$allSubject = CommonFunction::getAllSubjects();
?>


<div class="tab">
<div class="box box-success">
    <div class="box-header no-border">
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
      <div class="box-body">

        <div class="boxList1">
          <div class="one div8">#</div>
          <div class="one div8">节次</div>
          <?php foreach ($week as $id => $weekday) {echo '<div class="one div8">'.$weekday.'</div>';}?>
        </div>
        <div class="left">
            <?php
              foreach ($allDaytime as $time_id => $daytime) {//注意此处没有使用indexby来让ID成为key
              //echo "<div class='course'>".ArrayHelper::getValue($daytime,'sort')."</td>";
              //echo "<div class='course'>".ArrayHelper::getValue($daytime,'title')."</td>";
            }
            ?>
        </div>

       <div class="boxList" id="allcourse">
          <?php
              foreach ($allDaytime as $time_id => $daytime) {//注意此处没有使用indexby来让ID成为key
              echo "<div class='one div8' sname='ak'>".ArrayHelper::getValue($daytime,'sort')."</div>";
              echo "<div class='one div8'>".ArrayHelper::getValue($daytime,'title')."</div>";
              foreach ($week as $week_id => $weekday) { 
                    $courseName = '<span class="glyphicon glyphicon-plus-sign"></span>';
                    $name = ArrayHelper::getValue($courseArr,$time_id.'.'.$week_id.'.sub');
                    $name2 = ArrayHelper::getValue($courseArr,$time_id.'.'.$week_id.'.sub2');
                    if($name)
                      $courseName = $name;
                    echo '<div class="one div8" week_id="'.$week_id.'" time_id="'.$time_id.'">';
                      if($name2){
                        echo '<small>'.$courseName.'/'.$name2.'</small>';
                      }else{
                        echo $courseName;
                      }
                      echo '</div>';
              }
             }?> 

       </div>

    </div>
</div>
</div>
</div>
<?php
 $this->registerJsFile('js/Tdrag.js', [\backend\assets\AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);

$this->registerJs(<<<JS

var week, time;
$(".one").Tdrag({    
    scope:".boxList",
    pos:true,
    dragChange:true,
    cbStart:function(week_id,time_id){
        week = week_id;
        time = time_id;
        $('.div8').addClass("red");
    },
    cbEnd:function(week2_id,time2_id){
        console.log('移动前：星期'+week+'第'+time+'节');
        console.log('移动后：星期'+week2_id+'第'+time2_id+'节');
        $('.div8').removeClass('red');
    }
});

JS,View::POS_LOAD);
?>
<style type="text/css">

  .course{
    height: 40px;
    margin: 5px;
    border: 1px solid #ccc;
    width: 80px;
    float: left;
  }
  .red{
    background-color: red;
  }
  .one{
    width: 80px;
    height: 40px;
    border: 1px solid #ccc;
   /* position: absolute;*/
    margin: 5px;
}
.boxList{
    border: 1px solid #ff0033;
    height: 550px;
    margin: 30px;
    position: relative;
    width: 900px;
}
.boxList1{
    border: 1px solid #ff0033;
    height: 50px;
    margin: 30px;
    position: relative;
    width: 900px;
}
.div8{
    float: left;
}
</style>
