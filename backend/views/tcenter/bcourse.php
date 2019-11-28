<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
use backend\modules\school\models\TeachManage;
$this->title = '班级课表';
//$this->params['breadcrumbs'][] = $this->title;
$departments = (new \yii\db\Query())->select(['title','id'])->from('teach_department')->indexby('id')->column();
$allTerm = (new \yii\db\Query())->select(['title','id'])->from('teach_year_manage')
                                ->indexby('id')->orderby('start_date desc')->column();
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

   <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">班级任教</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <?php
                  $allTeach = TeachManage::find()->where(['year_id'=>$term,'class_id'=>$class_id])->indexby('subject')->all();
                  
                  foreach (CommonFunction::getAllTeachDuty() as $csx => $cname) {
                    if(!array_key_exists($csx,$allTeach))
                     { continue;}else{$teach = ArrayHelper::getValue($allTeach,$csx);}
                     echo '<li class="item">';
                     echo '<div class="product-img">
                           <img src="img/default-50x50.gif" alt="Product Image">
                           </div>
                           <div class="product-info">';
                     echo Html::a($cname,['tcenter/index','teacher_id'=>$teach->teacher_id],['class'=>"product-title"]);
                     //echo ArrayHelper::getValue(CommonFunction::getAllTeachDuty(),$teach->subject);
                     echo '<span class="product-description">';
                     echo $teach->teacher->name;
                     echo "</span></div></li>";    
                  }
                ?>
              </ul>
                   
            </div>
            <!-- /.box-body -->
          </div>

</div>
  <!-- /.col -->
</div>

