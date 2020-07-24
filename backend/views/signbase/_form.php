<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SignBase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sign-base-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xb')->textInput() ?>

    <?= $form->field($model, 'byzx')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bjdm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'csny')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lxdh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'txdz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfzh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yw')->textInput() ?>

    <?= $form->field($model, 'sx')->textInput() ?>

    <?= $form->field($model, 'wy')->textInput() ?>

    <?= $form->field($model, 'wl')->textInput() ?>

    <?= $form->field($model, 'hx')->textInput() ?>

    <?= $form->field($model, 'zz')->textInput() ?>

    <?= $form->field($model, 'ls')->textInput() ?>

    <?= $form->field($model, 'sw')->textInput() ?>

    <?= $form->field($model, 'dl')->textInput() ?>

    <?= $form->field($model, 'sy')->textInput() ?>

    <?= $form->field($model, 'ty')->textInput() ?>

    <?= $form->field($model, 'zf')->textInput() ?>

    <?= $form->field($model, 'lqzf')->textInput() ?>

    <?= $form->field($model, 'lqxx')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bmd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag')->dropDownlist(['0'=>'未录取','1'=>'已录取']) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
