<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dmstr\widgets\Alert;
/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachClass */
$this->title = '创建新班级';
$this->params['breadcrumbs'][] = ['label' => '班级', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
echo Alert::widget(['options'=>['class'=>'alert-info']]);
?>

<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">批量班级生成</h3>
</div>
<?php $form = ActiveForm::begin(); ?>
  <div class="box-body">
    <div class="form-group">
      <?=$form->field($model,'department')->dropDownList($departments,['prompt'=>"请选择部门",'class'=>'form-control'])?>
    </div>
    <div class="form-group">
      <?=$form->field($model,'start')->dropDownList(range(0,40),['prompt'=>'请选择班级序号','class'=>'form-control'])?>
    </div>
    <div class="form-group">
      <?=$form->field($model,'end')->dropDownList(range(0,40),['prompt'=>'请选择班级序号','id'=>'end','class'=>'form-control'])?>
      <p class="help-block">注意事项</p>
      <ul>
      	<li class="text-danger">班级名称同级部设置，请确认级部<b>年级选项</b>设置是否正确</li>
      	<li class="text-danger">所有生成班级类别为理科班，请稍后修改</li>
      	<li class="text-danger">班级标题生成格式：2018届18班</li>
      </ul>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <button type="submit" class="btn btn-primary">批量生成</button>
  </div>
    <?php ActiveForm::end(); ?>
</div>


