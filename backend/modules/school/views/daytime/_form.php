<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachDaytime */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teach-daytime-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'department')->dropDownlist((new \yii\db\Query())
                                          ->select(['title','id'])
                                          ->from('teach_department')
                                          ->indexby('id')
                                          ->column()
                                      ) ?>

    <?= $form->field($model, 'sort')->dropDownlist(range(0,40)) ?>

    <?= $form->field($model, 'part')->dropDownlist(['上午'=>'上午','下午'=>'下午','晚上'=>'晚上']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
