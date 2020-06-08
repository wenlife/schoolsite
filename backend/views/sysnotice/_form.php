<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;

/* @var $this yii\web\View */
/* @var $model backend\models\SysNotice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-notice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pos')->dropDownList(CommonFunction::getNoticepos()) ?>

    <?= $form->field($model, 'level')->dropDownList(CommonFunction::getNoticelevel()) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
