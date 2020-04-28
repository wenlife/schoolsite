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
<div class="col-md-7">
<div class="tab">
<div class="box box-success">
    <div class="box-header no-border">
        <h3 class="box-title" style="text-align:center;padding-bottom:5px;margin-bottom: 15px;border-bottom: 1px dashed #ccc;width:100%">班级课程安排表</h3>
        <?php 
            $form = ActiveForm::begin(['id'=>'form1','method'=>'get','action'=>Url::toRoute(['index']),'options'=>['class'=>'form-inline']]); ?>
        <div class="form-group">
          <?php echo Html::dropDownList('term',$term,$allTerm,['class'=>'form-control']);?>
        </div>
        <div class="form-group">
          <?php echo Html::dropDownList('department',$department,$departments,[
            'class'=>'form-control',
            'onChange'=>'
                  $("select#classoption").empty();
                  url = "index.php?r=school/teachcourse/getclass&department="+$(this).val();           
                  $.post(url,null,function(data){
                    var result = JSON.parse(data);
                    for(var x in result)
                    {
                        $("select#classoption").append("<option value="+x+">"+result[x]+"</option>");
                    }
                  });
            ']);?>
        </div>
        <div class="form-group">
          <?php echo Html::dropDownList('banji',$banji,$allClass,['class'=>'form-control autosubmit','id'=>'classoption','style'=>"width:120px"]);?>
        </div>
        <button type="submit" class="btn btn-primary">查询</button>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
      <div class="box-body">
        <table class="my">
          <thead>
          <tr>
            <th class="div1" style="width: 10px">#</th>
            <th class="div1" style="width: 100px">节次</th>
            <?php foreach ($week as $id => $weekday) {echo '<th class="div1">'.$weekday.'</th>';}?>
            </tr>
          </thead>
          <tbody>
          <?php
              foreach ($allDaytime as $time_id => $daytime) {//注意此处没有使用indexby来让ID成为key
              echo "<td class='div1'>".ArrayHelper::getValue($daytime,'sort')."</td>";
              echo "<td class='div1'>".ArrayHelper::getValue($daytime,'title')."</td>";
              foreach ($week as $week_id => $weekday) { 
                    $courseName = '<span class="glyphicon glyphicon-plus-sign"></span>';
                    $name = ArrayHelper::getValue($courseArr,$time_id.'.'.$week_id.'.sub');
                    $name2 = ArrayHelper::getValue($courseArr,$time_id.'.'.$week_id.'.sub2');
                    if($name)
                      $courseName = $name;
                    echo '<td class="div1"><div class="div11">';
                      if($name2){
                        echo '<small>'.$courseName.'/'.$name2.'</small>';
                      }else{
                        echo $courseName;
                      }
                      echo '</div></td>';
              }
              echo "</tr>";
             }?>  
        </tbody>
      </table>
      </div>
    </div>
</div>
</div>
</div>

<?php
$this->registerJsFile('js/Tdrag.js', [\backend\assets\AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
$this->registerJs(<<<JS
 var index;
 $(".div1").Tdrag({
     scope:".my",
     pos:true,
     dragChange:true,
     cbEnd:function(index){
         console.log(index)
      },

  });
JS,View::POS_LOAD);
?>
<style type="text/css">
.my{

    border: 1px solid #ff0033;
    height: 500px;
    margin: 5px;
    padding:5px;
    position: relative;
    width: 800px;
  }
.div1{
    border: 1px solid #ccc;
    width: 100px;
    height: 40px;
    cousor:hand;
}
td:hover{
  border:1px solid red;
}
.boxList{
/*    border: 1px solid #ff0033;
    height: 550px;
    margin: 30px;
    position: relative;
    width: 500px;*/
}
.div1{
/*  width: 200px;
    height: 200px;
    float:left;
    margin: 20px;
    float: right;
    background:transparent url(images/tezml2.PNG) no-repeat;
    top: 50px;
    right: 100px;*/
}
</style>