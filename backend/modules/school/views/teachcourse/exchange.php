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

<div class="all">
   <div class="course">
     <div class="cheader">
            <div class="item lfloat">#</div>
            <div class="item lfloat">节次</div>
            <?php foreach ($week as $id => $weekday) {echo '<div class="item lfloat">'.$weekday.'</div>';}?>
     </div>
     <div class="cbody">
            <div class="left">
            <?php
              foreach ($allDaytime as $time_id => $daytime) {//注意此处没有使用indexby来让ID成为key
                echo "<div class='item lfloat'>".ArrayHelper::getValue($daytime,'sort')."</div>";
              echo "<div class='item lfloat'>".ArrayHelper::getValue($daytime,'title')."</div>";
            }
            ?>
            </div>

         <div class="right">
              <div class="boxList" id="allcourse">
              <?php
                  foreach ($allDaytime as $time_id => $daytime) {//注意此处没有使用indexby来让ID成为key
                  foreach ($week as $week_id => $weekday) { 
                        $courseName = '<span class="glyphicon glyphicon-plus-sign"></span>';
                        $name = ArrayHelper::getValue($courseArr,$time_id.'.'.$week_id.'.sub');
                        $name2 = ArrayHelper::getValue($courseArr,$time_id.'.'.$week_id.'.sub2');
                        if($name)
                          $courseName = $name;
                        echo '<div class="one item lfloat" week_id="'.$week_id.'" time_id="'.$time_id.'">';
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
<style type="text/css">
   
   .item{
      width: 60px;
      height: 40px;
      border: 1px solid #ccc;
     /* position: absolute;*/
      margin: 5px;
      text-align: center;
      line-height: 40px;
   }
   .lfloat{
      float: left;
   }
   .one{
    cursor: pointer;
   }
  
  .all{
    width:1600px;
    height: 800px;
    border: 1px solid #ccc;
    position: relative;
  }
  .course{
    width:950px;
    height: 810px;
    border: 1px solid #ccc;
    position:absolute;
    left: 5px;
    top:5px;
    float:left;
  }
  .cheader{
    border: 1px solid #ff0033;
    height: 50px;
    margin: 30px;
    position: relative;
    width: 900px;
  }
  .cbody{
    border: 1px solid #ff0033;
    height: 600px;
    margin: 30px;
    position: relative;
    width: 900px;
  }
  .left{
    border: 1px solid #ff0033;
    height: 600px;
    margin: 1px;
    width: 145px;
    float: left;
  }
  .right{
    border: 1px solid #ff0033;
    height: 600px;
    margin: 3px;
    width: 510px;
    float: left;
  }

  .red{
    background-color: red;
  }

.boxList2{
    border: 1px solid #ff0033;
    height: 550px;
    margin: 30px;
    position: relative;
    width: 900px;
}
</style>

<?php
 $this->registerJsFile('js/Tdrag.js', [\backend\assets\AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);

$this->registerJs(<<<JS

var week, time;
$(".one").Tdrag({    
    //scope:".boxList",
    pos:true,
    dragChange:true,
    cbStart:function(week_id,time_id){
        week = week_id;
        time = time_id;
        $('.one').addClass("red");
    },
    cbEnd:function(week2_id,time2_id){
        console.log('移动前：星期'+week+'第'+time+'节');
        console.log('移动后：星期'+week2_id+'第'+time2_id+'节');
        $('.one').removeClass('red');
        $('#changeinfo').html('星期'+week+'第'+time+'节将和星期'+week2_id+'第'+time2_id+'节对换');
    }
});

JS,View::POS_LOAD);
?>

