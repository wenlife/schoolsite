<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachCal */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="teach-cal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grade')->dropDownList(["1"=>'高一年级',"2"=>'高二年级','3'=>'高三年级','4'=>'全校']) ?>

    <?= $form->field($model, 'start')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => '请选择开始日期'],
        'pluginOptions' => [
           'format' => 'yyyy-mm-dd hh:ii', 
           // 'startDate' => '01-Mar-2014 12:00 AM',
           'todayHighlight' => true,
           'minView'=>"day",
            'todayBtn'=>1,
            'autoclose'=>1,
        ]
    ]);
    ?>
    <?= $form->field($model, 'end')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => '请选择学期结束日期'], 
        'pluginOptions' => [
           'format' => 'yyyy-mm-dd hh:ii', 
            //'startDate' => '01-Mar-2014 12:00 AM',
           'todayHighlight' => true,
           'minView'=>"day",
            'todayBtn'=>1,
            'autoclose'=>1,
        ]
    ],['autocomplete'=>"off"]);
     ?>

    <?= $form->field($model, 'color')->dropDownList(['#f0ad4e'=>'小黄人','#337ab7'=>'蓝精灵','#d9534f'=>'魔力红'])?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

