<?php
/* @var $this yii\web\View */
/* @year 学年度 */
/* @model BackendLoginForm */
/* @courseArr array */
/* @teacher_id  id */
/* @subject  string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use backend\libary\CommonFunction;
$this->title = '教师中心';
$this->params['breadcrumbs'][] = $this->title;
$week = CommonFunction::getWeekday();
      // foreach ($courseArr as $key1 => $value1) {
      //    foreach ($value1 as $key2 => $value2) {
      //       echo $key1."-".$key2."-".$value2->title."<br>";
      //    }
      // }

echo Alert::widget([
  'options' => [
      'class' => 'alert-info',
  ],
  'body' => '各位老师，由于本网站尚在测试完善当中，安全性亦不符合主管部门的要求。因此本网站目前只能从学校内部网络访问，在完成后续工作后将尽快接入互联网，敬请期待！',
]);
?>
<div class="row">
<div class="col-md-9">
<div class="tab">
<div class="box box-primary">
  <div class="box-header with-border">
      <?php 
      $form = ActiveForm::begin(
        ['id'=>'form1','method'=>'get','action'=>Url::toRoute(['index']),'options'=>['class'=>'form-inline']]
      ); ?>
      <div class="form-group">
        <?php echo Html::dropDownList('year',Html::encode($term),$allTerm,['class'=>'form-control']);?>
      </div>
      <div class="form-group">
        <?php echo Html::dropDownList('subject',Html::encode($subject),CommonFunction::getAllSubjects(),[
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
        <?php echo Html::dropDownList('teacher_id',$teacher_id,$teachers,['class'=>'form-control','id'=>'teacheroption',
         'onChange'=>'$("#form1").submit();']);?>
      </div>
      <button type="submit" class="btn btn-primary">查询</button>
      <?php ActiveForm::end(); ?>
  </div>
  <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>  
            <tr><th>节次</th><?php  foreach ($week as $id => $weekday) {echo '<th>'.$weekday.'</th>';}?></tr>
          </thead>
          <tbody id="table-body">
          <?php
            foreach ($allDaytime as $time_id => $daytime) {
               if($time_id>=2 &&(ArrayHelper::getValue($allDaytime,($time_id-1).'.part')!=$daytime['part']))
                {
                    echo "<tr style='border-top:2px solid'>";
                }else{
                     echo "<tr>";
                }
                $setime = ArrayHelper::getValue($daytime,'start')."-".ArrayHelper::getValue($daytime,'end');

                echo "<td><small style='cursor:pointer' title='".$setime."'>".ArrayHelper::getValue($daytime,'title')."</small></td>";
              foreach ($week as $week_id => $weekday) { 

                $banji = ArrayHelper::getValue($courseArr,$week_id.'.'.$daytime['sort']);
                echo "<td>";
                if($banji&&!is_string($banji))
                 {
                    echo '<a href="index.php?r=tcenter/bcourse&class_id='.$banji->id.'">'.$banji->title."</a>";
                 }else{
                    echo $banji;
                 }
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



