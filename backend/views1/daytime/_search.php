<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DaytimeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="day-time-schedule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sort') ?>

    <?= $form->field($model, 'part') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'start') ?>

    <?php // echo $form->field($model, 'end') ?>

    <?php // echo $form->field($model, 'grade') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
