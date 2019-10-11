<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DayTimeSchedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="day-time-schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'part')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
