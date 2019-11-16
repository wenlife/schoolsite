<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
$this->title = '教师中心';
$this->params['breadcrumbs'][] = $this->title;

$allTerm = (new \yii\db\Query())->select(['title','id'])->from('teach_year_manage')
                                ->indexby('id')->orderby('end_date desc')->column();
$term = ArrayHelper::getValue($var,'yearpost')?ArrayHelper::getValue($var,'yearpost'):key($allTerm);
$week = CommonFunction::getWeekday();
$allDaytime = (new \yii\db\Query())->from('teach_daytime')->orderby('sort')->all();
?>

<div class="row">
        <!-- /.col -->
        <div class="col-md-9">
          <div class="tab">
              <div class="box box-success">
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
                  <div class="box-body no-padding">
                      <div class="box-body">
                        <table class="table table-bordered table-responsive">
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
                              //var_export($courseArr);
                             echo '<td>'.(isset($courseArr[$week_id][$daytime['id']]) ? $courseArr[$week_id][$daytime['id']] : null).'</td>';
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
        </div>
          <div class="col-md-3">
          <?=$this->render("login_bar")?>
        </div>
        <!-- /.col -->
      </div>


<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/radialIndicator.js"></script>
<script type="text/javascript">

var bg1 = radialIndicator('#indicatorContainer',{
            barColor: '#87CEEB',
            barWidth: 10,
            initValue: 80,
            roundCorner : true,
            percentage: true
        });

  $('.hover').mouseover(function(){
    $(this).css('border','1px solid #ccc');
    bg1.option('barColor','#ccc');
  });
  $('.hover').mouseout(function(){
    $(this).css('border','none');
  });


  // $('#indicatorContainer').radialIndicator({
  //               barColor: '#87CEEB',
  //               barWidth: 10,
  //               initValue: 80,
  //               roundCorner : true,
  //               percentage: true
  //           });
    $('#indicatorContainer1').radialIndicator({
                barColor: '#3fc',
                barWidth: 10,
                initValue: 40,
                roundCorner : true,
                percentage: true
            });
        $('#indicatorContainer2').radialIndicator({
                barColor: 'red',
                barWidth: 10,
                initValue: 40,
                roundCorner : true,
                percentage: true
            });
</script>

