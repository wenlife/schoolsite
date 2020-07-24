<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SignbaseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sign-base-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kh') ?>

    <?= $form->field($model, 'xm') ?>

    <?= $form->field($model, 'xb') ?>

    <?= $form->field($model, 'byzx') ?>

    <?php // echo $form->field($model, 'bjdm') ?>

    <?php // echo $form->field($model, 'csny') ?>

    <?php // echo $form->field($model, 'lxdh') ?>

    <?php // echo $form->field($model, 'txdz') ?>

    <?php // echo $form->field($model, 'sfzh') ?>

    <?php // echo $form->field($model, 'yw') ?>

    <?php // echo $form->field($model, 'sx') ?>

    <?php // echo $form->field($model, 'wy') ?>

    <?php // echo $form->field($model, 'wl') ?>

    <?php // echo $form->field($model, 'hx') ?>

    <?php // echo $form->field($model, 'zz') ?>

    <?php // echo $form->field($model, 'ls') ?>

    <?php // echo $form->field($model, 'sw') ?>

    <?php // echo $form->field($model, 'dl') ?>

    <?php // echo $form->field($model, 'sy') ?>

    <?php // echo $form->field($model, 'ty') ?>

    <?php // echo $form->field($model, 'zf') ?>

    <?php // echo $form->field($model, 'lqzf') ?>

    <?php // echo $form->field($model, 'lqxx') ?>

    <?php // echo $form->field($model, 'bmd') ?>

    <?php // echo $form->field($model, 'flag') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
