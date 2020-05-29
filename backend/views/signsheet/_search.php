<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SignsheetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sign-sheet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'old') ?>

    <?= $form->field($model, 'idcard') ?>

    <?php // echo $form->field($model, 'birth') ?>

    <?php // echo $form->field($model, 'graduate') ?>

    <?php // echo $form->field($model, 'cat1') ?>

    <?php // echo $form->field($model, 'cat2') ?>

    <?php // echo $form->field($model, 'cat3') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'graduate_id') ?>

    <?php // echo $form->field($model, 'prizedetail') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'parentname') ?>

    <?php // echo $form->field($model, 'parentrelation') ?>

    <?php // echo $form->field($model, 'parentphone') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
