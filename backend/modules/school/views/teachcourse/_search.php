<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachcourseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teach-course-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'class_id') ?>

    <?= $form->field($model, 'weekday') ?>

    <?= $form->field($model, 'day_time_id') ?>

    <?= $form->field($model, 'subject_id') ?>

    <?php // echo $form->field($model, 'subject2_id') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
