<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
/* @var $this yii\web\View */
/* @var $model backend\models\SignKszbm */

$this->title = "添加缴费信息";
$this->params['breadcrumbs'][] = ['label' => '新生报名', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '录取';
?>
<div class="sign-kszbm-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box box-primary">

    <!-- /.box-header -->
    <div class="box-body">
<div class="sign-kszbm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'zk_exam_id')->textInput(['style'=>'max-width:500px','readonly'=>'readonly']) ?>
    <?= $form->field($model, 'id_card')->textInput(['style'=>'max-width:500px','readonly'=>'readonly']) ?>
    <?= $form->field($model, 'name')->textInput(['style'=>'max-width:500px','readonly'=>'readonly']) ?>
    <?= $form->field($model, 'verify_msg')->textInput(['required'=>'required'])->label("缴费信息(元)") ?>
    <hr>
    <div class="form-group">
    	<p class="text-danger">注意：提交学生的缴费信息后将无法再修改该生信息</p>
        <?= Html::submitButton('提交信息，确定录取', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
