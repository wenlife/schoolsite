<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = '课程安排导入';
$this->params['breadcrumbs'][] = $this->title;

$year = (new \yii\db\Query())->select(['title','id'])->from('teach_year_manage')->indexby('id')->column();
$department = (new \yii\db\Query())->select(['title','id'])->from('teach_department')->indexby('id')->column();
?>
<div class="row">
<div class="col-md-6">
<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">导入课程安排<small>  注意：只能分学年和年级导入</small></h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<div class="box-body">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="form-group">
      <?=$form->field($model,'year')->dropDownList($year)->label("学年度")?>
    </div>
    <div class="form-group">
      <?=$form->field($model,'department')->dropDownList($department)->label("教学部")?>
    </div>
    <div class="form-group">
      <?= $form->field($model, 'imageFile')->fileInput()->label('年级课程安排表') ?>
      <p class="help-block"><a href="course.xls" download="课程导入模板.xlsx">课程安排样例表</a></p>
    </div>
  </div>
  <div class="box-footer">
    <button type="submit" class="btn btn-primary">导入课程安排</button>
  </div>
<?php ActiveForm::end() ?>
</div>
</div>

<?php
if(!is_null($errMSG)&&count($errMSG)>0) 
{
?>
  <div class="col-md-6">
    <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">导入内容注意事项</h3>
    </div>
    <div class="box-body">
      <ul>
        <?php
         foreach ($errMSG as $key => $value) {
         	if(is_array($value))
         	{
         		//echo "<li>".var_export($value)."</li>";
         		foreach ($value as $key1 => $value1) {
         			echo "<li>".$value1."</li>";
         		}
         	}else{
         		echo "<li>".$value."</li>";
         	}
           
         }
        ?>
      </ul>
      <b class="text-warning"><-以上内容可以选择修改表格重新导入或者手动录入,系统经过验证，可以重复导入</b>
    </div>
      <div class="box-footer">
         <a class="btn btn-primary" href="<?=Url::toRoute(['index'])?>">回到管理页面</a>
      </div>
    </div>
  </div>
<?php
}
?>
</div>