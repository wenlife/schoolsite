<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachCourseLimit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teach-course-limit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'department_id')->dropDownList((new \yii\db\Query())->select(['title','id'])->from('teach_department')->indexby('id')->column()) ?>

    <?= $form->field($model, 'course_id')->dropDownList(CommonFunction::getAllSubjects()) ?>

    <?= $form->field($model, 'course_limit')->dropDownList(range(0,20)) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
