<?php
/* @var $this yii\web\View */
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
use backend\modules\guest\models\UserTeacher;
use backend\modules\school\models\TeachManage;
$this->title = '班级课表';
$this->params['breadcrumbs'][] = $this->title;
$subjects = CommonFunction::getAllSubjects();
$week = CommonFunction::getWeekday();
?>
<div class="row">
<div class="col-md-9">
<div class="box box-success">
<div class="box-header with-border">
<?php 
//查询表单
  $form = ActiveForm::begin(
    ['id'=>'form1','method'=>'get','action'=>Url::toRoute(['bcourse']),'options'=>['class'=>'form-inline']]
  );
?>
<div class="form-group">
  <?=Html::dropDownList('term',$term,$allTerm,['class'=>'form-control','id'=>'teacheroption']);?>
</div>
<div class="form-group">
 <?=Html::dropDownList('department',$department,$departments,['class'=>'form-control','id'=>'department']);
 //  'onChange'=>'
 //        $("select#classoption").empty();
 //        url = "index.php?r=tcenter/getclass&department="+$(this).val();           
 //        $.post(url,null,function(data){
 //          var result = JSON.parse(data);
 //          for(var x in result)
 //          {
 //              $("select#classoption").append("<option value="+x+">"+result[x]+"</option>");
 //          }
 //        });
 // '
?>
</div>
<div class="form-group">
 <?=Html::dropDownList('class_id',$class_id,$classes,['class'=>'form-control','id'=>'classoption']);?>
</div>
<button type="submit" class="btn btn-primary">查询</button>
 <?php ActiveForm::end(); ?>
</div>
<!-- 班级课程表格 -->
<div class="box-body table-responsive no-padding">
   <table class="table table-hover">
    <thead>  
      <tr><th>节次</th><?php foreach ($week as $weekday) {echo '<th>'.$weekday.'</th>';}?></tr>
    </thead>
    <tbody id="table-body">
    <?php
      foreach ($allDaytime as $time_id=>$daytime) {
        if($time_id>=2 &&($allDaytime[$time_id-1]['part']!=$daytime->part))
          {
              echo "<tr style='border-top:2px solid'>";
          }else{
               echo "<tr>";
          }

        echo "<td>".$daytime->title."</td>";

        foreach ($week as $week_id => $weekday) { 
          $course = ArrayHelper::getValue($weekCourse,$time_id.'.'.$week_id);
          $teacher_id = ArrayHelper::getValue($course,'t_id');
          $sub = ArrayHelper::getValue($course,'sub');
          if($daytime->part == '晚上')
          {
             $tea = UserTeacher::findOne($teacher_id);
             if($tea)
               $sub = $tea->name;
          }
          echo "<td>";
          echo $teacher_id?Html::a($sub,['tcenter/index','teacher_id'=>$teacher_id]):$sub;
          echo "</td>";
      }
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

</div>
</div>
</div>
          <div class="col-md-3">
          <div class="box box-primary ">
            <div class="box-header with-border">
              <h3 class="box-title">班级任教</h3>
            </div>
            <div class="box-body fix-height">
              <ul class="products-list product-list-in-box ">
                <?php  
                  foreach (CommonFunction::getAllTeachDuty() as $csx => $cname) {
                    if(!array_key_exists($csx,$allTeach))
                      continue;
                     $teach = ArrayHelper::getValue($allTeach,$csx); 
                     echo '<li class="item">';
                     echo '<div class="product-img">';
                     echo     '<img src="img/default-50x50.gif" alt="Product Image">';
                     echo     '</div><div class="product-info">';
                     echo Html::a($cname,['tcenter/index','teacher_id'=>$teach->teacher_id],['class'=>"product-title"]);
                     echo '<span class="product-description">';
                     echo $teach->teacher->name;
                     echo "</span></div></li>";    
                  }
                ?>
              </ul>           
            </div>
          </div>
          </div>
</div>
<?php
$this->registerJs(<<<JS
  $("#department").on("change",function(){
            $("select#classoption").empty();
        url = "index.php?r=tcenter/getclass&department="+$(this).val();           
        $.post(url,null,function(data){
          var result = JSON.parse(data);
          for(var x in result)
          {
              $("select#classoption").append("<option value="+x+">"+result[x]+"</option>");
          }
        });

    });
JS,View::POS_LOAD);
?>

<style type="text/css">
 table,td,th{
     /*边框合并*/
     border-collapse: collapse;
     border: 1px solid #337ab7;
     text-align: center;
 }
table th{
  background-color: #337ab7;
  color:#fff;
}
.product-img .product-info{
  width:30px;
  height: 30px;
}

</style>