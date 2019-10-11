<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachManage */
//$teachers = $teachmod->getTeachersGroupBySubject();
//var_export($teachers);
//exit();

$this->title = '任教管理';
$this->params['breadcrumbs'][] = ['label' => 'Teach Manages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-manage-create">
<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">添加班级任教</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
  <div class="teach-manage-form">
  <div class="row">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-4">
    <?=Html::dropDownList('teacherid',null,$subjectteacher,['prompt' => '请选择教师','class'=>'form-control','style'=>'width:150px']);?>
    </div>
    <button type="submit" class="btn btn-primary">提交</button>
    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
</div>
