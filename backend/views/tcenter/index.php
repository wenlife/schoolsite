<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
$this->title = '教师中心';
$this->params['breadcrumbs'][] = $this->title;

$allTerm = (new \yii\db\Query())->select(['title','id'])->from('teach_year_manage')
                                ->indexby('id')->orderby('start_date desc')->column();
$term = $year?$year:key($allTerm);
$week = CommonFunction::getWeekday();
$allDaytime = (new \yii\db\Query())->from('teach_daytime')->orderby('sort')->all();
?>

<div class="row">
        <!-- /.col -->
        <div class="col-md-9">
          <div class="tab">
              <div class="box box-primary">
                  <div class="box-header with-border">
                      <?php 
                      $form = ActiveForm::begin(['id'=>'form1','method'=>'get','action'=>Url::toRoute(['index']),'options'=>['class'=>'form-inline']]); ?>
                      <div class="form-group">
                      <?php echo Html::dropDownList('year',$term,$allTerm,['class'=>'form-control']);?>
                      </div>
                      <div class="form-group">
                      <?php echo Html::dropDownList('subject',$subject,CommonFunction::getAllSubjects(),[
                        'class'=>'form-control',
                        'onChange'=>'
                              $("select#teacheroption").empty();
                              url = "index.php?r=tcenter/getteacher&subject="+$(this).val();           
                              $.post(url,null,function(data){
                                var result = JSON.parse(data);
                                for(var x in result)
                                {
                                    $("select#teacheroption").append("<option value="+x+">"+result[x]+"</option>");
                                }
                              });
                      ']);?>
                      </div>
                      <div class="form-group">
                      <?php echo Html::dropDownList('teacher_id',$teacher_id,$teachers,['class'=>'form-control','id'=>'teacheroption']);?>
                      </div>
                      <button type="submit" class="btn btn-primary">查询</button>
                      <?php ActiveForm::end(); ?>
                  </div>
                  <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                          <thead>  
                          <tr>
                            <th>节次</th>
                            <?php  foreach ($week as $id => $weekday) {echo '<th>'.$weekday.'</th>';}?>
                          </tr>
                          </thead>
                          <tbody id="table-body">
                         <?php
                              foreach ($allDaytime as $time_id => $daytime) {
                                  if($time_id>=2 &&($allDaytime[$time_id-1]['part']!=$allDaytime[$time_id]['part']))
                                  {
                                      echo "<tr style='border-top:2px solid'>";
                                  }else{
                                       echo "<tr>";
                                  }
                          ?>        
                          <td><?=ArrayHelper::getValue($daytime,'title')?></td>
                          <?php foreach ($week as $week_id => $weekday) { 
                            // var_export($courseArr);
                            // exit();
                            $banji = isset($courseArr[$week_id][$daytime['id']]) ? $courseArr[$week_id][$daytime['id']] : null;
                            echo "<td>";
                            if($banji)
                             {
                                echo '<a href="index.php?r=tcenter/bcourse&class_id='.$banji->id.'">'.$banji->title."</a>";
                             }else{
                             }
                            echo "</td>";
                             // echo '<td>'.(isset($courseArr[$week_id][$daytime['id']]) ? $courseArr[$week_id][$daytime['id']] : null).'</td>';
                             //echo '<td>'.$week_id.$daytime['id'].'</td>';
                          }
                          ?>
                          </tr>   
                          <?php }?>   
                        </tbody>
                      </table>
         
              </div>
              </div>
              </div>
        </div>
          <div class="col-md-3">
            <?php
                 if(Yii::$app->user->isGuest)
                 {
                     echo $this->render("login_bar",['model'=>$model]);
                 }else{
                     echo $this->render("left_bar",['model'=>$model]);
                 }
            ?>
        </div>
        <!-- /.col -->
      </div>

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
</style>

