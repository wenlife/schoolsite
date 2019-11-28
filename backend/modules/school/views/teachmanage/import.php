<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = '任教导入';
$this->params['breadcrumbs'][] = $this->title;

$year = (new \yii\db\Query())->select(['title','id'])->from('teach_year_manage')->indexby('id')->column();
$department = (new \yii\db\Query())->select(['title','id'])->from('teach_department')->indexby('id')->column();
?>
<div class="row">
<div class="col-md-6">
<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">导入任教信息<small>  注意：只能分学年和年级导入</small></h3>
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
      <?= $form->field($model, 'imageFile')->fileInput()->label('教师名单') ?>
      <p class="help-block"><a href="example/teach_import.xls" download="任教导入模板.xlsx">任教信息例表下载</a></p>
    </div>
  </div>
  <div class="box-footer">
    <button type="submit" class="btn btn-primary">导入数据</button>
  </div>
<?php ActiveForm::end() ?>
</div>
</div>

<?php
if(!is_null($errMSG)) 
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
           echo "<li>".$value."</li>";
         }
        ?>
      </ul>
      <p class="text-warning"><-以上内容可以选择修改表格重新导入或者手动录入,系统经过验证，可以重复导入</p>
    </div>
      <div class="box-footer">
         <?=Html::a('回到管理页面',['index','flag'=>1],['class'=>'btn btn-primary'])?>
         <?=Html::a('强制导入',['import','flag'=>1],['class'=>'btn btn-danger pull-right'])?>
      </div>
    </div>
  </div>
<?php
}
?>
</div>