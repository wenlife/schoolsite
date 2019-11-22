<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
$this->title = '班级课表';
//$this->params['breadcrumbs'][] = $this->title;
$departments = (new \yii\db\Query())->select(['title','id'])->from('teach_department')->indexby('id')->column();
$allTerm = (new \yii\db\Query())->select(['title','id'])->from('teach_year_manage')
                                ->indexby('id')->orderby('end_date desc')->column();
$term = $year?$year:key($allTerm);
$subjects = CommonFunction::getAllSubjects();
$week = CommonFunction::getWeekday();
$allDaytime = (new \yii\db\Query())->from('teach_daytime')->orderby('sort')->all();
$department = $department?$department:key($departments);
$classes = (new \yii\db\Query())->select(['title','id'])->from('teach_class')->where(['department_id'=>$department])->indexby('id')->column();
$class_id = $class_id?$class_id:key($classes);
?>
<div class="row">
<div class="col-md-9">
<div class="box box-success">
                  <div class="box-header with-border">
                      <?php 
                      $form = ActiveForm::begin(['id'=>'form1','method'=>'get','action'=>Url::toRoute(['bcourse']),'options'=>['class'=>'form-inline']]); ?>
                      <div class="form-group">
                      <?php echo Html::dropDownList('year',$term,$allTerm,['class'=>'form-control','id'=>'teacheroption']);?>
                      </div>
                      <div class="form-group">
                      <?php echo Html::dropDownList('department',$department,$departments,[
                        'class'=>'form-control','id'=>'department',
                        'onChange'=>'
                              $("select#classoption").empty();
                              url = "index.php?r=tcenter/getclass&department="+$(this).val();           
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
                      <?php echo Html::dropDownList('class_id',$class_id,$classes,['class'=>'form-control','id'=>'classoption']);?>
                      </div>
                      <button type="submit" class="btn btn-primary">查询</button>
                      <?php ActiveForm::end(); ?>
                      <p>任课教师：</p>
                  </div>
                  <div class="box-body table-responsive no-padding">
                    
                         <table class="table table-bordered  table-hover">
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
                                      echo "<tr style='border-top:2px solid #ccc'>";
                                  }else{
                                       echo "<tr>";
                                  }
                          ?>        
                          <td><?=ArrayHelper::getValue($daytime,'title')?></td>
                          <?php foreach ($week as $week_id => $weekday) { 
                             $sub = (new \yii\db\Query())->select(['subject_id'])->from('teach_course')->where(['year_id'=>$term,'class_id'=>$class_id,'weekday'=>$week_id,'day_time_id'=>ArrayHelper::getValue($daytime,'id')])->scalar();
                             $teacher_id = (new \yii\db\Query())->select(['teacher_id'])->from('teach_manage')->where(['year_id'=>$term,'class_id'=>$class_id,'subject'=>$sub])->scalar();

                            echo "<td style='text-align:center'>";
                            echo Html::a(ArrayHelper::getValue(CommonFunction::getAllSubjects(),$sub.""),['tcenter/index','teacher_id'=>$teacher_id]);
                            //echo ArrayHelper::getValue(CommonFunction::getAllSubjects(),$sub."");
                            echo "</td>";
                          }
                          ?>
                          </tr>   
                          <?php }?>   
                        </tbody>
                      </table>
         
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

