<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachCourse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teach-course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class_id')->dropDownlist(
    (new \yii\db\Query())->select(['title','id'])->from("teach_class")->indexby('id')->column()
 
    ) ?>

    <?= $form->field($model, 'weekday')->dropDownlist(
     ['0'=>'星期天','1'=>'星期一','2'=>'星期二','3'=>'星期三','4'=>'星期四','5'=>'星期五','6'=>'星期六'],['prompt'=>'请选择日期......']
    ) ?>

    <?= $form->field($model, 'day_time_id')->textInput() ?>

    <?= $form->field($model, 'subject_id')->textInput() ?>

    <?= $form->field($model, 'subject2_id')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
