<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SignkszbmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sign-kszbm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'birth_place') ?>

    <?= $form->field($model, 'birth_date') ?>

    <?php // echo $form->field($model, 'origin_place') ?>

    <?php // echo $form->field($model, 'minzu') ?>

    <?php // echo $form->field($model, 'id_card') ?>

    <?php // echo $form->field($model, 'hukou_place') ?>

    <?php // echo $form->field($model, 'hukou_type') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'health') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'if_pre_educate') ?>

    <?php // echo $form->field($model, 'if_sigle') ?>

    <?php // echo $form->field($model, 'if_alone') ?>

    <?php // echo $form->field($model, 'if_ls') ?>

    <?php // echo $form->field($model, 'zk_exam_id') ?>

    <?php // echo $form->field($model, 'zk_score') ?>

    <?php // echo $form->field($model, 'zk_school') ?>

    <?php // echo $form->field($model, 'party_type') ?>

    <?php // echo $form->field($model, 'speciality') ?>

    <?php // echo $form->field($model, 'if_live') ?>

    <?php // echo $form->field($model, 'if_cload') ?>

    <?php // echo $form->field($model, 'if_en') ?>

    <?php // echo $form->field($model, 'if_help') ?>

    <?php // echo $form->field($model, 'dad_name') ?>

    <?php // echo $form->field($model, 'dad_nation') ?>

    <?php // echo $form->field($model, 'dad_hukou') ?>

    <?php // echo $form->field($model, 'dad_idcard') ?>

    <?php // echo $form->field($model, 'dad_phone') ?>

    <?php // echo $form->field($model, 'dad_company') ?>

    <?php // echo $form->field($model, 'dad_duty') ?>

    <?php // echo $form->field($model, 'mom_name') ?>

    <?php // echo $form->field($model, 'mom_nation') ?>

    <?php // echo $form->field($model, 'mom_hukou') ?>

    <?php // echo $form->field($model, 'mom_idcard') ?>

    <?php // echo $form->field($model, 'mom_phone') ?>

    <?php // echo $form->field($model, 'mom_company') ?>

    <?php // echo $form->field($model, 'mom_duty') ?>

    <?php // echo $form->field($model, 'if_uniform') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'verify') ?>

    <?php // echo $form->field($model, 'verify_time') ?>

    <?php // echo $form->field($model, 'verify_admin') ?>

    <?php // echo $form->field($model, 'verify_msg') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
